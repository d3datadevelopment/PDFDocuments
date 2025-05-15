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

$sMetadataVersion = '2.1';

$aModule = [
    'id'            => Constants::OXID_MODULE_ID,
    'title'         => [
        'de'        => '(D3) PDF-Dokumente',
        'en'        => '(D3) PDF documents',
    ],
    'version'       => '2.0.2.0',
    'author'        => 'D3 Data Development (Inh.: Thomas Dartsch)',
    'email'         => 'support@shopmodule.com',
    'url'           => 'https://www.oxidmodule.com/',
    'extend'        => [
        OrderOverview::class    => d3_overview_controller_pdfdocuments::class,
    ],
    'controllers'   => [],
    'thumbnail'     => 'picture.svg',
    'templates'     => [
        //Admin
        '@' . Constants::OXID_MODULE_ID . '/admin/d3orderoverview_pdfform.tpl'                                      => 'views/smarty/admin/orderoverview_pdfform.tpl',

        // Frontend - Flow - Deliverynote
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/deliverynote.tpl'                  => 'views/smarty/documents/deliverynote/deliverynote.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/deliverynoteNoLogo.tpl'     => 'views/smarty/documents/deliverynote/deliverynoteNoLogo.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/informations.tpl'  => 'views/smarty/documents/deliverynote/inc/informations.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/recipientAddress.tpl'         => 'views/smarty/documents/deliverynote/inc/recipientAddress.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/salutation.tpl'       => 'views/smarty/documents/deliverynote/inc/salutation.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/deliverynote/conclusion.tpl'       => 'views/smarty/documents/deliverynote/inc/conclusion.tpl',

        // Frontend - Flow - Invoice
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/invoice.tpl'                            => 'views/smarty/documents/invoice/invoice.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/invoiceNoLogo.tpl'               => 'views/smarty/documents/invoice/invoiceNoLogo.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/informations.tpl'    => 'views/smarty/documents/invoice/inc/informations.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/salutation.tpl'        => 'views/smarty/documents/invoice/inc/salutation.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/conclusion.tpl'       => 'views/smarty/documents/invoice/inc/conclusion.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/invoice/payinfo.tpl'            => 'views/smarty/documents/invoice/inc/payinfo.tpl',

        // Frontend - Flow - Inc - Page
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/page/base.tpl'                  => 'views/smarty/documents/inc/page/base.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/page/header.tpl'              => 'views/smarty/documents/inc/page/header.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/page/footer.tpl'                => 'views/smarty/documents/inc/page/footer.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/page/returnaddress.tpl'  => 'views/smarty/documents/inc/page/returnaddress.tpl',

        // Frontend - Flow - Inc - Elements
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/addressarea.tpl'              => 'views/smarty/documents/inc/elements/addressarea.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/recipientAddress.tpl'       => 'views/smarty/documents/inc/elements/recipientAddress.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/informations.tpl'             => 'views/smarty/documents/inc/elements/informations.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/deliveryaddress.tpl'                => 'views/smarty/documents/inc/elements/deliveryaddress.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/articlelist.tpl'                   => 'views/smarty/documents/inc/elements/articlelist.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/articlecostssummary.tpl' => 'views/smarty/documents/inc/elements/articlecostssummary.tpl',
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/elements/foldmarks.tpl'                 => 'views/smarty/documents/inc/elements/foldmarks.tpl',

        // Frontend - Flow - Inc - Helper
        '@' . Constants::OXID_MODULE_ID . '/documents/inc/helper/rulers.tpl'                               => 'views/smarty/documents/inc/helper/rulers.tpl',

        // Frontend - Flow - Inc - Styles
        '@' . Constants::OXID_MODULE_ID . '/assets/d3pdfstyles.css.tpl'                                                 => 'views/smarty/assets/pdfStyling.css.tpl',
    ],
    'events'                => [],
    'blocks'                => [
        [
            'template' => 'order_overview.tpl',
            'block'    => 'admin_order_overview_export',
            'file'     => 'views/smarty/blocks/order_overview.tpl',
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
    ],
];
