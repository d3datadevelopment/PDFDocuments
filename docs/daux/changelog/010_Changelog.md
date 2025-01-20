---
title: Changelog
---

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased](https://git.d3data.de/D3Public/pdfdokumente/compare/2.0.1.1...rel_2.x)
### Added
- installierbar in OXID 7.2
### Fixed
- Syntaxfehler in Twig Templates

## [2.0.1.1](https://git.d3data.de/D3Public/pdfdokumente/compare/2.0.1.0...2.0.1.1) - 2024-10-04
### Fixed
- Syntax der Steuerangaben in Twig-Templates

## [2.0.1.0](https://git.d3data.de/D3Public/pdfdokumente/compare/2.0.0.0...2.0.1.0) - 2024-10-01
### Added
- Entwicklungshandbuch
- Überladungsblock für Unternehmenslogo
### Fixed
- CSS wird nicht als Referenz sondern inline eingebunden
- Entwicklermodus kann konfiguriert werden
- Smarty Templates
### Removed
- Modul Connector Bedingung

## [2.0.0.0](https://git.d3data.de/D3Public/pdfdokumente/compare/1.0.4.0...2.0.0.0) - 2024-09-12
### Added
- installierbar in OXID 7.0 && 7.1 (CE 7.0.x - 7.1.x)
- Support für Smarty- und Twig-Templates
### Removed
- Support für OXID < 7.0

## [1.0.4.0](https://git.d3data.de/D3Public/pdfdokumente/compare/1.0.3.1...1.0.4.0) - 2023-12-22
### Added
- installierbar in OXID 6.5.2 + 6.5.3 (CE 6.14)
- Modullogo

### Changed
- behandelt fehlende Bestellung bei auf Bestellungen basierenden Dokumenten

## [1.0.3.1](https://git.d3data.de/D3Public/pdfdokumente/compare/1.0.3.0...1.0.3.1) - 2023-05-09
### Fixed
- kann mehrere Dokumente auf einmal generieren

## [1.0.3.0](https://git.d3data.de/D3Public/pdfdokumente/compare/1.0.2.0...1.0.3.0) - 2023-01-04
### Added
- installierbar in OXID 6.4 und 6.5

## [1.0.2.0](https://git.d3data.de/D3Public/pdfdokumente/compare/1.0.1.0...1.0.2.0) - 2021-04-30
### Added
- installierbar in OXID 6.2.4 und 6.3.0
- Dateinamen werden auf Gültigkeit hin korrigiert

### Fixed
- Setzen der Rechnungsnummer setzt den "neue Bestellung"-Status nicht zurück

## [1.0.1.0](https://git.d3data.de/D3Public/pdfdokumente/compare/1.0.0.0...1.0.1.0) - 2020-08-20
### Changed
- Dokumentid für "Rechnung ohne Logo" angepasst

## [1.0.1.0](https://git.d3data.de/D3Public/pdfdokumente/tag/1.0.0.0) - 2020-08-13
#### Added
- Framework zur Erstellung unterschiedlichster PDF Dokumente
- ermöglicht Generierung von Rechnungen und Lieferscheinen für Bestellungen aus dem Adminbereich
- enthält Templates und Basislayouts für Rechnungen und Lieferscheine
- enthält Registries (Dokumentenlisten) für Bestellungen im Adminbereich sowie für Auftragsmanager-Aktionen 
- kann als vollwertiger Ersatz für Invoice-PDF-Modul verwendet werden
