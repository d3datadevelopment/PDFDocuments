<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

use D3\PdfDocuments\Application\Model\Constants as Constants;
use D3\PdfDocuments\Modules\Application\Controller\d3_overview_controller_pdfdocuments;
use OxidEsales\Eshop\Application\Controller\Admin\OrderOverview;

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

$logo = '<img src="https://logos.oxidmodule.com/d3logo.svg" alt="(D3)" style="height:1em;width:1em">';

/**
 * Module information
 */
$aModule = [
    'id'            => Constants::OXID_MODULE_ID,
    'title'         => [
        'de'        => $logo.' PDF-Dokumente',
        'en'        => $logo.' PDF documents',
    ],
    'version'       => '2.0.0',
    'author'        => $logo.' Data Development (Inh.: Thomas Dartsch)',
    'email'         => 'support@shopmodule.com',
    'url'           => 'https://www.oxidmodule.com/',
    'extend'        => [
        OrderOverview::class    => d3_overview_controller_pdfdocuments::class
    ],
    'controllers'   => [],
    'thumbnail'     => 'picture.svg',
    'templates'     => [
        //Admin
        '@' . Constants::OXID_MODULE_ID . '/admin/d3orderoverview_pdfform.tpl'                                      => 'views/smarty/admin/orderoverview_pdfform.tpl',

        // Frontend - Flow - Deliverynote
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/d3deliverynote_pdf.tpl'                  => 'views/smarty/flow/documents/deliverynote/deliverynote.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/d3deliverynoteNoLogo_pdf.tpl'     => 'views/smarty/flow/documents/deliverynote/deliverynoteNoLogo.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/d3delnote_pdf_informations.tpl'  => 'views/smarty/flow/documents/deliverynote/inc/informations.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/d3delnote_pdf_recipient.tpl'         => 'views/smarty/flow/documents/deliverynote/inc/recipientAddress.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/d3delnote_pdf_salutation.tpl'       => 'views/smarty/flow/documents/deliverynote/inc/salutation.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/d3delnote_pdf_conclusion.tpl'       => 'views/smarty/flow/documents/deliverynote/inc/conclusion.tpl',

        // Frontend - Flow - Invoice
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/d3invoice_pdf.tpl'                            => 'views/smarty/flow/documents/invoice/invoice.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/d3invoiceNoLogo_pdf.tpl'               => 'views/smarty/flow/documents/invoice/invoiceNoLogo.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/d3invoice_pdf_informations.tpl'    => 'views/smarty/flow/documents/invoice/inc/informations.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/d3invoice_pdf_salutation.tpl'        => 'views/smarty/flow/documents/invoice/inc/salutation.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/d3invoice_pdf_conclusion.tpl'       => 'views/smarty/flow/documents/invoice/inc/conclusion.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/d3invoice_pdf_payinfo.tpl'            => 'views/smarty/flow/documents/invoice/inc/payinfo.tpl',

        // Frontend - Flow - Inc - Page
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/page/d3pdfbase.tpl'                  => 'views/smarty/flow/documents/inc/page/base.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/page/d3pdfheader.tpl'              => 'views/smarty/flow/documents/inc/page/header.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/page/d3pdffooter.tpl'                => 'views/smarty/flow/documents/inc/page/footer.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/page/d3pdfreturnaddress.tpl'  => 'views/smarty/flow/documents/inc/page/returnaddress.tpl',

        // Frontend - Flow - Inc - Elements
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/d3pdfaddressarea.tpl'              => 'views/smarty/flow/documents/inc/elements/addressarea.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/d3pdfrecipientaddress.tpl'       => 'views/smarty/flow/documents/inc/elements/recipientAddress.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/d3pdfinformations.tpl'             => 'views/smarty/flow/documents/inc/elements/informations.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/d3pdfdeladdress.tpl'                => 'views/smarty/flow/documents/inc/elements/deliveryaddress.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/d3pdfarticlelist.tpl'                   => 'views/smarty/flow/documents/inc/elements/articlelist.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/d3pdfarticlecostsummary.tpl' => 'views/smarty/flow/documents/inc/elements/articlecostssummary.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/d3pdffoldmarks.tpl'                 => 'views/smarty/flow/documents/inc/elements/foldmarks.tpl',

        // Frontend - Flow - Inc - Helper
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/helper/d3pdfrulers.tpl'                               => 'views/smarty/flow/documents/inc/helper/rulers.tpl',
        
        //'@' . Constants::self::OXID_MODULE_ID . 'd3pdfstyles.css'                       => 'CHECKEN!d3/pdfdocuments/out/src/css/pdfStyling.css',
    ],
    'events'                => [],
    'blocks'                => [
        [
            'template' => 'order_overview.tpl',
            'block'    => 'admin_order_overview_export',
            'file'     => 'views/smarty/blocks/order_overview.tpl'
        ]
    ],
    'settings' => [
        [
            'group' => Constants::OXID_MODULE_ID.'main',
            'name' => Constants::OXID_MODULE_ID.'bDev',
            'type' => 'bool',
            'value' => false
        ]
    ]
];
