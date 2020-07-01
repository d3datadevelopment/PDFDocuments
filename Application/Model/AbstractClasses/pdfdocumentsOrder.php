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

use D3\PdfDocuments\Application\Model\Exceptions\noBaseObjectSetException;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderInterface as orderInterface;
use \OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Registry;
use Spipu\Html2Pdf\Exception\Html2PdfException;

abstract class pdfdocumentsOrder extends pdfdocumentsGeneric implements orderInterface
{
    /** @var Order */
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

    /**
     * @param int $iSelLang
     */
    public function setSmartyVars($iSelLang)
    {
        parent::setSmartyVars($iSelLang);

        $this->oSmarty->assign('order', $this->getOrder());

        $oUser = oxNew(User::Class);
        $oUser->load($this->getOrder()->getFieldData('oxuserid'));
        $this->oSmarty->assign('user', $oUser);

        $oPayment = oxNew(Payment::class);
        $oPayment->loadInLang($iSelLang, $this->getOrder()->getFieldData('oxpaymenttype'));
        $this->oSmarty->assign('payment', $oPayment);
    }

    /**
     * @param string $sFilename
     *
     * @return string
     */
    public function getFilename()
    {
        // forced filename from setFilename()
        if ($this->filename) {
            return $this->addFilenameExtension(
                $this->makeValidFileName(
                    $this->filename
                )
            );
        }

        $sTrimmedBillName = trim($this->getOrder()->getFieldData('oxbilllname'));

        return $this->addFilenameExtension(
            $this->makeValidFileName(
                implode(
                    '_',
                    [
                        $this->getTypeForFilename(),
                        $this->getOrder()->getFieldData('oxordernr'),
                        $sTrimmedBillName
                    ]
                )
            )
        );
    }

    /**
     * @param        $sFilename
     * @param int    $iSelLang
     * @param string $target
     *
     * @return mixed|string|void
     * @throws Html2PdfException
     * @throws noBaseObjectSetException
     */
    public function genPdf($sFilename, $iSelLang = 0, $target = 'I')
    {
        if (false == $this->getOrder()) {
            $e = oxNew(noBaseObjectSetException::class);
            throw $e;
        }

        return parent::genPdf($sFilename, $iSelLang, $target);
    }

    /**
     * @return int
     */
    public function getPaymentTerm()
    {
        if (null === $iPaymentTerm = Registry::getConfig()->getConfigParam('iPaymentTerm')) {
            $iPaymentTerm = 7;
        }

        return $iPaymentTerm;
    }

    /**
     * @return false|string
     */
    public function getPayableUntilDate()
    {
        return strtotime(
            '+' . $this->getPaymentTerm() . ' day',
            strtotime(
                $this->getOrder()->getFieldData('oxbilldate')
            )
        );
    }
}