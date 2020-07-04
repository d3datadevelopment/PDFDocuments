<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\Documents;

class deliverynotewithoutlogoPdf extends deliverynotePdf
{
    /**
     * @return string
     */
    public function getRequestId()
    {
        return 'dnote_without_logo';
    }

    /**
     * @return string
     */
    public function getTitleIdent()
    {
        return "D3_PDFDOCUMENTS_DELIVERYNOTE_WITHOUT_LOGO";
    }

    /**
     * @return string
     */
    public function getTypeForFilename()
    {
        return 'delnote-nl';
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'd3deliverynoteNoLogo_pdf.tpl';
    }
}