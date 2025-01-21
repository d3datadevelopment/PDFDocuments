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

interface registryOrderoverviewInterface extends registryGenericInterface
{
    /**
     * @param string $className * generator fully qualified class name
     */
    public function addGenerator(string $className): void;
}