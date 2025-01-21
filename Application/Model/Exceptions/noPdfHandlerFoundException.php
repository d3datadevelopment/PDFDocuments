<?php

/**
 * See LICENSE file for license details.
 * 
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

declare(strict_types = 1);

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
        parent::__construct( $message, $code, $previous );
    }
}