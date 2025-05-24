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

use D3\PdfDocuments\Application\Controller\orderOverviewPdfGenerator;
use D3\PdfDocuments\Modules\Application\Controller\d3_overview_controller_pdfdocuments;
use D3\TestingTools\Development\CanAccessRestricted;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\ForwardCompatibility\Result;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Generator;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Utils;
use OxidEsales\Eshop\Core\UtilsView;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use PHPUnit\Framework\MockObject\Rule\InvocationOrder;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class d3_overview_controller_pdfdocumentsTest extends TestCase
{
    use CanAccessRestricted;

    /**
     * @test
     * @covers \D3\PdfDocuments\Modules\Application\Controller\d3_overview_controller_pdfdocuments::render
     * @throws ReflectionException
     */
    public function testRenderReload(): void
    {
        $utils = $this->getMockBuilder(Utils::class)
            ->onlyMethods(['showMessageAndExit'])
            ->getMock();
        $utils->expects($this->once())->method('showMessageAndExit');

        Registry::set(Utils::class, $utils);

        $sut = oxNew(d3_overview_controller_pdfdocuments::class);

        $this->setValue($sut, 'doReload', true);

        $this->callMethod(
            $sut,
            'render'
        );
    }
    /**
     * @test
     * @covers \D3\PdfDocuments\Modules\Application\Controller\d3_overview_controller_pdfdocuments::render
     * @throws ReflectionException
     */
    public function testRenderDisplayError(): void
    {
        $utilsview = $this->getMockBuilder(UtilsView::class)
            ->onlyMethods(['addErrorToDisplay'])
            ->getMock();
        $utilsview->expects($this->once())->method('addErrorToDisplay');

        Registry::set(UtilsView::class, $utilsview);

        $sut = oxNew(d3_overview_controller_pdfdocuments::class);

        $this->setValue($sut, 'doReload', false);
        $_GET['generatorError'] = 'errorMessageFixture';

        $this->callMethod(
            $sut,
            'render'
        );
    }

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
     * @covers \D3\PdfDocuments\Modules\Application\Controller\d3_overview_controller_pdfdocuments::d3PdfDocsIsDevMode
     * @throws ReflectionException
     */
    public function testPdfDocsIsDevModeUnknownSetting(): void
    {
        $settingService = $this->getMockBuilder(ModuleSettingService::class)
            ->onlyMethods(['getBoolean'])
            ->disableOriginalConstructor()
            ->getMock();
        $settingService->method('getBoolean')->willThrowException(new Exception());

        $this->addServiceMocks([ModuleSettingServiceInterface::class => $settingService]);

        $sut = oxNew(d3_overview_controller_pdfdocuments::class);

        try {
            $this->assertFalse(
                $this->callMethod(
                    $sut,
                    'd3PdfDocsIsDevMode'
                )
            );
        } finally {
            ContainerFactory::resetContainer();
        }
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
            $queryBuilder->method('execute')->willThrowException(new Exception());
        } else {
            $queryBuilder->method('execute')->willReturn($result);
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

        $sut = $this->getMockBuilder(d3_overview_controller_pdfdocuments::class)
            ->onlyMethods(['getEditObjectId'])
            ->getMock();
        $sut->method('getEditObjectId')->willReturn('oxid');

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

    /**
     * @test
     * @covers \D3\PdfDocuments\Modules\Application\Controller\d3_overview_controller_pdfdocuments::d3CreatePDF
     * @throws ReflectionException
     * @dataProvider createPdfDataProvider
     */
    public function testCreatePdf(?string $objectid, bool $loadable, ?string $language, InvocationOrder $generate, bool $throwException): void
    {
        $order = $this->getMockBuilder(Order::class)
            ->onlyMethods(['load'])
            ->getMock();
        $order->method('load')->willReturn($loadable);

        $generatorController = $this->getMockBuilder(orderOverviewPdfGenerator::class)
            ->onlyMethods(['generatePdf'])
            ->getMock();
        if ($throwException) {
            $generatorController->expects($generate)->method('generatePdf')->willThrowException(new \Exception());
        } else {
            $generatorController->expects($generate)->method('generatePdf');
        }

        $sut = $this->getMockBuilder(d3_overview_controller_pdfdocuments::class)
            ->onlyMethods(['getEditObjectId', 'd3PdfGetOrder', 'd3PdfGetGeneratorController'])
            ->getMock();
        $sut->method('getEditObjectId')->willReturn($objectid);
        $sut->method('d3PdfGetOrder')->willReturn($order);
        $sut->method('d3PdfGetGeneratorController')->willReturn($generatorController);

        $_GET['pdflanguage'] = $language;

        $this->callMethod(
            $sut,
            'd3CreatePdf'
        );

        if ($throwException) {
            $this->assertTrue($this->getValue($sut, 'doReload'));
            $this->getValue($sut, 'generatorError');
            $this->assertStringContainsString('PDF documents', $this->getValue($sut, 'generatorError'));
        }
    }

    public static function createPdfDataProvider(): Generator
    {
        yield 'no edit object id' => [null, true, '1', self::never(), false];
        yield 'unloadable order' => ['objectid', false, '1', self::never(), false];
        yield 'no language defined' => ['objectid', false, null, self::never(), false];
        yield 'can generate' => ['objectid', true, '1', self::once(), false];
        yield 'generate exception' => ['objectid', true, '1', self::once(), true];
    }
}
