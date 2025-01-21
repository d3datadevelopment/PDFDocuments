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

use D3\PdfDocuments\Application\Model\Exceptions\wrongPdfGeneratorInterface;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsGenericInterface;
use OxidEsales\Eshop\Core\Exception\StandardException;

abstract class registryAbstract implements registryGenericInterface
{
    protected array $registry = [];

    public function getRequiredGeneratorInterfaceClassName(): string
    {
        return pdfdocumentsGenericInterface::class;
    }

    /**
     * @throws wrongPdfGeneratorInterface
     */
    public function addGenerator(string $className): void
    {
        if (false == $this->hasGenerator($className)) {
            /** @var pdfdocumentsGenericInterface $generator */
            $generator = oxNew( $className );

            $this->addItem( $className, $generator );
        } else {
            throw oxNew(StandardException::class, 'generator still exists in registry');
        }
    }

    /**
     * @param string $className * generator fully qualified class name
     * @param pdfdocumentsGenericInterface $item
     */
    protected function addItem(string $className, pdfdocumentsGenericInterface $item): void
    {
        $requiredInterface = $this->getRequiredGeneratorInterfaceClassName();

        if ( ! $item instanceof $requiredInterface ) {
            /** @var wrongPdfGeneratorInterface $exception */
            $exception = oxNew(wrongPdfGeneratorInterface::class, $requiredInterface);
            throw $exception;
        }

        $this->registry[$className] = $item;
    }

    /**
     * @param string $className * generator fully qualified class name
     */
    public function removeGenerator(string $className): void
    {
        if ($this->hasGenerator($className)) {
            unset( $this->registry[ $className ] );
        }
    }

    /**
     * @param $className * generator fully qualified class name
     * @return bool
     */
    public function hasGenerator(string $className): bool
    {
        return array_key_exists($className, $this->registry);
    }

    public function getList(): array
    {
        return $this->registry;
    }

    public function clearList(): void
    {
        $this->registry = [];
    }
}