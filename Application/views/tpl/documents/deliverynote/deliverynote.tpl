[{assign var="pagePadding"   value=","|explode:"45,15,25,25"}] [{* top, right, bottom, left *}]
[{assign var="showLogo"      value=$showLogo|default:true}]

[{capture append="pdfBlock_style"}]
    [{block name="pdfStyles"}]
        [{include file="d3pdfstyles.css"}]
    [{/block}]
[{/capture}]

[{capture append="pdfBlock_header"}]
    [{block name="pdfHeader"}]
        [{include file="d3pdfheader.tpl" showLogo=$showLogo}]
    [{/block}]
[{/capture}]

[{capture append="pdfBlock_content"}]
    [{* include file="d3pdfrulers.tpl" pagePadding=$pagePadding *}]
    [{include file="d3pdffoldmarks.tpl" pagePadding=$pagePadding}]

    [{block name="pdfAddressArea"}]
        [{include file="d3pdfaddressarea.tpl" addressfile="d3delnote_pdf_recipient.tpl"}]
    [{/block}]

    [{block name="pdfInformations"}]
        [{include file="d3pdfinformations.tpl" documentinformationfile="d3delnote_pdf_informations.tpl"}]
    [{/block}]

    [{block name="pdfSalutation"}]
        [{include file="d3delnote_pdf_salutation.tpl"}]
    [{/block}]

    [{block name="pdfArticleList"}]
        [{include file="d3pdfarticlelist.tpl" showPrices=false}]
    [{/block}]

    [{block name="pdfConclusion"}]
        [{include file="d3delnote_pdf_conclusion.tpl"}]
    [{/block}]
[{/capture}]

[{capture append="pdfBlock_footer"}]
    [{block name="pdfFooter"}]
        [{include file="d3pdffooter.tpl" pagePadding=$pagePadding}]
    [{/block}]
[{/capture}]

[{include file="d3pdfbase.tpl" pagePadding=$pagePadding}]