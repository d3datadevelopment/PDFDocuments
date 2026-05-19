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

namespace D3\PdfDocuments\Application\Model\Documents;

use D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder;
use OxidEsales\Eshop\Core\Registry;

/**
 * @codeCoverageIgnore
 */
class deliverynotePdf extends pdfdocumentsOrder
{
    public function getRequestId(): string
    {
        return 'dnote';
    }

    public function getTitleIdent(): string
    {
        return "D3_PDFDOCUMENTS_DELIVERYNOTE";
    }

    public function getTypeForFilename(): string
    {
        return 'delnote';
    }

    public function runPreAction(): void
    {
        parent::runPreAction();

        $this->addKeyword('deliverynote');
        $this->addKeyword('shop-'.str_replace(',', ' ', Registry::getConfig()->getActiveShop()->getFieldData('oxname')));
        $this->addKeyword('orderdate-'.$this->getOrder()->getFieldData('oxorderdate'));
        $this->addKeyword('ordernr-'.$this->getOrder()->getFieldData('oxordernr'));

        $this->setSubject(sprintf(
            Registry::getLang()->translateString('D3_PDFDOCUMENTS_ORDER_DELNOTE_FROM_AT', null, false),
            $this->getOrder()->getFieldData('oxordernr'),
            $this->getOrder()->getFieldData('oxorderdate')
        ));
    }

    public function getTemplate(): string
    {
        return '@d3PdfDocuments/documents/deliverynote/deliverynote';
    }
}
