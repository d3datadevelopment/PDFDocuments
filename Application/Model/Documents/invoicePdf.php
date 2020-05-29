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

namespace D3\PdfDocuments\Application\Model\Documents;

use D3\PdfDocuments\Application\Model\AbstractClasses\pdfDocuments_order;
use D3\PdfDocuments\Application\Model\Exceptions\noBaseObjectSetException;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocuments_orderinvoice_interface;

class invoicePdf extends pdfDocuments_order implements pdfdocuments_orderinvoice_interface
{
    protected $blIsNewOrder = false;

    /**
     * @return string
     */
    public function getRequestId()
    {
        // same like in OXID PDF module
        return 'standart';
    }

    /**
     * @return string
     */
    public function getTitleIdent()
    {
        return "ORDER_OVERVIEW_PDF_STANDART";
    }

    /**
     * @param $sFilename
     * @param int $iSelLang
     * @param string $target
     * @return void
     * @throws noBaseObjectSetException
     */
    public function genPdf( $sFilename, $iSelLang = 0, $target = 'I' )
    {
        $this->setInvoiceNumber();
        $this->setInvoiceDate();
        $this->saveOrderOnChanges();

        parent::genPdf( $sFilename, $iSelLang, $target );
    }

    public function setInvoiceNumber()
    {
        $this->blIsNewOrder = false;

        if (!$this->getOrder()->getFieldData('oxbillnr')) {
            $this->getOrder()->assign(['oxbillnr' => $this->getOrder()->getNextBillNum()]);

            $this->blIsNewOrder = true;
        }
    }

    public function setInvoiceDate()
    {
        if ($this->getOrder()->getFieldData('oxbilldate') == '0000-00-00') {
            $this->getOrder()->assign([date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y')))]);

            $this->blIsNewOrder = true;
        }
    }

    public function saveOrderOnChanges()
    {
        if ($this->blIsNewOrder) {
            $this->getOrder()->save();
        }
    }

    public function getTemplate(){
        return 'd3invoice_pdf.tpl';
    }
}