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

use D3\PdfDocuments\Application\Model\Constants;
use D3\PdfDocuments\Application\Model\Exceptions\wrongPdfGeneratorInterface;
use D3\PdfDocuments\Application\Model\Registries\registryOrdermanagerActions;
use D3\PdfDocuments\Tests\Unit\Helpers\orderDocument;
use Generator;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use ReflectionException;

class registryOrdermanagerActionsTest extends registryAbstract
{
    /**
     * @test
     * @throws ReflectionException
     * @covers \D3\PdfDocuments\Application\Model\Registries\registryOrdermanagerActions::__construct
     * @dataProvider constructDataProvider
     */
    public function testConstructor(bool $inv, bool $deln, bool $invNL, bool $delnNL, int $expectedCount): void
    {
        $settingService = $this->getMockBuilder(ModuleSettingService::class)
            ->onlyMethods(['getBoolean'])
            ->disableOriginalConstructor()
            ->getMock();
        $settingService->method('getBoolean')->willReturnMap([
            ['d3PdfDocumentsDocInvoice', Constants::OXID_MODULE_ID, $inv],
            ['d3PdfDocumentsDocDeliveryNote', Constants::OXID_MODULE_ID, $deln],
            ['d3PdfDocumentsDocInvoiceNoLogo', Constants::OXID_MODULE_ID, $invNL],
            ['d3PdfDocumentsDocDeliveryNoteNoLogo', Constants::OXID_MODULE_ID, $delnNL],
        ]);

        $this->addServiceMocks([ModuleSettingServiceInterface::class => $settingService]);

        try {
            $sut = $this->getMockBuilder(registryOrdermanagerActions::class)
                ->disableOriginalConstructor()
                ->onlyMethods(['addGenerator'])
                ->getMock();
            $sut->expects($this->exactly($expectedCount))->method('addGenerator');

            $this->callMethod(
                $sut,
                '__construct'
            );
        } finally {
            ContainerFactory::resetContainer();
        }
    }

    public static function constructDataProvider(): Generator
    {
        yield 'nothing'    => [false, false, false, false, 0];
        yield 'invoice only'    => [true, false, false, false, 1];
        yield 'invoice + delnote'    => [true, true, false, false, 2];
        yield 'invoice + NoLogo + delnote'    => [true, true, true, false, 3];
        yield 'invoice + NoLogo + delnote + NoLogo'    => [true, true, true, true, 4];
        yield 'invNoLogo + delnote + NoLogo'    => [false, true, true, true, 3];
    }

    /**
     * @test
     * @throws ReflectionException
     * @throws wrongPdfGeneratorInterface
     * @covers \D3\PdfDocuments\Application\Model\Registries\registryOrdermanagerActions::getGenerator
     */
    public function testGetGenerator(): void
    {
        $sut = oxNew(registryOrdermanagerActions::class);
        $sut->addGenerator(orderDocument::class);

        $this->assertInstanceOf(
            orderDocument::class,
            $this->callMethod(
                $sut,
                'getGenerator',
                [orderDocument::class]
            )
        );
    }
}
