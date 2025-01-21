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

class wrongPdfGeneratorInterface extends pdfGeneratorExceptionAbstract
{
    public function __construct(
        string $requiredInterface,
        string $message = "generator class doesn't fulfilled the interface",
        int $code = 0,
        Exception $previous = null
    ) {
        $message .= $requiredInterface;
        parent::__construct( $message, $code, $previous );
    }
}