# Entwicklungen

Um das Modul anzupassen, gibt es verschiedene Möglichkeiten:

## Grundsätzliches

Wir empfehlen dringend, alle Veränderungen bestehender Dokumente und auch neue Dokumente in einem eigenen Modul abzulegen, 
um die Updatefähigkeit zu behalten.

## neue Dokumente hinzufügen

Neue Dokumente können analog zu den Bestehenden angelegt werden. Jedes Dokument besteht aus der entsprechenden 
PHP-Klasse (unter Application/Model/Documents) und deren Template (unter views/.../documents). Verwenden Sie die 
Bestandsdokumente als Implementierungsreferenz.

Dokumentlisten sind für den Bestellbereich im Shopadmin sowie für die Generierung über den D3 Auftragsmanagers 
enthalten (unter Application/Model/Registries). Überladen Sie die Klassen und ergänzen Sie im Konstruktor Ihre neuen 
Dokumente.

## bestehende Dokumente verändern

Die Grundangaben eines Dokuments sind in dessen PHP-Datei definiert. Überladen Sie diese bei Bedarf und ändern die 
Einstellung.

Die Inhalte der Dokumente sind in Templates definiert. In den Templates sind Blöcke eingerichtet, die mit den 
Überladungsmöglichkeiten des Shops ergänzt oder ersetzt werden können.

Bei umfangreichen Anpassungen kann es sinnvoll sein, eigene Templates anzulegen, die in der PHP-Klasse des Dokuments als
Quelle definiert wird.