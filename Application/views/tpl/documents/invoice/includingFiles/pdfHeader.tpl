[{block name="pdfHeading"}]
	<table class="fontSize12 pdf_heading_table marginBottom15" cellspacing="0">
	[{block name="heading_owner_information"}]
		<tr>
			<td class="pdf_heading_width65">
				<div class="pdf_heading_fontSize8">[{$shop->getFielddata('oxname')}] - [{$shop->getFielddata('oxstreet')}] - [{$shop->getFielddata('oxzip')}] [{$shop->getFielddata('oxcity')}]</div>
			</td>
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
			[{if $order->getFieldData('oxbillcompany')}]
				<div>[{$order->getFieldData('oxbillcompany')}]</div>
			[{/if}]
				<div>[{$order->getFieldData('oxbillfname')}] [{$order->getFieldData('oxbilllname')}]</div>
				<div>[{$order->getFieldData('oxbillstreet')}] [{$order->getFieldData('oxbillstreetnr')}]</div>
				<div><strong>[{$order->getFieldData('oxbillzip')}] [{$order->getFieldData('oxbillcity')}]</strong></div>
				<div class="heading_order_paddingBottom15">[{$shop->getFieldData('oxcountry')}]</div>

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
				<div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DATE"}][{$smarty.now|date_format:"%d.%m.%G"}]</div>
				<div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTIDNR"}][{$shop->getFieldData('oxvatnumber')}]</div>
			</td>
		</tr>
    [{/block}]
	</table>
[{/block}]