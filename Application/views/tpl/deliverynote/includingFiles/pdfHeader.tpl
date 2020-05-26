[{block name="pdfHeading"}]
	<table class="fontSize12 pdf_heading_table" cellspacing="0">
	[{block name="heading_owner_information"}]
		<tr>
			<td class="pdf_heading_width65">
				<div class="pdf_heading_fontSize8">[{$shop->oxshops__oxname->value}] - [{$shop->oxshops__oxstreet->value}] - [{$shop->oxshops__oxzip->value}] [{$shop->oxshops__oxcity->value}]</div>
			</td>
			[{*<td class="pdf_heading_width35">
				<div class="aligning"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_GET_IN_CONTACT"}]</strong></div>
				<div class="aligning fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_TELEFON"}][{$shop->oxshops__oxtelefon->value}]</div>
				<div class="aligning fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_FAX"}][{$shop->oxshops__oxtelefax->value}]</div>
				<div class="aligning fontSize12">[{$shop->oxshops__oxinfoemail->value}]</div>
			</td>*}]
		</tr>
	[{/block}]
	[{block name="heading_order_information"}]
		<tr>
			<td class="vertical-a heading_order_width65 heading_order_paddingTopSub5" style="padding-top: 5px">
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
				<div class="heading_order_paddingTop22 heading_order_fontSize15"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DELIVERYNOTE"}][{$order->oxorder__oxordernr->value}]</strong></div>
				<div class="heading_order_paddingTop1">[{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSINCERELY"}][{$order->oxorder__oxorderdate->value|date_format:"%d.%m.%Y"}][{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSAT"}]</div>
			</td>
			<td class="vertical-a heading_order_width35 heading_order_paddingTopSub5">
				<div class="aligning" style="font-size: 7px; padding-top: 50px">[{oxmultilang ident="D3_DELIVERYNOTE_PDF_QUOTECUSTMNR"}]</div>
				<div class="aligning" style="padding-bottom: 50px">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_CUSTOMERNR"}] [{$user->oxuser__oxcustnr->value}]</div>
				<div class="aligning">[{$shop->oxshops__oxcity->value}], [{$order->oxorder__oxbilldate->value|date_format:"%d.%m.%Y"}]</div>
				<div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTIDNR"}][{$shop->oxshops__oxvatnumber->value}]</div>
				<div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILLNR"}][{$order->oxorder__oxbillnr->value}]</div>
			</td>
		</tr>
    [{/block}]
	</table>
[{/block}]