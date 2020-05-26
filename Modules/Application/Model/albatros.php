<?php
namespace D3\PdfDocuments\Modules\Application\Model;

interface albatros{
  public function setFilename($sContent, $target, $sFilename);
  public function setInvoiceNumber();
  public function setInvoiceDate();
  public function saveOrderOnChanges();
  public function getTemplate();
}