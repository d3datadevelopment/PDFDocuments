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

namespace D3\PdfDocuments\Application\Controller;

use D3\PdfDocuments\Application\Model\Exceptions\noPdfHandlerFoundException;
use D3\PdfDocuments\Application\Model\Exceptions\wrongPdfGeneratorInterface;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderInterface;
use D3\PdfDocuments\Application\Model\Registries\registryOrderoverview;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Registry;

class orderOverviewPdfGenerator
{
    /**
     * @throws noPdfHandlerFoundException
     * @throws wrongPdfGeneratorInterface
     */
    public function generatePdf(Order $order, int $iSelLang = 0): void
    {
        $Pdf = $this->getPdfClass();

        $Pdf->setDevelopmentMode(
            Registry::getConfig()->getConfigParam('d3PdfDocumentsbDev') &&
            Registry::getRequest()->getRequestEscapedParameter('devmode')
        );
        $Pdf->setOrder($order);
        $Pdf->downloadPdf($iSelLang);
    }

    /**
     * @return pdfdocumentsOrderInterface
     * @throws noPdfHandlerFoundException
     * @throws wrongPdfGeneratorInterface
     */
    public function getPdfClass(): pdfdocumentsOrderInterface
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
        $e = oxNew(
            noPdfHandlerFoundException::class,
            Registry::getRequest()->getRequestParameter('pdftype')
        );
        throw($e);
    }
}
