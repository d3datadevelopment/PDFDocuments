<?php

/**
 * See LICENSE file for license details.
 * 
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

$sLangName = "English";

$basicAuthHelp = <<<HELP
If the current shop is protected by a BasicAuth, the images cannot be loaded when the PDF is generated. Enter the access data here to view the images.  
HELP;

$aLang     = array(
    'charset'                                            => 'utf-8',

    'SHOP_MODULE_GROUP_d3PdfDocumentsmain'               => 'Basic settings',
    'SHOP_MODULE_d3PdfDocumentsbDev'                     => 'Developer mode',
    'HELP_SHOP_MODULE_d3PdfDocumentsbDev'                => 'If developer mode is activated, the document is output in '.
                                                    'HTML format. This makes it much easier to trace content errors.',
    'SHOP_MODULE_d3PdfDocumentsbasicAuthUserName'        => 'BasicAuth of the shop - user name (optional)',
    'HELP_SHOP_MODULE_d3PdfDocumentsbasicAuthUserName'   => $basicAuthHelp,
    'SHOP_MODULE_d3PdfDocumentsbasicAuthPassword'        => 'BasicAuth of the shop - password (optional)',
    'HELP_SHOP_MODULE_d3PdfDocumentsbasicAuthPassword'   => $basicAuthHelp,

    'D3_PDFDOCUMENTS'                                    => 'PDF Documents',
    'D3_PDFDOCUMENTS_INVOICE'                            => 'Invoice',
    'D3_PDFDOCUMENTS_INVOICE_WITHOUT_LOGO'               => 'Invoice without logo',
    'D3_PDFDOCUMENTS_DELIVERYNOTE'                       => 'Deliverynote',
    'D3_PDFDOCUMENTS_DELIVERYNOTE_WITHOUT_LOGO'          => 'Deliverynote without logo',

    'D3_PDFDOCUMENTS_PDF_TYPE'                           => 'Document',
    'D3_PDFDOCUMENTS_LANGUAGE'                           => 'Language',
    'D3_PDFDOCUMENTS_PDF_GENERATE'                       => 'Create Document',
);
