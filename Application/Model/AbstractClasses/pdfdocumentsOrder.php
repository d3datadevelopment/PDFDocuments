<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\AbstractClasses;

use Assert\Assert;
use Assert\InvalidArgumentException;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderInterface as orderInterface;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Registry;

abstract class pdfdocumentsOrder extends pdfdocumentsGeneric implements orderInterface
{
    /** @var Order */
    public $oOrder;

    /**
     * don't use order as constructor argument because of same method interface for all document types
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Order $order
     */
    public function setOrder(Order $order)
    {
        $this->oOrder = $order;
    }

    /**
     * @throws InvalidArgumentException
     * @return Order
     */
    public function getOrder()
    {
        Assert::lazy()
            ->that($this->oOrder)->isInstanceOf(Order::class, 'no order for pdf generator set')
            ->that($this->oOrder->isLoaded())->true('given order is not loaded')
            ->verifyNow();

        return $this->oOrder;
    }

    /**
     * @param int $iSelLang
     * @throws InvalidArgumentException
     */
    public function getTemplateEngineVars($iSelLang): array
    {
        $oUser = oxNew(User::Class);
        $oUser->load($this->getOrder()->getFieldData('oxuserid'));

        $oPayment = oxNew(Payment::class);
        $oPayment->loadInLang($iSelLang, $this->getOrder()->getFieldData('oxpaymenttype'));

        return array_merge(
            parent::getTemplateEngineVars($iSelLang),
            [
                'order'    => $this->getOrder(),
                'user'    => $oUser,
                'payment'   => $oPayment
            ]
        );
    }

    /**
     * @return string
     * @throws InvalidArgumentException
     */
    public function getFilename()
    {
        // forced filename from setFilename()
        if ($this->filename) {
            return $this->makeValidFileName(
                $this->addFilenameExtension(
                    $this->filename
                )
            );
        }

        $sTrimmedBillName = trim($this->getOrder()->getFieldData('oxbilllname'));

        return $this->makeValidFileName(
            $this->addFilenameExtension(
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
     * @return int
     */
    public function getPaymentTerm()
    {
// ToDo: check for changing to ModuleSettingService
        if (null === $iPaymentTerm = Registry::getConfig()->getConfigParam('iPaymentTerm')) {
            $iPaymentTerm = 7;
        }

        return $iPaymentTerm;
    }

    /**
     * @return false|int
     * @throws InvalidArgumentException
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