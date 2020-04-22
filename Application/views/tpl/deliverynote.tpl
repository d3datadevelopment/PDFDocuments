[{assign var=currency value=$order->getOrderCurrency()}]
[{assign var=deliveryPrice value=$order->getOrderDeliveryPrice()}]

<page backtop="30mm" backbottom="30mm" backleft="10mm" backright="10mm" pageset="new">
	<style>
		.aligning{
				text-align: right;
			}
		table > td > div,
		table > td{
			font-family: "helvetica";
			}
		
		.vertical-a{
			vertical-align: top;
			}
		.sizing{
			font-size: 12px;
			}
	</style>
	<page_header>
		<div  style="position: absolute; top: 30px; right: 44px;">
			<img src="[{$oViewConf->getImageUrl('d3pdf_logo.png')}]">
		</div>
	</page_header>
	<page_footer>
        <table style="width: 688px; font-size: 9px; margin: 0 30px 0 30px; border-top: solid 1px #000;" cellspacing="0">
			<tr>
				<td style="width: 33.33%;"></td>
				<td style="width: 33.33%;"></td>
				<td style="width: 33.33%;"></td>
			</tr>
			<tr>
				<td style="width: 33.33%">[{$shop->oxshops__oxname->value}]</td>
				<td style="width: 33.33%">[{$shop->oxshops__oxfname->value}][{$shop->oxshops__oxlname->value}]</td>
				<td style="width: 33.33%">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_BANKVERBINDUNG"}]</td>
			</tr>
			<tr>
				<td style="width: 33.33%">[{$shop->oxshops__oxstreet->value}]</td>
				<td style="width: 33.33%">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_COURT"}] [{$shop->oxshops__oxcourt->value}]</td>
				<td style="width: 33.33%">[{$shop->oxshops__oxbankname->value}]</td>
			</tr>
			<tr>
				<td style="width: 33.33%">[{$shop->oxshops__oxzip->value}] [{$shop->oxshops__oxcity->value}]</td>
				<td style="width: 33.33%">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_HRBNR"}][{$shop->oxshops__oxhrbnr->value}]</td>
				<td style="width: 33.33%">[{oxmultilang ident="ORDER_OVERVIEW_PDF_ACCOUNTNR"}][{$shop->oxshops__oxibannumber->value}]</td>
			</tr>
			<tr>
				<td style="width: 33.33%">[{$shop->oxshops__oxcountry->value}]</td>
				<td style="width: 33.33%">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTID"}][{$shop->oxshops__oxvatnumber->value}]</td>
				<td style="width: 33.33%">[{oxmultilang ident="ORDER_OVERVIEW_PDF_BANKCODE"}][{$shop->oxshops__oxbiccode->value}]</td>
			</tr>
		</table>
		<table style="width: 100%; font-size: 9px; margin: 0 30px 0 30px;" cellspacing="0">
			<tr>
				<td style="width: 100%">[{$shop->oxshops__oxurl->value}]</td>
			</tr>
			<tr>
				<td style="width: 100%">[{$shop->oxshops__oxinfoemail->value}]</td>
			</tr>
		</table>
	</page_footer>
	<table style="width: 100%; font-size: 12px;" cellspacing="0">
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
		<tr>
			<td style="width: 65%; vertical-align: top; padding-top: -5px;">
			[{if $order->oxorder__oxbillcompany->value}]
				<div>[{$order->oxorder__oxbillcompany->value}]</div>
			[{/if}]
				<div>[{$order->oxorder__oxbillfname->value}] [{$order->oxorder__oxbilllname->value}]</div>
				<div>[{$order->oxorder__oxbillstreet->value}] [{$order->oxorder__oxbillstreetnr->value}]</div>
				<div><strong>[{$order->oxorder__oxbillzip->value}] [{$order->oxorder__oxbillcity->value}]</strong></div>
				<div style="padding-bottom: 15px">[{$shop->oxshops__oxcountry->value}]</div>

			[{* +++++++Lieferadressen dynamisch+++++++ *}]
			[{if $order->oxorder__oxdelstreet->value}]
				<div style="font-size: 10px; padding-bottom: 10px">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DELIVERYADDRESS"}]</div>
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
				<div>[{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSINCERELY"}][{$order->oxorder__oxorderdate->value|date_format:"%d.%m.%Y"}][{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSAT"}]</div>
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
	</table>
	[{*<table style="width: 100%; font-size: 12px;" cellspacing="0">
		<tr>
			<td>
				<div style="font-size: 15px; padding-top: 10px"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERNR"}][{$order->oxorder__oxordernr->value}]</strong></div>
				<div>[{if $order->oxorder__d3pdftextkostenstelle_kunden->value}][{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_INVOICENOTE"}][{$order->oxorder__d3pdftextkostenstelle_kunden->value}][{/if}]</div>
				<div>[{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSINCERELY"}][{$order->oxorder__oxorderdate->value|date_format:"%d.%m.%Y"}][{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSAT"}]</div>
			</td>
		</tr>
	</table>*}]

	<table style="width: 100%; margin-top: 10px;" cellspacing="0">
		<tr>
			<td style="width: 10%; padding-bottom: 5px; font-size: 11px;" class="sizing vertical-a">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_AMOUNT"}]</td>
			<td style="width: 17%; padding-bottom: 5px; font-size: 11px;" class="sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ARTNR"}]</td>
			<td style="width: 43%; padding-bottom: 5px; font-size: 11px;" class="sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DESCRIPTION"}]</td>
			<td style="width: 5%; padding-bottom: 5px; font-size: 11px;" class="sizing aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTPERCENTAGE"}]</td>
			<td style="width: 12%; text-align: right; padding-bottom: 5px; font-size: 11px;" class="sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_UNITPRICE"}]</td>
			<td style="width: 13%; padding-bottom: 5px; font-size: 11px;" class="aligning sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_TOTALPRICE"}]</td>
		</tr>
		<tr>
			<td style="width: 10%; border-top: solid 0.15mm #000; padding-bottom: 5px"></td>
			<td style="width: 17%; border-top: solid 0.15mm #000; padding-bottom: 5px"></td>
			<td style="width: 43%; border-top: solid 0.15mm #000; padding-bottom: 5px"></td>
			<td style="width: 5%; border-top: solid 0.15mm #000; padding-bottom: 5px"></td>
			<td style="width: 12%; border-top: solid 0.15mm #000; padding-bottom: 5px"></td>
			<td style="width: 13%; border-top: solid 0.15mm #000; padding-bottom: 5px"></td>
		</tr>
[{foreach from=$order->getOrderArticles(true) item=oOrderArticle}]
		<tr>
			<td style="width: 10%; padding-bottom:  5px; padding-right: 45px; text-align: right;" class='vertical-a sizing'>[{$oOrderArticle->oxorderarticles__oxamount->value }]</td>
			<td style="width: 17%; padding-bottom:  5px;" class='vertical-a sizing'>[{$oOrderArticle->oxorderarticles__oxartnum->value }]</td>
			<td style="width: 43%; padding-bottom:  5px;" class='vertical-a sizing'>[{$oOrderArticle->oxorderarticles__oxtitle->getRawValue() }] [{ $oOrderArticle->oxorderarticles__oxselvariant->getRawValue() }]</td>
			<td style="width: 5%; padding-bottom:  5px;" class='vertical-a sizing aligning'>[{$oOrderArticle->oxorderarticles__oxvat->value }]</td>
			<td style="width: 12%; padding-bottom: 5px; text-align: right" class='vertical-a sizing'>[{$oOrderArticle->getBrutPriceFormated()}] [{$currency->name}]</td>
			<td style="width: 13%; padding-bottom:  5px;" class="aligning vertical-a sizing">[{$oOrderArticle->getTotalBrutPriceFormated()}] [{$currency->name}]</td>
		</tr>
[{/foreach}]
	</table>
	<nobreak>
	<table style="width: 100%;" cellspacing="0">
		<tr>
			<td style="width: 10%; border-top: solid 0.15mm #000;"></td>
			<td style="width: 17%; border-top: solid 0.15mm #000;"></td>
			<td style="width: 43%; border-top: solid 0.15mm #000;"></td>
			<td style="width: 5%; border-top: solid 0.15mm #000;"></td>
			<td style="width: 12%; border-top: solid 0.15mm #000;"></td>
			<td style="width: 13%; border-top: solid 0.15mm #000;"></td>
		</tr>
		<tr style="border-bottom: solid 2px #000;">
			<td style="width: 10%"></td>
			<td style="width: 17%"></td>
			<td style="width: 43%" class="sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_SUMNETTO"}]</td>
			<td style="width: 5%"></td>
			<td style="width: 12%"></td>
			<td style="width: 13%" class="aligning sizing">[{$order->getFormattedTotalNetSum()}] [{$currency->name}]</td>
		</tr>
		[{if $order->getFormattedDiscount() != 0}]
		<tr>
			<td style="width: 10%;"></td>
			<td style="width: 17%;"></td>
			<td style="width: 43%; border-bottom: solid 0.15mm #000;"></td>
			<td style="width: 5%; border-bottom: solid 0.15mm #000;"></td>
			<td style="width: 12%; border-bottom: solid 0.15mm #000;"></td>
			<td style="width: 13%; border-bottom: solid 0.15mm #000;"></td>
		</tr>
		<tr>
			<td style="width: 10%"></td>
			<td style="width: 17%"></td>
			<td style="width: 43%" class="sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_DISCOUNT"}]</td>
			<td style="width: 5%"></td>
			<td style="width: 12%"></td>
			<td style="width: 13%" class="aligning sizing">-[{$order->getFormattedDiscount()}] [{$currency->name}]</td>
		</tr>
		<tr>
			<td style="width: 10%;"></td>
			<td style="width: 17%;"></td>
			<td style="width: 43%; border-top: solid 0.15mm #000;"></td>
			<td style="width: 5%; border-top: solid 0.15mm #000;"></td>
			<td style="width: 12%; border-top: solid 0.15mm #000;"></td>
			<td style="width: 13%; border-top: solid 0.15mm #000;"></td>
		</tr>
		[{/if}]
	[{foreach from=$order->getVats() key=VatKey item=oVat}]
		<tr>
			<td style="width: 10%;"></td>
			<td style="width: 17%;">&nbsp;</td>
			<td style="width: 43%;" class="sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAX"}] [{$VatKey}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_PERCENTAGE"}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAXPERCVALUE"}]</td>
			<td style="width: 5%;"></td>
			<td style="width: 12%;"></td>
			<td style="width: 13%;" class="aligning sizing">[{$lang->formatCurrency($oVat, $currency)}] [{$currency->name}]</td>
		</tr>
	[{/foreach}]
		<tr>
			<td style="width: 10%; padding-bottom: 5px;"></td>
			<td style="width: 17%; padding-bottom: 5px;"></td>
			<td style="width: 43%; padding-bottom: 5px;" class="sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_SUMBRUTTO"}]</td>
			<td style="width: 5%; padding-bottom: 5px;"></td>
			<td style="width: 12%; padding-bottom: 5px;"></td>
			<td style="width: 13%; padding-bottom: 5px;" class="aligning sizing">[{$order->getFormattedTotalBrutSum()}] [{$currency->name}]</td>
		</tr>
		<tr>
			<td style="width: 10%;"></td>
			<td style="width: 17%;"></td>
			<td style="width: 43%; border-top: solid 0.15mm #000;"></td>
			<td style="width: 5%; border-top: solid 0.15mm #000;"></td>
			<td style="width: 12%; border-top: solid 0.15mm #000;"></td>
			<td style="width: 13%; border-top: solid 0.15mm #000;"></td>
		</tr>
		<tr style="border-bottom: 2px solid #000">
			<td style="width: 10%; padding-top: 5px;"></td>
			<td style="width: 17%; padding-top: 5px;"></td>
			<td style="width: 43%; padding-top: 5px;" class="sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_DELIVERY"}]</td>
			<td style="width: 5%; padding-top: 5px;"></td>
			<td style="width: 12%; padding-top: 5px;"></td>
			<td style="width: 13%; padding-top: 5px;" class="aligning sizing">[{$lang->formatCurrency($deliveryPrice->getNettoPrice(), $currency)}] [{$currency->name}]</td>
		</tr>
		<tr>
			<td style="width: 10%; padding-bottom: 5px;"></td>
			<td style="width: 17%; padding-bottom: 5px;">&nbsp;</td>
			<td style="width: 43%; padding-bottom: 5px;" class="sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAX"}]</td>
			<td style="width: 5%; padding-bottom: 5px;"></td>
			<td style="width: 12%; padding-bottom: 5px;"></td>
			<td style="width: 13%; padding-bottom: 5px;" class="aligning sizing">[{$lang->formatCurrency($deliveryPrice->getVATValue(), $currency)}] [{$currency->name}]</td>
		</tr>
		<tr>
			<td style="width: 10%; border-top: solid 0.1mm #000;"></td>
			<td style="width: 17%; border-top: solid 0.1mm #000;"></td>
			<td style="width: 43%; border-top: solid 0.1mm #000;"></td>
			<td style="width: 5%; border-top: solid 0.1mm #000;"></td>
			<td style="width: 12%; border-top: solid 0.1mm #000;"></td>
			<td style="width: 13%; border-top: solid 0.1mm #000;"></td>
		</tr>
		<tr>
			<td style="width: 10%; padding-bottom: 5px"></td>
			<td style="width: 17%; padding-bottom: 5px"></td>
			<td style="width: 43%; padding-bottom: 5px" class="sizing"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TOTALSUMBRUT"}]</strong></td>
			<td style="width: 5%; padding-bottom: 5px"></td>
			<td style="width: 12%; padding-bottom: 5px"></td>
			<td style="width: 13%; padding-bottom: 5px" class="aligning sizing"><strong>[{$order->getFormattedTotalOrderSum()}] [{$currency->name}]</strong></td>
		</tr>
		<tr>
			<td style="width: 10%; border-top: solid 0.1mm #000;"></td>
			<td style="width: 17%; border-top: solid 0.1mm #000;"></td>
			<td style="width: 43%; border-top: solid 0.1mm #000;"></td>
			<td style="width: 5%; border-top: solid 0.1mm #000;"></td>
			<td style="width: 12%; border-top: solid 0.1mm #000;"></td>
			<td style="width: 13%; border-top: solid 0.1mm #000;"></td>
		</tr>
	</table>
	<table style="width: 100%" cellspacing="0">
		<tr><td style="width: 100%">&nbsp;</td></tr>
		<tr><td style="width: 100%" class="sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USED_PAYMENTMETHOD"}][{$payment->oxpayments__oxdesc->value}]</td></tr>

	[{* +++++++Individueller Zahlungstext+++++++ *}]
	[{if $order->oxorder__d3pdftextbestellbestaetigung->value}]
		<tr><td style="width: 100%" class="sizing">[{$order->oxorder__d3pdftextbestellbestaetigung->value}]</td></tr>
	[{else}]
		<tr><td style="width: 100%" class="sizing">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USED_GREETINGSORDER"}]</td></tr>
	[{/if}]
		<tr><td style="width: 100%">&nbsp;</td></tr>
		<tr><td style="width: 100%" class="sizing">[{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_1"}]</td></tr>
		<tr><td style="width: 100%" class="sizing">[{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_2"}]</td></tr>
	</table>
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