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

namespace D3\PdfDocuments\Tests\Unit\Modules\Application\Controller;

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
use D3\PdfDocuments\Modules\Application\Controller\d3_overview_controller_pdfdocuments;
use D3\TestingTools\Development\CanAccessRestricted;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\ForwardCompatibility\Result;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Generator;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsView;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
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

class d3_overview_controller_pdfdocumentsTest extends TestCase
{
    use CanAccessRestricted;

    /**
     * @test
     * @covers \D3\PdfDocuments\Modules\Application\Controller\d3_overview_controller_pdfdocuments::d3PdfDocsIsDevMode
     * @throws ReflectionException
     * @dataProvider d3PdfDocsIsDevModeDataProvider
     */
    public function testPdfDocsIsDevMode(bool $devMode): void
    {
        $settingService = $this->getMockBuilder(ModuleSettingService::class)
            ->onlyMethods(['getBoolean'])
            ->disableOriginalConstructor()
            ->getMock();
        $settingService->method('getBoolean')->willReturn($devMode);

        $this->addServiceMocks([ModuleSettingServiceInterface::class => $settingService]);

        $sut = oxNew(d3_overview_controller_pdfdocuments::class);

        try {
            $this->assertSame(
                $devMode,
                $this->callMethod(
                    $sut,
                    'd3PdfDocsIsDevMode'
                )
            );
        } finally {
            ContainerFactory::resetContainer();
        }
    }

    public static function d3PdfDocsIsDevModeDataProvider(): Generator
    {
        yield 'is dev' => [true];
        yield 'is prod' => [false];
    }

    /**
     * @test
     * @covers \D3\PdfDocuments\Modules\Application\Controller\d3_overview_controller_pdfdocuments::d3CanExport
     * @dataProvider d3CanExportDataProvider
     * @throws ReflectionException
     */
    public function testCanExport(bool $throwException, bool $expectedReturn): void
    {
        $result = $this->getMockBuilder(Result::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['fetchOne'])
            ->getMock();
        $result->method('fetchOne')->willReturn('oxid');

        $expressionBuilder = $this->getMockBuilder(ExpressionBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $queryBuilder = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['execute', 'expr'])
            ->getMock();
        if ($throwException) {
            $queryBuilder->method( 'execute' )->willThrowException(new Exception());
        } else {
            $queryBuilder->method( 'execute' )->willReturn( $result );
        }
        $queryBuilder->method('expr')->willReturn($expressionBuilder);

        $qbFactory = $this->getMockBuilder(QueryBuilderFactory::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['create'])
            ->getMock();
        $qbFactory->method('create')->willReturn($queryBuilder);

        $this->addServiceMocks([
            QueryBuilderFactoryInterface::class => $qbFactory,
        ]);

        $sut = oxNew(d3_overview_controller_pdfdocuments::class);

        try {
            $this->assertSame(
                $expectedReturn,
                $this->callMethod(
                    $sut,
                    'd3CanExport'
                )
            );
        } finally {
            ContainerFactory::resetContainer();
        }
    }

    public static function d3CanExportDataProvider(): Generator
    {
        yield 'throw exception' => [true, false];
        yield 'doesnt throw exception' => [false, true];
    }
}