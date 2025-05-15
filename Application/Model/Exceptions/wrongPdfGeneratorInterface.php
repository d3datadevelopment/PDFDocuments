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

namespace D3\PdfDocuments\Application\Model\Exceptions;

use Exception;

class wrongPdfGeneratorInterface extends pdfGeneratorExceptionAbstract
{
    public function __construct(
        string $requiredInterface,
        string $message = "generator class doesn't fulfilled the interface",
        int $code = 0,
        Exception $previous = null
    ) {
        $message .= $requiredInterface;
        parent::__construct($message, $code, $previous);
    }
}
