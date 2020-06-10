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

use D3\PdfDocuments\Application\Model\Exceptions\pdfGeneratorExceptionAbstract;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsGenericInterface as genericInterface;
use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsView;
use Smarty;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

abstract class pdfdocumentsGeneric extends Base implements genericInterface
{
    const PDF_DESTINATION_DOWNLOAD          = 'D';   // force download in browser
    const PDF_DESTINATION_STDOUT            = 'I';   // show in browser plugin if available, otherwise download
    const PDF_DESTINATION_FILE              = 'F';   // save as local file
    const PDF_DESTINATION_FILEANDSTDOUT     = 'FI';  // output as local file and show in browser plugin
    const PDF_DESTINATION_FILEANDDOWNLOAD   = 'FD';  // output as local file and force download in browser
    const PDF_DESTINATION_STRING            = 'S';   // output as string

    const PDF_ORIENTATION_PORTRAIT = 'P';
    const PDF_ORIENTATION_LANDSCAPE = 'L';

    public $filenameExtension = 'pdf';

    /** @var Smarty  */
    public $oSmarty;

    /** @var string */
    public $filename;

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
     *
     * @return mixed|string
     * @throws Html2PdfException
     */
    public function genPdf($sFilename, $iSelLang = 0, $target = self::PDF_DESTINATION_STDOUT)
    {
        $oPdf = oxNew(Html2Pdf::class, ...$this->getPdfProperties());
        $oPdf->setTestIsImage(false);
        $oPdf->writeHTML($this->getHTMLContent($iSelLang));
        $oPdf->pdf->SetAuthor(Registry::getConfig()->getActiveShop()->getFieldData('oxname'));
        $oPdf->pdf->SetTitle(Registry::getLang()->translateString($this->getTitleIdent()));
        $oPdf->pdf->SetCreator('D³ PDF Documents for OXID eShop');
        $oPdf->pdf->SetSubject(NULL);
        return $oPdf->output($sFilename, $target);
    }

    /**
     * @param int $iLanguage
     */
    public function downloadPdf($iLanguage = 0)
    {
        try {
            $sFilename = $this->getFilename();
            $this->genPdf($sFilename, $iLanguage, self::PDF_DESTINATION_DOWNLOAD);
            Registry::getUtils()->showMessageAndExit('');
        } catch (pdfGeneratorExceptionAbstract $e) {
            Registry::get(UtilsView::class)->addErrorToDisplay($e);
            Registry::getLogger()->error($e);
        }
    }

    /**
     * @param string $path
     * @param int    $iLanguage
     *
     * @throws Html2PdfException
     */
    public function savePdfFile($path, $iLanguage = 0)
    {
        try {
            $sFilename = $this->getFilename();
            $this->genPdf(
                rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$sFilename,
                $iLanguage,
                self::PDF_DESTINATION_FILE
            );
        } catch (pdfGeneratorExceptionAbstract $e) {
            Registry::get(UtilsView::class)->addErrorToDisplay($e);
            Registry::getLogger()->error($e);
        }
    }

    /**
     * @param int $iLanguage
     *
     * @return null|string
     * @throws Html2PdfException
     */
    public function getPdfContent($iLanguage = 0)
    {
        try {
            $sFilename = $this->getFilename();
            return $this->genPdf( $sFilename, $iLanguage, self::PDF_DESTINATION_STRING );
        } catch (pdfGeneratorExceptionAbstract $e) {
            Registry::get(UtilsView::class)->addErrorToDisplay($e);
            Registry::getLogger()->error($e);
        }

        return null;
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
        $blCurrentRenderFromAdmin = self::$_blIsAdmin;
        self::$_blIsAdmin = $this->renderTemplateFromAdmin();

        $lang = Registry::getLang();

        $currTplLang = $lang->getTplLanguage();
        $lang->setTplLanguage($iSelLang);

        $this->setSmartyVars();

        $content = $this->oSmarty->fetch($this->getTemplate());

        $lang->setTplLanguage($currTplLang);

        self::$_blIsAdmin = $blCurrentRenderFromAdmin;

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
        return [self::PDF_ORIENTATION_PORTRAIT, 'A4', 'de'];
    }

    /**
     * @param $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @param string $sFilename
     *
     * @return string
     */
    public function getFilename()
    {
        // forced filename from setFilename()
        if ($this->filename) {
            return $this->addFilenameExtension($this->filename);
        }

        return $this->addFilenameExtension($this->getTypeForFilename());
    }

    /**
     * @param string $filename
     *
     * @return string
     */
    public function addFilenameExtension($filename)
    {
        $extension = $this->filenameExtension;
        $extensionLength = (strlen($extension) + 1) * -1;
        if ((bool) strlen($extension) && substr($filename, $extensionLength) != '.'.$extension) {
            $filename .= '.'.$extension;
        }

        return $filename;
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