---
title: Changelog
---

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased](https://git.d3data.de/D3Public/pdfdokumente/compare/1.1.0.1...rel_1.x)

## [1.1.0.1](https://git.d3data.de/D3Public/pdfdokumente/compare/1.1.0.0...1.1.0.1) - 2025-10-21
### Fixed
- gesamter Admin unerreichbar bei aktivem Modul

## [1.1.0.0](https://git.d3data.de/D3Public/pdfdokumente/compare/1.0.4.0...1.1.0.0) - 2025-08-25
### Added
- OrderOverview controller show the PDF generator exception message
- register shop host as allowed to prevent security check issues
- can add basic auth credentials to load image file from protected shop
- some template blocks
- make payable until date configurable
- select included documents for generating
- make logo and background image configurable
- add page depended header and footer layout 
- can handle hidden header and footer on certain pages

### Changed
- sanitizing filenames from umlauts and accents
- development mode ask for document type

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
