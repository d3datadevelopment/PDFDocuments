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

use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsGenericInterface;

interface registryGenericInterface
{
    public function getRequiredGeneratorInterfaceClassName(): string;

    /**
     * @param $className * generator fully qualified class name
     */
    public function removeGenerator(string $className): void;

    /**
     * @param $className * generator fully qualified class name
     */
    public function hasGenerator(string $className): bool;

    /**
     * @param $className * generator fully qualified class name
     */
    public function getGenerator(string $className): pdfdocumentsGenericInterface;

    public function getList(): array;

    public function clearList(): void;
}
