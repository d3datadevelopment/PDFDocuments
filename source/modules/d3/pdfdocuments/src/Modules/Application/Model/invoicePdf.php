<?php

namespace D3\PdfDocuments\Modules\Application\Model\dev;

use OxidEsales\Eshop\Application\Model\Order as OrderModel;
use OxidEsales\EshopCommunity\Application\Model\Order;
use OxidEsales\EshopCommunity\Application\Model\User;
use OxidEsales\EshopCommunity\Application\Model\Payment;
use OxidEsales\Eshop\Core\Registry;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

class invoicePdf extends pdfDocuments implements \pdfDocuments_interface
{
  /**
   * @param string $sFilename
   * @param int $iSelLang
   * @param string $target
   * @throws Html2PdfException
   */

  public $blIsNewOrder = 0;
  public $sFilename;
  public $oOrder;

  public function genPdf($sFilename, $iSelLang = 0, $target = 'I')
  {
    self::$_blIsAdmin = 0;

    $oSmarty = Registry::getUtilsView()->getSmarty();
    $oSmarty->assign('oConfig', Registry::getSession()->getConfig());
    $oSmarty->assign('oViewConf', Registry::getSession()->getConfig()->getActiveView()->getViewConfig());
    $oSmarty->assign('order', $this);
    $oSmarty->assign('shop', Registry::getSession()->getConfig()->getActiveShop());
    $oSmarty->assign('lang', Registry::getLang());

    $oUser= oxNew(User::Class);
    $oUser->load($this->getOrder()->getFieldData('oxuserid'));
    $oSmarty->assign('user', $oUser);

    $oPayment= oxNew(Payment::class);
    $oPayment->load($this->getOrder()->getFieldData('oxpaymenttype'));
    $oSmarty->assign('payment', $oPayment);

    $this->setInvoiceNumber();
    $this->setInvoiceDate();
    $this->saveOrderOnChanges();

    switch (Registry::getRequest()->getRequestParameter('pdftype')) {
      case ('dnote'):
      case ('dnote_without_logo'):
        $sContent = $oSmarty->fetch($this->getDeliveryNoteTemplate());
        break;
      default:
        $sContent = $oSmarty->fetch($this->getDeliveryNoteTemplate());
    }
  }

  /**
   * @param OrderModel $order
   */
  public function setOrder(OrderModel $order){
    $this->oOrder= $order;
  }

  /**
   * @return OrderModel
   */
  public function getOrder(){
    return $this->oOrder;
  }

  public function setFilename($sContent, $target, $sFilename){
    $ordernr= $this->getOrder()->getFieldData('oxordernr');
    $billnr= $this->getOrder()->getFieldData('oxbillnr');;

    $sFilename = str_replace( $ordernr, $billnr, $sFilename);

    $oPdf= oxNew(Html2Pdf::class, 'P', 'A4', 'de');
    $oPdf->writeHTML($sContent);
    $oPdf->output($sFilename, $target);
  }

  public function setInvoiceNumber(){
    $this->blIsNewOrder = 0;

    if (!$this->getOrder()->getFieldData('oxbillnr')) {
      $this->getOrder()->assign(['oxbillnr' => $this->getOrder()->getNextBillNum()]);

      $this->blIsNewOrder = 1;
    }
  }

  public function setInvoiceDate(){
    if ($this->getOrder()->getFieldData('oxbilldate') == '0000-00-00') {
      $this->getOrder()->assign([date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y')))]);

      $this->blIsNewOrder = 1;
    }
  }

  public function saveOrderOnChanges(){
    if ($this->blIsNewOrder) {
      $this->getOrder()->save();
    }
  }

  public function getDeliveryNoteTemplate(){
    return 'd3deliverynote.tpl';
  }
}