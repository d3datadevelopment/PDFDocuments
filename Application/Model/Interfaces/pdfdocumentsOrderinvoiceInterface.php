<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\Interfaces;

interface pdfdocumentsOrderinvoiceInterface extends pdfdocumentsOrderInterface
{
    public function setInvoiceNumber();
  
    public function setInvoiceDate();
}