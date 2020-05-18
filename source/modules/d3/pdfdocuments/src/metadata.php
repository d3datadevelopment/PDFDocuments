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
use D3\PdfDocuments\Modules\Application\Model\d3_Order_PdfDocuments as d3_pdfdocs_OrderModel;
use OxidEsales\Eshop\Application\Model as OxidModel;

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

$logo = (class_exists(d3utils::class) ? d3utils::getInstance()->getD3Logo() : 'D&sup3;');

$sModuleId = 'pdfDocuments';
/**
 * Module information
 */
$aModule = [
    'id'            => $sModuleId,
    'title'         => [
        'de'        => $logo.' PDF-Dokumente aus HTML-Templates',
        'en'        => $logo.' PDF documents from HTML templates',
    ],
    'thumbnail'     => 'picture.png',
    'version'       => '1.0',
    'author'        => 'D&sup3; Data Development (Inh.: Thomas Dartsch)',
    'email'         => 'support@shopmodule.com',
    'url'           => 'http://www.oxidmodule.com/',
    'extend'        => [
        OxidModel\Order::class             => d3_pdfdocs_OrderModel::class,
        'oxorder'                          => d3_pdfdocs_OrderModel::class
    ],
    'controllers'           => [],
    'templates'             => [
        'd3deliverynote.tpl'               => 'd3/pdfdocuments/Application/views/tpl/deliverynote.tpl',
        'd3tplheader.tpl'                  => 'd3/pdfdocuments/Application/views/tpl/header.tpl'
    ],
    'events'                => [],
    'blocks'                => []
];