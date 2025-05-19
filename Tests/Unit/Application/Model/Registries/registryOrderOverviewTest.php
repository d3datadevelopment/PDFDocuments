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

use D3\PdfDocuments\Application\Model\Documents\invoicePdf;
use D3\PdfDocuments\Application\Model\Registries\registryOrderoverview;
use D3\PdfDocuments\Tests\Unit\Helpers\nonOrderDocument;
use D3\TestingTools\Development\CanAccessRestricted;
use Exception;
use Generator;
use PHPUnit\Framework\MockObject\Rule\InvocationOrder;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class registryOrderOverviewTest extends TestCase
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
            [invoicePdf::class]
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
        dumpvar(__LINE__);
        yield 'right interface passed' => [invoicePdf::class, false];
        dumpvar(__LINE__);
        yield 'wrong interface' => [nonOrderDocument::class, true];
        dumpvar(__LINE__);
    }
}