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

class noPdfHandlerFoundException extends pdfGeneratorExceptionAbstract
{
    /**
     * d3noPdfHandlerFoundException constructor.
     *
     * @param                 $requestId
     * @param string          $sMessage
     * @param int             $iCode
     * @param Exception|null $previous
     */
    public function __construct( $requestId, $sMessage = "no pdf handler defined for given request id", $iCode = 0, Exception $previous = null )
    {
        $sMessage .= ' "'.$requestId.'"';
        parent::__construct( $sMessage, $iCode, $previous );
    }
}