<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Tests\Unit\Application\Model\AbstractClasses;

use Assert\InvalidArgumentException;
use D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric;
use D3\PdfDocuments\Application\Model\Constants;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsGenericInterface as genericInterface;
use Generator;
use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsView;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRenderer;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererBridgeInterface;
use OxidEsales\Twig\Resolver\TemplateChain\TemplateNotInChainException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Component\String\UnicodeString;
use Twig\Error\Error;

abstract class pdfDocumentsGenericTest extends TestCase
{
    /**
     * setup basic requirements
     * @throws ReflectionException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->_oModel = oxNew(pdfdocumentsGeneric::class);
    }

    /**
     * @covers \D3\ModCfg\Application\Model\d3filesystem::filterFilename
     * @test
     * @param $filename
     * @param $expected
     * @param $beautify
     * @throws ReflectionException
     * @dataProvider filterFilenameTestDataProvider
     */
    public function filterFilenameTest($filename, $expected, $beautify)
    {
        /** @var pdfdocumentsGeneric|MockObject $modelMock */
        $modelMock = $this->getMockBuilder(pdfdocumentsGeneric::class)
          ->onlyMethods(['beautifyFilename'])
          ->getMock();
        $modelMock->expects($this->exactly((int) $beautify))->method('beautifyFilename')->willReturnArgument(0);

        $this->assertSame(
            $expected,
            $this->callMethod(
                $modelMock,
                'filterFilename',
                [$filename, $beautify]
            )
        );
    }

    /**
     * @return Generator
     */
    public function filterFilenameTestDataProvider(): Generator
    {
        yield 'file system reserved'      => ["ab<>cd\\ef*ghi.ext", 'ab--cd-ef-ghi.ext', false];
        yield 'control characters'        => [".abc\x00def\x01ghi.ext", 'abc-def-ghi.ext', true];
        yield 'non-printing characters'   => ["..abc\x7Fdef\xA0ghi.ext", 'abc-def ghi.ext', false];
        yield 'URI reserved'              => ['abc#def@&ghi.ext', 'abc-def--ghi.ext', true];
        yield 'URL unsafe characters'     => ["abc{def~ghi.ext", 'abc-def-ghi.ext', false];
        yield 'umlauts'                   => ["abücdßefÄgh.ext", 'abucdssefAgh.ext', false];
        yield 'accents'                   => ["abçcdïeféghùijôkl.ext", 'abccdiefeghuijokl.ext', false];
        yield 'currency signs'            => ['ab€cd£ef$gh?ij¢kl¥m.ext', 'ab-cdGBPef-gh-ijcklJPYm.ext', false];
        //        yield 'cyrillic'                  => ['????????', 'foo', false];
        //        yield 'arabic'                    => ['???????? ???????', 'foo', false];
        yield 'long string'               => [str_repeat("a", 300).".ext", str_repeat('a', 251).'.ext', true];
    }

    /**
     * @covers \D3\ModCfg\Application\Model\d3filesystem::beautifyFilename
     * @test
     * @param $fileName
     * @param $expected
     * @throws ReflectionException
     * @dataProvider beautifyFilenameTestDataProvider
     */
    public function beautifyFilenameTest($fileName, $expected)
    {
        $this->assertSame(
            $expected,
            $this->callMethod(
                $this->_oModel,
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
        yield 'null'                  => [null, ''];
        yield 'false'                 => [false, ''];
    }
}