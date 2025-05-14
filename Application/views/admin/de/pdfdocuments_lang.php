<?php

/**
 * See LICENSE file for license details.
 * 
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

$sLangName = "Deutsch";

$basicAuthHelp = <<<HELP
Befindet sich der aktuelle Shop hinter einem BasicAuth, können beim Generieren des PDFs die Bilder nicht geladen werden. Tragen Sie hier die Zugangsdaten ein, um die Bilder zu sehen.  
HELP;

$aLang     = array(
    'charset'                                            => 'utf-8',

    'SHOP_MODULE_GROUP_d3PdfDocumentsmain'               => 'Grundeinstellungen',
    'SHOP_MODULE_d3PdfDocumentsbDev'                     => 'Entwicklermodus',
    'HELP_SHOP_MODULE_d3PdfDocumentsbDev'                => 'Mit aktiviertem Entwicklermodus wird das Dokument im '.
                                    'HTML-Format ausgegeben. Inhaltliche Fehler können so besser nachvollzogen werden.',
    'SHOP_MODULE_d3PdfDocumentsbasicAuthUserName'        => 'BasicAuth des Shops - Benutzername (optional)',
    'HELP_SHOP_MODULE_d3PdfDocumentsbasicAuthUserName'   => $basicAuthHelp,
    'SHOP_MODULE_d3PdfDocumentsbasicAuthPassword'        => 'BasicAuth des Shops - Passwort (optional)',
    'HELP_SHOP_MODULE_d3PdfDocumentsbasicAuthPassword'   => $basicAuthHelp,

    'D3_PDFDOCUMENTS'                                    => 'PDF-Dokumente',
    'D3_PDFDOCUMENTS_INVOICE'                            => 'Rechnung',
    'D3_PDFDOCUMENTS_INVOICE_WITHOUT_LOGO'               => 'Rechnung ohne Logo',
    'D3_PDFDOCUMENTS_DELIVERYNOTE'                       => 'Lieferschein',
    'D3_PDFDOCUMENTS_DELIVERYNOTE_WITHOUT_LOGO'          => 'Lieferschein ohne Logo',

    'D3_PDFDOCUMENTS_PDF_TYPE'                           => 'Dokument',
    'D3_PDFDOCUMENTS_LANGUAGE'                           => 'Sprache',
    'D3_PDFDOCUMENTS_PDF_GENERATE'                       => 'Dokument erstellen',
);
