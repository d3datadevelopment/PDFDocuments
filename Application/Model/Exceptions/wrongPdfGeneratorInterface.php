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

class wrongPdfGeneratorInterface extends pdfGeneratorExceptionAbstract
{
    public function __construct( $requiredInterface, $sMessage = "generator class doesn't fulfilled the interface", $iCode = 0, Exception $previous = null ) {

        $sMessage .= $requiredInterface;

        parent::__construct( $sMessage, $iCode, $previous );
    }
}