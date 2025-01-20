![stability mature](https://img.shields.io/badge/stability-mature-008000.svg)
[![latest tag](https://img.shields.io/packagist/v/d3/pdfdocuments?label=release)](https://packagist.org/packages/d3/pdfdocuments)
![License](https://img.shields.io/packagist/l/d3/pdfdocuments)

[![deutsche Version](https://logos.oxidmodule.com/de2_xs.svg)](README.md)
[![english version](https://logos.oxidmodule.com/en2_xs.svg)](README.en.md)

# PDF Documents

PDF document generator for OXID eShop

Create a wide variety of static or dynamic PDF documents at the touch of a button. The document content is created from templates (Smarty or Twig).

At the orders of your OXID shop you have the option of creating an invoice and delivery note.

The module can be easily extended to adapt existing documents or add new ones. Even completely different document types (e.g. article data sheets) are possible.

## System requirements:

- installed OXID eShop version from 7.0 - 7.1
- PHP version for which installation packages are available (PHP 8)
- Installation via Composer

## Compatibility:

The module contains the same functionality as the 'OXID Invoice PDF' module. Basically, both modules can be installed in parallel in the shop, if required. 

If the `OXID Invoice PDF` module is to be completely replaced by the `D3 PDF Documents` module (e.g. because third modules also use its function), we provide [a customization](https://packagist.org/packages/d3/pdfdocuments_compat) which is installed additionally.

## Installation:

```bash
composer require d3/pdfdocuments:^2.0 --update-no-dev
```

Detailed installation instructions can be found [online](https://docs.oxidmodule.com/PDF-Dokumente/) and in the docs directory of this package. The module manual is also available there.
  
## Support:

- D3 Data Development (Inh. Thomas Dartsch)
- Home: [www.d3data.de](https://www.d3data.de)
- E-Mail: support@shopmodule.com

## Credits:

- PDF logo made by Dimitriy Morilubov by www.flaticon.com
- example company logo by https://www.logologo.com/

## License

This module is distributed under the GPL v3 License. For more information see the ./LICENSE file.
 
Copyright by D3 Data Development (Inh. Thomas Dartsch)