---
title: Hinweise für Templatedesigner
---

## HTML

Aus den Templates wird HTML-ähnlicher Quellcode mit CSS-Angaben erzeugt, der zur Erzeugung des PDF-Dokumentes dient.

Der Quellcode beinhaltet jedoch einige wenige Besonderheiten (z.B. die `page`-, `page_head`- und `page_footer`-Tags), die im [HTML2PDF-Projekt](https://github.com/spipu/html2pdf) beschrieben sind. 

## CSS

Layouts können mit inline CSS-Styles definiert werden. Die Einbindung externer Stylesheets wird zum Zeitpunkt der Dokumentationserstellung leider nicht unterstützt.

Beachten Sie bitte, dass auch nur ein CSS-Subset unterstützt wird. Mit etwas CSS-Kreativität sollten sich die üblichen Formatierungen dennoch deutlich einfacher umsetzen lassen, als dies direkt in PHP-Programmierung möglich wäre.

## Templates

Innerhalb der Templates steht Ihnen die komplette Twig- bzw. Smarty-Funktionalität zur Verfügung.

## Debug

Zur Erstellung der Dokumente kann es hilfreich sein, dass statt des fertigen PDFs eine besser prüfbare Zwischenversion exportiert wird.
Dies können Sie mit der Entwickleroption im Modul erreichen, die Sie im Adminbereich des Shops unter `Erweiterungen -> Module -> D3 PDF-Dokumente -> Einstell. -> Grundeinstellungen`. Sie erhalten dann beim Download ein HTML-Dokument, welches einfach im Browser analysiert werden kann.