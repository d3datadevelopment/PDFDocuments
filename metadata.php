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

use D3\ModCfg\Application\Model\d3utils;
use D3\PdfDocuments\Modules\Application\Controller\d3_overview_controller_pdfdocuments;
use D3\PdfDocuments\Modules\Application\Model\d3_Order_PdfDocuments as d3_pdfdocs_OrderModel;
use OxidEsales\Eshop\Application\Controller\Admin\OrderOverview;
use OxidEsales\Eshop\Application\Model as OxidModel;

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

$logo = (class_exists(d3utils::class) ? d3utils::getInstance()->getD3Logo() : 'D&sup3;');

$sModuleId = 'd3PdfDocuments';
/**
 * Module information
 */
$aModule = [
    'id'            => $sModuleId,
    'title'         => [
        'de'        => $logo.' PDF-Dokumente aus HTML-Templates',
        'en'        => $logo.' PDF documents from HTML templates',
    ],
    'version'       => '1.0',
    'author'        => 'D&sup3; Data Development (Inh.: Thomas Dartsch)',
    'email'         => 'support@shopmodule.com',
    'url'           => 'http://www.oxidmodule.com/',
    'extend'        => [
        OxidModel\Order::class             => d3_pdfdocs_OrderModel::class,
        OrderOverview::class => d3_overview_controller_pdfdocuments::class
    ],
    'controllers'           => [],
    'templates'             => [
        'd3orderoverview_pdfform.tpl'   => 'd3/pdfdocuments/Application/views/tpl/admin/orderoverview_pdfform.tpl',

        'd3deliverynote_pdf.tpl'        => 'd3/pdfdocuments/Application/views/tpl/documents/deliverynote/deliverynote.tpl',
        'd3deliverynoteNoLogo_pdf.tpl'  => 'd3/pdfdocuments/Application/views/tpl/documents/deliverynote/deliverynoteNoLogo.tpl',
        'd3delnote_pdf_addressarea.tpl' => 'd3/pdfdocuments/Application/views/tpl/documents/deliverynote/includingFiles/pdfHeader.tpl',
        'd3delnote_pdf_conclusion.tpl'  => 'd3/pdfdocuments/Application/views/tpl/documents/deliverynote/includingFiles/pdfPastThank.tpl',
        'd3delnote_pdf_style.css'       => 'd3/pdfdocuments/out/src/css/deliverynote.css',

        'd3invoice_pdf.tpl'             => 'd3/pdfdocuments/Application/views/tpl/documents/invoice/invoice.tpl',
        'd3invoiceNoLogo_pdf.tpl'       => 'd3/pdfdocuments/Application/views/tpl/documents/invoice/invoiceNoLogo.tpl',
        'd3invoice_pdf_addressarea.tpl' => 'd3/pdfdocuments/Application/views/tpl/documents/invoice/includingFiles/pdfHeader.tpl',
        'd3invoice_pdf_conclusion.tpl'  => 'd3/pdfdocuments/Application/views/tpl/documents/invoice/includingFiles/pdfPastThank.tpl',
        'd3_article_costs_summary.tpl'  => 'd3/pdfdocuments/Application/views/tpl/documents/invoice/includingFiles/d3_article_costs_summary.tpl',

        'd3pdfheader.tpl'               => 'd3/pdfdocuments/Application/views/tpl/documents/inc/header.tpl',
        'd3pdffooter.tpl'               => 'd3/pdfdocuments/Application/views/tpl/documents/inc/footer.tpl',
        'd3din5008.tpl'                 => 'd3/pdfdocuments/Application/views/tpl/documents/inc/din5008.tpl',
        'd3pdfstyle.css'                => 'd3/pdfdocuments/out/src/css/pdfStyling.css'
    ],
    'events'                => [],
    'blocks'                => [
        [
            'template' => 'order_overview.tpl',
            'block'    => 'admin_order_overview_export',
            'file'     => 'Application/views/admin/blocks/order_overview.tpl'
        ],
    ],
    'settings' => [
        ['group' => $sModuleId.'main', 'name' => $sModuleId.'bDev', 'type' => 'bool',      'value' => false],
    ]
];
