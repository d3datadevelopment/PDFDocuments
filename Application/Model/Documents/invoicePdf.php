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

namespace D3\PdfDocuments\Application\Model\Documents;

use D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderinvoiceInterface;

class invoicePdf extends pdfdocumentsOrder implements pdfdocumentsOrderinvoiceInterface
{
    protected bool $isNewOrder = false;

    public function getRequestId(): string
    {
        return 'invoice';
    }

    public function getTitleIdent(): string
    {
        return "D3_PDFDOCUMENTS_INVOICE";
    }

    public function getTypeForFilename(): string
    {
        return 'invoice';
    }

    public function runPreAction(): void
    {
        parent::runPreAction();

        $this->setInvoiceNumber();
        $this->setInvoiceDate();
        $this->saveOrderOnChanges();
    }

    public function setInvoiceNumber(): void
    {
        if (!$this->getOrder()->getFieldData('oxbillnr')) {
            $this->getOrder()->assign(['oxbillnr' => $this->getOrder()->getNextBillNum()]);

            $this->isNewOrder = true;
        }
    }

    public function setInvoiceDate(): void
    {
        if ($this->getOrder()->getFieldData('oxbilldate') == '0000-00-00') {
            $this->getOrder()->assign([
                "oxbilldate" => date('Y-m-d'),
            ]);

            $this->isNewOrder = true;
        }
    }

    public function saveOrderOnChanges(): void
    {
        if ($this->isNewOrder) {
            $this->getOrder()->save();
        }
    }

    public function getTemplate(): string
    {
        return '@d3PdfDocuments/documents/invoice/invoice';
    }

    public function getFilename(): string
    {
        $filename = parent::getFilename();

        $filename = str_replace(
            (string) $this->getOrder()->getFieldData('oxordernr'),
            (string) $this->getOrder()->getFieldData('oxbillnr'),
            $filename
        );

        return $this->makeValidFileName($filename);
    }
}
