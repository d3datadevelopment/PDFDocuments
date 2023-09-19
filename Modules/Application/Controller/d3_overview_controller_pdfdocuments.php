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
use OxidEsales\Eshop\Application\Controller\Admin\OrderOverview;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\TableViewNameGenerator;

if (false) {
    class_alias(
        d3_overview_controller_pdfdocuments_parent::class,
        OrderOverview::class
    );
}

class d3_overview_controller_pdfdocuments extends d3_overview_controller_pdfdocuments_parent
{
    /**
     * @return bool
     * @throws DatabaseConnectionException
     */
    public function d3CanExport()
    {
        // We force reading from master to prevent issues with slow replications or open transactions (see ESDEV-3804).
        $masterDb = DatabaseProvider::getMaster();
        $sOrderId = $this->getEditObjectId();

        $viewNameGenerator = Registry::get(TableViewNameGenerator::class);
        $sTable = $viewNameGenerator->getViewName("oxorderarticles");

        $sQ = "select count(oxid) from $sTable where oxorderid = " . $masterDb->quote($sOrderId) . " and oxstorno = 0";
        return (bool) $masterDb->getOne($sQ);
    }

    /**
     * @throws noPdfHandlerFoundException
     * @throws pdfGeneratorExceptionAbstract
     */
    public function d3CreatePDF()
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

    /**
    * @return registryOrderoverview
    */
    public function d3getGeneratorList()
    {
        return oxNew(registryOrderoverview::class);
    }
}