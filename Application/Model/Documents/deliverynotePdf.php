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

use D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder;

class deliverynotePdf extends pdfdocumentsOrder
{
    public function getRequestId(): string
    {
        return 'dnote';
    }

    public function getTitleIdent(): string
    {
        return "D3_PDFDOCUMENTS_DELIVERYNOTE";
    }

    public function getTypeForFilename(): string
    {
        return 'delnote';
    }

    public function getTemplate(): string
    {
        return 'd3deliverynote_pdf.tpl';
    }
}