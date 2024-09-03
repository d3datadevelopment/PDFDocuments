<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\Documents;

use Assert\InvalidArgumentException;
use D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderinvoiceInterface;

class invoicePdf extends pdfdocumentsOrder implements pdfdocumentsOrderinvoiceInterface
{
    protected $blIsNewOrder = false;

    /**
     * @return string
     */
    public function getRequestId()
    {
        return 'invoice';
    }

    /**
     * @return string
     */
    public function getTitleIdent()
    {
        return "D3_PDFDOCUMENTS_INVOICE";
    }

    /**
     * @return string
     */
    public function getTypeForFilename()
    {
        return 'invoice';
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function runPreAction()
    {
        parent::runPreAction();

        $this->setInvoiceNumber();
        $this->setInvoiceDate();
        $this->saveOrderOnChanges();
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function setInvoiceNumber()
    {
        if (!$this->getOrder()->getFieldData('oxbillnr')) {
            $this->getOrder()->assign(['oxbillnr' => $this->getOrder()->getNextBillNum()]);

            $this->blIsNewOrder = true;
        }
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function setInvoiceDate()
    {
        if ($this->getOrder()->getFieldData('oxbilldate') == '0000-00-00') {
            $this->getOrder()->assign([
                "oxbilldate" => date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y')))
            ]);

            $this->blIsNewOrder = true;
        }
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function saveOrderOnChanges()
    {
        if ($this->blIsNewOrder) {
            $this->getOrder()->save();
        }
    }

    public function getTemplate(){
        return '@d3PdfDocuments/admin/documents/invoice/invoice';
    }

    /**
     * @return string
     * @throws InvalidArgumentException
     */
    public function getFilename()
    {
        $filename = parent::getFilename();

        $filename = str_replace(
            $this->getOrder()->getFieldData('oxordernr'),
            $this->getOrder()->getFieldData('oxbillnr'),
            $filename
        );

        return $this->makeValidFileName($filename);
    }
}