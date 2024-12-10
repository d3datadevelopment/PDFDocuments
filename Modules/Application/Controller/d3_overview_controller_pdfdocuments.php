<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Modules\Application\Controller;

use D3\PdfDocuments\Application\Controller\orderOverviewPdfGenerator;
use D3\PdfDocuments\Application\Model\Exceptions\noPdfHandlerFoundException;
use D3\PdfDocuments\Application\Model\Exceptions\pdfGeneratorExceptionAbstract;
use D3\PdfDocuments\Application\Model\Registries\registryOrderoverview;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\DBAL\Exception as DBALException;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Query\QueryBuilder;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\TableViewNameGenerator;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class d3_overview_controller_pdfdocuments extends d3_overview_controller_pdfdocuments_parent
{
    /**
     * @return bool
     * @throws Exception
     */
    public function d3CanExport(): bool
    {
        try {
            $sOrderId = $this->getEditObjectId();

            $viewNameGenerator = Registry::get( TableViewNameGenerator::class );
            $sTable            = $viewNameGenerator->getViewName( "oxorderarticles" );

            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = ContainerFactory::getInstance()->getContainer()->get( QueryBuilderFactoryInterface::class )->create();
            $queryBuilder
                ->select( 'oxid' )
                ->from( $sTable )
                ->where(
                    $queryBuilder->expr()->and(
                        $queryBuilder->expr()->eq( 'oxorderid', $queryBuilder->createNamedParameter( $sOrderId ) ),
                        $queryBuilder->expr()->eq( 'oxstorno', $queryBuilder->createNamedParameter( 0, ParameterType::INTEGER ) )
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
        $soxId = $this->getEditObjectId();
        if ($soxId != "-1" && isset($soxId)) {
            /** @var Order $oOrder */
            $oOrder = oxNew(Order::class);
            if ($oOrder->load($soxId)) {
                $generator = oxNew( orderOverviewPdfGenerator::class );
                $generator->generatePdf($oOrder, Registry::getRequest()->getRequestEscapedParameter("pdflanguage"));
            }
        }
    }

    public function d3getGeneratorList(): registryOrderoverview
    {
        return oxNew(registryOrderoverview::class);
    }
}