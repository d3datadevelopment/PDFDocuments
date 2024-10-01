[{assign var="pagePadding"   value=","|explode:"45,15,30,25"}] [{* top, right, bottom, left *}]
[{assign var="showLogo"      value=$showLogo|default:true}]

[{capture append="pdfBlock_style"}]
    [{block name="pdfStyles"}]
        [{include file="@d3PdfDocuments/assets/d3pdfstyles.css.tpl"}]
    [{/block}]
[{/capture}]

[{capture append="pdfBlock_header"}]
    [{block name="pdfHeader"}]
        [{include file="@d3PdfDocuments/documents/inc/page/header.tpl" showLogo=$showLogo}]
    [{/block}]
[{/capture}]

[{capture append="pdfBlock_content"}]
    [{* include file="@d3PdfDocuments/documents/inc/helper/rulers" pagePadding=$pagePadding *}]
    [{include file="@d3PdfDocuments/documents/inc/elements/foldmarks.tpl" pagePadding=$pagePadding}]

    [{block name="pdfAddressArea"}]
        [{include file="@d3PdfDocuments/documents/inc/elements/addressarea.tpl"}]
    [{/block}]

    [{block name="pdfInformations"}]
        [{include file="@d3PdfDocuments/documents/inc/elements/informations.tpl" documentinformationfile="@d3PdfDocuments/documents/invoice/informations.tpl"}]
    [{/block}]

    [{block name="pdfDeliveryAddress"}]
        [{include file="@d3PdfDocuments/documents/inc/elements/deliveryaddress.tpl"}]
    [{/block}]

    [{block name="pdfSalutation"}]
        [{include file="@d3PdfDocuments/documents/invoice/salutation.tpl"}]
    [{/block}]

    [{block name="pdfArticleList"}]
        [{include file="@d3PdfDocuments/documents/inc/elements/articlelist.tpl"}]
    [{/block}]

    [{block name="pdfConclusion"}]
        [{include file="@d3PdfDocuments/documents/invoice/conclusion.tpl"}]
    [{/block}]
[{/capture}]

[{capture append="pdfBlock_footer"}]
    [{block name="pdfFooter"}]
        [{include file="@d3PdfDocuments/documents/inc/page/footer.tpl" pagePadding=$pagePadding}]
    [{/block}]
[{/capture}]

[{include file="@d3PdfDocuments/documents/inc/page/base.tpl" pagePadding=$pagePadding}]