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
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Modules\Application\Model;

use OxidEsales\EshopCommunity\Application\Model\User;
use OxidEsales\EshopCommunity\Application\Model\Payment;
use OxidEsales\Eshop\Core\Registry;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

class d3_Order_PdfDocuments extends d3_Order_PdfDocuments_parent
{
    /**
     * @param string $sFilename
     * @param int $iSelLang
     * @param string $target
     * @throws Html2PdfException
     */
    public function genPdf($sFilename, $iSelLang = 0, $target = 'I')
    {
        self::$_blIsAdmin = false;

        $oSmarty = Registry::getUtilsView()->getSmarty();
        $oSmarty->assign('oConfig', Registry::getSession()->getConfig());
        $oSmarty->assign('oViewConf', Registry::getSession()->getConfig()->getActiveView()->getViewConfig());
        $oSmarty->assign('order', $this);
        $oSmarty->assign('shop', Registry::getSession()->getConfig()->getActiveShop());
        $oSmarty->assign('lang', Registry::getLang());

        $oUser= oxNew(User::Class);
        $oUser->load($this->oxorder__oxuserid->value);
        $oSmarty->assign('user', $oUser);

        $oPayment= oxNew(Payment::class);
        $oPayment->load($this->oxorder__oxpaymenttype->value);
        $oSmarty->assign('payment', $oPayment);

        //in eigene Funktion auslagern//
        $blIsNewOrder = 0;
        // setting invoice number
        if (!$this->oxorder__oxbillnr->value) {
          $this->oxorder__oxbillnr->setValue($this->getNextBillNum());
          $blIsNewOrder = 1;
        }
        // setting invoice date
        if ($this->oxorder__oxbilldate->value == '0000-00-00') {
          $this->oxorder__oxbilldate->setValue(date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y'))));
          $blIsNewOrder = 1;
        }
        // saving order if new number or date
        if ($blIsNewOrder) {
          $this->save();
        }


        switch (Registry::getRequest()->getRequestParameter('pdftype')) {
            case ('dnote'):
            case ('dnote_without_logo'):
                $sContent = $oSmarty->fetch($this->getDeliveryNoteTemplate());
                break;
            default:
                $sContent = $oSmarty->fetch($this->getDeliveryNoteTemplate());
        }

        $sFilename = str_replace( $this->oxorder__oxordernr->value, $this->oxorder__oxbillnr->value, $sFilename);

        $oPdf = oxNew(Html2Pdf::class, 'P', 'A4', 'de');
        $oPdf->writeHTML($sContent);
        $oPdf->output($sFilename, $target);
    }

    public function getDeliveryNoteTemplate()
    {
        return 'd3deliverynote.tpl';
    }
}