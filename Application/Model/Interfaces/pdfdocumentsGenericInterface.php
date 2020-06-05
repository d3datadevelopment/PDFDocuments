<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\Interfaces;

use D3\PdfDocuments\Application\Model\Exceptions\noBaseObjectSetException;

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
     * @param        $sFilename
     * @param int    $iSelLang
     * @param string $target
     *
     * @return mixed
     * @throws noBaseObjectSetException
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
}