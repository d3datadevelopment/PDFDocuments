<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Modules\Application\controllers;

use D3\PdfDocuments\Application\Model\Exceptions\pdfGeneratorExceptionAbstract;
use D3\PdfDocuments\Application\Model\Registries\registryOrderoverview;
use D3\PdfDocuments\Modules\Application\Model\d3_Order_PdfDocuments;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\TableViewNameGenerator;
use OxidEsales\Eshop\Core\UtilsView;

class d3_overview_controller_pdfdocuments extends d3_overview_controller_pdfdocuments_parent
{
  public function canExport()
  {
    // We force reading from master to prevent issues with slow replications or open transactions (see ESDEV-3804).
    $masterDb = DatabaseProvider::getMaster();
    $sOrderId = $this->getEditObjectId();

    $viewNameGenerator = Registry::get(TableViewNameGenerator::class);
    $sTable = $viewNameGenerator->getViewName("oxorderarticles");

    $sQ = "select count(oxid) from {$sTable} where oxorderid = " . $masterDb->quote($sOrderId) . " and oxstorno = 0";
    $blCan = (bool) $masterDb->getOne($sQ);

    return $blCan;
  }

  public function createPDF()
  {
    $soxId = $this->getEditObjectId();
    if ($soxId != "-1" && isset($soxId)) {
      /** @var d3_Order_PdfDocuments $oOrder */
      $oOrder = oxNew(Order::class);
      if ($oOrder->load($soxId)) {
          try {
              self::$_blIsAdmin = 0;
              $oUtils = Registry::getUtils();
              $sTrimmedBillName = trim($oOrder->oxorder__oxbilllname->getRawValue());
              //oxbillr nicht so eingeschrieben lassen
              $sFilename = $oOrder->oxorder__oxbillnr->value . "_" . $sTrimmedBillName . ".pdf";
              $sFilename = $this->makeValidFileName($sFilename);
              ob_start();
              $oOrder->genPdf($sFilename, Registry::getConfig()->getRequestParameter("pdflanguage"));
              $sPDF = ob_get_contents();
              ob_end_clean();
              $oUtils->setHeader("Pragma: public");
              $oUtils->setHeader("Cache-Control: must-revalidate, post-check=0, pre-check=0");
              $oUtils->setHeader("Expires: 0");
              $oUtils->setHeader("Content-type: application/pdf");
              $oUtils->setHeader("Content-Disposition: attachment; filename=" . $sFilename);
              Registry::getUtils()->showMessageAndExit($sPDF);
          } catch (pdfGeneratorExceptionAbstract $e) {
              Registry::get(UtilsView::class)->addErrorToDisplay($e);
              Registry::getLogger()->error($e);
          }
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