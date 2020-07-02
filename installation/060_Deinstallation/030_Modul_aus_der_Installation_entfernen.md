---
title: Modul aus der Installation entfernen
---

Starten Sie die Konsole Ihres Webservers und wechseln in das Hauptverzeichnis Ihres Shops (oberhalb des `source`- und `vendor`-Verzeichnisses). Führen Sie Sie dort diesen Befehl aus:

```Bash
php composer remove {$composerident} --no-update
``` 

> [!] Achten Sie darauf, dass die Installation über Composer mit derselben PHP-Version erfolgt, in der auch Ihr Shop installiert ist. Sie erhalten sonst unpassende Modulpakete.
    
> [i] Benötigt Ihre Installation einen anderen Aufruf von Composer, ändern Sie den Befehl bitte entsprechend ab. Für weitere Optionen dieses Befehls lesen Sie bitte die [Dokumentation von Composer](https://getcomposer.org/doc/03-cli.md#require).
