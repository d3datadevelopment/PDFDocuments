[{block name="pdfHeading"}]
	<table class="fontSize12 pdf_heading_table" cellspacing="0">
		[{block name="heading_owner_information"}]
		<tr>
			<td class="pdf_heading_width65">
				<div class="pdf_heading_fontSize8">[{$shop->oxshops__oxname->value}] - [{$shop->oxshops__oxstreet->value}] - [{$shop->oxshops__oxzip->value}] [{$shop->oxshops__oxcity->value}]</div>
			</td>
			<td class="pdf_heading_width35">
				<div class="aligning" style="font-size: 7px; padding-top: 8px; padding-bottom: 4px">[{oxmultilang ident="D3_DELIVERYNOTE_PDF_QUOTECUSTMNR"}]</div>
				<div class="aligning" style="font-size: 10px;">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_CUSTOMERNR"}] [{$user->oxuser__oxcustnr->value}]</div>
			</td>
		</tr>
		[{/block}]
		[{block name="heading_order_information"}]
		<tr>
			<td class="vertical-a heading_order_width65 heading_order_paddingTopSub5 invoiceCorrectionPaddingTop5" style="padding-top: 5px;">
				[{if $order->oxorder__oxbilllname->value}]
					[{if $order->oxorder__oxdelcompany->value}]<div>[{$order->oxorder__oxdelcompany->value}]</div>[{/if}]
					<div>[{$order->oxorder__oxdelfname->value}] [{$order->oxorder__oxdellname->value}]</div>
					<div>[{$order->oxorder__oxdelstreet->value}] [{$order->oxorder__oxdelstreetnr->value}]</div>
					<div><strong>[{$order->oxorder__oxdelzip->value}] [{$order->oxorder__oxdelcity->value}]</strong></div>
					<div>[{$shop->oxshops__oxcountry->value}]</div>
					<div>[{$shop->oxshops__oxdeladdinfo->value}]</div>
				[{else}]
					[{if $order->oxorder__oxbillcompany->value}]<div>[{$order->oxorder__oxbillcompany->value}]</div>[{/if}]
					<div>[{$order->oxorder__oxbillfname->value}] [{$order->oxorder__oxbilllname->value}]</div>
					<div>[{$order->oxorder__oxbillstreet->value}] [{$order->oxorder__oxbillstreetnr->value}]</div>
					<div><strong>[{$order->oxorder__oxbillzip->value}] [{$order->oxorder__oxbillcity->value}]</strong></div>
					<div class="heading_order_paddingBottom15">[{$shop->oxshops__oxcountry->value}]</div>
				[{/if}]
			</td>
		</tr>
	</table>
	<table class="fontSize12 pdf_heading_table" cellspacing="0">
		<tr>
			<td class="invoiceCorrection_width_60" style="width: 60%">
				<div class="heading_order_fontSize15 invoiceCorrectionPaddingBottom20">[{oxmultilang ident="D3_DELIVERYNOTE_PDF_INVOICECORRECTION"}] 0000 [{oxmultilang ident="D3_DELIVERYNOTE_PDF_TOINVOICE"}][{$order->oxorder__oxbillnr->value}]</div>
				<div class="">[{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSINCERELY"}][{$order->oxorder__oxorderdate->value|date_format:"%d.%m.%Y"}][{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSAT"}]</div>
			</td>
			<td class="vertical-a  invoiceCorrection_width_40">
				<div class="aligning invoiceCorrection_font8 invoiceCorrectionPaddingTop4">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DATE"}]</div>
				<div class="aligning invoiceCorrection_font9 invoiceCorrectionPaddingBottom16">[{$shop->oxshops__oxcity->value}], [{$order->oxorder__oxorderdate->value|date_format:"%d.%m.%Y"}]</div>
				<div class="aligning invoiceCorrection_font9">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERNR"}][{$order->oxorder__oxordernr->value}]</div>
			</td>
		</tr>
		[{/block}]
	</table>
	[{/block}]