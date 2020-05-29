<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Controller;

use D3\PdfDocuments\Application\Model\Documents\deliverynotePdf;
use D3\PdfDocuments\Application\Model\Documents\invoicePdf;
use D3\PdfDocuments\Application\Model\Exceptions\d3noPdfHandlerFoundException;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocuments_order_interface as OrderPdfInterface;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Registry;

class orderPdfGenerator
{
    /**
     * @param Order  $order
     * @param        $sFilename
     * @param int    $iSelLang
     * @param string $target
     */
    public function generatePdf(Order $order, $sFilename, $iSelLang = 0, $target = 'I')
    {
        $Pdf= $this->getPdfClass($order);

        $Pdf->setOrder($order);
        $Pdf->genPdf($sFilename, $iSelLang, $target);
    }

    public function getPdfClass(Order $order)
    {
echo __CLASS__." - ".__FUNCTION__." - ".__LINE__."<br>";
        switch (Registry::getRequest()->getRequestParameter('pdftype')) {
            case ('dnote'):
            case ('dnote_without_logo'):
echo __CLASS__." - ".__FUNCTION__." - ".__LINE__."<br>";
                $pdfInstance= oxNew(deliverynotePdf::class);
                $pdfInstance->setOrder($order);
                return $pdfInstance;
            case ('standart'):
            case('standart_without_logo'):
echo __CLASS__." - ".__FUNCTION__." - ".__LINE__."<br>";
                $pdfInvoice= oxNew(invoicePdf::class);
                $pdfInvoice->setOrder($order);
                return $pdfInvoice;
            default:
echo __CLASS__." - ".__FUNCTION__." - ".__LINE__."<br>";
                return $this->getCustomPdfClass($order);
        }
    }

    /**
     * @param Order $order
     *
     * @return OrderPdfInterface
     * @throws d3noPdfHandlerFoundException
     */
    public function getCustomPdfClass(Order $order)
    {
        unset($order);

        /** @var d3noPdfHandlerFoundException $e */
        $e = oxNew(d3noPdfHandlerFoundException::class, Registry::getRequest()->getRequestParameter('pdftype'));
        throw($e);
    }
}