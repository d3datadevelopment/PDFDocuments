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

namespace D3\PdfDocuments\Tests\Unit\Application\Model\Exceptions;

use D3\PdfDocuments\Application\Model\Exceptions\noPdfHandlerFoundException;
use D3\PdfDocuments\Application\Model\Exceptions\wrongPdfGeneratorInterface;
use D3\TestingTools\Development\CanAccessRestricted;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class wrongPdfGeneratorInterfaceTest extends TestCase
{
    use CanAccessRestricted;

    /**
     * @covers \D3\PdfDocuments\Application\Model\Exceptions\wrongPdfGeneratorInterface::__construct
     * @test
     * @throws ReflectionException
     */
    public function testConstruct(): void
    {
        $fixture = 'requestIdFixture';

        $sut = $this->getMockBuilder(wrongPdfGeneratorInterface::class)
            ->setConstructorArgs([$fixture])
            ->getMock();

        $this->assertStringEndsWith(
            $fixture,
            $this->callMethod(
                $sut,
                'getMessage'
            )
        );

        $sut = $this->getMockBuilder(wrongPdfGeneratorInterface::class)
            ->setConstructorArgs([$fixture, 'custom message'])
            ->getMock();

        $this->assertStringEndsWith(
            $fixture,
            $this->callMethod(
                $sut,
                'getMessage'
            )
        );
    }
}
