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

use D3\PdfDocuments\Application\Model\Interfaces\pdfdocuments_generic as genericInterface;
use \OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\Registry;
use Spipu\Html2Pdf\Html2Pdf;

abstract class pdfDocuments_generic implements genericInterface
{
  public function genPdf($sFilename, $iSelLang = 0, $target = 'I')
  {
    $oSmarty = Registry::getUtilsView()->getSmarty();

    $oSmarty = $this->setSmartyVars($oSmarty);

    $this->setInvoiceNumber();
    $this->setInvoiceDate();
    $this->saveOrderOnChanges();

    $sContent = $oSmarty->fetch($this->getTemplate());
    $this->setFilename($sContent, $target, $sFilename);
  }

  public function setSmartyVars($smarty)
  {
      $smarty->assign('oConfig', Registry::getSession()->getConfig());
      $smarty->assign('oViewConf', Registry::getSession()->getConfig()->getActiveView()->getViewConfig());
      $smarty->assign('order', $this->getOrder());
      $smarty->assign('shop', Registry::getSession()->getConfig()->getActiveShop());
      $smarty->assign('lang', Registry::getLang());

      $oUser = oxNew(User::Class);
      $oUser->load($this->getOrder()->getFieldData('oxuserid'));
      $smarty->assign('user', $oUser);

      $oPayment = oxNew(Payment::class);
      $oPayment->load($this->getOrder()->getFieldData('oxpaymenttype'));
      $smarty->assign('payment', $oPayment);

      return $smarty;
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
}