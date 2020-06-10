[{assign var="currency"      value=$order->getOrderCurrency()}]
[{assign var="deliveryPrice" value= $order->getOrderDeliveryPrice()}]
[{assign var="productVats"   value= $order->getProductVats(false)}]

<style type="text/css">
	[{include file="d3pdfstyle.css"}]
</style>

<page backtop="30mm" backbottom="30mm" backleft="10mm" backright="10mm" pageset="new" orientation="P" format="A4">
	<page_header>
        [{block name="pdfTopingFile"}]
			[{include file="d3pdfheader.tpl" showLogo=true}]
        [{/block}]
	</page_header>
	<page_footer>
        [{block name="pdfFooterFile"}]
			[{include file="d3pdffooter.tpl"}]
        [{/block}]
	</page_footer>

	[{* +++++ fold and punch marks +++++ *}]
	[{block name="pdfDIN5008Markings"}]
		[{include file="d3din5008.tpl"}]
	[{/block}]

	[{* +++++ main page part +++++ *}]
    [{block name="pdfHeadingFile"}]
        [{block name="pdfHeaderFile"}]
			[{include file="d3invoice_pdf_addressarea.tpl"}]
        [{/block}]
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
				[{* ++++++Beschreibung der Kostensummierung++++++ *}]
				<td class="article_costs_table_paddingRight article_costs_table_desc_width70 ">
					<div class="order_sum fontSize12 border-bottom  order_article_PaddingBottom5">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_SUMBRUTTO"}]</div>
				[{if $order->getFormattedDiscount() != 0}]
					<div class="order_sum fontSize12 border-bottom spacing_order_info">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_DISCOUNT"}]</div>
				[{/if}]
					<div class="order_sum fontSize12 order_article_PaddingTop5">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_SUMNETTO"}]</div>
				[{foreach from=$productVats key=VatKey item=oVat}]
					<div class="order_sum fontSize12 border-bottom spacing_order_info">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAX"}] [{$VatKey}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_PERCENTAGE"}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAXPERCVALUE"}]</div>
				[{/foreach}]
					<div class="order_sum fontSize12 order_article_PaddingTop5">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_DELIVERY"}]</div>
					<div class="order_sum fontSize12 border-bottom spacing_order_info">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAX"}] [{$VatKey}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_PERCENTAGE"}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAXPERCVALUE"}]</div>
					<div class="order_sum fontSize12 order_article_PaddingTop5 order_article_PaddingBottom5"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TOTALSUMBRUT"}]</strong></div>
				</td>
				[{* ++++++Kostensummierung++++++ *}]
				<td class="article_costs_table_sum_width30">
					<div class="order_sumNum aligning fontSize12 border-bottom  order_article_PaddingBottom5">[{$order->getFormattedTotalBrutSum()}] [{$currency->name}]</div>
				[{if $order->getFormattedDiscount() != 0}]
					<div class="spacing_order_info order_sumNum aligning fontSize12 border-bottom">-[{$order->getFormattedDiscount()}] [{$currency->name}]</div>
				[{/if}]
					<div class="order_article_PaddingTop5 order_sumNum aligning fontSize12">[{$order->getFormattedTotalNetSum()}] [{$currency->name}]</div>
					<div class="spacing_order_info order_sumNum aligning fontSize12 border-bottom">[{$lang->formatCurrency($oVat, $currency)}] [{$currency->name}]</div>
					<div class="order_article_PaddingTop5 order_sumNum aligning fontSize12">[{$lang->formatCurrency($deliveryPrice->getNettoPrice(), $currency)}] [{$currency->name}]</div>
					<div class="order_article_PaddingTop5 order_article_PaddingBottom5 order_sumNum aligning fontSize12 border-bottom">[{$lang->formatCurrency($deliveryPrice->getVATValue(), $currency)}] [{$currency->name}]</div>
					<div class="order_article_PaddingTop5 order_article_PaddingBottom5 order_sumNum aligning fontSize12"><strong>[{$order->getFormattedTotalOrderSum()}] [{$currency->name}]</strong></div>
				</td>
				[{/block}]
			</tr>
		</table>
	[{/block}]
	[{block name="pdfPastThankFile"}]
		[{include file="d3invoice_pdf_conclusion.tpl"}]
	[{/block}]
	</nobreak>
</page>