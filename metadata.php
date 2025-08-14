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

use D3\PdfDocuments\Application\Model\Constants as Constants;
use D3\PdfDocuments\Modules\Application\Controller\d3_overview_controller_pdfdocuments;
use OxidEsales\Eshop\Application\Controller\Admin\OrderOverview;

// @codeCoverageIgnoreStart
$sMetadataVersion = '2.1';

$aModule = [
    'id'            => Constants::OXID_MODULE_ID,
    'title'         => [
        'de'        => '(D3) PDF-Dokumente',
        'en'        => '(D3) PDF documents',
    ],
    'version'       => '1.0.4.0',
    'author'        => 'D3 Data Development (Inh.: Thomas Dartsch)',
    'email'         => 'support@shopmodule.com',
    'url'           => 'https://www.oxidmodule.com/',
    'extend'        => [
        OrderOverview::class    => d3_overview_controller_pdfdocuments::class,
    ],
    'controllers'   => [],
    'thumbnail'     => 'picture.svg',
    'templates'     => [
        'd3orderoverview_pdfform.tpl'   => 'd3/pdfdocuments/Application/views/tpl/admin/orderoverview_pdfform.tpl',

        'd3deliverynote_pdf.tpl'        => 'd3/pdfdocuments/Application/views/tpl/documents/deliverynote/deliverynote.tpl',
        'd3deliverynoteNoLogo_pdf.tpl'  => 'd3/pdfdocuments/Application/views/tpl/documents/deliverynote/deliverynoteNoLogo.tpl',
        'd3delnote_pdf_informations.tpl'=> 'd3/pdfdocuments/Application/views/tpl/documents/deliverynote/inc/informations.tpl',
        'd3delnote_pdf_recipient.tpl'   => 'd3/pdfdocuments/Application/views/tpl/documents/deliverynote/inc/recipientAddress.tpl',
        'd3delnote_pdf_salutation.tpl'  => 'd3/pdfdocuments/Application/views/tpl/documents/deliverynote/inc/salutation.tpl',
        'd3delnote_pdf_conclusion.tpl'  => 'd3/pdfdocuments/Application/views/tpl/documents/deliverynote/inc/conclusion.tpl',

        'd3invoice_pdf.tpl'             => 'd3/pdfdocuments/Application/views/tpl/documents/invoice/invoice.tpl',
        'd3invoiceNoLogo_pdf.tpl'       => 'd3/pdfdocuments/Application/views/tpl/documents/invoice/invoiceNoLogo.tpl',
        'd3invoice_pdf_informations.tpl'=> 'd3/pdfdocuments/Application/views/tpl/documents/invoice/inc/informations.tpl',
        'd3invoice_pdf_salutation.tpl'  => 'd3/pdfdocuments/Application/views/tpl/documents/invoice/inc/salutation.tpl',
        'd3invoice_pdf_conclusion.tpl'  => 'd3/pdfdocuments/Application/views/tpl/documents/invoice/inc/conclusion.tpl',
        'd3invoice_pdf_payinfo.tpl'     => 'd3/pdfdocuments/Application/views/tpl/documents/invoice/inc/payinfo.tpl',

        'd3pdfbase.tpl'                 => 'd3/pdfdocuments/Application/views/tpl/documents/inc/page/base.tpl',
        'd3pdfheader.tpl'               => 'd3/pdfdocuments/Application/views/tpl/documents/inc/page/header.tpl',
        'd3pdffooter.tpl'               => 'd3/pdfdocuments/Application/views/tpl/documents/inc/page/footer.tpl',
        'd3pdfreturnaddress.tpl'        => 'd3/pdfdocuments/Application/views/tpl/documents/inc/page/returnaddress.tpl',

        'd3pdfaddressarea.tpl'          => 'd3/pdfdocuments/Application/views/tpl/documents/inc/elements/addressarea.tpl',
        'd3pdfrecipientaddress.tpl'     => 'd3/pdfdocuments/Application/views/tpl/documents/inc/elements/recipientAddress.tpl',
        'd3pdfinformations.tpl'         => 'd3/pdfdocuments/Application/views/tpl/documents/inc/elements/informations.tpl',
        'd3pdfdeladdress.tpl'           => 'd3/pdfdocuments/Application/views/tpl/documents/inc/elements/deliveryaddress.tpl',
        'd3pdfarticlelist.tpl'          => 'd3/pdfdocuments/Application/views/tpl/documents/inc/elements/articlelist.tpl',
        'd3pdfarticlecostsummary.tpl'   => 'd3/pdfdocuments/Application/views/tpl/documents/inc/elements/articlecostssummary.tpl',
        'd3pdffoldmarks.tpl'            => 'd3/pdfdocuments/Application/views/tpl/documents/inc/elements/foldmarks.tpl',

        'd3pdfstyles.css'               => 'd3/pdfdocuments/out/src/css/pdfStyling.css',

        'd3pdfrulers.tpl'               => 'd3/pdfdocuments/Application/views/tpl/documents/inc/helper/rulers.tpl',
    ],
    'events'                => [],
    'blocks'                => [
        [
            'template' => 'order_overview.tpl',
            'block'    => 'admin_order_overview_export',
            'file'     => 'Application/views/admin/blocks/order_overview.tpl',
        ],
    ],
    'settings' => [
        [
            'group' => Constants::OXID_MODULE_ID.'main',
            'name' => Constants::OXID_MODULE_ID.'bDev',
            'type' => 'bool',
            'value' => false,
        ],
        [
            'group' => Constants::OXID_MODULE_ID.'main',
            'name' => Constants::OXID_MODULE_ID.'basicAuthUserName',
            'type' => 'str',
        ],
        [
            'group' => Constants::OXID_MODULE_ID.'main',
            'name' => Constants::OXID_MODULE_ID.'basicAuthPassword',
            'type' => 'password',
        ],

        [
            'group' => Constants::OXID_MODULE_ID.'invoice',
            'name' => 'invoicePaymentTerm',
            'type' => 'num',
            'value' => 7,
        ],
        [
            'group' => Constants::OXID_MODULE_ID.'contents',
            'name' => Constants::OXID_MODULE_ID.'LogoUrl',
            'type' => 'str'
        ],
        [
            'group' => Constants::OXID_MODULE_ID.'contents',
            'name' => Constants::OXID_MODULE_ID.'BackgroundUrl',
            'type' => 'str'
        ],
        [
            'group' => Constants::OXID_MODULE_ID.'documents',
            'name' => Constants::OXID_MODULE_ID.'DocInvoice',
            'type' => 'bool',
            'value' => true
        ],
        [
            'group' => Constants::OXID_MODULE_ID.'documents',
            'name' => Constants::OXID_MODULE_ID.'DocInvoiceNoLogo',
            'type' => 'bool',
            'value' => true
        ],
        [
            'group' => Constants::OXID_MODULE_ID.'documents',
            'name' => Constants::OXID_MODULE_ID.'DocDeliveryNote',
            'type' => 'bool',
            'value' => true
        ],
        [
            'group' => Constants::OXID_MODULE_ID.'documents',
            'name' => Constants::OXID_MODULE_ID.'DocDeliveryNoteNoLogo',
            'type' => 'bool',
            'value' => true
        ],
    ],
];
// @codeCoverageIgnoreEnd