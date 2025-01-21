<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

declare(strict_types = 1);

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
    public Order $order;

    /**
     * don't use order as constructor argument because of same method interface for all document types
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getOrder(): Order
    {
        Assert::lazy()
            ->that($this->order)->isInstanceOf(Order::class, 'no order for pdf generator set')
            ->that($this->order->isLoaded())->true('given order is not loaded')
            ->verifyNow();

        return $this->order;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getTemplateEngineVars(int $language): array
    {
        parent::setSmartyVars($iSelLang);

        $this->oSmarty->assign('order', $this->getOrder());

        $oUser = oxNew(User::Class);
        $oUser->load($this->getOrder()->getFieldData('oxuserid'));
        $this->oSmarty->assign('user', $oUser);

        $oPayment = oxNew(Payment::class);
        $oPayment->loadInLang($language, $this->getOrder()->getFieldData('oxpaymenttype'));

        return array_merge(
            parent::getTemplateEngineVars($language),
            [
                'order'     => $this->getOrder(),
                'user'      => $oUser,
                'payment'   => $oPayment
            ]
        );
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getFilename(): string
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

    public function getPaymentTerm(): int
    {
        return (int) Registry::getConfig()->getConfigParam('iPaymentTerm') ?? 7;
    }

    public function getPayableUntilDate(): false|int
    {
        return strtotime(
            '+' . $this->getPaymentTerm() . ' day',
            strtotime(
                $this->getOrder()->getFieldData('oxbilldate')
            )
        );
    }
}