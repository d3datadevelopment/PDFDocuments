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

use D3\PdfDocuments\Application\Model\Exceptions\noBaseObjectSetException;
use D3\PdfDocuments\Application\Model\Exceptions\pdfGeneratorExceptionAbstract;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsGenericInterface as genericInterface;
use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsView;
use Smarty;
use Spipu\Html2Pdf\Html2Pdf;

abstract class pdfdocumentsGeneric extends Base implements genericInterface
{
    const PDF_DOWNLOAD = 'I';

    /** @var Smarty  */
    public $oSmarty;

    /**
     * pdfDocumentsGeneric constructor.
     */
    public function __construct()
    {
        parent::__construct();

        /** @var Smarty $oSmarty */
        $this->oSmarty = Registry::getUtilsView()->getSmarty();
    }

    /**
     * @param        $sFilename
     * @param int    $iSelLang
     * @param string $target
     * @throws noBaseObjectSetException
     */
    public function genPdf($sFilename, $iSelLang = 0, $target = 'I')
    {
        $sFilename = $this->getFilename();
        $oPdf = oxNew(Html2Pdf::class, ...$this->getPdfProperties());
        $oPdf->writeHTML($this->getHTMLContent($iSelLang));
        $oPdf->output($sFilename, $target);
    }

    public function downloadPdf($iLanguage = 0)
    {
        try {
            $oUtils = Registry::getUtils();
            $sFilename = $this->makeValidFileName($this->getFilename());
            ob_start();
            $this->genPdf($sFilename, $iLanguage, self::PDF_DOWNLOAD);
            $sPDF = ob_get_contents();
            ob_end_clean();
            $oUtils->setHeader("Pragma: public");
            $oUtils->setHeader("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            $oUtils->setHeader("Expires: 0");
            $oUtils->setHeader("Content-type: application/pdf");
            $oUtils->setHeader("Content-Disposition: attachment; filename=" . $sFilename);
            Registry::getUtils()->showMessageAndExit($sPDF);
        } catch (pdfGeneratorExceptionAbstract $e) {
            Registry::get(UtilsView::class)->addErrorToDisplay($e);
            Registry::getLogger()->error($e);
        }
    }

    public function setSmartyVars()
    {
        $this->oSmarty->assign('oConfig', Registry::getSession()->getConfig());
        $this->oSmarty->assign('oViewConf', Registry::getSession()->getConfig()->getActiveView()->getViewConfig());
        $this->oSmarty->assign('shop', Registry::getSession()->getConfig()->getActiveShop());
        $this->oSmarty->assign('lang', Registry::getLang());
    }

    /**
     * @param int $iSelLang
     *
     * @return mixed
     */
    public function getHTMLContent($iSelLang = 0)
    {
        self::$_blIsAdmin = $this->renderTemplateFromAdmin();

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

    /**
     * Gets proper file name
     *
     * @param string $sFilename file name
     *
     * @return string
     */
    public function makeValidFileName($sFilename)
    {
        $sFilename = preg_replace('/[\s]+/', '_', $sFilename);
        $sFilename = preg_replace('/[^a-zA-Z0-9_\.-]/', '', $sFilename);

        return str_replace(' ', '_', $sFilename);
    }

    /**
     * @return bool
     */
    public function renderTemplateFromAdmin()
    {
        return false;
    }
}