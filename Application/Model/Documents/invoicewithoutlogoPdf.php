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
