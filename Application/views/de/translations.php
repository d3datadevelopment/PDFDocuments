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

use D3\PdfDocuments\Application\Model\Constants;

// @codeCoverageIgnoreStart
$basicAuthHelp = <<<HELP
    Befindet sich der aktuelle Shop hinter einem BasicAuth, können beim Generieren des PDFs die Bilder nicht geladen werden. Tragen Sie hier die Zugangsdaten ein, um die Bilder zu sehen.  
HELP;

return [
    'charset'                                               => 'utf-8',

    'SHOP_MODULE_GROUP_'. Constants::OXID_MODULE_ID.'main'  => 'Grundeinstellungen',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'bDev'        => 'Entwicklermodus',
    'HELP_SHOP_MODULE_'. Constants::OXID_MODULE_ID.'bDev'   => 'Mit aktiviertem Entwicklermodus kann das Dokument im '.
                                    'SGML-Format ausgegeben werden. Inhaltliche Fehler können so besser nachvollzogen werden.',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'basicAuthUserName'        => 'BasicAuth des Shops - Benutzername (optional)',
    'HELP_SHOP_MODULE_'. Constants::OXID_MODULE_ID.'basicAuthUserName'   => $basicAuthHelp,
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'basicAuthPassword'        => 'BasicAuth des Shops - Passwort (optional)',
    'HELP_SHOP_MODULE_'. Constants::OXID_MODULE_ID.'basicAuthPassword'   => $basicAuthHelp,

    'SHOP_MODULE_GROUP_'. Constants::OXID_MODULE_ID.'invoice'           => 'Rechnung',
    'SHOP_MODULE_invoicePaymentTerm'                                    => 'Zahlungsziel (in Tagen)',

    'SHOP_MODULE_GROUP_'. Constants::OXID_MODULE_ID.'contents'           => 'Inhalte',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'LogoUrl'                  => 'Logo-Grafik URL',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'BackgroundUrl'            => 'Hintergrund-Grafik URL',

    'SHOP_MODULE_GROUP_'. Constants::OXID_MODULE_ID.'documents'          => 'Dokumente',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'DocInvoice'               => 'Rechnung',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'DocInvoiceNoLogo'         => 'Rechnung ohne Logo',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'DocDeliveryNote'          => 'Lieferschein',
    'SHOP_MODULE_'. Constants::OXID_MODULE_ID.'DocDeliveryNoteNoLogo'    => 'Lieferschein ohne Logo',

    'D3_PDFDOCUMENTS'                                    => 'PDF-Dokumente',
    'D3_PDFDOCUMENTS_INVOICE'                            => 'Rechnung',
    'D3_PDFDOCUMENTS_INVOICE_WITHOUT_LOGO'               => 'Rechnung ohne Logo',
    'D3_PDFDOCUMENTS_DELIVERYNOTE'                       => 'Lieferschein',
    'D3_PDFDOCUMENTS_DELIVERYNOTE_WITHOUT_LOGO'          => 'Lieferschein ohne Logo',

    'D3_PDFDOCUMENTS_PDF_TYPE'                           => 'Dokument',
    'D3_PDFDOCUMENTS_LANGUAGE'                           => 'Sprache',
    'D3_PDFDOCUMENTS_SGML_GENERATE'                      => 'Markup erstellen',
    'D3_PDFDOCUMENTS_PDF_GENERATE'                       => 'Dokument erstellen',
];
// @codeCoverageIgnoreEnd
