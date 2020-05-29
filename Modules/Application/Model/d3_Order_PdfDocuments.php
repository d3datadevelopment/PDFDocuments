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
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Modules\Application\Model;

use D3\PdfDocuments\Application\Controller\orderPdfGenerator;

class d3_Order_PdfDocuments extends d3_Order_PdfDocuments_parent
{
    /**
     * @param string $sFilename
     * @param int $iSelLang
     * @param string $target
     */
    public function genPdf($sFilename, $iSelLang = 0, $target = 'I')
    {
        $generator = oxNew( orderPdfGenerator::class );
        $generator->generatePdf($this, $sFilename, $iSelLang, $target);
    }
}
