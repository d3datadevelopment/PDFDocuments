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
use org\bovigo\vfs\vfsStream;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Utils;
use OxidEsales\Eshop\Core\UtilsView;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRenderer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Rule\InvocationOrder;
use ReflectionException;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\MyPdf;
use Symfony\Component\String\UnicodeString;

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
        $sut->expects($this->atLeastOnce())->method('runPostAction');

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
            $sut->expects($this->atLeastOnce())->method('runPostAction')
                ->willThrowException(new InvalidArgumentException('messageFixture', 200));
        } else {
            $sut->expects($this->atLeastOnce())->method('runPostAction');
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

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::getHTMLContent
     * @throws ReflectionException
     */
    public function testGetHTMLContent(): void
    {
        $templateRender = $this->getMockBuilder(TemplateRenderer::class)
            ->onlyMethods(['renderTemplate'])
            ->disableOriginalConstructor()
            ->getMock();
        $templateRender->method('renderTemplate')->willReturn('htmlContentFixture');

        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['getTemplateRenderer', 'addBasicAuth'])
            ->getMock();
        $sut->method('getTemplateRenderer')->willReturn($templateRender);
        $sut->method('addBasicAuth')->willReturnArgument(0);

        $this->assertSame(
            'htmlContentFixture',
            $this->callMethod(
                $sut,
                'getHTMLContent',
            )
        );
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::addBasicAuth
     * @throws ReflectionException
     * @dataProvider addBasicAuthDataProvider
     */
    public function testAddBasicAuth(string $credential, string $expected): void
    {
        $source = '<a href="https://www.test.dev/image.jpg">image</a>';

        $settingService = $this->getMockBuilder(ModuleSettingService::class)
            ->onlyMethods(['getString'])
            ->disableOriginalConstructor()
            ->getMock();
        $settingService->method('getString')->willReturn(new UnicodeString($credential));

        $config = $this->getMockBuilder(Config::class)
            ->onlyMethods(['getShopCurrentUrl'])
            ->getMock();
        $config->method('getShopCurrentUrl')->willReturn('https://www.test.dev/index.php');

        $this->addServiceMocks([ModuleSettingServiceInterface::class => $settingService]);
        $currentConfig = Registry::getConfig();
        Registry::set(Config::class, $config);

        $sut = oxNew($this->sutClassName);

        try {
            $this->assertSame(
                $expected,
                $this->callMethod(
                    $sut,
                    'addBasicAuth',
                    [ $source ]
                )
            );
        } finally {
            Registry::set(Config::class, $currentConfig);
            ContainerFactory::resetContainer();
        }
    }

    public static function addBasicAuthDataProvider(): Generator
    {
        yield 'no credential' => ['', '<a href="https://www.test.dev/image.jpg">image</a>'];
        yield 'credential' => ['crd', '<a href="https://crd:crd@www.test.dev/image.jpg">image</a>'];
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::setFilename
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::getFilename
     * @throws ReflectionException
     * @dataProvider setFilenameDataProvider
     */
    public function testGetFileName(?string $setFileName, InvocationOrder $getTypeInvocation, string $expected): void
    {
        /** @var MockObject|nonOrderDocument $sut */
        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['sanitizeFileName', 'addFilenameExtension', 'getTypeForFilename'])
            ->getMock();
        $sut->expects($this->once())->method('sanitizeFileName')->willReturnArgument(0);
        $sut->expects($this->once())->method('addFilenameExtension')->willReturnArgument(0);
        $sut->expects($getTypeInvocation)->method('getTypeForFilename')->willReturn('docType');

        if ($setFileName) {
            $sut->setFileName($setFileName);
        }

        $this->assertSame(
            $expected,
            $this->callMethod(
                $sut,
                'getFileName'
            )
        );
    }

    public static function setFilenameDataProvider(): Generator
    {
        yield 'no set filename' => [null, self::once(), 'docType'];
        yield 'set filename' => ['document', self::never(), 'document'];
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::addFilenameExtension
     * @throws ReflectionException
     * @dataProvider addFilenameExtensionDataProvider
     */
    public function testAddFilenameExtension(string $filename, string $expected): void
    {
        $sut = oxNew($this->sutClassName);

        $this->assertSame(
            $expected,
            $this->callMethod(
                $sut,
                'addFilenameExtension',
                [$filename]
            )
        );
    }

    public static function addFilenameExtensionDataProvider(): Generator
    {
        yield 'no extension' => ['document', 'document.pdf'];
        yield 'with extension' => ['document.pdf', 'document.pdf'];
        yield 'with different extensions' => ['document.txt', 'document.txt.pdf'];
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::output
     * @throws ReflectionException
     * @dataProvider outputDataProvider
     */
    public function testOutput(bool $dev, InvocationOrder $outputInvocation, InvocationOrder $devInvocation): void
    {
        $pdf = $this->getMockBuilder(Html2Pdf::class)
            ->onlyMethods(['output'])
            ->getMock();
        $pdf->expects($outputInvocation)->method('output');

        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['outputDev'])
            ->getMock();
        $sut->expects($devInvocation)->method('outputDev');

        $this->setValue($sut, 'devMode', $dev);

        $this->callMethod(
            $sut,
            'output',
            [$pdf, 'fileNameFixture', 'targetFixture', 'htmlFixture']
        );
    }

    public static function outputDataProvider(): Generator
    {
        yield 'is dev'  => [true, self::never(), self::once()];
        yield 'is prod'  => [false, self::once(), self::never()];
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::outputDev
     * @throws ReflectionException
     * @dataProvider outputDevDataProvider
     */
    public function testOutputDev(
        string $target,
        InvocationOrder $stdout,
        InvocationOrder $download,
        InvocationOrder $file,
        InvocationOrder $error,
        ?string $expectedReturn
    ): void {
        $myPdf = $this->getMockBuilder(MyPdf::class)
            ->onlyMethods(['Error'])
            ->getMock();
        $myPdf->expects($error)->method('Error');

        $pdf = oxNew(Html2Pdf::class);
        $this->setValue($pdf, 'pdf', $myPdf);

        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['outputDev_stdout', 'outputDev_download', 'outputDev_saveLocal'])
            ->getMock();
        $sut->expects($stdout)->method('outputDev_stdout');
        $sut->expects($download)->method('outputDev_download');
        $sut->expects($file)->method('outputDev_saveLocal');

        $this->assertSame(
            $expectedReturn,
            $this->callMethod(
                $sut,
                'outputDev',
                [$pdf, 'fileNameFixture', $target, 'htmlFixture']
            )
        );
    }

    public static function outputDevDataProvider(): Generator
    {
        yield 'stdout' => [pdfdocumentsGenericSut::PDF_DESTINATION_STDOUT, self::once(), self::never(), self::never(), self::never(), null];
        yield 'download' => [pdfdocumentsGenericSut::PDF_DESTINATION_DOWNLOAD, self::never(), self::once(), self::never(), self::never(), null];
        yield 'file' => [pdfdocumentsGenericSut::PDF_DESTINATION_FILE, self::never(), self::never(), self::once(), self::never(), null];
        yield 'string' => [pdfdocumentsGenericSut::PDF_DESTINATION_STRING, self::never(), self::never(), self::never(), self::never(), 'htmlFixture'];
        yield 'other' => ['unknown', self::never(), self::never(), self::never(), self::once(), null];
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::outputDev_stdout
     * @throws ReflectionException
     */
    public function testOutputDev_stdout_formerOutput(): void
    {
        $myPdf = $this->getMockBuilder(MyPdf::class)
            ->onlyMethods(['Error'])
            ->getMock();
        $myPdf->expects($this->once())->method('Error');

        $pdf = oxNew(Html2Pdf::class);
        $this->setValue($pdf, 'pdf', $myPdf);

        ob_start();
        echo 'formerOutput';

        $sut = oxNew($this->sutClassName);
        $this->callMethod(
            $sut,
            'outputDev_stdout',
            [$pdf, 'fileNameFixture', 'htmlFixture']
        );

        ob_end_clean();
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::outputDev_stdout
     * @throws ReflectionException
     * @dataProvider outputDev_stdout_noFormerOutputDataProvider
     */
    public function testOutputDev_stdout_noFormerOutput(bool $isCli): void
    {
        $myPdf = $this->getMockBuilder(MyPdf::class)
            ->onlyMethods(['Error'])
            ->getMock();
        $myPdf->expects($this->never())->method('Error');

        $pdf = oxNew(Html2Pdf::class);
        $this->setValue($pdf, 'pdf', $myPdf);

        ob_start();
        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['isCli', 'headersSent'])
            ->getMock();
        $sut->method('isCli')->willReturn($isCli);
        $sut->method('headersSent')->willReturn(false);

        $this->callMethod(
            $sut,
            'outputDev_stdout',
            [$pdf, 'fileNameFixture', 'htmlFixture']
        );

        $output = ob_get_contents();
        ob_end_clean();

        $this->assertSame(
            $output,
            'htmlFixture'
        );
    }

    public static function outputDev_stdout_noFormerOutputDataProvider(): Generator
    {
        yield 'is cli' => [true];
        yield 'is not cli' => [false];
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::outputDev_download
     * @throws ReflectionException
     */
    public function testOutputDev_download_formerOutput(): void
    {
        $myPdf = $this->getMockBuilder(MyPdf::class)
          ->onlyMethods(['Error'])
          ->getMock();
        $myPdf->expects($this->once())->method('Error');

        $pdf = oxNew(Html2Pdf::class);
        $this->setValue($pdf, 'pdf', $myPdf);

        ob_start();
        echo 'formerOutput';

        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['headersSent'])
            ->getMock();
        $sut->method('headersSent')->willReturn(false);
        $this->callMethod(
            $sut,
            'outputDev_download',
            [$pdf, 'fileNameFixture', 'htmlFixture']
        );

        ob_end_clean();
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::outputDev_download
     * @throws ReflectionException
     */
    public function testOutputDev_download_noFormerOutput(): void
    {
        $myPdf = $this->getMockBuilder(MyPdf::class)
            ->onlyMethods(['Error'])
            ->getMock();
        $myPdf->expects($this->never())->method('Error');

        $pdf = oxNew(Html2Pdf::class);
        $this->setValue($pdf, 'pdf', $myPdf);

        ob_start();
        $sut = $this->getMockBuilder($this->sutClassName)
            ->onlyMethods(['headersSent'])
            ->getMock();
        $sut->method('headersSent')->willReturn(false);

        $this->assertNull(
            $this->callMethod(
                $sut,
                'outputDev_download',
                [$pdf, 'fileNameFixture', 'htmlFixture']
            )
        );

        $output = ob_get_contents();
        ob_end_clean();

        $this->assertSame(
            $output,
            'htmlFixture'
        );
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::outputDev_saveLocal
     * @throws ReflectionException
     */
    public function testOutputDev_saveLocal_passed(): void
    {
        $myPdf = $this->getMockBuilder(MyPdf::class)
                      ->onlyMethods(['Error'])
                      ->getMock();
        $myPdf->expects($this->never())->method('Error');

        $pdf = oxNew(Html2Pdf::class);
        $this->setValue($pdf, 'pdf', $myPdf);

        $sut = oxNew($this->sutClassName);

        $root = vfsStream::setup('exampleDir');

        $this->assertNull(
            $this->callMethod(
                $sut,
                'outputDev_saveLocal',
                [$pdf, $root->url().'/fileNameFixture.pdf', 'htmlFixture']
            )
        );

        $this->assertFileExists(
            $root->url().'/fileNameFixture.pdf'
        );
        $this->assertSame(
            strlen('htmlFixture'),
            $root->getChild('fileNameFixture.pdf')->size()
        );
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric::outputDev_saveLocal
     * @throws ReflectionException
     */
    public function testOutputDev_saveLocal_unableToWrite(): void
    {
        $myPdf = $this->getMockBuilder(MyPdf::class)
            ->onlyMethods(['Error'])
            ->getMock();
        $myPdf->expects($this->once())->method('Error');

        $pdf = oxNew(Html2Pdf::class);
        $this->setValue($pdf, 'pdf', $myPdf);

        $sut = oxNew($this->sutClassName);

        $root = vfsStream::setup('exampleDir');
        $root->chmod(0000);

        $this->assertNull(
            $this->callMethod(
                $sut,
                'outputDev_saveLocal',
                [$pdf, $root->url().'/fileNameFixture.pdf', 'htmlFixture']
            )
        );

        $this->assertFileDoesNotExist(
            $root->url().'/fileNameFixture.pdf'
        );
    }
}
