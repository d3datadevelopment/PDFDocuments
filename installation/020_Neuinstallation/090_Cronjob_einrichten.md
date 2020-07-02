---
title: Cronjob einrichten
---

Legen Sie den Cronjob für die automatische Bearbeitung der eingerichteten Aufträge an. Die für die Anlage benötigten Daten finden Sie im Adminbereich des Moduls unter [ (D3) Module ] -> [ {$menutitle} ] -> [ Einstellungen ] -> [ Grundeinstellungen ]. Weitere Informationen zum Anlegen von Cronjobs finden Sie in unserer [FAQ](https://faq.d3data.de/technik/wie-werden-cronjobs-angelegt/).

> [!!] Sie sollten unbedingt den Aufruf von `.sh`-Dateien via Browser verhindern, so dass kein Unbefugter die Datei von außen aufrufen kann. Dazu können Sie z.B. die `.htaccess`-Datei des Shops um folgende Zeilen erweitern:

```htaccess
    <Files *.sh>
      Require all denied
    </Files>
```