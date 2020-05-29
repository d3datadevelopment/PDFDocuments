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

namespace D3\PdfDocuments\Application\Model\AbstractClasses;

use D3\PdfDocuments\Application\Model\Interfaces\pdfdocuments_generic_interface as genericInterface;
use OxidEsales\Eshop\Core\Registry;
use Smarty;
use Spipu\Html2Pdf\Html2Pdf;

abstract class pdfDocuments_generic implements genericInterface
{
    /** @var Smarty  */
    public $oSmarty;

    /**
     * pdfDocuments_generic constructor.
     */
    public function __construct()
    {
        /** @var Smarty $oSmarty */
        $this->oSmarty = Registry::getUtilsView()->getSmarty();
    }

    /**
     * @param        $sFilename
     * @param int    $iSelLang
     * @param string $target
     */
    public function genPdf($sFilename, $iSelLang = 0, $target = 'I')
    {
        $sFilename = $this->getFilename( $sFilename);
        $oPdf = oxNew(Html2Pdf::class, ...$this->getPdfProperties());
        $oPdf->writeHTML($this->getHTMLContent($iSelLang));
        $oPdf->output($sFilename, $target);
    }

    public function setSmartyVars()
    {
        $this->oSmarty->assign('oConfig', Registry::getSession()->getConfig());
        $this->oSmarty->assign('oViewConf', Registry::getSession()->getConfig()->getActiveView()->getViewConfig());
        $this->oSmarty->assign('shop', Registry::getSession()->getConfig()->getActiveShop());
        $this->oSmarty->assign('lang', Registry::getLang());
    }

    /**
     * @param string $sFilename
     *
     * @return string
     */
    public function getFilename($sFilename)
    {
        return $sFilename;
    }

    /**
     * @param int $iSelLang
     *
     * @return mixed
     */
    public function getHTMLContent($iSelLang = 0)
    {
        $lang = Registry::getLang();

        $currTplLang = $lang->getTplLanguage();
        $lang->setTplLanguage($iSelLang);

        $this->setSmartyVars();

        $content = $this->oSmarty->fetch($this->getTemplate());

        $lang->setTplLanguage($currTplLang);

        return $content;
    }

    /**
     * arguments for Html2Pdf class constructor
     * - $orientation = 'P',
     * - $format = 'A4',
     * - $lang = 'fr',
     * - $unicode = true,
     * - $encoding = 'UTF-8',
     * - $margins = array(5, 5, 5, 8),
     * - $pdfa = false
     * @return string[]
     */
    public function getPdfProperties()
    {
        return ['P', 'A4', 'de'];
    }
}