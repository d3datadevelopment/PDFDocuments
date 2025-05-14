<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\AbstractClasses;

use Assert\InvalidArgumentException;
use D3\PdfDocuments\Application\Model\Constants;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsGenericInterface as genericInterface;
use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsView;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRenderer;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererBridgeInterface;
use OxidEsales\Twig\Resolver\TemplateChain\TemplateNotInChainException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\MyPdf;
use Symfony\Component\String\UnicodeString;
use Twig\Error\Error;

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

    /** @var string */
    public $filename;

    public function runPreAction()
    {
    }

    public function runPostAction()
    {
    }

    /**
     * @param string $sFilename
     * @param int $iSelLang
     * @param string $target
     *
     * @return string|null
     * @throws ContainerExceptionInterface
     * @throws Html2PdfException
     * @throws NotFoundExceptionInterface
     */
    public function genPdf($sFilename, $iSelLang = 0, $target = self::PDF_DESTINATION_STDOUT)
    {
        $oPdf = oxNew(Html2Pdf::class, ...$this->getPdfProperties());
        $oPdf->setTestIsImage(false);
        $htmlContent = $this->getHTMLContent($iSelLang);

        $oPdf->writeHTML($htmlContent);
        /** @var MyPdf $myPdf */
        $myPdf = $oPdf->pdf;
        $myPdf->setAuthor( Registry::getConfig()->getActiveShop()->getFieldData( 'oxname'));
        $myPdf->setTitle( Registry::getLang()->translateString( $this->getTitleIdent()));
        $myPdf->setCreator( 'D³ PDF Documents for OXID eShop');
        $myPdf->setSubject( NULL);
        return $this->output($oPdf, $sFilename, $target, $htmlContent);
    }

    /**
     * @param int $iLanguage
     * @throws Html2PdfException
     */

    /**
     * @param $iLanguage
     *
     * @return void
     * @throws ContainerExceptionInterface
     * @throws Html2PdfException
     * @throws NotFoundExceptionInterface
     */
    public function downloadPdf($iLanguage = 0)
    {
        try {
            $this->runPreAction();
            $sFilename = $this->getFilename();
            $this->genPdf($sFilename, $iLanguage, self::PDF_DESTINATION_DOWNLOAD);
            $this->runPostAction();
            Registry::getUtils()->showMessageAndExit('');
        } catch (InvalidArgumentException $e) {
            Registry::getLogger()->error($e);
            Registry::get(UtilsView::class)->addErrorToDisplay($e);
        }
    }

    /**
     * @param string $path
     * @param int $iLanguage
     *
     * @return void
     * @throws ContainerExceptionInterface
     * @throws Html2PdfException
     * @throws NotFoundExceptionInterface
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
        } catch (InvalidArgumentException $e) {
            Registry::get(UtilsView::class)->addErrorToDisplay($e);
            Registry::getLogger()->error($e);
        }
    }

    /**
     * @param int $iLanguage
     *
     * @return string|null
     * @throws ContainerExceptionInterface
     * @throws Html2PdfException
     * @throws NotFoundExceptionInterface
     */
    public function getPdfContent($iLanguage = 0)
    {
        try {
            $this->runPreAction();
            $sFilename = $this->getFilename();
            $ret = $this->genPdf( $sFilename, $iLanguage, self::PDF_DESTINATION_STRING );
            $this->runPostAction();
            return $ret;
        } catch (InvalidArgumentException $e) {
            Registry::get(UtilsView::class)->addErrorToDisplay($e);
            Registry::getLogger()->error($e);
        }

        return null;
    }

    public function getTemplateEngineVars(int $iSelLang): array
    {
        unset($iSelLang);

        return [
            'config' => Registry::getConfig(),
            'oViewConf' => Registry::getConfig()->getActiveView()->getViewConfig(),
            'shop'  => Registry::getConfig()->getActiveShop(),
            'lang'  => Registry::getLang(),
            'document' => $this
        ];
    }
	
    /**
     * @param int $iSelLang
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function getHTMLContent(int $iSelLang = 0)
    {
        $blCurrentRenderFromAdmin = self::$_blIsAdmin;
        self::$_blIsAdmin = $this->renderTemplateFromAdmin();

        $lang = Registry::getLang();

        $currTplLang = $lang->getTplLanguage();
        $lang->setTplLanguage($iSelLang);

	    try {
            $content = $this->getTemplateRenderer()->renderTemplate(
                $this->getTemplate(),
                $this->getTemplateEngineVars($iSelLang)
            );
	    } catch (Error|TemplateNotInChainException $error) {
		    
		    //Registry::getLogger()->error(dumpVar(__METHOD__." ".__LINE__), [$error->getFile()]);
			
		    throw oxNew(StandardException::class, $error->getMessage());
	    }
	    
	    $lang->setTplLanguage($currTplLang);

        self::$_blIsAdmin = $blCurrentRenderFromAdmin;

        return $content;
    }

    protected function getTemplateRenderer(): TemplateRenderer
    {
        return ContainerFactory::getInstance()->getContainer()
            ->get(TemplateRendererBridgeInterface::class)
            ->getTemplateRenderer();
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
        if (strlen($extension) && substr($filename, $extensionLength) != '.'.$extension) {
            $filename .= '.'.$extension;
        }

        return $filename;
    }

    /**
     * Gets proper file name
     *
     * @param $filename
     *
     * @return string
     */
    public function makeValidFileName($filename)
    {
        // replace transliterations (umlauts, accents ...)
        $unicodeString = new UnicodeString(utf8_encode($filename));
        $filename = (string) $unicodeString->ascii();

        // sanitize filename
        $filename = preg_replace(
            '~
            [<>:"/\\\\|?*]|      # file system reserved
            [\x00-\x1F]|         # control characters
            [\x7F\xA0\xAD]|      # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
            [#\[\]@!$&\'()+,;=]| # URI reserved
            [{}^\~`]             # URL unsafe characters
            ~x',
            '-',
            $filename
        );

        // avoids ".", ".." or ".hiddenFiles"
        $filename = ltrim($filename, '.-');

        $filename = $this->beautifyFilename($filename);

        // maximize filename length to 255 bytes
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        return mb_strcut(
            pathinfo($filename, PATHINFO_FILENAME),
            0,
            255 - ($ext ? strlen($ext) + 1 : 0),
            mb_detect_encoding($filename) ?: null
        ) . ($ext ? '.' . $ext : '');
    }

    public function beautifyFilename($filename)
    {
        // reduce consecutive characters
        $filename = preg_replace([
            // "file   name.zip" becomes "file-name.zip"
            '/\s+/',
            // "file___name.zip" becomes "file-name.zip"
            '/_{2,}/',
            // "file---name.zip" becomes "file-name.zip"
            '/-+/',
        ], '-', $filename);

        $filename = preg_replace([
            // "file--.--.-.--name.zip" becomes "file.name.zip"
            '/-*\.-*/',
            // "file...name..zip" becomes "file.name.zip"
            '/\.{2,}/',
        ], '.', $filename);

        // lowercase for windows/unix interoperability
        $filename = mb_strtolower($filename, mb_detect_encoding($filename));

        // ".file-name.-" becomes "file-name"
        $filename = trim($filename, '.-');

        return trim($filename);
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
     * @param          $sFilename
     * @param          $target
     * @param          $html
     *
     * @return string|null
     * @throws Html2PdfException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function output(Html2Pdf $oPdf, $sFilename, $target, $html)
    {
        $moduleSettings = ContainerFactory::getInstance()->getContainer()->get(ModuleSettingServiceInterface::class);
        if ($moduleSettings->getBoolean( 'd3PdfDocumentsbDev', Constants::OXID_MODULE_ID )) {
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
                if (substr(php_sapi_name(), 0, 3) != 'cli') {
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