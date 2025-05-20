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

use Assert\InvalidArgumentException;
use D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric as pdfdocumentsGenericSut;
use D3\PdfDocuments\Tests\Unit\Application\Model\AbstractClasses\pdfDocumentsGeneric;
use D3\PdfDocuments\Tests\Unit\Helpers\nonOrderDocument;
use Generator;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Utils;
use OxidEsales\Eshop\Core\UtilsView;
use ReflectionException;

class nonOrderDocumentTest extends pdfDocumentsGeneric
{
    protected string $sutClassName = nonOrderDocument::class;

    /**
     * @test
     * @throws ReflectionException
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::downloadPdf
     */
    public function testDownloadPdf(): void
    {
        $utils = $this->getMockBuilder(Utils::class)
                      ->onlyMethods(['showMessageAndExit'])
                      ->getMock();
        $utils->expects($this->once())->method('showMessageAndExit');
        Registry::set(Utils::class, $utils);

        $sut = $this->getMockBuilder($this->sutClassName)
                    ->onlyMethods(['runPreAction', 'genPdf', 'runPostAction'])
                    ->getMock();
        $sut->expects($this->atLeastOnce())->method('runPreAction');
        $sut->expects($this->atLeastOnce())->method('genPdf')->with(
            $this->anything(),
            $this->anything(),
            pdfdocumentsGenericSut::PDF_DESTINATION_DOWNLOAD
        );
        $sut->expects( $this->atLeastOnce() )->method( 'runPostAction' );

        $this->callMethod(
            $sut,
            'downloadPdf',
            [10]
        );
    }

    /**
     * @test
     * @throws ReflectionException
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::savePdfFile
     */
    public function testSavePdfFile(): void
    {
        $sut = $this->getMockBuilder($this->sutClassName)
                    ->onlyMethods(['runPreAction', 'genPdf', 'runPostAction'])
                    ->getMock();
        $sut->expects($this->atLeastOnce())->method('runPreAction');
        $sut->expects($this->atLeastOnce())->method('genPdf')->with(
            $this->anything(),
            $this->anything(),
            pdfdocumentsGenericSut::PDF_DESTINATION_FILE
        );
        $sut->expects($this->atLeastOnce())->method('runPostAction');

        $this->callMethod(
            $sut,
            'savePdfFile',
            [10]
        );
    }

    /**
     * @test
     * @throws ReflectionException
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::getPdfContent
     * @dataProvider getPdfContentDataProvider
     */
    public function testGetPdfContent(bool $throwException, ?string $expected): void
    {
        $sut = $this->getMockBuilder($this->sutClassName)
                    ->onlyMethods(['runPreAction', 'genPdf', 'runPostAction'])
                    ->getMock();
        $sut->expects($this->atLeastOnce())->method('runPreAction');
        $sut->expects($this->atLeastOnce())->method('genPdf')->with(
            $this->anything(),
            $this->anything(),
            pdfdocumentsGenericSut::PDF_DESTINATION_STRING
        )->willReturn('pdfContentFixture');
        if ($throwException) {
            $sut->expects( $this->atLeastOnce() )->method( 'runPostAction' )
                ->willThrowException(new InvalidArgumentException('messageFixture', 200));
        } else {
            $sut->expects( $this->atLeastOnce() )->method( 'runPostAction' );
        }

        $this->assertSame(
            $expected,
            $this->callMethod(
                $sut,
                'getPdfContent',
                [10]
            )
        );
    }

    public static function getPdfContentDataProvider(): Generator
    {
        yield 'no exception' => [false, 'pdfContentFixture'];
        yield 'exception' => [true, null];
    }
}