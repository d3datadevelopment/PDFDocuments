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
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/deliverynote.tpl'                  => 'views/smarty/flow/documents/deliverynote/deliverynote.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/deliverynoteNoLogo.tpl'     => 'views/smarty/flow/documents/deliverynote/deliverynoteNoLogo.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/informations.tpl'  => 'views/smarty/flow/documents/deliverynote/inc/informations.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/recipientAddress.tpl'         => 'views/smarty/flow/documents/deliverynote/inc/recipientAddress.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/salutation.tpl'       => 'views/smarty/flow/documents/deliverynote/inc/salutation.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/conclusion.tpl'       => 'views/smarty/flow/documents/deliverynote/inc/conclusion.tpl',

        // Frontend - Flow - Invoice
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/invoice.tpl'                            => 'views/smarty/flow/documents/invoice/invoice.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/invoiceNoLogo.tpl'               => 'views/smarty/flow/documents/invoice/invoiceNoLogo.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/informations.tpl'    => 'views/smarty/flow/documents/invoice/inc/informations.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/salutation.tpl'        => 'views/smarty/flow/documents/invoice/inc/salutation.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/conclusion.tpl'       => 'views/smarty/flow/documents/invoice/inc/conclusion.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/payinfo.tpl'            => 'views/smarty/flow/documents/invoice/inc/payinfo.tpl',

        // Frontend - Flow - Inc - Page
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/page/base.tpl'                  => 'views/smarty/flow/documents/inc/page/base.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/page/header.tpl'              => 'views/smarty/flow/documents/inc/page/header.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/page/footer.tpl'                => 'views/smarty/flow/documents/inc/page/footer.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/page/returnaddress.tpl'  => 'views/smarty/flow/documents/inc/page/returnaddress.tpl',

        // Frontend - Flow - Inc - Elements
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/addressarea.tpl'              => 'views/smarty/flow/documents/inc/elements/addressarea.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/recipientAddress.tpl'       => 'views/smarty/flow/documents/inc/elements/recipientAddress.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/informations.tpl'             => 'views/smarty/flow/documents/inc/elements/informations.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/deliveryaddress.tpl'                => 'views/smarty/flow/documents/inc/elements/deliveryaddress.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/articlelist.tpl'                   => 'views/smarty/flow/documents/inc/elements/articlelist.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/articlecostssummary.tpl' => 'views/smarty/flow/documents/inc/elements/articlecostssummary.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/foldmarks.tpl'                 => 'views/smarty/flow/documents/inc/elements/foldmarks.tpl',

        // Frontend - Flow - Inc - Helper
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/helper/rulers.tpl'                               => 'views/smarty/flow/documents/inc/helper/rulers.tpl',
	    
	    // Frontend - Flow - Inc - Styles
        '@' . Constants::OXID_MODULE_ID . '/assets/d3pdfstyles.css'                                                 => 'assets/out/src/css/pdfStyling.css',
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
        ],
        [
            'group' => Constants::OXID_MODULE_ID.'main',
            'name' => Constants::OXID_MODULE_ID.'_sAlternativePdfLogoName',
            'type' => 'str',
            'value' => ''
        ]
    ]
];
