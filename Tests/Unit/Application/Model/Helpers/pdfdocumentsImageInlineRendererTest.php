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

namespace D3\PdfDocuments\Tests\Unit\Application\Model\Helpers;

use D3\PdfDocuments\Application\Model\Helpers\pdfdocumentsImageInlineRenderer;
use D3\TestingTools\Development\CanAccessRestricted;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class pdfdocumentsImageInlineRendererTest extends TestCase
{
    use CanAccessRestricted;

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\Helpers\pdfdocumentsImageInlineRenderer::resolveImagePath
     * @throws ReflectionException
     */
    public function testResolveImagePathForRootRelativeShopPath(): void
    {
        $sut = oxNew(pdfdocumentsImageInlineRenderer::class);
        $expectedPath = realpath(getShopBasePath() . '/out/modules/d3PdfDocuments/out/img/pdf.svg');

        $resolvedPath = $this->callMethod(
            $sut,
            'resolveImagePath',
            ['/out/modules/d3PdfDocuments/out/img/pdf.svg']
        );

        $this->assertSame($expectedPath, $resolvedPath);
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\Helpers\pdfdocumentsImageInlineRenderer::resolveImagePath
     * @throws ReflectionException
     */
    public function testResolveImagePathForAbsoluteFilesystemPath(): void
    {
        $sut = oxNew(pdfdocumentsImageInlineRenderer::class);
        $absolutePath = realpath(getShopBasePath() . '/out/modules/d3PdfDocuments/out/img/clogo.jpg');

        $resolvedPath = $this->callMethod(
            $sut,
            'resolveImagePath',
            [$absolutePath]
        );

        $this->assertSame($absolutePath, $resolvedPath);
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\Helpers\pdfdocumentsImageInlineRenderer::inlineImages
     * @throws ReflectionException
     */
    public function testInlineImages(): void
    {
        $sut = oxNew(pdfdocumentsImageInlineRenderer::class);
        $assetPath = '/out/modules/d3PdfDocuments/out/img/pdf.svg';

        $html = sprintf('<page backimg="%1$s"><img src="%1$s"></page>', $assetPath);

        $result = $this->callMethod(
            $sut,
            'inlineImages',
            [$html]
        );

        $this->assertStringNotContainsString($assetPath, $result);
        $this->assertStringContainsString('backimg="data:', $result);
        $this->assertStringContainsString('<img src="data:', $result);
    }
}
