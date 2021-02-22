<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\AbstractClasses;

use D3\ModCfg\Application\Model\d3filesystem;
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

    public function runPreAction()
    {
    }

    public function runPostAction()
    {
    }

    /**
     * @param $sFilename
     * @param int $iSelLang
     * @param string $target
     * @return mixed|string|null
     * @throws Html2PdfException
     */
    public function genPdf($sFilename, $iSelLang = 0, $target = self::PDF_DESTINATION_STDOUT)
    {
        $oPdf = oxNew(Html2Pdf::class, ...$this->getPdfProperties());
        $oPdf->setTestIsImage(false);
        $htmlContent = $this->getHTMLContent($iSelLang);
        $oPdf->writeHTML($htmlContent);
        $oPdf->pdf->SetAuthor(Registry::getConfig()->getActiveShop()->getFieldData('oxname'));
        $oPdf->pdf->SetTitle(Registry::getLang()->translateString($this->getTitleIdent()));
        $oPdf->pdf->SetCreator('D³ PDF Documents for OXID eShop');
        $oPdf->pdf->SetSubject(NULL);
        return $this->output($oPdf, $sFilename, $target, $htmlContent);
    }

    /**
     * @param int $iLanguage
     * @throws Html2PdfException
     */
    public function downloadPdf($iLanguage = 0)
    {
        try {
            $this->runPreAction();
            $sFilename = $this->getFilename();
            $this->genPdf($sFilename, $iLanguage, self::PDF_DESTINATION_DOWNLOAD);
            $this->runPostAction();
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
            $this->runPreAction();
            $sFilename = $this->getFilename();
            $this->genPdf(
                rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$sFilename,
                $iLanguage,
                self::PDF_DESTINATION_FILE
            );
            $this->runPostAction();
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
            $this->runPreAction();
            $sFilename = $this->getFilename();
            $ret = $this->genPdf( $sFilename, $iLanguage, self::PDF_DESTINATION_STRING );
            $this->runPostAction();
            return $ret;
        } catch (pdfGeneratorExceptionAbstract $e) {
            Registry::get(UtilsView::class)->addErrorToDisplay($e);
            Registry::getLogger()->error($e);
        }

        return null;
    }

    /**
     * @param int $iSelLang
     */
    public function setSmartyVars($iSelLang)
    {
        unset($iSelLang);
        $this->oSmarty->assign('config', Registry::getSession()->getConfig());
        $this->oSmarty->assign('viewConfig', Registry::getSession()->getConfig()->getActiveView()->getViewConfig());
        $this->oSmarty->assign('shop', Registry::getSession()->getConfig()->getActiveShop());
        $this->oSmarty->assign('lang', Registry::getLang());
        $this->oSmarty->assign('document', $this);
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

        $this->setSmartyVars($iSelLang);

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
        $orientation = self::PDF_ORIENTATION_PORTRAIT;
        $format = 'A4';
        $lang = 'de';
        $unicode = true;
        $encoding = 'UTF-8';
        $margins = [0, 0, 0, 0];
        $pdfa = true;
        return [$orientation, $format, $lang, $unicode, $encoding, $margins, $pdfa];
    }

    /**
     * @param $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        // forced filename from setFilename()
        if ($this->filename) {
            return $this->makeValidFileName(
                $this->addFilenameExtension(
                    $this->filename
                )
            );
        }

        return $this->makeValidFileName(
            $this->addFilenameExtension(
                $this->getTypeForFilename()
            )
        );
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
        $fs = oxNew(d3filesystem::class);
        return $fs->filterFilename($sFilename);
    }

    /**
     * @return bool
     */
    public function renderTemplateFromAdmin()
    {
        return false;
    }

    /**
     * @param Html2Pdf $oPdf
     * @param $sFilename
     * @param $target
     * @param $html
     * @return string|null
     * @throws Html2PdfException
     */
    public function output(Html2Pdf $oPdf, $sFilename, $target, $html)
    {
        if ((bool) Registry::getConfig()->getConfigParam('d3PdfDocumentsbDev') === true) {
            return $this->outputDev($oPdf, $sFilename, $target, $html);
        } else {
            return $oPdf->output($sFilename, $target);
        }
    }

    /**
     * @param Html2Pdf $oPdf
     * @param $sFilename
     * @param $target
     * @param $html
     * @return null
     */
    public function outputDev(Html2Pdf $oPdf, $sFilename, $target, $html)
    {
        $sFilename = str_replace('.pdf', '.html', $sFilename);

        switch($target) {
            case 'I': {
                // Send PDF to the standard output
                if (ob_get_contents()) {
                    $oPdf->pdf->Error('Some data has already been output, can\'t send PDF file');
                }
                if (php_sapi_name() != 'cli') {
                    //We send to a browser
                    header('Content-Type: text/html');
                    if (headers_sent()) {
                        $oPdf->pdf->Error('Some data has already been output to browser, can\'t send PDF file');
                    }
                    header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
                    header('Pragma: public');
                    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
                    header('Content-Length: '.strlen($html));
                    header('Content-Disposition: inline; filename="'.basename($sFilename).'";');
                }
                echo $html;
                break;
            }
            case 'D': {
                // Download PDF as file
                if (ob_get_contents()) {
                    $oPdf->pdf->Error('Some data has already been output, can\'t send PDF file');
                }
                header('Content-Description: File Transfer');
                if (headers_sent()) {
                    $oPdf->pdf->Error('Some data has already been output to browser, can\'t send PDF file');
                }
                header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
                header('Pragma: public');
                header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
                // force download dialog
                header('Content-Type: application/force-download');
                header('Content-Type: application/octet-stream', false);
                header('Content-Type: application/download', false);
                header('Content-Type: text/html', false);
                // use the Content-Disposition header to supply a recommended filename
                header('Content-Disposition: attachment; filename="'.basename($sFilename).'";');
                header('Content-Transfer-Encoding: binary');
                header('Content-Length: '.strlen($html));
                echo $html;
                break;
            }
            case 'F': {
                // Save PDF to a local file
                $f = fopen($sFilename, 'wb');
                if (!$f) {
                    $oPdf->pdf->Error('Unable to create output file: '.$sFilename);
                }
                fwrite($f, $html, strlen($html));
                fclose($f);
                break;
            }
            case 'S': {
                // Returns PDF as a string
                return $html;
            }
            default: {
                $oPdf->pdf->Error('Incorrect output destination: '.$target);
            }
        }

        return null;
    }
}