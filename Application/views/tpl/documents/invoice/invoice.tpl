[{assign var="currency"      value=$order->getOrderCurrency()}]
[{assign var="deliveryPrice" value= $order->getOrderDeliveryPrice()}]
[{assign var="productVats"   value= $order->getProductVats(false)}]

[{capture append="pdfBlock_style"}]
    [{include file="d3pdfstyle.css"}]
[{/capture}]

[{capture append="pdfBlock_header"}]
    [{block name="pdfTopingFile"}]
        [{include file="d3pdfheader.tpl" showLogo=true}]
    [{/block}]
[{/capture}]

[{capture append="pdfBlock_content"}]
    [{include file="d3pdfrulers.tpl"}]
    [{include file="d3din5008.tpl"}]

    [{* +++++ main page part +++++ *}]
    [{block name="pdfHeadingFile"}]
        [{block name="pdfHeaderFile"}]
            [{include file="d3pdfaddressarea.tpl" addressfile="d3invoice_pdf_addressarea.tpl"}]
        [{/block}]
    [{/block}]



    [{block name="pdfHeading"}]
        <table class="fontSize12 pdf_heading_table marginBottom15" cellspacing="0">
            [{block name="heading_owner_information"}]
                <tr>
                    <td class="pdf_heading_width35">
                        <div class="aligning"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_GET_IN_CONTACT"}]</strong></div>
                        <div class="aligning fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_TELEFON"}][{$shop->getFieldData('oxtelefon')}]</div>
                        <div class="aligning fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_FAX"}][{$shop->getFieldData('oxtelefax')}]</div>
                        <div class="aligning fontSize12">[{$shop->getFieldData('oxinfoemail')}]</div>
                    </td>
                </tr>
            [{/block}]
            [{block name="heading_order_information"}]
                <tr>
                    <td class="vertical-a heading_order_width65 heading_order_paddingTopSub5">


                        [{* +++++++Lieferadressen dynamisch+++++++ *}]
                        [{if $order->getFieldData('oxdelstreet')}]
                            <div class="heading_order_fontSize10 heading_order_paddingBottom8">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DELIVERYADDRESS"}]</div>
                            [{if $order->getFieldData('oxdelcompany')}]<div>[{$order->getFieldData('oxdelcompany')}]</div>[{/if}]
                            <div>[{$order->getFieldData('oxdelfname')}] [{$order->getFieldData('oxdellname')}]</div>
                            <div>[{$order->getFieldData('oxdelstreet')}] [{$order->getFieldData('oxdelstreetnr')}]</div>
                            <div><strong>[{$order->getFieldData('oxdelzip')}] [{$order->getFieldData('oxdelcity')}]</strong></div>
                            <div>[{$shop->getFieldData('oxcountry')}]</div>
                            <div>[{$shop->getFieldData('oxdeladdinfo')}]</div>
                        [{/if}]

                        [{*Bestellnummer,Rechnungsvermerk, 'Ihre bestellung vom...'*}]
                        <div class="heading_order_paddingTop22 heading_order_fontSize15"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERNR"}][{$order->getFieldData('oxordernr')}]</strong></div>
                        [{if $order->getFieldData('d3pdftextkostenstelle_kunden')}]<div>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_INVOICENOTE"}][{$order->getFieldData('d3pdftextkostenstelle_kunden')}]</div>[{/if}]
                        <div class="heading_order_paddingTop1">[{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSINCERELY"}][{$order->getFieldData('oxorderdate')|date_format:"%d.%m.%Y"}][{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSAT"}]</div>
                    </td>
                    <td class="vertical-a heading_order_width35 heading_order_paddingTopSub5">
                        <div class="aligning heading_order_paddingTop10"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_BANKVERBINDUNG"}]</strong></div>
                        <div class="aligning">[{$shop->getFieldData('oxbankname')}]</div>
                        <div class="aligning">[{oxmultilang ident="ORDER_OVERVIEW_PDF_ACCOUNTNR"}][{$shop->getFieldData('oxibannumber')}]</div>
                        <div class="aligning">[{oxmultilang ident="ORDER_OVERVIEW_PDF_BANKCODE_HEADER"}][{$shop->getFieldData('oxbiccode')}]</div>
                        <div class="aligning heading_order_paddingTop10">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILLNR"}][{$order->getFieldData('oxbillnr')}]</div>
                        <div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_CUSTOMERNR"}] [{$user->getFieldData('oxcustnr')}]</div>
                        <div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DATE"}][{$order->getFieldData('oxbilldate')|date_format:"%d.%m.%Y"}]</div>
                        <div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTIDNR"}][{$shop->getFieldData('oxvatnumber')}]</div>
                    </td>
                </tr>
            [{/block}]
        </table>
    [{/block}]


    [{* +++++Artikeltabelle+++++*}]
    [{block name="articleListing"}]
        <table class="order_article_marginTop10" cellspacing="0">
            <tr>
                <td class="border-bottom order_article_PaddingBottom5 "><div class="vertical-a order_article_listing_fontSize order_article_listing_width_amount">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_AMOUNT"}]</div></td>
                <td class="border-bottom order_article_PaddingBottom5 "><div class="order_article_listing_fontSize order_article_listing_width_desc">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DESCRIPTION"}]</div></td>
                <td class="border-bottom order_article_PaddingBottom5 "><div class="aligning order_article_listing_fontSize order_article_listing_width_ust">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTPERCENTAGE"}]</div></td>
                <td class="border-bottom order_article_PaddingBottom5 "><div class="aligning order_article_listing_fontSize order_article_listing_width_unitPrice">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_UNITPRICE"}]</div></td>
                <td class="border-bottom order_article_PaddingBottom5 "><div class="aligning order_article_listing_fontSize order_article_listing_width_total_Price">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_TOTALPRICE"}]</div></td>
            </tr>
            [{foreach from=$order->getOrderArticles(true) item=oOrderArticle}]
                <tr>
                    <td class="order_article_PaddingTop5 vertical-a order_article_PaddingBottom5"><div class='fontSize12 aligning order_article_listing_width_amount order_article_listing_paddingRight52'>[{$oOrderArticle->oxorderarticles__oxamount->value }]</div></td>
                    <td class="order_article_PaddingTop5 vertical-a order_article_PaddingBottom5"><div class='fontSize12 order_article_listing_width_desc'>
                            [{$oOrderArticle->oxorderarticles__oxtitle->getRawValue() }] [{ $oOrderArticle->oxorderarticles__oxselvariant->getRawValue() }]
                            <br>
                            <span class="order_article_listing_fontSize9">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ARTNR"}] [{$oOrderArticle->oxorderarticles__oxartnum->value }]</span>
                        </div></td>
                    <td class="order_article_PaddingTop5 vertical-a order_article_PaddingBottom5"><div class='aligning fontSize12 order_article_listing_width_ust'>[{$oOrderArticle->oxorderarticles__oxvat->value }]</div></td>
                    <td class="order_article_PaddingTop5 vertical-a order_article_PaddingBottom5"><div class='aligning fontSize12 order_article_listing_width_unitPrice'>[{$oOrderArticle->getBrutPriceFormated()}] [{$currency->name}]</div></td>
                    <td class="order_article_PaddingTop5 vertical-a order_article_PaddingBottom5"><div class='aligning fontSize12 order_article_listing_width_total_Price'>[{$oOrderArticle->getTotalBrutPriceFormated()}] [{$currency->name}]</div></td>
                </tr>
            [{/foreach}]
        </table>
    [{/block}]
    <nobreak>
        [{block name="articleCosts"}]
            <table class="article_costs_table border-bottom">
                <tr>
                    [{block name="d3_article_costs_summary"}]
                        [{include file="d3_article_costs_summary.tpl"}]
                    [{/block}]
                </tr>
            </table>
        [{/block}]
        [{block name="pdfPastThankFile"}]
            [{include file="d3invoice_pdf_conclusion.tpl"}]
        [{/block}]
    </nobreak>
[{/capture}]

[{capture append="pdfBlock_footer"}]
    [{block name="pdfFooterFile"}]
        [{include file="d3pdffooter.tpl"}]
    [{/block}]
[{/capture}]

[{include file="d3pdfbase.tpl"}]
