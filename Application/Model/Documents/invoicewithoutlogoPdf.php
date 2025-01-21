<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

declare(strict_types = 1);

namespace D3\PdfDocuments\Application\Model\Documents;

class invoicewithoutlogoPdf extends invoicePdf
{
    public function getRequestId(): string
    {
        return 'invoice_without_logo';
    }

    public function getTitleIdent(): string
    {
        return "D3_PDFDOCUMENTS_INVOICE_WITHOUT_LOGO";
    }

    public function getTypeForFilename(): string
    {
        return 'invoice-nl';
    }

    public function getTemplate(): string
    {
        return 'd3invoiceNoLogo_pdf.tpl';
    }
}