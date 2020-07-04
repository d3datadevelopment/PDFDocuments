<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
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
        return "D3_PDFDOCUMENTS_INVOICE_WITHOUT_LOGO";
    }

    /**
     * @return string
     */
    public function getTypeForFilename()
    {
        return 'invoice-nl';
    }

    /**
     * @return string
     */
    public function getTemplate(){
        return 'd3invoiceNoLogo_pdf.tpl';
    }
}