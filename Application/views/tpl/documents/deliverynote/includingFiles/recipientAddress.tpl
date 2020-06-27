[{block name="pdfHeading"}]
	<table class="fontSize12 pdf_heading_table" cellspacing="0">
	[{block name="heading_owner_information"}]
		<tr>
			<td class="pdf_heading_width65">
				<div class="pdf_heading_fontSize8">[{$shop->oxshops__oxname->value}] - [{$shop->oxshops__oxstreet->value}] - [{$shop->oxshops__oxzip->value}] [{$shop->oxshops__oxcity->value}]</div>
			</td>
		</tr>
	[{/block}]
	[{block name="heading_order_information"}]
		<tr>
			<td class="vertical-a heading_order_width65 heading_order_paddingTopSub5" style="padding-top: 5px">
			[{* +++++++Lieferadressen dynamisch+++++++ *}]
			[{if $order->getFieldData('oxdellname')}]
				<div class="heading_order_fontSize10 heading_order_paddingBottom8">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DELIVERYADDRESS"}]</div>
			[{if $order->oxorder__oxdelcompany->value}]
				<div>[{$order->getFieldData('oxdelcompany')}]</div>
			[{/if}]
				<div>[{$order->getFieldData('oxdelfname')}] [{$order->getFieldData('oxdellname')}]</div>
				<div>[{$order->getFieldData('oxdelstreet')}] [{$order->getFieldData('oxdelstreetnr')}]</div>
				<div><strong>[{$order->getFieldData('oxdelzip')}] [{$order->getFieldData('oxdelcity')}]</strong></div>
				<div>[{$shop->getFieldData('oxcountry')}]</div>
				<div>[{$shop->getFieldData('oxdeladdinfo')}]</div>
			[{else}]
			[{if $order->getFieldData('oxbillcompany')}]
				<div>[{$order->getFieldData('oxbillcompany')}]</div>
			[{/if}]
				<div>[{$order->getFieldData('oxbillfname')}] [{$order->getFieldData('oxbilllname')}]</div>
				<div>[{$order->getFieldData('oxbillstreet')}] [{$order->getFieldData('oxbillstreetnr')}]</div>
				<div><strong>[{$order->getFieldData('oxbillzip')}] [{$order->getFieldData('oxbillcity')}]</strong></div>
				<div class="heading_order_paddingBottom15">[{$shop->getFieldData('oxcountry')}]</div>
				[{/if}]
			[{*Bestellnummer,Rechnungsvermerk, 'Ihre bestellung vom...'*}]
			</td>
			<td class="vertical-a heading_order_width35" style="padding-bottom: -30px">
				<div class="aligning" style="font-size: 7px; padding-top: 50px">[{oxmultilang ident="D3_DELIVERYNOTE_PDF_QUOTECUSTMNR"}]</div>
				<div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_CUSTOMERNR"}] [{$user->getFieldData('oxcustnr')}]</div>
				<div class="aligning" style="padding-top: 50px">[{$shop->getFieldData('oxcity')}], [{$smarty.now|date_format:"%d.%m.%G"}]</div>
				<div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTIDNR"}][{$shop->getFieldData('oxvatnumber')}]</div>
				<div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILLNR"}][{$order->getFieldData('oxbillnr')}]</div>
			</td>
		</tr>
    [{/block}]
	</table>
	<table class="fontSize12" cellspacing="0">
		<tr>
			<td>
				<div style="width: 300px; padding-bottom: 20px"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DELIVERYNOTE"}][{$order->oxorder__oxordernr->value}]</strong></div>
			</td>
		</tr>
		<tr>
			<td>
				<div style="padding-bottom: 20px">[{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSINCERELY"}][{$order->oxorder__oxorderdate->value|date_format:"%d.%m.%Y"}][{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSAT"}]</div>
			</td>
		</tr>
	</table>
[{/block}]