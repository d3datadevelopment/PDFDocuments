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

class deliverynotewithoutlogoPdf extends deliverynotePdf
{
    public function getRequestId(): string
    {
        return 'dnote_without_logo';
    }

    public function getTitleIdent(): string
    {
        return "D3_PDFDOCUMENTS_DELIVERYNOTE_WITHOUT_LOGO";
    }

    public function getTypeForFilename(): string
    {
        return 'delnote-nl';
    }

    public function getTemplate(): string
    {
        return 'd3deliverynoteNoLogo_pdf.tpl';
    }
}