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

declare(strict_types=1);

namespace D3\PdfDocuments\Application\Model\Registries;

use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsOrderInterface;

class registryOrderoverview extends registryAbstract implements registryOrderoverviewInterface
{
    use registryTrait;

    /**
     * @codeCoverageIgnore
     */
    public function getRequiredGeneratorInterfaceClassName(): string
    {
        return pdfdocumentsOrderInterface::class;
    }

    /**
     * @param string $className * generator fully qualified class name
     * @return pdfdocumentsOrderInterface
     */
    public function getGenerator(string $className): pdfdocumentsOrderInterface
    {
        return $this->registry[$className];
    }
}
