<?php
require('deliverynotePdf.php');
require('invoicePdf.php');

interface pdfDocuments_interface{
  public function genPdf($sFilename, $iSelLang = 0, $target = 'I');
  public function setOrder(\OxidEsales\Eshop\Application\Model\Order $order);
  public function getOrder();
}