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

namespace D3\PdfDocuments\Tests\Unit\Application\Model\Registries;

use D3\PdfDocuments\Application\Model\Exceptions\wrongPdfGeneratorInterface;
use D3\PdfDocuments\Application\Model\Registries\registryOrderoverview;
use D3\PdfDocuments\Tests\Unit\Helpers\nonOrderDocument;
use D3\PdfDocuments\Tests\Unit\Helpers\orderDocument;
use D3\TestingTools\Development\CanAccessRestricted;
use Exception;
use Generator;
use PHPUnit\Framework\MockObject\Rule\InvocationOrder;
use PHPUnit\Framework\TestCase;
use ReflectionException;

abstract class registryAbstract extends TestCase
{
    use CanAccessRestricted;

    /**
     * @test
     * @throws ReflectionException
     * @covers \D3\PdfDocuments\Application\Model\Registries\registryAbstract::addGenerator
     * @dataProvider addGeneratorDataProvider
     */
    public function testAddGenerator(bool $exist, InvocationOrder $addInvocation, bool $expectException): void
    {
        $sut = $this->getMockBuilder(registryOrderoverview::class)
            ->onlyMethods(['hasGenerator', 'addItem'])
            ->getMock();
        $sut->method('hasGenerator')->willReturn($exist);
        $sut->expects($addInvocation)->method('addItem');

        if ($expectException) {
            $this->expectException(Exception::class);
        }

        $this->callMethod(
            $sut,
            'addGenerator',
            [orderDocument::class]
        );
    }

    public static function addGeneratorDataProvider(): Generator
    {
        yield 'not added'   => [false, self::once(), false];
        yield 'already added'   => [true, self::never(), true];
    }

    /**
     * @test
     * @throws ReflectionException
     * @covers \D3\PdfDocuments\Application\Model\Registries\registryAbstract::addItem
     * @dataProvider addItemDataProvider
     */
    public function testAddItem(string $fqcn, bool $expectException): void
    {
        $sut = $this->getMockBuilder(registryOrderoverview::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['addGenerator'])
            ->getMock();

        $this->assertArrayNotHasKey($fqcn, $this->getValue($sut, 'registry'));

        if ($expectException) {
            $this->expectException(Exception::class);
        }

        $this->callMethod(
            $sut,
            'addItem',
            [oxNew($fqcn)]
        );

        if ($expectException) {
            $this->assertArrayNotHasKey($fqcn, $this->getValue($sut, 'registry'));
        } else {
            $this->assertArrayHasKey($fqcn, $this->getValue($sut, 'registry'));
        }
    }

    public static function addItemDataProvider(): Generator
    {
        yield 'right interface passed' => [orderDocument::class, false];
        yield 'wrong interface' => [nonOrderDocument::class, true];
    }

    /**
     * @test
     * @throws ReflectionException
     * @covers \D3\PdfDocuments\Application\Model\Registries\registryAbstract::removeGenerator
     * @dataProvider removeGeneratorDataProvider
     */
    public function testRemoveGenerator(bool $exist, bool $removed): void
    {
        $sut = $this->getMockBuilder(registryOrderoverview::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['hasGenerator'])
            ->getMock();
        $sut->method('hasGenerator')->willReturn($exist);

        $this->setValue(
            $sut,
            'registry',
            array_merge(
                $this->getValue(
                    $sut,
                    'registry',
                ),
                [orderDocument::class => oxNew(orderDocument::class)]
            )
        );

        $this->assertArrayHasKey(orderDocument::class, $this->getValue($sut, 'registry'));

        $this->callMethod(
            $sut,
            'removeGenerator',
            [orderDocument::class]
        );

        if ($removed) {
            $this->assertArrayNotHasKey(orderDocument::class, $this->getValue($sut, 'registry'));
        } else {
            $this->assertArrayHasKey(orderDocument::class, $this->getValue($sut, 'registry'));
        }
    }

    public static function removeGeneratorDataProvider(): Generator
    {
        yield 'generator exists' => [true, true];
        yield 'generator does not exist' => [false, false];
    }

    /**
     * @test
     * @throws wrongPdfGeneratorInterface
     * @covers \D3\PdfDocuments\Application\Model\Registries\registryAbstract::hasGenerator
     */
    public function testHasGenerator(): void
    {
        $sut = oxNew(registryOrderoverview::class);

        $this->assertFalse($sut->hasGenerator(orderDocument::class));
        $sut->addGenerator(orderDocument::class);
        $this->assertTrue($sut->hasGenerator(orderDocument::class));
        $sut->removeGenerator(orderDocument::class);
        $this->assertFalse($sut->hasGenerator(orderDocument::class));
    }

    /**
     * @test
     * @throws wrongPdfGeneratorInterface
     * @covers \D3\PdfDocuments\Application\Model\Registries\registryAbstract::getList
     */
    public function testGetList(): void
    {
        $sut = oxNew(registryOrderoverview::class);
        $list = $sut->getList();

        $this->assertIsIterable($list);
        $startCount = count($list);

        $sut->addGenerator(orderDocument::class);
        $this->assertCount($startCount + 1, $sut->getList());

        $sut->removeGenerator(orderDocument::class);
        $this->assertCount($startCount, $sut->getList());
    }

    /**
     * @test
     * @throws wrongPdfGeneratorInterface
     * @covers \D3\PdfDocuments\Application\Model\Registries\registryAbstract::clearList
     */
    public function testClearList(): void
    {
        $sut = oxNew(registryOrderoverview::class);
        $sut->addGenerator(orderDocument::class);
        $sut->clearList();
        $this->assertCount(0, $sut->getList());
    }
}
