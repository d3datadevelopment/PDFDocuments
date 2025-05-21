<?php

namespace D3\PdfDocuments\Application\Model\Registries;

use D3\PdfDocuments\Application\Model\Constants;
use D3\PdfDocuments\Application\Model\Documents\deliverynotePdf;
use D3\PdfDocuments\Application\Model\Documents\deliverynotewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Documents\invoicePdf;
use D3\PdfDocuments\Application\Model\Documents\invoicewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Exceptions\wrongPdfGeneratorInterface;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
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
        /** @var ModuleSettingService $settingsService */
        $settingsService =  ContainerFactory::getInstance()->getContainer()->get(ModuleSettingServiceInterface::class);
        if ($settingsService->getBoolean('d3PdfDocumentsDocInvoice', Constants::OXID_MODULE_ID)) {
            $this->addGenerator(invoicePdf::class);
        }
        if ($settingsService->getBoolean('d3PdfDocumentsDocDeliveryNote', Constants::OXID_MODULE_ID)) {
            $this->addGenerator(deliverynotePdf::class);
        }
        if ($settingsService->getBoolean('d3PdfDocumentsDocInvoiceNoLogo', Constants::OXID_MODULE_ID)) {
            $this->addGenerator(invoicewithoutlogoPdf::class);
        }
        if ($settingsService->getBoolean('d3PdfDocumentsDocDeliveryNoteNoLogo', Constants::OXID_MODULE_ID)) {
            $this->addGenerator(deliverynotewithoutlogoPdf::class);
        }
    }
}