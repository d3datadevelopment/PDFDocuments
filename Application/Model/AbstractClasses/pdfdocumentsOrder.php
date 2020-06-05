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

    public function setSmartyVars()
    {
        parent::setSmartyVars();

        $this->oSmarty->assign('order', $this->getOrder());

        $oUser = oxNew(User::Class);
        $oUser->load($this->getOrder()->getFieldData('oxuserid'));
        $this->oSmarty->assign('user', $oUser);

        $oPayment = oxNew(Payment::class);
        $oPayment->load($this->getOrder()->getFieldData('oxpaymenttype'));
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
            return $this->filename;
        }

        $sTrimmedBillName = trim($this->getOrder()->getFieldData('oxbilllname'));

        return implode(
            '_',
            [
                $this->getTypeForFilename(),
                $this->getOrder()->getFieldData('oxordernr'),
                $sTrimmedBillName . ".pdf"
            ]
        );
    }

    /**
     * @param $sFilename
     * @param int $iSelLang
     * @param string $target
     * @throws noBaseObjectSetException
     */
    public function genPdf($sFilename, $iSelLang = 0, $target = 'I')
    {
        if (false == $this->getOrder()) {
            $e = oxNew(noBaseObjectSetException::class);
            throw $e;
        }

        parent::genPdf($sFilename, $iSelLang, $target);
    }
}