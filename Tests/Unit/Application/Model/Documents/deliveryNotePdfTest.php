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

namespace D3\PdfDocuments\Tests\Unit\Application\Model\Documents;

use D3\PdfDocuments\Application\Model\Documents\deliverynotePdf;
use D3\PdfDocuments\Tests\Unit\Application\Model\AbstractClasses\pdfDocumentsOrder;
use Generator;

class deliveryNotePdfTest extends pdfDocumentsOrder
{
    protected string $sutClassName = deliveryNotePdf::class;

    public static function getFileNameDataProvider(): Generator
    {
        yield 'predefined' => ['predefinedFileName', 'predefinedfilename.pdf'];
        yield 'undefined' => [null, 'delnote_ordernumberfixture_billlnamefixture.pdf'];
    }
}
