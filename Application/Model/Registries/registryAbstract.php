<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\Registries;

use D3\PdfDocuments\Application\Model\Exceptions\wrongPdfGeneratorInterface;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsGenericInterface;
use OxidEsales\Eshop\Core\Exception\StandardException;

abstract class registryAbstract implements registryGenericInterface
{
    protected $_aRegistry = array();

    /**
     * @return string
     */
    public function getRequiredGeneratorInterfaceClassName()
    {
        return pdfdocumentsGenericInterface::class;
    }

    /**
     * @param $className
     */
    public function addGenerator($className)
    {
        if ( ! $this->hasGenerator( $className ) ) {
            /** @var pdfdocumentsGenericInterface $generator */
            $generator = oxNew( $className );

            $this->addItem( $className, $generator );
        } else {
            throw oxNew(StandardException::class, 'generator still exists in registry');
        }
    }

    /**
     * @param $className * generator fully qualified class name
     * @param pdfdocumentsGenericInterface $item
     */
    protected function addItem($className, pdfdocumentsGenericInterface $item)
    {
        $requiredInterface = $this->getRequiredGeneratorInterfaceClassName();

        if ( ! $item instanceof $requiredInterface ) {
            throw oxNew(wrongPdfGeneratorInterface::class, $requiredInterface);
        }

        $this->_aRegistry[$className] = $item;
    }

    /**
     * @param $className * generator fully qualified class name
     */
    public function removeGenerator($className)
    {
        if ($this->hasGenerator($className)) {
            unset( $this->_aRegistry[ $className ] );
        }
    }

    /**
     * @param $className * generator fully qualified class name
     * @return bool
     */
    public function hasGenerator($className)
    {
        return array_key_exists($className, $this->_aRegistry);
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
        $this->_aRegistry = [];
    }
}