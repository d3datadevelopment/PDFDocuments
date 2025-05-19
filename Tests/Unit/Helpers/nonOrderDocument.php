<?php

namespace D3\PdfDocuments\Tests\Unit\Helpers;

use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsGenericInterface;

class nonOrderDocument implements pdfdocumentsGenericInterface
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

    public function getHTMLContent(): string
    {
        return "HtmlContent";
    }

    public function downloadPdf(int $language = 0): void
    {
    }

    public function getPdfContent(int $language = 0): ?string
    {
        return "pdfContent";
    }

    public function savePdfFile(string $path, int $language = 0): void
    {
    }

    public function genPdf(string $filename, int $language = 0, string $target = 'I'): ?string
    {
        return null;
    }

    public function setFilename(string $filename): void
    {
    }

    public function getFilename(): string
    {
        return 'filename';
    }

    public function addFilenameExtension(string $filename): string
    {
        return 'filenameExtension';
    }
}