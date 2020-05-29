<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\Registries;

interface registryGenericInterface
{
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