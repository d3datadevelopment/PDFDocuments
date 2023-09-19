<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\Interfaces;

use Assert\InvalidArgumentException;
use OxidEsales\Eshop\Application\Model\Order;

interface pdfdocumentsOrderInterface extends pdfdocumentsGenericInterface
{
    /**
     * @param Order $order
     */
    public function setOrder(Order $order);

    /**
     * @throws InvalidArgumentException
     * @return Order
     */
    public function getOrder();

    /**
     * @return string
     */
    public function getTypeForFilename();
}