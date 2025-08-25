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

use Assert\Assert;
use Assert\InvalidArgumentException;
use D3\PdfDocuments\Application\Controller\orderOverviewPdfGenerator;
use D3\PdfDocuments\Application\Model\Exceptions\noPdfHandlerFoundException;
use D3\PdfDocuments\Application\Model\Registries\registryOrderoverview;
use D3\PdfDocuments\Application\Model\Registries\registryOrderoverviewInterface;
use Doctrine\DBAL\Driver\Exception as DBALDriverException;
use ErrorException;
use Exception;
use Doctrine\DBAL\Exception as DBALException;
use Doctrine\DBAL\Query\QueryBuilder;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\TableViewNameGenerator;
use OxidEsales\Eshop\Core\ViewHelper\JavaScriptRegistrator;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class d3_overview_controller_pdfdocuments extends d3_overview_controller_pdfdocuments_parent
{
    protected ?string $generatorError = null;
    protected bool $doReload = false;

    public function render()
    {
        $this->addTplParam('d3PdfDocumentGeneratorList', $this->d3getGeneratorList());

        if ($this->doReload) {
            $formReload = <<<HTML
                <html lang="de">
                <body>
                <script>
                let form = top.basefrm.edit.document.getElementById("transfer");
                let input = document.createElement("input");
                input.setAttribute("type", "hidden");
                input.setAttribute("name", "generatorError");
                input.setAttribute("id", "generatorError");
                input.setAttribute("value", encodeURIComponent('$this->generatorError'));
                form.appendChild(input);
                form.submit();
                </script>
                </body>
                </html>
                HTML;
            Registry::getUtils()->showMessageAndExit($formReload);
        } elseif ($generatorError = Registry::getRequest()->getRequestParameter('generatorError')) {
            Registry::getUtilsView()->addErrorToDisplay(urldecode($generatorError));
            $register = oxNew(JavaScriptRegistrator::class);
            $script = <<<JS
                top.basefrm.edit.document.getElementById('generatorError').remove();
                JS;
            $register->addSnippet($script);
        }

        return parent::render();
    }

    /**
     * @return bool
     */
    public function d3PdfDocsIsDevMode(): bool
    {
        return Registry::getConfig()->getConfigParam('d3PdfDocumentsbDev');
    }

    /**
     * @throws DBALDriverException
     */
    public function d3CanExport(): bool
    {
        try {
            $sOrderId = $this->getEditObjectId();
            Assert::that($sOrderId)->string()->notSame('-1');
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
//                        $queryBuilder->expr()->eq('oxstorno', $queryBuilder->createNamedParameter(0, ParameterType::INTEGER))
                    )
                );
            return (bool) $queryBuilder->execute()->fetchOne();
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface|DBALException|InvalidArgumentException $e) {
            unset($e);
            return false;
        }
    }

    /**
     * @throws noPdfHandlerFoundException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function d3CreatePDF(): void
    {
        try {
            $oldErrorHandlder = set_error_handler(
                [$this, 'exception_error_handler'],
                E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
            );
            $soxId = $this->getEditObjectId();
            $language = Registry::getRequest()->getRequestEscapedParameter("pdflanguage");
            Assert::that($soxId)->string()->notSame('-1');
            Assert::that($language)->integerish();
            $oOrder = $this->d3PdfGetOrder();
            Assert::that($oOrder->load($soxId))->true();
            $generator = $this->d3PdfGetGeneratorController();
            $generator->generatePdf($oOrder, $language);
        } catch (Exception $exception) {
            $this->doReload = true;
            Registry::getLogger()->error($exception->getMessage(), [ 'exception' => $exception ]);
            $this->generatorError = 'PDF documents: ' . $exception->getMessage();
        } finally {
            set_error_handler($oldErrorHandlder);
        }
    }

    /**
     * @codeCoverageIgnore
     */
    public function d3PdfGetOrder(): Order
    {
        return oxNew(Order::class);
    }

    /**
     * @codeCoverageIgnore
     */
    public function d3PdfGetGeneratorController(): orderOverviewPdfGenerator
    {
        return oxNew(orderOverviewPdfGenerator::class);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @codeCoverageIgnore
     */
    public function d3getGeneratorList(): ?registryOrderoverview
    {
        try {
            return ContainerFactory::getInstance()->getContainer()->get( registryOrderoverviewInterface::class );
        } catch (Exception $exception) {
            Registry::getUtilsView()->addErrorToDisplay($exception->getMessage());
        }

        return null;
    }

    /**
     * @codeCoverageIgnore
     * @throws ErrorException
     */
    public function exception_error_handler(int $errno, string $errstr, ?string $errfile = null, ?int $errline  = null): void
    {
        // don't catch stupid OXID errors when getting bill country name
        if ((stristr($errstr, "Undefined property:") && stristr($errstr, "oxbillcountry")) ||
            (stristr($errstr, 'Attempt to read property "value" on null'))
        ) {
            return;
        }

        if (!(error_reporting() & $errno)) {
            // This error code is not included in error_reporting
            return;
        }

        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }
}
