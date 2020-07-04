<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\Registries;

interface registryGenericInterface
{
    public function getRequiredGeneratorInterfaceClassName();

    /**
     * @param $className * generator fully qualified class name
     */
    public function removeGenerator($className);

    /**
     * @param $className * generator fully qualified class name
     */
    public function hasGenerator($className);

    /**
     * @param $className * generator fully qualified class name
     */
    public function getGenerator($className);

    /**
     * @return array
     */
    public function getList();

    public function clearList();
}