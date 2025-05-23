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

use Assert\Assert;
use Assert\InvalidArgumentException;
use D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric;
use OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererBridge;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererBridgeInterface;
use OxidEsales\Twig\TwigEngine;

/**
 * @codeCoverageIgnore
 */
class articleDataSheet extends pdfdocumentsGeneric
{
    protected ?Article $article = null;

    public function genPdf( string $filename, int $language = 0, string $target = self::PDF_DESTINATION_STDOUT ): ?string
    {
        /** @var TemplateRendererBridge $bridge */
        $bridge = ContainerFactory::getInstance()->getContainer()->get(TemplateRendererBridgeInterface::class);
        Assert::that($bridge->getTemplateRenderer()->getTemplateEngine())
              ->isInstanceOf(
                  TwigEngine::class,
                  <<<MSG
                  The article data sheet is only provided by the Twig Engine. 
                  Please contact the author for further assistance.
                  MSG
              );

        return parent::genPdf( $filename, $language, $target );
    }

    public function setArticle(Article $article): void
    {
        $this->article = $article;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getArticle(): Article
    {
        Assert::that($this->article)->isInstanceOf(Article::class, 'no article for pdf generator set');
        Assert::that($this->article->isLoaded())->true('given article is not loaded');
        return $this->article;
    }

    public function getRequestId(): string
    {
        return 'article_datasheet';
    }

    public function getTitleIdent(): string
    {
        return "D3_PDFDOCUMENTS_ARTICLE_DATASHEET";
    }

    public function getTemplate(): string
    {
        return '@d3PdfDocuments/documents/article/datasheet';
    }

    public function getTypeForFilename(): string
    {
        return "article_datasheet";
    }
}