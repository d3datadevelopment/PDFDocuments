<?php

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Modules\Application\Controller;

use D3\PdfDocuments\Application\Controller\orderOverviewPdfGenerator;
use D3\PdfDocuments\Application\Model\Exceptions\noPdfHandlerFoundException;
use D3\PdfDocuments\Application\Model\Exceptions\pdfGeneratorExceptionAbstract;
use D3\PdfDocuments\Application\Model\Exceptions\wrongPdfGeneratorInterface;
use D3\PdfDocuments\Application\Model\Registries\registryOrderoverview;
use D3\PdfDocuments\Application\Model\Registries\registryOrderoverviewInterface;
use Doctrine\DBAL\Driver\Exception as DBALDriverException;
use ErrorException;
use Exception;
use Doctrine\DBAL\Exception as DBALException;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Query\QueryBuilder;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\TableViewNameGenerator;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class d3_overview_controller_pdfdocuments extends d3_overview_controller_pdfdocuments_parent
{
    private ?string $generatorError = null;

    public function render()
    {
        if ($this->generatorError) {
            echo <<<HTML
                <html lang="de">
                <body>
                <script>
                let form = top.basefrm.edit.document.getElementById("transfer");
                let input = document.createElement("input");
                input.setAttribute("type", "hidden");
                input.setAttribute("name", "generatorError");
                input.setAttribute("value", encodeURIComponent('$this->generatorError'));
                form.appendChild(input);
                form.submit();
                </script>
                </body>
                </html>
                HTML;
            Registry::getUtils()->showMessageAndExit('');
        } elseif ($generatorError = Registry::getRequest()->getRequestParameter('generatorError')) {
            Registry::getUtilsView()->addErrorToDisplay(urldecode($generatorError));
        }

        return parent::render();
    }

    /**
     * @throws DBALDriverException
     */
    public function d3CanExport(): bool
    {
        try {
            $sOrderId = $this->getEditObjectId();

            $viewNameGenerator = Registry::get(TableViewNameGenerator::class);
            $sTable            = $viewNameGenerator->getViewName("oxorderarticles");

            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
            $queryBuilder
                ->select('oxid')
                ->from($sTable)
                ->where(
                    $queryBuilder->expr()->and(
                        $queryBuilder->expr()->eq('oxorderid', $queryBuilder->createNamedParameter($sOrderId)),
                        $queryBuilder->expr()->eq('oxstorno', $queryBuilder->createNamedParameter(0, ParameterType::INTEGER))
                    )
                );

            return $queryBuilder->execute()->fetchOne();
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface|DBALException) {
            return false;
        }
    }

    /**
     * @throws noPdfHandlerFoundException
     * @throws pdfGeneratorExceptionAbstract
     */
    public function d3CreatePDF(): void
    {
        try {
            $oldErrorHandlder = set_error_handler(
                [$this, 'exception_error_handler'],
                E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
            );
            $soxId = $this->getEditObjectId();
            if ($soxId != "-1" && isset($soxId)) {
                /** @var Order $oOrder */
                $oOrder = oxNew(Order::class);
                if ($oOrder->load($soxId)) {
                    $generator = oxNew(orderOverviewPdfGenerator::class);
                    $generator->generatePdf($oOrder, Registry::getRequest()->getRequestEscapedParameter("pdflanguage"));
                }
            }
        } catch (Exception $exception) {
            Registry::getLogger()->error($exception->getMessage(), [ 'exception' => $exception ]);
            $this->generatorError = 'PDF documents: ' . $exception->getMessage();
        } finally {
            set_error_handler($oldErrorHandlder);
        }
    }

    /**
     * @return registryOrderoverview
     * @throws wrongPdfGeneratorInterface
     */
    public function d3getGeneratorList(): registryOrderoverview
    {
        return ContainerFactory::getInstance()->getContainer()->get(registryOrderoverviewInterface::class);
    }

    public function exception_error_handler(int $errno, string $errstr, ?string $errfile = null, ?int $errline  = null)
    {
        if (!(error_reporting() & $errno)) {
            // This error code is not included in error_reporting
            return;
        }

        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }
}
