<?php

namespace D3\PdfDocuments\Modules\Application\Model;

class invoicePdf extends pdfDocuments{
  public function getTemplate(){
    return 'invoice.tpl';
  }
}