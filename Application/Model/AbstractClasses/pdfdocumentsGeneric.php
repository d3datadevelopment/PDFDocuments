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

namespace D3\PdfDocuments\Application\Model\AbstractClasses;

use Assert\InvalidArgumentException;
use D3\PdfDocuments\Application\Model\Constants;
use D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsGenericInterface as genericInterface;
use Exception;
use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsView;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Exception\ModuleConfigurationNotFoundException;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Exception\ModuleSettingNotFountException;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRenderer;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererBridgeInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\MyPdf;
use Symfony\Component\String\UnicodeString;

abstract class pdfdocumentsGeneric extends Base implements genericInterface
{
    public const PDF_DESTINATION_DOWNLOAD          = 'D';   // force download in browser
    public const PDF_DESTINATION_STDOUT            = 'I';   // show in browser plugin if available, otherwise download
    public const PDF_DESTINATION_FILE              = 'F';   // save as a local file
    public const PDF_DESTINATION_FILEANDSTDOUT     = 'FI';  // output as a local file and show in browser plugin
    public const PDF_DESTINATION_FILEANDDOWNLOAD   = 'FD';  // output as a local file and force download in browser
    public const PDF_DESTINATION_STRING            = 'S';   // output as string

    public const PDF_ORIENTATION_PORTRAIT = 'P';
    public const PDF_ORIENTATION_LANDSCAPE = 'L';

    public string $filenameExtension = 'pdf';
    public ?string $filename = null;

    protected bool $devMode = false;

    public function setDevelopmentMode(bool $devMode): void
    {
        $this->devMode = $devMode;
    }

    /**
     * @codeCoverageIgnore
     */
    public function runPreAction()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function runPostAction()
    {
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws Html2PdfException
     * @throws ModuleConfigurationNotFoundException
     * @throws ModuleSettingNotFountException
     * @throws NotFoundExceptionInterface
     */
    public function genPdf(string $filename, int $language = 0, string $target = self::PDF_DESTINATION_STDOUT): ?string
    {
        $oPdf = $this->getHtml2Pdf();
        $oPdf->getSecurityService()->addAllowedHost(
            parse_url(Registry::getConfig()->getShopCurrentUrl())['host']
        );
        $oPdf->setTestIsImage(false);
        $htmlContent = $this->getHTMLContent($language);
        $oPdf->writeHTML($htmlContent);
        /** @var MyPdf $myPdf */
        $myPdf = $oPdf->pdf;
        $myPdf->setAuthor(Registry::getConfig()->getActiveShop()->getFieldData('oxname'));
        $myPdf->setTitle(Registry::getLang()->translateString($this->getTitleIdent()));
        $myPdf->setCreator('D³ PDF Documents for OXID eShop');
        $myPdf->setSubject(null);
        return $this->output($oPdf, $filename, $target, $htmlContent);
    }

    protected function getHtml2Pdf(): Html2Pdf
    {
        return oxNew(Html2Pdf::class, ...$this->getPdfProperties());
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws Html2PdfException
     * @throws ModuleConfigurationNotFoundException
     * @throws ModuleSettingNotFountException
     * @throws NotFoundExceptionInterface
     */
    public function downloadPdf(int $language = 0): void
    {
        try {
            $this->runPreAction();
            $sFilename = $this->getFilename();
            $this->genPdf($sFilename, $language, self::PDF_DESTINATION_DOWNLOAD);
            $this->runPostAction();
            Registry::getUtils()->showMessageAndExit('');
            // @codeCoverageIgnoreStart
        } catch (InvalidArgumentException $e) {
            Registry::getLogger()->error($e);
            Registry::get(UtilsView::class)->addErrorToDisplay($e);
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws Html2PdfException
     * @throws ModuleConfigurationNotFoundException
     * @throws ModuleSettingNotFountException
     * @throws NotFoundExceptionInterface
     */
    public function savePdfFile(string $path, int $language = 0): void
    {
        try {
            $this->runPreAction();
            $sFilename = $this->getFilename();
            $this->genPdf(
                rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$sFilename,
                $language,
                self::PDF_DESTINATION_FILE
            );
            $this->runPostAction();
            // @codeCoverageIgnoreStart
        } catch (InvalidArgumentException $e) {
            Registry::get(UtilsView::class)->addErrorToDisplay($e);
            Registry::getLogger()->error($e);
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws Html2PdfException
     * @throws ModuleConfigurationNotFoundException
     * @throws ModuleSettingNotFountException
     * @throws NotFoundExceptionInterface
     */
    public function getPdfContent(int $language = 0): ?string
    {
        try {
            $this->runPreAction();
            $sFilename = $this->getFilename();
            $ret = $this->genPdf($sFilename, $language, self::PDF_DESTINATION_STRING);
            $this->runPostAction();
            return $ret;
            // @codeCoverageIgnoreStart
        } catch (InvalidArgumentException $e) {
            Registry::get(UtilsView::class)->addErrorToDisplay($e);
            Registry::getLogger()->error($e);
        }
        // @codeCoverageIgnoreEnd

        return null;
    }

    public function getTemplateEngineVars(int $language): array
    {
        unset($language);

        return [
            'config'    => Registry::getConfig(),
            'oViewConf' => Registry::getConfig()->getActiveView()->getViewConfig(),
            'shop'      => Registry::getConfig()->getActiveShop(),
            'lang'      => Registry::getLang(),
            'utilsUrl'  => Registry::getUtilsUrl(),
            'document'  => $this,
        ];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws ModuleConfigurationNotFoundException
     * @throws ModuleSettingNotFountException
     * @throws NotFoundExceptionInterface
     */
    public function getHTMLContent(int $language = 0): string
    {
        $lastRenderFromAdmin = $this->setAdminContext($this->renderTemplateFromAdmin());

        $lang = Registry::getLang();
        $currTplLang = $lang->getTplLanguage();
        $lang->setTplLanguage($language);

        $content = $this->getTemplateRenderer()->renderTemplate(
            $this->getTemplate(),
            $this->getTemplateEngineVars($language)
        );

        $lang->setTplLanguage($currTplLang);

        $this->setAdminContext($lastRenderFromAdmin);

        return $this->addBasicAuth($content);
    }

    protected function setAdminContext(bool $blAdmin): bool
    {
        $config = Registry::getConfig();
        $isAdmin = $config->isAdmin();

        if ($config->isAdmin() !== $blAdmin) {
            $config->setAdminMode($blAdmin);
            ContainerFactory::resetContainer();
        }

        return $isAdmin;
    }

    /**
     * @param string $content
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ModuleConfigurationNotFoundException
     * @throws ModuleSettingNotFountException
     */
    protected function addBasicAuth(string $content): string
    {
        /** @var ModuleSettingService $settingsService */
        $settingsService =  ContainerFactory::getInstance()->getContainer()->get(ModuleSettingServiceInterface::class);
        $username = trim(
            (string) $settingsService->getString('d3PdfDocumentsbasicAuthUserName', Constants::OXID_MODULE_ID)
        );
        $password = trim(
            (string) $settingsService->getString('d3PdfDocumentsbasicAuthPassword', Constants::OXID_MODULE_ID)
        );

        if ($username && $password) {
            $shopUrl  = parse_url(Registry::getConfig()->getShopCurrentUrl());
            $pattern  = '/(["|\'])'.
                        '(' . preg_quote($shopUrl['scheme'], '/') . ':\/\/)'.
                        '(' . preg_quote($shopUrl['host'], '/') . '.*?)'.
                        '\1/m';
            $replace  = "$1$2" . urlencode($username). ":" . urlencode($password) . "@$3$1";

            $content = preg_replace($pattern, $replace, $content);
        }

        return $content;
    }

    /**
     * @codeCoverageIgnore
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getTemplateRenderer(): TemplateRenderer
    {
        return ContainerFactory::getInstance()->getContainer()
            ->get(TemplateRendererBridgeInterface::class)
            ->getTemplateRenderer();
    }

    /**
     * @codeCoverageIgnore
     */
    public function getPdfProperties(): array
    {
        return [
            'orientation' => self::PDF_ORIENTATION_PORTRAIT,
            'format'    => 'A4',
            'lang'      => 'de',
            'unicode'   => true,
            'encoding'  => 'UTF-8',
            'margins'   => [0, 0, 0, 0],
            'pdfa'      => true,
        ];
    }

    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    public function getFilename(): string
    {
        // forced filename from setFilename()
        if ($this->filename) {
            return $this->sanitizeFileName(
                $this->addFilenameExtension(
                    $this->filename
                )
            );
        }

        return $this->sanitizeFileName(
            $this->addFilenameExtension(
                $this->getTypeForFilename()
            )
        );
    }

    public function addFilenameExtension(string $filename): string
    {
        $extension = $this->filenameExtension;
        $extensionLength = (strlen($extension) + 1) * -1;
        if (strlen($extension) && substr($filename, $extensionLength) != '.'.$extension) {
            $filename .= '.'.$extension;
        }

        return $filename;
    }

    /**
     * Gets a proper file name
     */
    public function sanitizeFileName(string $filename): string
    {
        // replace transliterations (umlauts, accents ...)
        $filename = mb_detect_encoding($filename) == 'UTF-8' ? (string) (new UnicodeString($filename))->ascii() : $filename;

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
            mb_detect_encoding($filename)
        ) . ($ext ? '.' . $ext : '');
    }

    public function beautifyFilename(string $filename): string
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
     * @codeCoverageIgnore
     */
    public function renderTemplateFromAdmin(): bool
    {
        return false;
    }

    /**
     * @throws Html2PdfException
     * @throws Exception
     */
    public function output(Html2Pdf $pdf, string $filename, string $target, string $html): ?string
    {
        if ($this->devMode) {
            return $this->outputDev($pdf, $filename, $target, $html);
        } else {
            return $pdf->output($filename, $target);
        }
    }

    /**
     * @throws Exception
     */
    public function outputDev(Html2Pdf $pdf, string $filename, string $target, string $html): ?string
    {
        $filename = str_replace('.pdf', '.sgml', $filename);

        switch ($target) {
            case self::PDF_DESTINATION_STDOUT:
                return $this->outputDev_stdout($pdf, $filename, $html);
            case self::PDF_DESTINATION_DOWNLOAD:
                return $this->outputDev_download($pdf, $filename, $html);
            case self::PDF_DESTINATION_FILE:
                return $this->outputDev_saveLocal($pdf, $filename, $html);
            case self::PDF_DESTINATION_STRING:
                return $html;
            default:
                $pdf->pdf->Error('Incorrect output destination: '.$target);
        }

        return null;
    }

    /**
     * @param Html2Pdf $pdf
     * @param string $html
     * @param array|string $filename
     * @return null
     * @throws Exception
     */
    protected function outputDev_stdout(Html2Pdf $pdf, array|string $filename, string $html)
    {
        if (ob_get_contents()) {
            $pdf->pdf->Error('Some data has already been output, can\'t send PDF file');
        }
        if (!$this->isCli()) {
            header('Content-Type: text/html');
            // @codeCoverageIgnoreStart
            if ($this->headersSent()) {
                $pdf->pdf->Error('Some data has already been output to browser, can\'t send PDF file');
            }
            // @codeCoverageIgnoreEnd
            header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
            header('Pragma: public');
            header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
            header('Content-Length: ' . strlen($html));
            header('Content-Disposition: inline; filename="' . basename($filename) . '";');
        }
        echo $html;

        return null;
    }

    /**
     * @param Html2Pdf $pdf
     * @param array|string $filename
     * @param string $html
     * @return null
     * @throws Exception
     */
    protected function outputDev_download(Html2Pdf $pdf, array|string $filename, string $html)
    {
        if (ob_get_contents()) {
            $pdf->pdf->Error('Some data has already been output, can\'t send PDF file');
        }
        header('Content-Description: File Transfer');
        // @codeCoverageIgnoreStart
        if ($this->headersSent()) {
            $pdf->pdf->Error('Some data has already been output to browser, can\'t send PDF file');
        }
        // @codeCoverageIgnoreEnd
        header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        // force download dialog
        header('Content-Type: application/force-download');
        header('Content-Type: application/octet-stream', false);
        header('Content-Type: application/download', false);
        header('Content-Type: text/sgml', false);
        // use the Content-Disposition header to supply a recommended filename
        header('Content-Disposition: attachment; filename="' . basename($filename) . '";');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($html));
        echo $html;

        return null;
    }

    /**
     * @param array|string $filename
     * @param Html2Pdf $pdf
     * @param string $html
     * @return null
     * @throws Exception
     */
    public function outputDev_saveLocal(Html2Pdf $pdf, array|string $filename, string $html)
    {
        $f = fopen($filename, 'wb');
        if (!$f) {
            $pdf->pdf->Error('Unable to create output file: ' . $filename);
            return null;
        }
        fwrite($f, $html, strlen($html));
        fclose($f);

        return null;
    }

    /**
     * @codeCoverageIgnore
     */
    protected function isCli(): bool
    {
        return str_starts_with(php_sapi_name(), 'cli');
    }

    /**
     * @codeCoverageIgnore
     */
    protected function headersSent(): bool
    {
        return headers_sent();
    }
}
