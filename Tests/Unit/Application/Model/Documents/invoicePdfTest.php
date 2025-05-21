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

namespace D3\PdfDocuments\Tests\Unit\Application\Model\Documents;

use D3\PdfDocuments\Application\Model\Documents\invoicePdf;
use D3\PdfDocuments\Tests\Unit\Application\Model\AbstractClasses\pdfDocumentsOrder;
use Generator;
use OxidEsales\Eshop\Application\Model\Order;
use PHPUnit\Framework\MockObject\Rule\InvocationOrder;
use ReflectionException;

class invoicePdfTest extends pdfDocumentsOrder
{
    protected string $sutClassName = invoicePdf::class;

    public static function getFileNameDataProvider(): Generator
    {
        yield 'predefined' => ['predefinedFileName', 'predefinedfilename.pdf'];
        yield 'undefined' => [null, 'invoice_ordernumberfixture_billlnamefixture.pdf'];
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\Documents\invoicePdf::runPreAction
     * @covers \D3\PdfDocuments\Application\Model\Documents\invoicewithoutlogoPdf::runPreAction
     * @throws ReflectionException
     */
    public function testPreAction(): void
    {
        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['setInvoiceNumber', 'setInvoiceDate', 'saveOrderOnChanges'])
            ->getMock();
        $sut->expects($this->once())->method('setInvoiceNumber');
        $sut->expects($this->once())->method('setInvoiceDate');
        $sut->expects($this->once())->method('saveOrderOnChanges');

        $this->callMethod(
            $sut,
            'runPreAction',
        );
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\Documents\invoicePdf::setInvoiceNumber
     * @covers \D3\PdfDocuments\Application\Model\Documents\invoicewithoutlogoPdf::setInvoiceNumber
     * @throws ReflectionException
     * @dataProvider setInvoiceNumberDataProvider
     */
    public function testSetInvoiceNumber(?string $setBillNo, InvocationOrder $expectNewBillNo, bool $changedOrder): void
    {
        $order = $this->getMockBuilder(Order::class)
            ->onlyMethods(['getFieldData', 'assign', 'getNextBillNum'])
            ->getMock();
        $order->method('getFieldData')->willReturnMap([
            ['oxbillnr', $setBillNo],
        ]);
        $order->expects($expectNewBillNo)->method('assign');
        $order->method('getNextBillNum')->willReturn(1234);

        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['getOrder'])
            ->getMock();
        $sut->method('getOrder')->willReturn($order);

        $this->callMethod(
            $sut,
            'setInvoiceNumber',
        );

        $this->assertSame(
            $changedOrder,
            $this->getValue(
                $sut,
                'orderIsChanged',
            )
        );
    }

    public static function setInvoiceNumberDataProvider(): Generator
    {
        yield 'has bill no' => ['4567', self::never(), false];
        yield 'has not bill no' => [null, self::atLeastOnce(), true];
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\Documents\invoicePdf::setInvoiceDate
     * @covers \D3\PdfDocuments\Application\Model\Documents\invoicewithoutlogoPdf::setInvoiceDate
     * @throws ReflectionException
     * @dataProvider setInvoiceDateDataProvider
     */
    public function testSetInvoiceDate(?string $setBillDate, InvocationOrder $expectNewBillNo, bool $changedOrder): void
    {
        $order = $this->getMockBuilder(Order::class)
            ->onlyMethods(['getFieldData', 'assign'])
            ->getMock();
        $order->method('getFieldData')->willReturnMap([
            ['oxbilldate', $setBillDate],
        ]);
        $order->expects($expectNewBillNo)->method('assign');

        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['getOrder'])
            ->getMock();
        $sut->method('getOrder')->willReturn($order);

        $this->callMethod(
            $sut,
            'setInvoiceDate',
        );

        $this->assertSame(
            $changedOrder,
            $this->getValue(
                $sut,
                'orderIsChanged',
            )
        );
    }

    public static function setInvoiceDateDataProvider(): Generator
    {
        yield 'has bill no' => ['2020-01-01', self::never(), false];
        yield 'has not bill no' => ['0000-00-00', self::atLeastOnce(), true];
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\Documents\invoicePdf::saveOrderOnChanges
     * @covers \D3\PdfDocuments\Application\Model\Documents\invoicewithoutlogoPdf::saveOrderOnChanges
     * @throws ReflectionException
     * @dataProvider saveOrderOnChangesDataProvider
     */
    public function testSaveOrderOnChanges(InvocationOrder $saveInvocation, bool $orderIsChanged): void
    {
        $order = $this->getMockBuilder(Order::class)
            ->onlyMethods(['save'])
            ->getMock();
        $order->expects($saveInvocation)->method('save');

        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['getOrder'])
            ->getMock();
        $sut->method('getOrder')->willReturn($order);

        $this->setValue(
            $sut,
            'orderIsChanged',
            $orderIsChanged,
        );

        $this->callMethod(
            $sut,
            'saveOrderOnChanges',
        );
    }

    public static function saveOrderOnChangesDataProvider(): Generator
    {
        yield 'is changed' => [self::once(), true];
        yield 'not changed' => [self::never(), false];
    }
}
