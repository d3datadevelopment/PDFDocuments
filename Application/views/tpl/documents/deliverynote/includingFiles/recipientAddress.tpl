[{block name="recipientaddress"}]
    [{if $order->getFieldData('oxdellname')}]
        [{if $order->getFieldData('oxdelcompany')}]
            <div>[{$order->getFieldData('oxdelcompany')}]</div>
        [{/if}]
        <div>[{$order->getFieldData('oxdelfname')}] [{$order->getFieldData('oxdellname')}]</div>
        [{if $order->getFieldData('oxdeladdinfo')}]
            <div>[{$order->getFieldData('oxdeladdinfo')}]</div>
        [{/if}]
        <div>[{$order->getFieldData('oxdelstreet')}] [{$order->getFieldData('oxdelstreetnr')}]</div>
        <div><strong>[{$order->getFieldData('oxdelzip')}] [{$order->getFieldData('oxdelcity')}]</strong></div>
        <div class="heading_order_paddingBottom15">[{$order->getFieldData('oxdelcountry')}]</div>
    [{else}]
        [{if $order->getFieldData('oxbillcompany')}]
            <div>[{$order->getFieldData('oxbillcompany')}]</div>
        [{/if}]
        <div>[{$order->getFieldData('oxbillfname')}] [{$order->getFieldData('oxbilllname')}]</div>
        [{if $order->getFieldData('oxbilladdinfo')}]
            <div>[{$order->getFieldData('oxbilladdinfo')}]</div>
        [{/if}]
        <div>[{$order->getFieldData('oxbillstreet')}] [{$order->getFieldData('oxbillstreetnr')}]</div>
        <div><strong>[{$order->getFieldData('oxbillzip')}] [{$order->getFieldData('oxbillcity')}]</strong></div>
        <div class="heading_order_paddingBottom15">[{$order->getFieldData('oxbillcountry')}]</div>
    [{/if}]
[{/block}]