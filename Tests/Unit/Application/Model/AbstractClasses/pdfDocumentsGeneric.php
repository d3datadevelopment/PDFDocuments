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

use D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric as pdfdocumentsGenericSut;
use D3\TestingTools\Development\CanAccessRestricted;
use Generator;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Spipu\Html2Pdf\Html2Pdf;

abstract class pdfDocumentsGeneric extends TestCase
{
    use CanAccessRestricted;
    protected string $sutClassName;

    /**
     * @test
     * @throws ReflectionException
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::setDevelopmentMode
     */
    public function testSetDevelopmentMode(): void
    {
        $sut = oxNew($this->sutClassName);

        $this->assertFalse($this->getValue($sut, 'devMode'));

        $this->callMethod(
            $sut,
            'setDevelopmentMode',
            [true]
        );

        $this->assertTrue($this->getValue($sut, 'devMode'));

        $this->callMethod(
            $sut,
            'setDevelopmentMode',
            [false]
        );

        $this->assertFalse($this->getValue($sut, 'devMode'));
    }

    /**
     * @test
     * @throws ReflectionException
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::genPdf
     */
    public function testGenPdf(): void
    {
        $html = 'htmlFixture';

        $html2Pdf = $this->getMockBuilder(Html2Pdf::class)
            ->onlyMethods(['writeHTML'])
            ->getMock();
        $html2Pdf->method('writeHTML')->with($this->identicalTo($html));

        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['getHtml2Pdf', 'getHTMLContent', 'output'])
            ->getMock();
        $sut->method('getHtml2Pdf')->willReturn($html2Pdf);
        $sut->method('getHTMLContent')->willReturn($html);
        $sut->method('output')->with(
            $this->identicalTo($html2Pdf),
            $this->identicalTo('fileNameFixture'),
            $this->identicalTo(pdfdocumentsGenericSut::PDF_DESTINATION_FILEANDDOWNLOAD),
            $this->identicalTo($html),
        )->willReturn('expectedReturn');

        $this->assertSame(
            'expectedReturn',
            $this->callMethod(
                $sut,
                'genPdf',
                [ 'fileNameFixture', 10, pdfdocumentsGenericSut::PDF_DESTINATION_FILEANDDOWNLOAD]
            )
        );
    }

    /**
     * @test
     * @throws ReflectionException
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::getHtml2Pdf
     */
    public function testGetHtml2Pdf(): void
    {
        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['getPdfProperties'])
            ->getMock();
        $sut->expects($this->once())->method('getPdfProperties');

        $this->assertInstanceOf(
            Html2Pdf::class,
            $this->callMethod(
                $sut,
                'getHtml2Pdf'
            )
        );
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::getTemplateEngineVars
     * @throws ReflectionException
     */
    public function testGetTemplateEngineVars(): void
    {
        $sut = oxNew($this->sutClassName);

        $vars = $this->callMethod(
            $sut,
            'getTemplateEngineVars',
            [0]
        );

        $this->assertArrayHasKey('config', $vars);
        $this->assertArrayHasKey('oViewConf', $vars);
        $this->assertArrayHasKey('shop', $vars);
        $this->assertArrayHasKey('lang', $vars);
        $this->assertArrayHasKey('document', $vars);
    }

    /**
     * @covers \D3\PdfDocuments\Application\Model\Documents\deliverynotePdf::sanitizeFileName
     * @covers \D3\PdfDocuments\Application\Model\Documents\deliverynotePdf::beautifyFilename
     * @test
     * @throws ReflectionException
     * @dataProvider sanitizeFileNameDataProvider
     */
    public function testSanitizeFileName($filename, $expected): void
    {
        $sut = oxNew($this->sutClassName);

        $this->assertSame(
            $expected,
            $this->callMethod(
                $sut,
                'sanitizeFileName',
                [$filename]
            )
        );
    }

    /**
     * @return Generator
     */
    public function sanitizeFileNameDataProvider(): Generator
    {
        yield 'file system reserved'      => ["ab<>cd\\ef*ghi.ext", 'ab-cd-ef-ghi.ext'];
        yield 'control characters'        => [".abc\x00def\x01ghi.ext", 'abc-def-ghi.ext'];
        yield 'non-printing characters'   => ["..abc\x7Fdef\xA0ghi.ext", 'abc-def-ghi.ext'];
        yield 'URI reserved'              => ['abc#def@&ghi.ext', 'abc-def-ghi.ext'];
        yield 'URL unsafe characters'     => ["abc{def~ghi.ext", 'abc-def-ghi.ext'];
        yield 'umlauts'                   => ["abücdßefÄgh.ext", 'abucdssefagh.ext'];
        yield 'accents'                   => ["abçcdïeféghùijôkl.ext", 'abccdiefeghuijokl.ext'];
        yield 'currency signs'            => ['ab€cd£ef$gh?ij¢kl¥m.ext', 'abeurcd-ef-gh-ij-kl-m.ext'];
        yield 'cyrillic'                  => ['Тестовый текст.ext', 'testovyj-tekst.ext'];
        yield 'arabic'                    => ['نص اختباري.ext', 'ns-akhtbary.ext'];
        yield 'long string'               => [str_repeat("a", 300).".ext", str_repeat('a', 251).'.ext'];
    }

    /**
     * @covers \D3\ModCfg\Application\Model\d3filesystem::beautifyFilename
     * @test
     * @throws ReflectionException
     * @dataProvider beautifyFilenameTestDataProvider
     */
    public function beautifyFilenameTest(string $fileName, string $expected): void
    {
        $sut = oxNew($this->sutClassName);

        $this->assertSame(
            $expected,
            $this->callMethod(
                $sut,
                'beautifyFilename',
                [$fileName]
            )
        );
    }

    /**
     * @return Generator
     */
    public function beautifyFilenameTestDataProvider(): Generator
    {
        yield 'spaces'                => ['file   name.zip', 'file-name.zip'];
        yield 'underscores'           => ['file___name.zip', 'file-name.zip'];
        yield 'dashes'                => ['file---name.zip', 'file-name.zip'];
        yield 'dot separated dashes'  => ['file--.--.-.--name.zip', 'file.name.zip'];
        yield 'dotted'                => [' file...name..zip ', 'file.name.zip'];
        yield 'mixed cases'           => ['fIleNaMe..zIp', 'filename.zip'];
        yield 'trimmed'               => ['.file-name.-', 'file-name'];
        yield 'single underscore'     => ['file_name', 'file_name'];
        yield 'empty'                 => ['', ''];
    }
}
