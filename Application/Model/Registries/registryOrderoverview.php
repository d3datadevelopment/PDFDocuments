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

namespace D3\PdfDocuments\Application\Model\Registries;

use D3\PdfDocuments\Application\Model\Constants;
use D3\PdfDocuments\Application\Model\Documents\deliverynotePdf;
use D3\PdfDocuments\Application\Model\Documents\deliverynotewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Documents\invoicePdf;
use D3\PdfDocuments\Application\Model\Documents\invoicewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Exceptions\wrongPdfGeneratorInterface;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderInterface;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;

class registryOrderoverview extends registryAbstract implements registryOrderoverviewInterface
{
    /**
     * @throws wrongPdfGeneratorInterface
     */
    public function __construct()
    {
        /** @var ModuleSettingService $settingsService */
        $settingsService =  ContainerFactory::getInstance()->getContainer()->get(ModuleSettingServiceInterface::class);
        if ($settingsService->getBoolean('d3PdfDocumentsDocInvoice', Constants::OXID_MODULE_ID))
            $this->addGenerator( invoicePdf::class );
        if ($settingsService->getBoolean('d3PdfDocumentsDocDeliveryNote', Constants::OXID_MODULE_ID))
            $this->addGenerator(deliverynotePdf::class);
        if ($settingsService->getBoolean('d3PdfDocumentsDocInvoiceNoLogo', Constants::OXID_MODULE_ID))
            $this->addGenerator(invoicewithoutlogoPdf::class);
        if ($settingsService->getBoolean('d3PdfDocumentsDocDeliveryNoteNoLogo', Constants::OXID_MODULE_ID))
            $this->addGenerator(deliverynotewithoutlogoPdf::class);
    }

    public function getRequiredGeneratorInterfaceClassName(): string
    {
        return pdfdocumentsOrderInterface::class;
    }

    /**
     * @param string $className * generator fully qualified class name
     * @return pdfdocumentsOrderInterface
     */
    public function getGenerator(string $className): pdfdocumentsOrderInterface
    {
        return $this->registry[$className];
    }
}
