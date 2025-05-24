<?php

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

declare(strict_types=1);

namespace D3\PdfDocuments\Application\Model\AbstractClasses;

use Assert\Assert;
use Assert\InvalidArgumentException;
use D3\PdfDocuments\Application\Model\Constants;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderInterface as orderInterface;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use Throwable;

abstract class pdfdocumentsOrder extends pdfdocumentsGeneric implements orderInterface
{
    public ?Order $order = null;

    /**
     * don't use order as constructor argument because of the same method interface for all document types
     * @codeCoverageIgnore
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
        Assert::that($this->order)->isInstanceOf(Order::class, 'no order for pdf generator set');
        Assert::that($this->order->isLoaded())->true('given order is not loaded');

        return $this->order;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getTemplateEngineVars(int $language): array
    {
        $oUser = oxNew(User::class);
        $oUser->load($this->getOrder()->getFieldData('oxuserid'));

        $oPayment = oxNew(Payment::class);
        $oPayment->loadInLang($language, $this->getOrder()->getFieldData('oxpaymenttype'));

        return array_merge(
            parent::getTemplateEngineVars($language),
            [
                'order'     => $this->getOrder(),
                'user'      => $oUser,
                'payment'   => $oPayment,
            ]
        );
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getFilename(): string
    {
        // forced filename from setFilename()
        if (!$this->filename || !trim($this->filename)) {
            $sTrimmedBillName = trim($this->getOrder()->getFieldData('oxbilllname'));

            $this->filename = implode(
                '_',
                [
                    $this->getTypeForFilename(),
                    $this->getOrder()->getFieldData('oxordernr'),
                    $sTrimmedBillName,
                ]
            );
        }

        return $this->sanitizeFileName(
            $this->addFilenameExtension(
                $this->filename
            )
        );
    }

    public function getPaymentTerm(): int
    {
        try {
            /** @var ModuleSettingService $settingService */
            $settingService = ContainerFactory::getInstance()->getContainer()
                ->get(ModuleSettingServiceInterface::class);
            return $settingService->getInteger('invoicePaymentTerm', Constants::OXID_MODULE_ID);
        } catch (Throwable) {
            return 7;
        }
    }

    public function getPayableUntilDate(): false|int
    {
        $startDate = $this->getOrder()->getFieldData('oxbilldate');

        try {
            Assert::that($startDate)->date('Y-m-d');
            $startDate = strtotime($startDate);
        } catch (InvalidArgumentException) {
            $startDate = strtotime(date('Y-m-d'));
        }

        return strtotime(
            '+' . $this->getPaymentTerm() . ' day',
            $startDate
        );
    }
}
