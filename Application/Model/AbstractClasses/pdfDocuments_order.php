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

namespace D3\PdfDocuments\Application\Model\AbstractClasses;

use D3\PdfDocuments\Application\Model\Interfaces\pdfdocuments_order as orderInterface;
use \OxidEsales\Eshop\Application\Model\Order;

abstract class pdfDocuments_order extends pdfDocuments_generic implements orderInterface
{
  public $oOrder;

  /**
   * @param Order $order
   */
  public function setOrder(Order $order)
  {
    $this->oOrder = $order;
  }

  /**
   * @return Order
   */
  public function getOrder()
  {
    return $this->oOrder;
  }
}