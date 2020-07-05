---
title: Registries
---

Sollen in einem bestimmten Bereich des Shops mehrere Dokumente zur Auswahl angeboten werden, verwenden wir so genannte Registries für diese Liste. 
So gibt es zum Beispiel eine Registry für den Bereich der Bestellungsdokumente im Adminbereich des Shops unter `Bestellungen verwalten -> Bestellungen -> Übersicht`.

Sollen in diesem Bereich neue Dokumente zusätzlich angeboten werden oder bestehende Dokumente entfernt werden, können Sie die jeweilige Registry im eigenen Modul überladen und mit deren Methoden die Dokumentliste manipulieren.

Benötigen Sie eine eigene Regsitry, können Sie eine eigene Klasse erstellen, die `D3\PdfDocuments\Application\Model\Registries\registryAbstract` erweitert.

Ein Beispiel zur Verwendung von Registries finden Sie in der Erweiterung des im 1. Abschnitt genannten Adminbereich.