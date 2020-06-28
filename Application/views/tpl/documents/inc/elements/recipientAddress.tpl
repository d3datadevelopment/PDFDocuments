[{block name="recipientaddress"}]
    [{if $order->getFieldData('oxbillcompany')}]
        <div class="company">[{$order->getFieldData('oxbillcompany')}]</div>
    [{/if}]
    <div class="name">[{$order->getFieldData('oxbillfname')}] [{$order->getFieldData('oxbilllname')}]</div>
    [{if $order->getFieldData('oxbilladdinfo')}]
        <div class="addinfo">[{$order->getFieldData('oxbilladdinfo')}]</div>
    [{/if}]
    <div class="street">[{$order->getFieldData('oxbillstreet')}] [{$order->getFieldData('oxbillstreetnr')}]</div>
    <div class="location">[{$order->getFieldData('oxbillzip')}] [{$order->getFieldData('oxbillcity')}]</div>
    <div class="country">[{$order->getFieldData('oxbillcountry')}]</div>
[{/block}]