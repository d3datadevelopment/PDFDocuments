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

namespace D3\PdfDocuments\Tests\Unit\Application\Model\AbstractClasses;

use Assert\InvalidArgumentException;
use D3\PdfDocuments\Application\Model\Documents\deliverynotePdf;
use Exception;
use Generator;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use ReflectionException;

abstract class pdfDocumentsOrder extends pdfDocumentsGeneric
{
    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder::getOrder
     * @throws ReflectionException
     */
    public function testGetUnsetOrder(): void
    {
        $sut = oxNew($this->sutClassName);

        $this->expectException(InvalidArgumentException::class);

        $this->callMethod(
            $sut,
            'getOrder'
        );
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder::getOrder
     * @throws ReflectionException
     */
    public function testGetUnloadedOrder(): void
    {
        /** @var deliverynotePdf $sut */
        $sut = oxNew($this->sutClassName);

        $this->expectException(InvalidArgumentException::class);
        $sut->setOrder(oxNew(Order::class));

        $this->callMethod(
            $sut,
            'getOrder'
        );
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder::getOrder
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder::setOrder
     * @throws ReflectionException
     */
    public function testGetLoadedOrder(): void
    {
        /** @var deliverynotePdf $sut */
        $sut = oxNew($this->sutClassName);

        $order = $this->getMockBuilder(Order::class)
            ->onlyMethods(['isLoaded'])
            ->getMock();
        $order->method('isLoaded')->willReturn(true);

        $sut->setOrder($order);

        $this->assertSame(
            $order,
            $this->callMethod(
                $sut,
                'getOrder'
            )
        );
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder::getTemplateEngineVars
     * @throws ReflectionException
     */
    public function testGetTemplateEngineVars(): void
    {
        $order = oxNew(Order::class);

        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['getOrder'])
            ->getMock();
        $sut->method('getOrder')->willReturn($order);

        $vars = $this->callMethod(
            $sut,
            'getTemplateEngineVars',
            [0]
        );

        $this->assertArrayHasKey('order', $vars);
        $this->assertArrayHasKey('user', $vars);
        $this->assertArrayHasKey('payment', $vars);
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder::getFilename
     * @covers \D3\PdfDocuments\Application\Model\Documents\invoicePdf::getFilename
     * @covers \D3\PdfDocuments\Application\Model\Documents\invoicewithoutlogoPdf::getFilename
     * @dataProvider getFileNameDataProvider
     * @throws ReflectionException
     */
    public function testGetFileName(mixed $predefinedFileName, string $expected): void
    {
        $order = $this->getMockBuilder(Order::class)
            ->onlyMethods(['getFieldData'])
            ->getMock();
        $order->method('getFieldData')->willReturnMap([
            ['oxbilllname', 'billLNameFixture'],
            ['oxordernr', 'orderNumberFixture'],
        ]);

        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['getOrder'])
            ->getMock();
        $sut->method('getOrder')->willReturn($order);

        if ($predefinedFileName) {
            $this->setValue($sut, 'filename', $predefinedFileName);
        }

        $this->assertSame(
            $expected,
            $this->callMethod(
                $sut,
                'getFileName'
            )
        );
    }

    abstract public static function getFileNameDataProvider(): Generator;

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder::getPaymentTerm
     * @throws ReflectionException
     */
    public function testGetPaymentTerm(): void
    {
        $settingService = $this->getMockBuilder(ModuleSettingService::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getInteger'])
            ->getMock();
        $settingService->method('getInteger')->willReturn(10);

        $this->addServiceMocks([
            ModuleSettingServiceInterface::class    => $settingService,
        ]);

        $sut = oxNew($this->sutClassName);

        try {
            $this->assertSame(
                10,
                $this->callMethod(
                    $sut,
                    'getPaymentTerm'
                )
            );
        } finally {
            ContainerFactory::resetContainer();
        }
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder::getPaymentTerm
     * @throws ReflectionException
     */
    public function testGetPaymentTermUnknownSetting(): void
    {
        $settingService = $this->getMockBuilder(ModuleSettingService::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getInteger'])
            ->getMock();
        $settingService->method('getInteger')->willThrowException(new Exception());

        $this->addServiceMocks([
            ModuleSettingServiceInterface::class    => $settingService,
        ]);

        $sut = oxNew($this->sutClassName);

        try {
            $this->assertSame(
                7,
                $this->callMethod(
                    $sut,
                    'getPaymentTerm'
                )
            );
        } finally {
            ContainerFactory::resetContainer();
        }
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder::getPayableUntilDate
     * @throws ReflectionException
     * @dataProvider getPayableUntilDateDataProvider
     */
    public function testGetPayableUntilDate($billdate, $expected): void
    {
        $order = oxNew(Order::class);
        $order->assign(['oxbilldate' => $billdate]);

        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['getOrder', 'getPaymentTerm'])
            ->getMock();
        $sut->method('getOrder')->willReturn($order);
        $sut->method('getPaymentTerm')->willReturn(10);

        $return = $this->callMethod(
            $sut,
            'getPayableUntilDate'
        );

        if (is_int($expected)) {
            $this->assertSame($expected, $return);
        } else {
            $this->assertGreaterThan(time(), $return);
        }
    }

    public static function getPayableUntilDateDataProvider(): Generator
    {
        yield 'date set' => ['2020-01-01', 1578697200];
        yield 'zero date set' => ['0000-00-00', null];  // expected greater than now
        yield 'date is null' => [null, null];     // expected greater than now
    }
}
