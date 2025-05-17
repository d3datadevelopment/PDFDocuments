<?php

/**
 * See LICENSE file for license details.
 * 
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\Registries;

use D3\PdfDocuments\Application\Model\Documents\deliverynotePdf;
use D3\PdfDocuments\Application\Model\Documents\deliverynotewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Documents\invoicePdf;
use D3\PdfDocuments\Application\Model\Documents\invoicewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderInterface;
use OxidEsales\Eshop\Core\Registry;

class registryOrdermanagerActions extends registryAbstract implements registryOrdermanagerActionsInterface
{
    public function __construct()
    {
        $config = Registry::getConfig();
        if ($config->getConfigParam('d3PdfDocumentsDocInvoice'))
            $this->addGenerator(invoicePdf::class);
        if ($config->getConfigParam('d3PdfDocumentsDocDeliveryNote'))
            $this->addGenerator(deliverynotePdf::class);
        if ($config->getConfigParam('d3PdfDocumentsDocInvoiceNoLogo'))
            $this->addGenerator(invoicewithoutlogoPdf::class);
        if ($config->getConfigParam('d3PdfDocumentsDocDeliveryNoteNoLogo'))
            $this->addGenerator(deliverynotewithoutlogoPdf::class);
    }

    /**
     * @return string
     */
    public function getRequiredGeneratorInterfaceClassName()
    {
        return pdfdocumentsOrderInterface::class;
    }

    /**
     * @param $className * generator fully qualified class name
     * @return pdfdocumentsOrderInterface
     */
    public function getGenerator($className)
    {
        return $this->_aRegistry[$className];
    }
}