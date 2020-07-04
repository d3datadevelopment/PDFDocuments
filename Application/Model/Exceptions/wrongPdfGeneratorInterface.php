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

class wrongPdfGeneratorInterface extends pdfGeneratorExceptionAbstract
{
    public function __construct( $requiredInterface, $sMessage = "generator class doesn't fulfilled the interface", $iCode = 0, Exception $previous = null ) {

        $sMessage .= $requiredInterface;

        parent::__construct( $sMessage, $iCode, $previous );
    }
}