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
 * @author    D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\Registries;

use D3\PdfDocuments\Application\Model\Documents\deliverynotePdf;
use D3\PdfDocuments\Application\Model\Documents\deliverynotewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Documents\invoicePdf;
use D3\PdfDocuments\Application\Model\Documents\invoicewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocuments_order_interface;

class registryOrderoverview extends registryAbstract implements registryOrderoverviewInterface
{
    public function __construct()
    {
        $this->addGenerator(invoicePdf::class, oxNew(invoicePdf::class));
        $this->addGenerator(deliverynotePdf::class, oxNew(deliverynotePdf::class));
        $this->addGenerator(invoicewithoutlogoPdf::class, oxNew(invoicewithoutlogoPdf::class));
        $this->addGenerator(deliverynotewithoutlogoPdf::class, oxNew(deliverynotewithoutlogoPdf::class));
    }

    /**
     * @param $className
     * @param pdfdocuments_order_interface $pdfGenerator
     */
    public function addGenerator($className, pdfdocuments_order_interface $pdfGenerator)
    {
        $this->addItem($className, $pdfGenerator);
    }

    /**
     * @param $className * generator fully qualified class name
     * @return pdfdocuments_order_interface
     */
    public function getGenerator($className)
    {
        return $this->_aRegistry[$className];
    }
}