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

declare(strict_types=1);

namespace D3\PdfDocuments\Application\Model\Interfaces;

interface pdfdocumentsGenericInterface
{
    public function setDevelopmentMode(bool $devMode);
    
    public function getRequestId(): string;

    public function getTitleIdent(): string;

    public function getTemplate(): string;

    public function getHTMLContent(): string;

    public function downloadPdf(int $language = 0): void;

    public function getPdfContent(int $language = 0): ?string;

    public function savePdfFile(string $path, int $language = 0): void;

    public function genPdf(string $filename, int $language = 0, string $target = 'I'): ?string;

    public function setFilename(string $filename): void;

    public function getFilename(): string;

    public function addFilenameExtension(string $filename): string;
}
