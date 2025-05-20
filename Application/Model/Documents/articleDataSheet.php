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

/**
 * @codeCoverageIgnore
 */
class articleDataSheet extends pdfdocumentsGeneric
{
    protected ?Article $article = null;

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