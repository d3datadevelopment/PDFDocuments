---
title: Anpassungen an bestehenden Dokumenten
---

Die Dokumente werden aus Twigtemplates erstellt, die Sie im `views/twig/documents` finden. Die entsprechenden Smarty Pendants sind unter `views/smarty/documents`.

Für Änderungen einzelner Dokumentbereiche können Sie die darin notierten Templateblöcke in einem eigenen Modul überladen und deren Inhalt so verändern oder ergänzen. So müssen Sie das Originalmodul nicht verändern.

Beachten Sie, dass Templateblöcke in gemeinsam genutzen Templates auch in allen Dokumenten Änderungen hervorrufen.

Für umfangreichere Veränderungen können Sie dem jeweiligen Dokument auch auch anderes Template zuordnen. Überladen Sie dafür die entsprechende Dokumentenklasse und verändern Sie den Rückgabewert der Methode `getTemplate`.