---
title: optische Anpassungen
---

Die Modulausgaben können durch eigene CSS-Styles angepasst werden. Um die Updatefähigkeit des Moduls zu 
erhalten, übernehmen Sie die neuen Stylesheets bitte in modulunabhängige Dateien. 

Die mitgelieferten Assets (CSS, JavaScripts) werden von uns über einen vorkonfigurierten Kompilierungstask 
erstellt. Dieser kann via [Grunt](https://gruntjs.com/) ausgeführt werden. Möchten Sie eigene oder 
angepasste Inhalte daraus kompilieren lassen, installieren Sie das Modul bitte mit Composer und der 
`--prefer-source`-Option. Dann stehen Ihnen die Quelldateien im Ordner `src/build` zur Verfügung. 

Diese können direkt aufgerufen werden, um eventuelle Anpassungen im zu Grunde liegenden Theme zu 
integrieren. Alternativ können Sie die Sources auch in eigene Kompilierungsprozesse einbinden, 
um projektspezifische Assets zu erstellen.

Details zur Verwendung des Taskrunners und der Quelldateien entnehmen Sie bitte der `README.md` im 
oben erwähnten Build-Ordner.