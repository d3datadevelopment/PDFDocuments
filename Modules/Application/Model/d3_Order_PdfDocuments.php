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

use D3\PdfDocuments\Application\Controller\orderOverviewPdfGenerator;
use D3\PdfDocuments\Application\Model\Exceptions\noBaseObjectSetException;
use D3\PdfDocuments\Application\Model\Exceptions\noPdfHandlerFoundException;
use D3\PdfDocuments\Application\Model\Exceptions\pdfGeneratorExceptionAbstract;

class d3_Order_PdfDocuments extends d3_Order_PdfDocuments_parent
{
    /**
     * compatibility to OXID Invoice PDF module
     * @param string $sFilename
     * @param int $iSelLang
     * @param string $target
     * @throws noBaseObjectSetException
     * @throws noPdfHandlerFoundException
     * @throws pdfGeneratorExceptionAbstract
     */
    public function genPdf($sFilename, $iSelLang = 0, $target = 'I')
    {
        $generator = oxNew( orderOverviewPdfGenerator::class );
        $generator->generatePdf($this, $sFilename, $iSelLang, $target);
    }
}
