<?php

namespace D3\PdfDocuments\Tests\Unit\Helpers;

use D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric;

class nonOrderDocument extends pdfDocumentsGeneric
{
    public function getRequestId(): string
    {
        return 'requestId';
    }

    public function getTitleIdent(): string
    {
        return 'titleIdent';
    }

    public function getTemplate(): string
    {
        return 'template';
    }

    public function getTypeForFilename(): string
    {
        return 'nonOrderDocument';
    }
}