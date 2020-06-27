[{assign var="currency"      value=$order->getOrderCurrency()}]
[{assign var="deliveryPrice" value= $order->getOrderDeliveryPrice()}]
[{assign var="productVats"   value= $order->getProductVats(false)}]
[{assign var="pagePadding"   value=","|explode:"45,15,10,25"}] [{* top, right, bottom, left *}]

[{capture append="pdfBlock_style"}]
    [{block name="pdfStyles"}]
        [{include file="d3pdfstyles.css"}]
    [{/block}]
[{/capture}]

[{capture append="pdfBlock_header"}]
    [{block name="pdfHeader"}]
        [{include file="d3pdfheader.tpl" showLogo=true}]
    [{/block}]
[{/capture}]

[{capture append="pdfBlock_content"}]
    [{*include file="d3pdfrulers.tpl" pagePadding=$pagePadding*}]
    [{include file="d3pdffoldmarks.tpl" pagePadding=$pagePadding}]

    [{block name="pdfAddressArea"}]
        [{include file="d3pdfaddressarea.tpl" addressfile="d3invoice_pdf_addressarea.tpl"}]
    [{/block}]

    [{block name="pdfInformations"}]
        [{include file="d3pdfinformations.tpl"}]
    [{/block}]

    [{block name="pdfDeliveryAddress"}]
        [{include file="d3pdfdeladdress.tpl"}]
    [{/block}]

    [{block name="pdfSalutation"}]
        [{include file="d3invoice_pdf_salutation.tpl"}]
    [{/block}]

    [{block name="pdfArticleList"}]
        [{include file="d3pdfarticlelist.tpl"}]
    [{/block}]

    [{block name="pdfConclusion"}]
        [{include file="d3invoice_pdf_conclusion.tpl"}]
    [{/block}]
[{/capture}]

[{capture append="pdfBlock_footer"}]
    [{block name="pdfFooter"}]
        [{include file="d3pdffooter.tpl" pagePadding=$pagePadding}]
    [{/block}]
[{/capture}]

[{include file="d3pdfbase.tpl" pagePadding=$pagePadding}]
