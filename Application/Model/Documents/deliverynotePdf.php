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
        return 'd3deliverynote_pdf.tpl';
    }
}