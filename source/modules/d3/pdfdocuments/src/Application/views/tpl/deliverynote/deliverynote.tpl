[{assign var= currency      value= $order->getOrderCurrency()}]
[{assign var= deliveryPrice value= $order->getOrderDeliveryPrice()}]

<style type="text/css">
	[{include file=$oViewConf->getModulePath('d3invoicePdf', 'out/src/css/deliverynote.css')}],
	[{include file=$oViewConf->getModulePath('d3invoicePdf', 'out/src/css/pdfStyling.css')}]
</style>
<page backtop="30mm" backbottom="30mm" backleft="10mm" backright="10mm" pageset="new">
	<page_header>
        [{block name="pdfTopingFile"}]
						[{include file=$oViewConf->getModulePath('d3invoicePdf', 'Application/views/tpl/deliveryNote/includingFiles/pdfToping.tpl')}]
        [{/block}]
	</page_header>
	<page_footer>
        [{block name="pdfFooterFile"}]
						[{include file=$oViewConf->getModulePath('d3invoicePdf', 'Application/views/tpl/deliveryNote/includingFiles/pdfFooter.tpl')}]
        [{/block}]
	</page_footer>

	[{* +++++ main page part +++++ *}]
    [{block name="pdfHeadingFile"}]
        [{block name="pdfHeaderFile"}]
						[{include file=$oViewConf->getModulePath('d3invoicePdf', 'Application/views/tpl/deliveryNote/includingFiles/pdfHeader.tpl')}]
        [{/block}]
    [{/block}]
	[{* +++++Artikeltabelle+++++*}]
    [{block name="articleListing"}]
        <table class="order_article_marginTop10 border-bottom" cellspacing="0">
            <tr>
                <td class="border-bottom order_article_PaddingBottom5 "><div class="vertical-a order_article_listing_fontSize deliverynote_width_amount">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_AMOUNT"}]</div></td>
								<td class="border-bottom order_article_PaddingBottom5 paddingLeft"><div class="order_article_listing_fontSize deliverynote_width_artnum">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ARTNR"}]</div></td>
                <td class="border-bottom order_article_PaddingBottom5 "><div class="order_article_listing_fontSize deliverynote_width_desc">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DESCRIPTION"}]</div></td>
            </tr>
        [{foreach from=$order->getOrderArticles(true) item=oOrderArticle}]
            [{*<tr>
                <td class="order_article_PaddingTop5 vertical-a order_article_PaddingBottom5"><div class='fontSize12 aligning order_article_listing_width_amount order_article_listing_paddingRight52'>[{$oOrderArticle->oxorderarticles__oxamount->value }]</div></td>
                <td class="order_article_PaddingTop5 vertical-a order_article_PaddingBottom5"><div class='fontSize12 order_article_listing_width_desc'>
                        [{$oOrderArticle->oxorderarticles__oxtitle->getRawValue() }] [{ $oOrderArticle->oxorderarticles__oxselvariant->getRawValue() }]
                        <br>
                        <span class="order_article_listing_fontSize9">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ARTNR"}] [{$oOrderArticle->oxorderarticles__oxartnum->value }]</span>
                    </div></td>
                <td class="order_article_PaddingTop5 vertical-a order_article_PaddingBottom5"><div class='aligning fontSize12 order_article_listing_width_ust'>[{$oOrderArticle->oxorderarticles__oxvat->value }]</div></td>
                <td class="order_article_PaddingTop5 vertical-a order_article_PaddingBottom5"><div class='aligning fontSize12 order_article_listing_width_unitPrice'>[{$oOrderArticle->getBrutPriceFormated()}] [{$currency->name}]</div></td>
                <td class="order_article_PaddingTop5 vertical-a order_article_PaddingBottom5"><div class='aligning fontSize12 order_article_listing_width_total_Price'>[{$oOrderArticle->getTotalBrutPriceFormated()}] [{$currency->name}]</div></td>
            </tr>*}]
						<tr>
                <td class="order_article_PaddingTop5 vertical-a order_article_PaddingBottom5"><div class='fontSize12 aligning deliverynote_width_amount order_article_listing_paddingRight52'>[{$oOrderArticle->oxorderarticles__oxamount->value }]</div></td>
                <td class="order_article_PaddingTop5 vertical-a order_article_PaddingBottom5"><div class='fontSize12 textAlignLeft deliverynote_width_artnum order_article_listing_paddingRight52'>[{$oOrderArticle->oxorderarticles__oxartnum->value }]</div></td>
                <td class="order_article_PaddingTop5 vertical-a order_article_PaddingBottom5"><div class='fontSize12 deliverynote_width_desc'>[{$oOrderArticle->oxorderarticles__oxtitle->getRawValue() }] [{$oOrderArticle->oxorderarticles__oxselvariant->getRawValue()}]</div></td>
            </tr>
        [{/foreach}]
        </table>
    [{/block}]
	<nobreak>
		[{block name="articleCosts"}]
		[{*<table class="article_costs_table border-bottom">
			<tr>
				[{ ++++++Artikelzusammenfassung++++++ }]
				<td class="article_costs_table_paddingRight article_costs_table_td_width50 ">
					<div class="order_sum fontSize12 border-bottom  order_article_PaddingBottom5">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_SUMBRUTTO"}]</div>
				[{if $order->getFormattedDiscount() != 0}]
					<div class="order_sum fontSize12 border-bottom spacing_order_info">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_DISCOUNT"}]</div>
				[{/if}]
					<div class="order_sum fontSize12 order_article_PaddingTop5">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_SUMNETTO"}]</div>
				[{foreach from=$order->getVats() key=VatKey item=oVat}]
					<div class="order_sum fontSize12 border-bottom spacing_order_info">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAX"}] [{$VatKey}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_PERCENTAGE"}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAXPERCVALUE"}]</div>
				[{/foreach}]
					<div class="order_sum fontSize12 order_article_PaddingTop5">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_DELIVERY"}]</div>
					<div class="fontSize12 border-bottom spacing_order_info aligning order_article_costs_paddingRight66 order_article_costs_marginLeftSub3">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAX"}] [{$VatKey}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_PERCENTAGE"}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAXPERCVALUE"}]</div>
					<div class="order_sum fontSize12 order_article_PaddingTop5 order_article_PaddingBottom5"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TOTALSUMBRUT"}]</strong></div>
				</td>
				[{ ++++++Kosten der Bestellung++++++ }]
				<td class="article_costs_table_td_width50">
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
			</tr>
		</table>*}]
	[{/block}]
	[{block name="pdfPastThankFile"}]
		[{include file=$oViewConf->getModulePath('d3InvoicePdf', 'Application/views/tpl/deliveryNote/includingFiles/pdfPastThank.tpl')}]
	[{/block}]
	</nobreak>
</page>