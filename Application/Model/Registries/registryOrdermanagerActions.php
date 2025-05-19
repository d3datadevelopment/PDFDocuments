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
