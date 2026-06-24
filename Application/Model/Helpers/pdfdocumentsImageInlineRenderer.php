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

namespace D3\PdfDocuments\Application\Model\Helpers;

use OxidEsales\Eshop\Core\DynamicImageGenerator;
use OxidEsales\Eshop\Core\Registry;

class pdfdocumentsImageInlineRenderer
{
    public function inlineImages(string $body): string
    {
        $body = $this->inlineHtmlAttributeUrls($body, 'src');
        $body = $this->inlineHtmlAttributeUrls($body, 'backimg');

        return $body;
    }

    protected function inlineHtmlAttributeUrls(string $body, string $attribute): string
    {
        if (!preg_match_all(
            '/\b'.preg_quote($attribute, '/').'\s*=\s*([\'"])(.*?)\1/i',
            $body,
            $matches,
            PREG_SET_ORDER
        )) {
            return $body;
        }

        foreach ($matches as $match) {
            $fullAttribute = $match[0];
            $src = trim($match[2]);

            if ($src === '' || str_starts_with($src, 'data:')) {
                continue;
            }

            $dataUri = $this->resolveImageDataUri($src);

            if ($dataUri === null) {
                continue;
            }

            $newAttribute = str_replace($src, $dataUri, $fullAttribute);
            $body = str_replace($fullAttribute, $newAttribute, $body);
        }

        return $body;
    }

    private function resolveImageDataUri(string $src): ?string
    {
        $localPath = $this->resolveImagePath($src);

        if ($localPath !== null && $this->isPathAllowed($localPath)) {
            return $this->buildDataUri($localPath);
        }

        $this->tryGenerateMissingImage($src);

        $localPath = $this->resolveImagePath($src);

        if ($localPath !== null && $this->isPathAllowed($localPath)) {
            return $this->buildDataUri($localPath);
        }

        return null;
    }

    protected function tryGenerateMissingImage(string $src): void
    {
        $src = str_replace(
            Registry::getConfig()->getConfigParam('sShopURL'),
            Registry::getConfig()->getConfigParam('sShopDir'),
            $src
        );

        DynamicImageGenerator::getInstance()->getImagePath($src);
    }

    protected function resolveImagePath(string $src): ?string
    {
        $shopUrl = Registry::getConfig()->getConfigParam('sShopURL');

        $shopUrlParts = parse_url($shopUrl);
        $srcParts = parse_url($src);
        $srcPath = (string) ($srcParts['path'] ?? $src);

        if (is_file($src)) {
            return realpath($src) ?: null;
        }

        if (str_starts_with($src, '/')) {
            return realpath(getShopBasePath() . ltrim($srcPath, '/')) ?: null;
        }

        if (
            isset($srcParts['host'], $shopUrlParts['host'])
            && strtolower($srcParts['host']) === strtolower($shopUrlParts['host'])
        ) {
            return realpath(getShopBasePath() . ltrim($srcPath, '/')) ?: null;
        }

        if (!isset($srcParts['scheme']) && !isset($srcParts['host'])) {
            return
                realpath(getShopBasePath() . ltrim($srcPath, '/')) ?:
                realpath(ltrim($srcPath, '/')) ?: null;
        }

        return null;
    }

    private function isPathAllowed(string $filePath): bool
    {
        $realFile = realpath($filePath);

        if (!$realFile || !is_file($realFile) || !is_readable($realFile)) {
            return false;
        }

        foreach ($this->getAllowedAssetRoots() as $allowedRoot) {
            $realRoot = realpath($allowedRoot);

            if (!$realRoot) {
                continue;
            }

            if ($this->isInsideDirectory($realFile, $realRoot)) {
                return true;
            }
        }

        return false;
    }

    protected function getAllowedAssetRoots(): array
    {
        $sourceRoot = rtrim(getShopBasePath(), DIRECTORY_SEPARATOR);
        $projectRoot = dirname($sourceRoot);

        return [
            $sourceRoot,
            $projectRoot . DIRECTORY_SEPARATOR . 'vendor',
        ];
    }

    protected function isInsideDirectory(string $filePath, string $directory): bool
    {
        $filePath = rtrim($filePath, DIRECTORY_SEPARATOR);
        $directory = rtrim($directory, DIRECTORY_SEPARATOR);

        return $filePath === $directory
               || str_starts_with($filePath, $directory . DIRECTORY_SEPARATOR);
    }

    private function buildDataUri(string $filePath): ?string
    {
        $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';
        $content  = file_get_contents($filePath);

        if ($content === false) {
            return null;
        }

        return sprintf(
            'data:%s;base64,%s',
            $mimeType,
            base64_encode($content)
        );
    }
}
