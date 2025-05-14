<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

declare(strict_types = 1);

namespace D3\PdfDocuments\Application\Model\Interfaces;

use OxidEsales\Eshop\Application\Model\Order;

interface pdfdocumentsOrderInterface extends pdfdocumentsGenericInterface
{
    public function setOrder(Order $order): void;

    public function getOrder(): Order;

    public function getTypeForFilename(): string;
}