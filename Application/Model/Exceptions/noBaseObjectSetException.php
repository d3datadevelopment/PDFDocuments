<?php

/**
 * See LICENSE file for license details.
 * 
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Application\Model\Exceptions;

use Exception;

class noBaseObjectSetException extends pdfGeneratorExceptionAbstract
{
    public function __construct( $sMessage = "no base object (e.g. order) for pdf generator set", $iCode = 0, Exception $previous = null )
    {
        parent::__construct( $sMessage, $iCode, $previous );
    }
}