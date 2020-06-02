<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * http://www.shopmodule.com
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