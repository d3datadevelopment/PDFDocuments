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

use D3\PdfDocuments\Application\Model\Constants;

// @codeCoverageIgnoreStart
$basicAuthHelp = <<<HELP
    If the current shop is protected by a BasicAuth, the images cannot be loaded when the PDF is generated. Enter the access data here to view the images.  
    HELP;

return [
    'charset'                                            => 'utf-8',

    'SHOP_MODULE_GROUP_'. Constants::OXID_MODULE_ID.'main'               => 'Basic settings',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'bDev'     => 'Developer mode',
    'HELP_SHOP_MODULE_'. Constants::OXID_MODULE_ID.'bDev'                => 'If developer mode is activated, the document is output in '.
                                                    'HTML format. This makes it much easier to trace content errors.',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'basicAuthUserName'        => 'BasicAuth of the shop - user name (optional)',
    'HELP_SHOP_MODULE_'. Constants::OXID_MODULE_ID.'basicAuthUserName'   => $basicAuthHelp,
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'basicAuthPassword'        => 'BasicAuth of the shop - password (optional)',
    'HELP_SHOP_MODULE_'. Constants::OXID_MODULE_ID.'basicAuthPassword'   => $basicAuthHelp,

    'SHOP_MODULE_GROUP_'. Constants::OXID_MODULE_ID.'invoice'           => 'Invoice',
    'SHOP_MODULE_invoicePaymentTerm'                                    => 'Payment term (in days)',

    'SHOP_MODULE_GROUP_'. Constants::OXID_MODULE_ID.'contents'           => 'Contents',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'LogoUrl'                  => 'Logo image URL',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'BackgroundUrl'            => 'Background image URL',

    'SHOP_MODULE_GROUP_'. Constants::OXID_MODULE_ID.'documents'          => 'Documents',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'DocInvoice'               => 'Invoice',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'DocInvoiceNoLogo'         => 'Invoice without logo',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'DocDeliveryNote'          => 'Delivery note',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'DocDeliveryNoteNoLogo'    => 'Delivery note without logo',

    'D3_PDFDOCUMENTS'                                    => 'PDF Documents',
    'D3_PDFDOCUMENTS_INVOICE'                            => 'Invoice',
    'D3_PDFDOCUMENTS_INVOICE_WITHOUT_LOGO'               => 'Invoice without logo',
    'D3_PDFDOCUMENTS_DELIVERYNOTE'                       => 'Delivery note',
    'D3_PDFDOCUMENTS_DELIVERYNOTE_WITHOUT_LOGO'          => 'Delivery note without logo',

    'D3_PDFDOCUMENTS_PDF_TYPE'                           => 'Document',
    'D3_PDFDOCUMENTS_LANGUAGE'                           => 'Language',
    'D3_PDFDOCUMENTS_SGML_GENERATE'                      => 'Create SGML',
    'D3_PDFDOCUMENTS_PDF_GENERATE'                       => 'Create Document',
];
// @codeCoverageIgnoreEnd