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

class noPdfHandlerFoundException extends pdfGeneratorExceptionAbstract
{
    public function __construct(
        $requestId,
        string $message = "no pdf handler defined for given request id",
        int $code = 0,
        ?Exception $previous = null
    ) {
        $message .= ' "'.$requestId.'"';
        parent::__construct($message, $code, $previous);
    }
}
