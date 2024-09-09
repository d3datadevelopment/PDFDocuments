<?php

/**
 * See LICENSE file for license details.
 * 
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

use D3\PdfDocuments\Application\Model\Constants;

$sLangName = "English";
$aLang     = array(
    'charset'                                            => 'utf-8',

    'SHOP_MODULE_GROUP_d3PdfDocumentsmain'               => 'Basic settings',
	'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'bDev'     => 'Developer mode',

    'D3_PDFDOCUMENTS'                                    => 'PDF Documents',
    'D3_PDFDOCUMENTS_INVOICE'                            => 'Invoice',
    'D3_PDFDOCUMENTS_INVOICE_WITHOUT_LOGO'               => 'Invoice without logo',
    'D3_PDFDOCUMENTS_DELIVERYNOTE'                       => 'Deliverynote',
    'D3_PDFDOCUMENTS_DELIVERYNOTE_WITHOUT_LOGO'          => 'Deliverynote without logo',

    'D3_PDFDOCUMENTS_PDF_TYPE'                           => 'Document',
    'D3_PDFDOCUMENTS_LANGUAGE'                           => 'Language',
    'D3_PDFDOCUMENTS_PDF_GENERATE'                       => 'Create Document',
);
