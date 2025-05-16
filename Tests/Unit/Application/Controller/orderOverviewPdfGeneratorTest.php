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

namespace D3\PdfDocuments\Tests\Unit\Application\Controller;

use Assert\InvalidArgumentException;
use D3\PdfDocuments\Application\Controller\orderOverviewPdfGenerator;
use D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric;
use D3\PdfDocuments\Application\Model\Constants;
use D3\PdfDocuments\Application\Model\Documents\invoicePdf;
use D3\PdfDocuments\Application\Model\Exceptions\noPdfHandlerFoundException;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsGenericInterface as genericInterface;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderInterface;
use D3\PdfDocuments\Application\Model\Registries\registryOrderoverview;
use D3\PdfDocuments\Application\Model\Registries\registryOrderoverviewInterface;
use D3\TestingTools\Development\CanAccessRestricted;
use Generator;
use OxidEsales\Eshop\Application\Model\Order;
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

class orderOverviewPdfGeneratorTest extends TestCase
{
    use CanAccessRestricted;

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Controller\orderOverviewPdfGenerator::generatePdf
     * @throws ReflectionException
     */
    public function testGeneratePdf(): void
    {
        $document = $this->getMockBuilder(invoicePdf::class)
            ->onlyMethods(['downloadPdf'])
            ->getMock();
        $document->expects($this->once())->method('downloadPdf');

        $sut = $this->getMockBuilder(orderOverviewPdfGenerator::class)
            ->onlyMethods(['getPdfClass'])
            ->getMock();
        $sut->expects($this->once())->method('getPdfClass')->willReturn($document);

        $this->callMethod(
            $sut,
            'generatePdf',
            [oxNew(Order::class)]
        );
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Application\Controller\orderOverviewPdfGenerator::getPdfClass
     * @throws ReflectionException
     * @dataProvider getPdfClassDataProvider
     */
    public function testGetPdfClass(array $generatorList, string $request, bool $expectException): void
    {
        $_GET['pdftype']    = $request;

        $orderOverviewRegistry = $this->getMockBuilder(registryOrderoverview::class)
            ->onlyMethods(['getList'])
            ->getMock();
        $orderOverviewRegistry->method('getList')->willReturn($generatorList);

        $this->addServiceMocks([
            registryOrderoverviewInterface::class => $orderOverviewRegistry,
        ]);

        $sut = oxNew(orderOverviewPdfGenerator::class);

        if ($expectException) {
            $this->expectException(noPdfHandlerFoundException::class);
        }

        $this->assertInstanceOf(
            pdfdocumentsOrderInterface::class,
            $this->callMethod(
                $sut,
                'getPdfClass',
            )
        );
    }

    public static function getPdfClassDataProvider(): Generator
    {
        yield 'no generator set' => [[], 'foo', true];
        yield 'unknown generator set' => [[new invoicePdf()], 'foo', true];
        yield 'valid generator set' => [[new invoicePdf()], 'invoice', false];
    }
}