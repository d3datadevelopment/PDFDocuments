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

use D3\PdfDocuments\Application\Model\Exceptions\noPdfHandlerFoundException;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderInterface;
use D3\PdfDocuments\Application\Model\Registries\registryOrderoverview;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Registry;

class orderOverviewPdfGenerator
{
    /**
     * @param Order $order
     * @param int $iSelLang
     * @throws noPdfHandlerFoundException
     */
    public function generatePdf(Order $order, $iSelLang = 0)
    {
        $Pdf= $this->getPdfClass();

        $Pdf->setOrder($order);
        $Pdf->downloadPdf($iSelLang);
    }

    /**
     * @return pdfdocumentsOrderInterface
     * @throws noPdfHandlerFoundException
     */
    public function getPdfClass()
    {
        $requestedType = Registry::getRequest()->getRequestParameter('pdftype');

        $generatorList = oxNew(registryOrderoverview::class);
        /** @var pdfdocumentsOrderInterface $generator */
        foreach ($generatorList->getList() as $generator) {
            if ($generator->getRequestId() == $requestedType) {
                return $generator;
            }
        }

        /** @var noPdfHandlerFoundException $e */
        $e = oxNew(noPdfHandlerFoundException::class, Registry::getRequest()->getRequestParameter('pdftype'));
        throw($e);
    }
}