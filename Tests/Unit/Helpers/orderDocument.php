<?php

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Tests\Unit\Helpers;

use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderInterface;
use OxidEsales\Eshop\Application\Model\Order;

class orderDocument implements pdfdocumentsOrderInterface
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

    public function setDevelopmentMode(bool $devMode): void
    {
    }

    public function setOrder(Order $order): void
    {
    }

    public function getOrder(): Order
    {
        return oxNew(Order::class);
    }

    public function getTypeForFilename(): string
    {
        return 'typeForFilename';
    }
}
