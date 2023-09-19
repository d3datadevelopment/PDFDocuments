<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\Interfaces;

interface pdfdocumentsGenericInterface
{
    /**
     * @return string
     */
    public function getRequestId();

    /**
     * @return string
     */
    public function getTitleIdent();

    /**
     * @return string
     */
    public function getTemplate();

    /**
     * @return mixed
     */
    public function getHTMLContent();

    /**
     * @param int $iLanguage
     */
    public function downloadPdf($iLanguage = 0);

    /**
     * @param int $iLanguage
     *
     * @return string|null
     */
    public function getPdfContent($iLanguage = 0);

    /**
     * @param string $path
     * @param int $iLanguage
     */
    public function savePdfFile($path, $iLanguage = 0);

    /**
     * @param        $sFilename
     * @param int    $iSelLang
     * @param string $target
     *
     * @return mixed
     */
    public function genPdf($sFilename, $iSelLang = 0, $target = 'I');

    /**
     * @param string $filename
     */
    public function setFilename($filename);

    /**
     * @return string
     */
    public function getFilename();

    /**
     * @param string $filename
     *
     * @return string
     */
    public function addFilenameExtension($filename);
}