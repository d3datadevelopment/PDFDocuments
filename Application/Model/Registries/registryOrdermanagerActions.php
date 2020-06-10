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

namespace D3\PdfDocuments\Application\Model\Registries;

use D3\PdfDocuments\Application\Model\Documents\deliverynotePdf;
use D3\PdfDocuments\Application\Model\Documents\deliverynotewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Documents\invoicePdf;
use D3\PdfDocuments\Application\Model\Documents\invoicewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderInterface;

class registryOrdermanagerActions extends registryAbstract implements registryOrdermanagerActionsInterface
{
    public function __construct()
    {
        $this->addGenerator(invoicePdf::class);
        $this->addGenerator(deliverynotePdf::class);
        $this->addGenerator(invoicewithoutlogoPdf::class);
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