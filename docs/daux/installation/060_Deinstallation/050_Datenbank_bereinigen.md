---
title: Datenbank bereinigen
---
  
Das Modul legt Informationen in der Datenbank ab. Sofern diese Daten nicht mehr benötigt werden, können diese gelöscht werden. 

> [!] Legen Sie sich vorab bitte unbedingt eine Sicherung an, um die Daten im Zweifelsfall wiederherstellen zu können.
    
Für das Modul **{$modulename}** sind dies die folgende Tabellen und Felder:

* die komplette Tabelle `tablename`
* sofern vorhanden: `tablename_setX` *)
    
und diese Felder in bestehenden Tabellen:

* in Tabelle `oxorder`:  
  * das Feld `fieldname1`
  * das Feld `fieldname2`
* in Tabelle `oxuser`:  
  * das Feld `fieldname3`
  * das Feld `fieldname4`
  
sowie diese Einträge in bestehenden Tabellen:

* in Tabelle `d3_cfg_mod`:  
  * den Eintrag `oxmodid = "{$modcfgident}"` **)

*) `_setX` ist eine Tabellenliste, die mit `_set1` beginnen und shopabhängig auch Tabellen mit höheren Nummerierungen enthalten kann (z.B. `_set2`, `_set3`, …).
Zu einigen dieser Tabellen wurden die Config-Einträge `aMultiLangTables` (bei Enterprise Edition auch `aMultiShopTables`) um entsprechende Einträge ergänzt). Bereinigen Sie diese ebenfalls.

**) Diesen Eintrag gibt es ggf. für jeden Subshop. Entfernen Sie diesen nur für die Mandanten, in denen das Modul **nicht** mehr installiert ist. 