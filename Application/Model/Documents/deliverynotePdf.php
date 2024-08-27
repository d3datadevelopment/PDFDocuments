<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\Documents;

use D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder;

class deliverynotePdf extends pdfdocumentsOrder
{
    /**
     * @return string
     */
    public function getRequestId()
    {
        return 'dnote';
    }

    /**
     * @return string
     */
    public function getTitleIdent()
    {
        return "D3_PDFDOCUMENTS_DELIVERYNOTE";
    }

    /**
     * @return string
     */
    public function getTypeForFilename()
    {
        return 'delnote';
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return '@d3PdfDocuments/documents/deliverynote/d3deliverynote_pdf.tpl';
    }
}