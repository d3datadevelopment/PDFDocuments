[{assign var="pagePadding"   value=","|explode:"45,15,30,25"}] [{* top, right, bottom, left *}]
[{assign var="showLogo"      value=$showLogo|default:true}]

[{capture append="pdfBlock_style"}]
    [{block name="pdfStyles"}]
        [{include file="@d3PdfDocuments/assets/d3pdfstyles.css"}]
    [{/block}]
[{/capture}]

[{capture append="pdfBlock_header"}]
    [{block name="pdfHeader"}]
        [{include file="@d3PdfDocuments/documents/inc/page/d3pdfheader.tpl" showLogo=$showLogo}]
    [{/block}]
[{/capture}]

[{capture append="pdfBlock_content"}]
    [{* include file="@d3PdfDocuments/documents/inc/helper/d3pdfrulers.tpl" pagePadding=$pagePadding *}]
    [{include file="@d3PdfDocuments/documents/inc/elements/d3pdffoldmarks.tpl" pagePadding=$pagePadding}]

    [{block name="pdfAddressArea"}]
        [{include file="@d3PdfDocuments/documents/inc/elements/d3pdfaddressarea.tpl"}]
    [{/block}]

    [{block name="pdfInformations"}]
        [{include file="@d3PdfDocuments/documents/inc/elements/d3pdfinformations.tpl" documentinformationfile="@d3PdfDocuments/documents/invoice/d3invoice_pdf_informations.tpl"}]
    [{/block}]

    [{block name="pdfDeliveryAddress"}]
        [{include file="@d3PdfDocuments/documents/inc/elements/d3pdfdeladdress.tpl"}]
    [{/block}]

    [{block name="pdfSalutation"}]
        [{include file="@d3PdfDocuments/documents/invoice/d3invoice_pdf_salutation.tpl"}]
    [{/block}]

    [{block name="pdfArticleList"}]
        [{include file="@d3PdfDocuments/documents/inc/elements/d3pdfarticlelist.tpl"}]
    [{/block}]

    [{block name="pdfConclusion"}]
        [{include file="@d3PdfDocuments/documents/invoice/d3invoice_pdf_conclusion.tpl"}]
    [{/block}]
[{/capture}]

[{capture append="pdfBlock_footer"}]
    [{block name="pdfFooter"}]
        [{include file="@d3PdfDocuments/documents/inc/page/d3pdffooter.tpl" pagePadding=$pagePadding}]
    [{/block}]
[{/capture}]

[{include file="@d3PdfDocuments/documents/inc/page/d3pdfbase.tpl" pagePadding=$pagePadding}]
