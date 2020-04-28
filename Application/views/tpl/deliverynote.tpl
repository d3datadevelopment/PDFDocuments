[{assign var=currency value=$order->getOrderCurrency()}]
[{assign var=deliveryPrice value=$order->getOrderDeliveryPrice()}]

<page backtop="30mm" backbottom="30mm" backleft="10mm" backright="10mm" pageset="new">
	[{block name="include_css"}]
		<link rel="stylesheet" type="text/css" href="../../../Modules/out/src/deliverynote.css">
	[{/block}]
	<page_header>
		[{block name="pdf_header"}]
		<div class="pdf_header_positioning">
			<img src="[{$oViewConf->getImageUrl('Elektroversand-Schmidt_Logo_180.jpg')}]">
		</div>
		[{/block}]
	</page_header>
	<page_footer>
		<table class="pdf_footer_table" cellspacing="0">
			<tr>
				[{block name="shop_basic_information"}]
				<td class="footer_parts">
					<div>[{$shop->oxshops__oxname->value}]</div>
					<div>[{$shop->oxshops__oxstreet->value}]</div>
					<div>[{$shop->oxshops__oxzip->value}] [{$shop->oxshops__oxcity->value}]</div>
					<div>[{$shop->oxshops__oxcountry->value}]</div>
					<div>[{$shop->oxshops__oxurl->value}]</div>
					<div>[{$shop->oxshops__oxinfoemail->value}]</div>
				</td>
				[{/block}]
				[{block name="owner_basic_information"}]
				<td class="vertical-a footer_parts">
					<div>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_MANAGINGDIRECTOR"}][{$shop->oxshops__oxfname->value}] [{$shop->oxshops__oxlname->value}]</div>
					<div>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_COURT"}] [{$shop->oxshops__oxcourt->value}]</div>
					<div>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_HRBNR"}][{$shop->oxshops__oxhrbnr->value}]</div>
					<div>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTID"}][{$shop->oxshops__oxvatnumber->value}]</div>
				</td>
				[{/block}]
				[{block name="bank_basic_information"}]
				<td class="vertical-a footer_parts">
					<div>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_BANKVERBINDUNG"}]</div>
					<div>[{$shop->oxshops__oxbankname->value}]</div>
					<div>[{oxmultilang ident="ORDER_OVERVIEW_PDF_ACCOUNTNR"}][{$shop->oxshops__oxibannumber->value}]</div>
					<div>[{oxmultilang ident="ORDER_OVERVIEW_PDF_BANKCODE"}][{$shop->oxshops__oxbiccode->value}]</div>
				</td>
				[{/block}]
			</tr>
		</table>
	</page_footer>

	[{* +++++ main page part +++++ *}]
[{block name="pdf_heading"}]
	<table class="fontSize12 pdf_heading_table" cellspacing="0">
	[{block name="heading_owner_information"}]
		<tr>
			<td class="pdf_heading_width65">
				<div class="pdf_heading_fontSize8">[{$shop->oxshops__oxname->value}] - [{$shop->oxshops__oxstreet->value}] - [{$shop->oxshops__oxzip->value}] [{$shop->oxshops__oxcity->value}]</div>
			</td>
			<td class="pdf_heading_width35">
				<div class="aligning"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_GET_IN_CONTACT"}]</strong></div>
				<div class="aligning fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_TELEFON"}][{$shop->oxshops__oxtelefon->value}]</div>
				<div class="aligning fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_FAX"}][{$shop->oxshops__oxtelefax->value}]</div>
				<div class="aligning fontSize12">[{$shop->oxshops__oxinfoemail->value}]</div>
			</td>
		</tr>
	[{/block}]
	[{block name="heading_order_information"}]
		<tr>
			<td class="vertical-a heading_order_width65 heading_order_paddingTopSub5">
			[{if $order->oxorder__oxbillcompany->value}]
				<div>[{$order->oxorder__oxbillcompany->value}]</div>
			[{/if}]
				<div>[{$order->oxorder__oxbillfname->value}] [{$order->oxorder__oxbilllname->value}]</div>
				<div>[{$order->oxorder__oxbillstreet->value}] [{$order->oxorder__oxbillstreetnr->value}]</div>
				<div><strong>[{$order->oxorder__oxbillzip->value}] [{$order->oxorder__oxbillcity->value}]</strong></div>
				<div class="heading_order_paddingBottom15">[{$shop->oxshops__oxcountry->value}]</div>

			[{* +++++++Lieferadressen dynamisch+++++++ *}]
			[{if $order->oxorder__oxdelstreet->value}]
				<div class="heading_order_fontSize10 heading_order_paddingBottom8">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DELIVERYADDRESS"}]</div>
			[{if $order->oxorder__oxdelcompany->value}]<div>[{$order->oxorder__oxdelcompany->value}]</div>[{/if}]
				<div>[{$order->oxorder__oxdelfname->value}] [{$order->oxorder__oxdellname->value}]</div>
				<div>[{$order->oxorder__oxdelstreet->value}] [{$order->oxorder__oxdelstreetnr->value}]</div>
				<div><strong>[{$order->oxorder__oxdelzip->value}] [{$order->oxorder__oxdelcity->value}]</strong></div>
				<div>[{$shop->oxshops__oxcountry->value}]</div>
				<div>[{$shop->oxshops__oxdeladdinfo->value}]</div>
			[{/if}]

			[{*Bestellnummer,Rechnungsvermerk, 'Ihre bestellung vom...'*}]
				<div class="heading_order_paddingTop22 heading_order_fontSize15"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERNR"}][{$order->oxorder__oxordernr->value}]</strong></div>
				<div>[{if $order->oxorder__d3pdftextkostenstelle_kunden->value}][{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_INVOICENOTE"}][{$order->oxorder__d3pdftextkostenstelle_kunden->value}][{/if}]</div>
				<div class="heading_order_paddingTop1">[{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSINCERELY"}][{$order->oxorder__oxorderdate->value|date_format:"%d.%m.%Y"}][{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSAT"}]</div>
			</td>
			<td class="vertical-a heading_order_width35 heading_order_paddingTopSub5">
				<div class="aligning heading_order_paddingTop10"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_BANKVERBINDUNG"}]</strong></div>
				<div class="aligning">[{$shop->oxshops__oxbankname->value}]</div>
				<div class="aligning">[{oxmultilang ident="ORDER_OVERVIEW_PDF_ACCOUNTNR"}][{$shop->oxshops__oxibannumber->value}]</div>
				<div class="aligning">[{oxmultilang ident="ORDER_OVERVIEW_PDF_BANKCODE_HEADER"}][{$shop->oxshops__oxbiccode->value}]</div>
				<div class="aligning heading_order_paddingTop10">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILLNR"}][{$order->oxorder__oxbillnr->value}]</div>
				<div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_CUSTOMERNR"}] [{$user->oxuser__oxcustnr->value}]</div>
				<div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DATE"}][{$order->oxorder__oxbilldate->value|date_format:"%d.%m.%Y"}]</div>
				<div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTIDNR"}][{$shop->oxshops__oxvatnumber->value}]</div>
			</td>
		</tr>
		[{/block}]
	</table>
[{/block}]
	[{* +++++Artikeltabelle+++++*}]
[{block name="order_article_listing"}]
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
		[{block name="order_article_costs"}]
		<table class="article_costs_table border-bottom">
			<tr>
				[{* ++++++Artikelzusammenfassung++++++ *}]
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
				[{* ++++++Kosten der Bestellung++++++ *}]
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
		</table>
	[{/block}]
	[{block name="order_shop_past_thank"}]
		<table class="past_thank_width100" cellspacing="0">
			<tr><td class="past_thank_width100">&nbsp;</td></tr>
			<tr><td class="past_thank_width100 fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USED_PAYMENTMETHOD"}][{$payment->oxpayments__oxdesc->value}]</td></tr>
		[{* +++++++Individueller Zahlungstext+++++++ *}]
		[{if $order->oxorder__d3pdftextbestellbestaetigung->value}]
			<tr><td class="past_thank_width100 fontSize12">[{$order->oxorder__d3pdftextbestellbestaetigung->value}]</td></tr>
		[{else}]
			<tr><td class="past_thank_width100 fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USED_GREETINGSORDER"}]</td></tr>
		[{/if}]
		[{*+++++++++++*}]
			<tr><td class="past_thank_width100">&nbsp;</td></tr>
			<tr><td class="past_thank_width100 fontSize12">[{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_1"}]</td></tr>
			<tr><td class="past_thank_width100 fontSize12">[{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_2"}]</td></tr>
		</table>
	[{/block}]
	</nobreak>
</page>

[{*
[{include file="d3tplheader.tpl" title="DD_ORDER_CUST_HEADING"|oxmultilangassign|cat:" #"|cat:"0815" style=""}]

[{block name="email_html_order_cust_orderemail"}]
    <p>
        [{oxcontent ident="oxuserorderemail"}]
    </p>
[{/block}]

[{block name="email_html_order_cust_address"}]
    <table class="orderarticles" width="100%" style="width:100%; border: 1px;">
        <thead>
        <tr bgcolor="#ebebeb">
            <th>[{oxmultilang ident="PRODUCT"}]</th>
            <th>[{oxmultilang ident="UNIT_PRICE"}]</th>
            <th>[{oxmultilang ident="QUANTITY"}]</th>
            <th>[{oxmultilang ident="VAT"}]</th>
            <th>[{oxmultilang ident="TOTAL"}]</th>
        </tr>
        </thead>
        <tr>
            <td>[{oxmultilang ident="PRODUCT"}]</td>
            <td>[{oxmultilang ident="UNIT_PRICE"}]</td>
            <td>[{oxmultilang ident="QUANTITY"}]</td>
            <td>[{oxmultilang ident="VAT"}]</td>
            <td>[{oxmultilang ident="TOTAL"}]</td>
        </tr>
    </table>
[{/block}]

++[{$order->getFieldData('oxordernr')}]++
*}]