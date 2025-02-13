![stability mature](https://img.shields.io/badge/stability-mature-008000.svg)
[![latest tag](https://img.shields.io/packagist/v/d3/pdfdocuments?label=release)](https://packagist.org/packages/d3/pdfdocuments)
![License](https://img.shields.io/packagist/l/d3/pdfdocuments)

[![deutsche Version](https://logos.oxidmodule.com/de2_xs.svg)](README.md)
[![english version](https://logos.oxidmodule.com/en2_xs.svg)](README.en.md)

# PDF-Dokumente

PDF-Dokumentgenerator für OXID eShop

Erstellen Sie unterschiedliche statische oder dynamische PDF-Dokumente auf Knopfdruck. Der Dokumentinhalt wird aus Templates (Smarty bzw. Twig) erstellt.

An den Bestellungen Ihres OXID-Shops steht Ihnen die Erstellung von Rechnung und Lieferschein zur Verfügung.

Das Modul kann einfach erweitert werden, um bestehende Dokumente anzupassen oder Neue hinzuzufügen. Auch komplett andere Dokumentarten (z.B. Artikeldatenblätter) sind einfach möglich.

## Systemanforderungen:

- installierter OXID eShop in Version 7.x
- PHP-Version, für die Installationspakete verfügbar sind (PHP 8)
- Installation via Composer

## Kompatibilität:

Das Modul enthält die selbe Funktionalität wie das `OXID Invoice-PDF`-Modul. Grundsätzlich können beide Module parallel im Shop installiert werden, wenn dies erforderlich ist. 

Soll das `OXID Invoice-PDF`-Modul komplett vom `PDF Dokumente` Modul ersetzt werden (weil z.B. dritte Module ebenfalls dessen Funktion verwenden), stellen wir [eine Anpassung](https://packagist.org/packages/d3/pdfdocuments_compat) zur Verfügung, die zusätzlich installiert wird.

## Installation:

```bash
composer require d3/pdfdocuments:^2.0 --update-no-dev
```

Eine detaillierte Installationsanleitung finden Sie [online](https://docs.oxidmodule.com/PDF-Dokumente/) und im docs-Verzeichnis dieses Pakets. Dort ist ebenfalls das Modulhandbuch hinterlegt.
  
## Support:

- D3 Data Development (Inh. Thomas Dartsch)
- Home: [www.d3data.de](https://www.d3data.de)
- E-Mail: support@shopmodule.com

## Danksagung:

- PDF-Logo erstellt von Dimitriy Morilubov von www.flaticon.com
- Beispielfirmenlogo von https://www.logologo.com/

## Lizenz

Dieses Modul wird unter der GPL v3 Lizenz vertrieben. Für weitere Informationen siehe die ./LICENSE Datei.
 
Copyright by D3 Data Development (Inh. Thomas Dartsch)