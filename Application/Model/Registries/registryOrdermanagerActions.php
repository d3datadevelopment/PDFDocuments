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

use D3\PdfDocuments\Application\Model\Documents\deliverynotePdf;
use D3\PdfDocuments\Application\Model\Documents\deliverynotewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Documents\invoicePdf;
use D3\PdfDocuments\Application\Model\Documents\invoicewithoutlogoPdf;
use D3\PdfDocuments\Application\Model\Exceptions\wrongPdfGeneratorInterface;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderInterface;
use OxidEsales\Eshop\Core\Registry;

class registryOrdermanagerActions extends registryAbstract implements registryOrdermanagerActionsInterface
{
    /**
     * @throws wrongPdfGeneratorInterface
     */
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
