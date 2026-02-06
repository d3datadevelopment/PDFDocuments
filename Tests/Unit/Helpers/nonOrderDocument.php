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

namespace D3\PdfDocuments\Tests\Unit\Helpers;

use D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric;

class nonOrderDocument extends pdfdocumentsGeneric
{
    public function getRequestId(): string
    {
        return 'requestId';
    }

    public function getTitleIdent(): string
    {
        return 'titleIdent';
    }

    public function getTemplate(): string
    {
        return 'template';
    }

    public function getTypeForFilename(): string
    {
        return 'nonOrderDocument';
    }
}
