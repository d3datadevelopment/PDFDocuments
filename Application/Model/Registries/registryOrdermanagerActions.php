<?php

/**
 * See LICENSE file for license details.
 * 
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

declare(strict_types = 1);

namespace D3\PdfDocuments\Application\Model\Registries;

use D3\PdfDocuments\Application\Model\Documents\deliverynotePdf;
use D3\PdfDocuments\Application\Model\Documents\deliverynotewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Documents\invoicePdf;
use D3\PdfDocuments\Application\Model\Documents\invoicewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Exceptions\wrongPdfGeneratorInterface;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsGenericInterface;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderInterface;

class registryOrdermanagerActions extends registryAbstract implements registryOrdermanagerActionsInterface
{
    /**
     * @throws wrongPdfGeneratorInterface
     */
    public function __construct()
    {
        $this->addGenerator(invoicePdf::class);
        $this->addGenerator(deliverynotePdf::class);
        $this->addGenerator(invoicewithoutlogoPdf::class);
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