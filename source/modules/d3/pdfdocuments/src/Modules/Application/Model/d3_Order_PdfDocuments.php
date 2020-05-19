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
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Modules\Application\Model;

use D3\PdfDocuments\Modules\Application\Model\deliverynotePdf;
use OxidEsales\EshopCommunity\Application\Model\User;
use OxidEsales\EshopCommunity\Application\Model\Payment;
use OxidEsales\Eshop\Core\Registry;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

class d3_Order_PdfDocuments extends d3_Order_PdfDocuments_parent
{
    /**
     * @param string $sFilename
     * @param int $iSelLang
     * @param string $target
     * @throws Html2PdfException
     */
    public function genPdf($sFilename, $iSelLang = 0, $target = 'I')
    {
      $Pdf= $this->getPdfClass();
      die();

      $Pdf->setOrder($this);
      $Pdf->genPdf($sFilename, $iSelLang = 0, $target = 'I');
    }
    public function getPdfClass(){
      switch (Registry::getRequest()->getRequestParameter('pdftype')) {
        case ('dnote'):
        case ('dnote_without_logo'):
          return oxNew(deliverynotePdf::class);
        case ('standart'):
        case('standart_without_logo'):
          return oxNew(invoicePdf::class);
        default:
          dumpVar(get_class($this));
          return $this->getCustomPdfClass();
      }
    }

  /**
   * @return albatros
   * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
   * @throws \oxSystemComponentException
   */
    public function getCustomPdfClass()
    {
      return oxNew(invoicePdf::class);
    }
}
