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

namespace D3\PdfDocuments\Application\Model;

use D3\PdfDocuments\Application\Model\Interfaces\pdfdocuments_generic;
use \OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\Registry;
use Spipu\Html2Pdf\Html2Pdf;

abstract class pdfDocuments_abstract implements pdfdocuments_generic
{
  public $oOrder;
  protected $blIsNewOrder;

  public function genPdf($sFilename, $iSelLang = 0, $target = 'I')
  {
    $oSmarty = Registry::getUtilsView()->getSmarty();
    $oSmarty->assign('oConfig', Registry::getSession()->getConfig());
    $oSmarty->assign('oViewConf', Registry::getSession()->getConfig()->getActiveView()->getViewConfig());
    $oSmarty->assign('order', $this->getOrder());
    $oSmarty->assign('shop', Registry::getSession()->getConfig()->getActiveShop());
    $oSmarty->assign('lang', Registry::getLang());

    $oUser = oxNew(User::Class);
    $oUser->load($this->getOrder()->getFieldData('oxuserid'));
    $oSmarty->assign('user', $oUser);

    $oPayment = oxNew(Payment::class);
    $oPayment->load($this->getOrder()->getFieldData('oxpaymenttype'));
    $oSmarty->assign('payment', $oPayment);

    $this->setInvoiceNumber();
    $this->setInvoiceDate();
    $this->saveOrderOnChanges();

    $sContent = $oSmarty->fetch($this->getTemplate());
    $this->setFilename($sContent, $target, $sFilename);
  }

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

  public function setFilename($sContent, $target, $sFilename)
  {
    $ordernr = $this->getOrder()->getFieldData('oxordernr');
    $billnr = $this->getOrder()->getFieldData('oxbillnr');;

    $sFilename = str_replace($ordernr, $billnr, $sFilename);

    $oPdf = oxNew(Html2Pdf::class, 'P', 'A4', 'de');
    $oPdf->writeHTML($sContent);
    $oPdf->output($sFilename, $target);
  }

  public function setInvoiceNumber()
  {
    $this->blIsNewOrder = 0;

    if (!$this->getOrder()->getFieldData('oxbillnr')) {
      $this->getOrder()->assign(['oxbillnr' => $this->getOrder()->getNextBillNum()]);

      $this->blIsNewOrder = 1;
    }
  }

  public function setInvoiceDate()
  {
    if ($this->getOrder()->getFieldData('oxbilldate') == '0000-00-00') {
      $this->getOrder()->assign([date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y')))]);

      $this->blIsNewOrder = 1;
    }
  }

  public function saveOrderOnChanges()
  {
    if ($this->blIsNewOrder) {
      $this->getOrder()->save();
    }
  }
}