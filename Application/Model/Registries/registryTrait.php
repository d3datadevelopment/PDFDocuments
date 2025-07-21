<?php

namespace D3\PdfDocuments\Application\Model\Registries;

use D3\PdfDocuments\Application\Model\Documents\deliverynotePdf;
use D3\PdfDocuments\Application\Model\Documents\deliverynotewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Documents\invoicePdf;
use D3\PdfDocuments\Application\Model\Documents\invoicewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Exceptions\wrongPdfGeneratorInterface;
use OxidEsales\Eshop\Core\Registry;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

trait registryTrait
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws wrongPdfGeneratorInterface
     */
    public function __construct()
    {
        $config = Registry::getConfig();
        if ($config->getConfigParam('d3PdfDocumentsDocInvoice')) {
            $this->addGenerator(invoicePdf::class);
        }
        if ($config->getConfigParam('d3PdfDocumentsDocDeliveryNote')) {
            $this->addGenerator(deliverynotePdf::class);
        }
        if ($config->getConfigParam('d3PdfDocumentsDocInvoiceNoLogo')) {
            $this->addGenerator(invoicewithoutlogoPdf::class);
        }
        if ($config->getConfigParam('d3PdfDocumentsDocDeliveryNoteNoLogo')) {
            $this->addGenerator(deliverynotewithoutlogoPdf::class);
        }
    }
}