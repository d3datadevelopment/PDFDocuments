[{assign var=currency value=$order->getOrderCurrency()}]
[{assign var=deliveryPrice value=$order->getOrderDeliveryPrice()}]

<page backtop="30mm" backbottom="30mm" backleft="10mm" backright="10mm" pageset="new">
	<style>
		{*debug hilfe*}
		.eraseBug{
			border: dashed blueviolet 1px;
		}
		{*-----------------*}
		table{
			font-family: "helvetica";
		}

		.aligning{
				text-align: right;
			}
		.vertical-a{
			vertical-align: top;
			}
		.sizing{
			font-size: 12px;
			}
		.order_sum{
			margin-left: 181px;
		}
		.order_sumNum{
			margin-right: -2.2px;
		}
		.border-bottom{
			border-bottom: solid 0.15mm #000;
		}
		.hermes{
			padding-top: 5px;
		}
		.mercurius{
			padding-bottom: 5px;
		}
		.spacing_order_info{
			padding-bottom: 5px;
			padding-top: 5px;
		}
		{*---------------------*}
		{*pdf_header*}
		.pdf_header_positioning{
			position: absolute;
			top: 30px;
			right: 44px;
		}
		{*---------------------*}
		{*page_footer*}
		.page_footer_table{
			width: 688px;
			font-size: 9px;
			margin: 0 30px 0 30px;
			border-top: solid 1px #000;
		}
		{*---------------------*}
		{*pdf_heading*}
		.pdf_heading_table{
			width: 100%;
			margin-top: 8mm;
		}
		{* order_aritcle_costs *}
		.aritcle_costs_table{
			width: 100%;
			border-top: solid 0.15mm #000;
		}
		.aritcle_costs_table_td_width50{
			width: 50%;
		}
		.aritcle_costs_table_paddingRight{
			padding-right: -3px;
		}

		{*order_shop_past_thank*}
		.past_thank_width100{
			width: 100%;
		}

		{*order_article_listing*}
		.order_article_listing_width_amount{
			width: 20px;
		}
		.order_article_listing_width_desc{
			width: 418px;
		}
		.order_article_listing_width_ust{
			width: 10px;
		}
		.order_article_listing_width_unitPrice{
			width: 80px;
		}
		.order_article_listing_width_total_Price{
			width: 90px;
		}

		.order_article_listing_fontSize{
			font-size: 11px;
		}
		{* footer styling *}
		.footer_parts{
			width: 33.33%;
		}
	</style>
	<page_header>
		[{block name="pdf_header"}]
		<div class="pdf_header_positioning">
			<img src="[{$oViewConf->getImageUrl('Elektroversand-Schmidt_Logo_180.jpg')}]">
		</div>
		[{/block}]
	</page_header>
	<page_footer>
		<table class="page_footer_table" style="cellspacing: 0;">
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
	<table class="sizing pdf_heading_table" cellspacing="0">
	[{block name="heading_owner_information"}]
		<tr>
			<td style="width: 65%;">
				<div style="font-size: 8px;">[{$shop->oxshops__oxname->value}] - [{$shop->oxshops__oxstreet->value}] - [{$shop->oxshops__oxzip->value}] [{$shop->oxshops__oxcity->value}]</div>
			</td>
			<td style="width: 35%;">
				<div class="aligning"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_GET_IN_CONTACT"}]</strong></div>
				<div class="aligning sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_TELEFON"}][{$shop->oxshops__oxtelefon->value}]</div>
				<div class="aligning sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_FAX"}][{$shop->oxshops__oxtelefax->value}]</div>
				<div class="aligning sizing">[{$shop->oxshops__oxinfoemail->value}]</div>
			</td>
		</tr>
	[{/block}]
	[{block name="heading_order_information"}]
		<tr>
			<td class="vertical-a" style="width: 65%; padding-top: -5px;">
			[{if $order->oxorder__oxbillcompany->value}]
				<div>[{$order->oxorder__oxbillcompany->value}]</div>
			[{/if}]
				<div>[{$order->oxorder__oxbillfname->value}] [{$order->oxorder__oxbilllname->value}]</div>
				<div>[{$order->oxorder__oxbillstreet->value}] [{$order->oxorder__oxbillstreetnr->value}]</div>
				<div><strong>[{$order->oxorder__oxbillzip->value}] [{$order->oxorder__oxbillcity->value}]</strong></div>
				<div style="padding-bottom: 15px">[{$shop->oxshops__oxcountry->value}]</div>

			[{* +++++++Lieferadressen dynamisch+++++++ *}]
			[{if $order->oxorder__oxdelstreet->value}]
				<div style="font-size: 10px; padding-bottom: 8px">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DELIVERYADDRESS"}]</div>
			[{if $order->oxorder__oxdelcompany->value}]<div>[{$order->oxorder__oxdelcompany->value}]</div>[{/if}]
				<div>[{$order->oxorder__oxdelfname->value}] [{$order->oxorder__oxdellname->value}]</div>
				<div>[{$order->oxorder__oxdelstreet->value}] [{$order->oxorder__oxdelstreetnr->value}]</div>
				<div><strong>[{$order->oxorder__oxdelzip->value}] [{$order->oxorder__oxdelcity->value}]</strong></div>
				<div>[{$shop->oxshops__oxcountry->value}]</div>
				<div>[{$shop->oxshops__oxdeladdinfo->value}]</div>
			[{/if}]

			[{*Bestellnummer,Rechnungsvermerk, 'Ihre bestellung vom...'*}]
				<div style="font-size: 15px; padding-top: 22px"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERNR"}][{$order->oxorder__oxordernr->value}]</strong></div>
				<div>[{if $order->oxorder__d3pdftextkostenstelle_kunden->value}][{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_INVOICENOTE"}][{$order->oxorder__d3pdftextkostenstelle_kunden->value}][{/if}]</div>
				<div style="padding-top: 1mm">[{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSINCERELY"}][{$order->oxorder__oxorderdate->value|date_format:"%d.%m.%Y"}][{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSAT"}]</div>
			</td>
			<td style="width: 35%; padding-top: -5px;" class="vertical-a">
				<div style="padding-top: 10px" class="aligning"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_BANKVERBINDUNG"}]</strong></div>
				<div class="aligning">[{$shop->oxshops__oxbankname->value}]</div>
				<div class="aligning">[{oxmultilang ident="ORDER_OVERVIEW_PDF_ACCOUNTNR"}][{$shop->oxshops__oxibannumber->value}]</div>
				<div style="padding-bottom: 10px" class="aligning">[{oxmultilang ident="ORDER_OVERVIEW_PDF_BANKCODE_HEADER"}][{$shop->oxshops__oxbiccode->value}]</div>
				<div style="padding-top: 10px" class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILLNR"}][{$order->oxorder__oxbillnr->value}]</div>
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
	<table style="margin-top: 10px;" cellspacing="0">
		<tr>
			<td class="border-bottom mercurius order_article_listing_width_amount"><div class="vertical-a order_article_listing_fontSize">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_AMOUNT"}]</div></td>
			<td class="border-bottom mercurius order_article_listing_width_desc"><div class="order_article_listing_fontSize">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DESCRIPTION"}]</div></td>
			<td class="border-bottom mercurius order_article_listing_width_ust"><div class="aligning order_article_listing_fontSize">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTPERCENTAGE"}]</div></td>
			<td class="border-bottom mercurius order_article_listing_width_unitPrice"><div class="aligning order_article_listing_fontSize">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_UNITPRICE"}]</div></td>
			<td class="border-bottom mercurius order_article_listing_width_total_Price"><div class="aligning order_article_listing_fontSize">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_TOTALPRICE"}]</div></td>
		</tr>
	[{foreach from=$order->getOrderArticles(true) item=oOrderArticle}]
		<tr>
			<td class="hermes vertical-a mercurius" style="width: 20px;"><div class='sizing aligning' style="padding-right: 57.3px">[{$oOrderArticle->oxorderarticles__oxamount->value }]</div></td>
			<td class="hermes vertical-a mercurius" style="width: 418px"><div class='sizing'>
					[{$oOrderArticle->oxorderarticles__oxtitle->getRawValue() }] [{ $oOrderArticle->oxorderarticles__oxselvariant->getRawValue() }]
					<br>
					<span style="font-size: 9px">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ARTNR"}] [{$oOrderArticle->oxorderarticles__oxartnum->value }]</span>
				</div></td>
			<td class="hermes vertical-a mercurius" style="width: 10px"><div class='aligning sizing'>[{$oOrderArticle->oxorderarticles__oxvat->value }]</div></td>
			<td class="hermes vertical-a mercurius" style="width: 80px"><div class='aligning sizing'>[{$oOrderArticle->getBrutPriceFormated()}] [{$currency->name}]</div></td>
			<td class="hermes vertical-a mercurius" style="width: 90px"><div class='aligning sizing'>[{$oOrderArticle->getTotalBrutPriceFormated()}] [{$currency->name}]</div></td>
		</tr>
	[{/foreach}]
	</table>
[{/block}]
	<nobreak>
		[{block name="order_aritcle_costs"}]
		<table class="aritcle_costs_table border-bottom">
			<tr>
				[{* ++++++Artikelzusammenfassung++++++ *}]
				<td class="aritcle_costs_table_paddingRight aritcle_costs_table_td_width50 ">
					<div class="order_sum sizing border-bottom  mercurius">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_SUMBRUTTO"}]</div>
				[{if $order->getFormattedDiscount() != 0}]
					<div class="order_sum sizing border-bottom spacing_order_info">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_DISCOUNT"}]</div>
				[{/if}]
					<div class="order_sum sizing hermes">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_SUMNETTO"}]</div>
				[{foreach from=$order->getVats() key=VatKey item=oVat}]
					<div class="order_sum sizing border-bottom spacing_order_info">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAX"}] [{$VatKey}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_PERCENTAGE"}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAXPERCVALUE"}]</div>
				[{/foreach}]
					<div class="order_sum sizing hermes">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_DELIVERY"}]</div>
					<div class="sizing border-bottom spacing_order_info aligning" style="padding-right: 65.9px; margin-left: -3px">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAX"}] [{$VatKey}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_PERCENTAGE"}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAXPERCVALUE"}]</div>
					<div class="order_sum sizing hermes mercurius"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TOTALSUMBRUT"}]</strong></div>
				</td>
				[{* ++++++Zahlenteil der Zusammenfassung der Kosten++++++ *}]
				<td class="aritcle_costs_table_td_width50">
					<div class="order_sumNum aligning sizing border-bottom  mercurius">[{$order->getFormattedTotalBrutSum()}] [{$currency->name}]</div>
				[{if $order->getFormattedDiscount() != 0}]
					<div class="spacing_order_info order_sumNum aligning sizing border-bottom">-[{$order->getFormattedDiscount()}] [{$currency->name}]</div>
				[{/if}]
					<div class="hermes order_sumNum aligning sizing">[{$order->getFormattedTotalNetSum()}] [{$currency->name}]</div>
					<div class="spacing_order_info order_sumNum aligning sizing border-bottom">[{$lang->formatCurrency($oVat, $currency)}] [{$currency->name}]</div>
					<div class="hermes order_sumNum aligning sizing">[{$lang->formatCurrency($deliveryPrice->getNettoPrice(), $currency)}] [{$currency->name}]</div>
					<div class="hermes mercurius order_sumNum aligning sizing border-bottom">[{$lang->formatCurrency($deliveryPrice->getVATValue(), $currency)}] [{$currency->name}]</div>
					<div class="hermes mercurius order_sumNum aligning sizing"><strong>[{$order->getFormattedTotalOrderSum()}] [{$currency->name}]</strong></div>
				</td>
			</tr>
		</table>
	[{/block}]
	[{block name="order_shop_past_thank"}]
		<table class="past_thank_width100" cellspacing="0">
			<tr><td class="past_thank_width100">&nbsp;</td></tr>
			<tr><td class="past_thank_width100 sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USED_PAYMENTMETHOD"}][{$payment->oxpayments__oxdesc->value}]</td></tr>
		[{* +++++++Individueller Zahlungstext+++++++ *}]
		[{if $order->oxorder__d3pdftextbestellbestaetigung->value}]
			<tr><td class="past_thank_width100 sizing">[{$order->oxorder__d3pdftextbestellbestaetigung->value}]</td></tr>
		[{else}]
			<tr><td class="past_thank_width100 sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USED_GREETINGSORDER"}]</td></tr>
		[{/if}]
		[{*+++++++++++*}]
			<tr><td class="past_thank_width100">&nbsp;</td></tr>
			<tr><td class="past_thank_width100 sizing">[{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_1"}]</td></tr>
			<tr><td class="past_thank_width100 sizing">[{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_2"}]</td></tr>
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