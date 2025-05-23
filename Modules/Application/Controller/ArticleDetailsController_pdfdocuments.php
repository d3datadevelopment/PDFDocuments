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

namespace D3\PdfDocuments\Modules\Application\Controller;

use D3\PdfDocuments\Application\Model\Documents\articleDataSheet;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Spipu\Html2Pdf\Exception\Html2PdfException;

class ArticleDetailsController_pdfdocuments extends ArticleDetailsController_pdfdocuments_parent
{
    /**
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Html2PdfException
     */
    public function generateDataSheet(): void
    {
        $document = oxNew(articleDataSheet::class);
        $document->setArticle($this->getProduct());
        $document->downloadPdf();
    }
}