<?php
namespace D3\PdfDocuments\Modules\Application\controllers;

use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\TableViewNameGenerator;

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
      // load object
      $oOrder = oxNew(Order::class);
      if ($oOrder->load($soxId)) {
        self::$_blIsAdmin = 0;
        $oUtils = Registry::getUtils();
        $sTrimmedBillName = trim($oOrder->oxorder__oxbilllname->getRawValue());
        $sFilename = $oOrder->oxorder__oxordernr->value . "_" . $sTrimmedBillName . ".pdf";
        $sFilename = $this->makeValidFileName($sFilename);
        ob_start();
        $oOrder->genPDF($sFilename, Registry::getConfig()->getRequestParameter("pdflanguage"));
        $sPDF = ob_get_contents();
        ob_end_clean();
        $oUtils->setHeader("Pragma: public");
        $oUtils->setHeader("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        $oUtils->setHeader("Expires: 0");
        $oUtils->setHeader("Content-type: application/pdf");
        $oUtils->setHeader("Content-Disposition: attachment; filename=" . $sFilename);
        Registry::getUtils()->showMessageAndExit($sPDF);
      }
    }
  }
}