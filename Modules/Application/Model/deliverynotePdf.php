<?php

namespace D3\PdfDocuments\Modules\Application\Model;

class deliverynotePdf extends pdfDocuments{
  public function getTemplate(){
    return 'deliverynote.tpl';
  }
}