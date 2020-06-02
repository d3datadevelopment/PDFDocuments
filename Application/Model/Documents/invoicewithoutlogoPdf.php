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

namespace D3\PdfDocuments\Application\Model\Documents;

class invoicewithoutlogoPdf extends invoicePdf
{
    /**
     * @return string
     */
    public function getRequestId()
    {
        // same like in OXID PDF module
        return 'standart_without_logo';
    }

    /**
     * @return string
     */
    public function getTitleIdent()
    {
        return "ORDER_OVERVIEW_PDF_STANDART_WITHOUT_LOGO";
    }

    /**
     * @return string
     */
    public function getTemplate(){
        return 'd3invoiceNoLogo_pdf.tpl';
    }
}