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
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

use D3\PdfDocuments\Modules\Application\Controller\d3_overview_controller_pdfdocuments;
use D3\PdfDocuments\Modules\Application\Model\d3_Order_PdfDocuments as d3_pdfdocs_OrderModel;
use OxidEsales\Eshop\Application\Controller\Admin\OrderOverview;
use OxidEsales\Eshop\Application\Model as OxidModel;

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

$logo = '<svg style="height:1em;width:1em"><image xlink:href="https://logos.oxidmodule.com/d3logo.svg" style="height:1em;width:1em" /></svg>';

$sModuleId = 'd3PdfDocuments';
/**
 * Module information
 */
$aModule = [
    'id'            => $sModuleId,
    'title'         => [
        'de'        => $logo.' PDF-Dokumente',
        'en'        => $logo.' PDF documents',
    ],
    'version'       => '0.1',
    'author'        => 'D&sup3; Data Development (Inh.: Thomas Dartsch)',
    'email'         => 'support@shopmodule.com',
    'url'           => 'http://www.oxidmodule.com/',
    'extend'        => [
        OxidModel\Order::class  => d3_pdfdocs_OrderModel::class,
        OrderOverview::class    => d3_overview_controller_pdfdocuments::class
    ],
    'controllers'           => [],
    'templates'             => [
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
            'file'     => 'Application/views/admin/blocks/order_overview.tpl'
        ]
    ],
    'settings' => [
        [
            'group' => $sModuleId.'main', 
            'name' => $sModuleId.'bDev', 
            'type' => 'bool',
            'value' => false
        ]
    ]
];
