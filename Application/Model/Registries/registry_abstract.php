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

use D3\PdfDocuments\Application\Model\Interfaces\pdfdocuments_generic_interface;

abstract class registry_abstract implements registry_generic_interface
{
    protected $_aRegistry = array();

    /**
     * @param $className * generator fully qualified class name
     * @param pdfdocuments_generic_interface $item
     */
    protected function addItem($className, pdfdocuments_generic_interface $item)
    {
        $this->_aRegistry[$className] = $item;
    }

    /**
     * @param $className * generator fully qualified class name
     */
    public function removeGenerator($className)
    {
        // TODO: Implement removeGenerator() method.
    }

    /**
     * @param $className * generator fully qualified class name
     */
    public function hasGenerator($className)
    {
        // TODO: Implement hasGenerator() method.
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->_aRegistry;
    }

    public function clearList()
    {
        // TODO: Implement clearList() method.
    }
}