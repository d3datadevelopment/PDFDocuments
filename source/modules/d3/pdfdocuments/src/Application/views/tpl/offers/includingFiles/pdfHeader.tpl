[{block name="pdfHeading"}]
	<table class="fontSize12 pdf_heading_table helvetica" cellspacing="0">
	[{block name="heading_order_information"}]
		<tr>
			<td class="vertical-a heading_order_width65 heading_order_paddingTopSub5">
				<div class="pdf_heading_fontSize8">[{$shop->oxshops__oxname->value}] - [{$shop->oxshops__oxstreet->value}] - [{$shop->oxshops__oxzip->value}] - [{$shop->oxshops__oxcity->value}]</div>
			[{if $order->oxorder__oxdelstreet->value}]
				[{if $order->oxorder__oxdelcompany->value}]<div>[{$order->oxorder__oxdelcompany->value}]</div>[{/if}]
				<div>[{$order->oxorder__oxdelfname->value}] [{$order->oxorder__oxdellname->value}]</div>
				<div>[{$order->oxorder__oxdelstreet->value}] [{$order->oxorder__oxdelstreetnr->value}]</div>
				<div><strong>[{$order->oxorder__oxdelzip->value}] [{$order->oxorder__oxdelcity->value}]</strong></div>
				<div>[{$shop->oxshops__oxcountry->value}]</div>
				<div>[{$shop->oxshops__oxdeladdinfo->value}]</div>
			[{else}]
				[{if $order->oxorder__oxbillcompany->value}]
				<div>[{$order->oxorder__oxbillcompany->value}]</div>
				[{/if}]
				<div>[{$order->oxorder__oxbillfname->value}] [{$order->oxorder__oxbilllname->value}]</div>
				<div>[{$order->oxorder__oxbillstreet->value}] [{$order->oxorder__oxbillstreetnr->value}]</div>
				<div><strong>[{$order->oxorder__oxbillzip->value}] [{$order->oxorder__oxbillcity->value}]</strong></div>
				<div class="heading_order_paddingBottom15">[{$shop->oxshops__oxcountry->value}]</div>
			[{/if}]
			</td>
		[{block name="heading_owner_information"}]
			<td class="eraseBug pdf_heading_width35">
				<div class="aligning offers_subTitle_font14"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_GET_IN_CONTACT"}]</strong></div>
				<div class="aligning fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_TELEFON"}][{$shop->oxshops__oxtelefon->value}]</div>
				<div class="aligning fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_FAX"}][{$shop->oxshops__oxtelefax->value}]</div>
				<div class="aligning fontSize12">[{$shop->oxshops__oxinfoemail->value}]</div>
				<div class="aligning offers_subTitle_font14 heading_order_paddingTop10"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_BANKVERBINDUNG"}]</strong></div>
				<div class="aligning">[{$shop->oxshops__oxbankname->value}]</div>
				<div class="aligning">[{oxmultilang ident="ORDER_OVERVIEW_PDF_ACCOUNTNR"}][{$shop->oxshops__oxibannumber->value}]</div>
				<div class="aligning">[{oxmultilang ident="ORDER_OVERVIEW_PDF_BANKCODE_HEADER"}][{$shop->oxshops__oxbiccode->value}]</div>
			</td>
		</tr>
		[{/block}]
	[{/block}]
	</table>
	<table class="offers_width100 fontSize12 helvetica offers_margin_top20" cellspacing="0">
	[{block name="table_toping_information"}]
		<tr>
			<td class="offers_width50">
				<div class="heading_order_fontSize15 offers_margin_bottom20"><strong>[{oxmultilang ident="D3_OFFER_PDF_OFFERN"}][0000]</strong></div>
			</td>
			<td class="vertical-a offers_width50">
				<div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_CUSTOMERNR"}] [{$user->oxuser__oxcustnr->value}]</div>
				<div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DATE"}][{$order->oxorder__oxbilldate->value|date_format:"%d.%m.%Y"}]</div>
				<div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTIDNR"}][{$shop->oxshops__oxvatnumber->value}]</div>
			</td>
		</tr>
	</table>
	<table class="fontSize12 helvetica" cellspacing="0">
		<tr>
			<td>
				<div>[{oxmultilang ident="D3_OFFER_PDF_THANKINTEREST"}]</div>
				<div>[{oxmultilang ident="D3_OFFER_PDF_OFFERTEXT"}]</div>
			</td>
		</tr>
    [{/block}]
	</table>
[{/block}]