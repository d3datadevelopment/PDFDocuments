<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

declare(strict_types = 1);

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