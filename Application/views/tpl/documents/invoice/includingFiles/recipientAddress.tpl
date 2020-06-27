[{block name="recipientaddress"}]
	[{if $order->getFieldData('oxbillcompany')}]
		<div>[{$order->getFieldData('oxbillcompany')}]</div>
	[{/if}]
	<div>[{$order->getFieldData('oxbillfname')}] [{$order->getFieldData('oxbilllname')}]</div>
	<div>[{$order->getFieldData('oxbillstreet')}] [{$order->getFieldData('oxbillstreetnr')}]</div>
	<div><strong>[{$order->getFieldData('oxbillzip')}] [{$order->getFieldData('oxbillcity')}]</strong></div>
	<div class="heading_order_paddingBottom15">[{$shop->getFieldData('oxcountry')}]</div>
[{/block}]