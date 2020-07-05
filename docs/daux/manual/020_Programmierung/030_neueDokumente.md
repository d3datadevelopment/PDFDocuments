---
title: neue Dokumente hinzufügen
---

Erstellen Sie eine neue PHP-Klasse, die mindestens das Interface `D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentsGenericInterface` implementiert. Für Dokumente, die auf Bestellungen basieren (z.B. Rechnungen, Angebote, ...) können Sie statt dessen auch das optimierte Interface `D3\PdfDocuments\Application\Model\Interfaces\pdfdocumentOrderInterface` verwenden.

Wenn Sie Ihre Dokumentenklasse von `D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsGeneric` bzw. von `D3\PdfDocuments\Application\Model\AbstractClasses\pdfdocumentsOrder` ableiten, sind für jedes Dokument nur noch wenige Zeilen Quellcode nötig. Beide abstrakte Klassen implementieren die oben genannten Interfaces automatisch.

Als Beispiele dienen Ihnen die im Modul enthaltenen Dokumentklassen `invoice` und `deliverynote`. 