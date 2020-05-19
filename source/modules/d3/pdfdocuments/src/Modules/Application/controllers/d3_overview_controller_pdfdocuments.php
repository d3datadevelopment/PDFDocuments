<?php
namespace D3\PdfDocuments\Modules\Application\controllers;

class d3_overview_controller_pdfdocuments extends d3_overview_controller_pdfdocuments_parent
{
  public function canExport()
  {
    // We force reading from master to prevent issues with slow replications or open transactions (see ESDEV-3804).
    $masterDb = \OxidEsales\Eshop\Core\DatabaseProvider::getMaster();
    $sOrderId = $this->getEditObjectId();

    $viewNameGenerator = \OxidEsales\Eshop\Core\Registry::get(\OxidEsales\Eshop\Core\TableViewNameGenerator::class);
    $sTable = $viewNameGenerator->getViewName("oxorderarticles");

    $sQ = "select count(oxid) from {$sTable} where oxorderid = " . $masterDb->quote($sOrderId) . " and oxstorno = 0";
    $blCan = (bool) $masterDb->getOne($sQ);

    return $blCan;
  }

  public function createPDF()
  {
    echo __LINE__;
    $soxId = $this->getEditObjectId();
    if ($soxId != "-1" && isset($soxId)) {
      echo __LINE__;
      // load object
      $oOrder = oxNew(\OxidEsales\Eshop\Application\Model\Order::class);
      if ($oOrder->load($soxId)) {
        echo __LINE__;
        $oUtils = \OxidEsales\Eshop\Core\Registry::getUtils();
        $sTrimmedBillName = trim($oOrder->oxorder__oxbilllname->getRawValue());
        $sFilename = $oOrder->oxorder__oxordernr->value . "_" . $sTrimmedBillName . ".pdf";
        $sFilename = $this->makeValidFileName($sFilename);
        //ob_start();
        echo __LINE__;
        $oOrder->genPDF($sFilename, \OxidEsales\Eshop\Core\Registry::getConfig()->getRequestParameter("pdflanguage"));
        die();
        $sPDF = ob_get_contents();
        ob_end_clean();
        $oUtils->setHeader("Pragma: public");
        $oUtils->setHeader("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        $oUtils->setHeader("Expires: 0");
        $oUtils->setHeader("Content-type: application/pdf");
        $oUtils->setHeader("Content-Disposition: attachment; filename=" . $sFilename);
        \OxidEsales\Eshop\Core\Registry::getUtils()->showMessageAndExit($sPDF);
      }
    }
  }
}