[{block name="recipientaddress"}]
    [{if $order->getFieldData('oxdellname')}]
        [{if $order->getFieldData('oxdelcompany')}]
            <div class="company">[{$order->getFieldData('oxdelcompany')}]</div>
        [{/if}]
        <div class="name">[{$order->getFieldData('oxdelfname')}] [{$order->getFieldData('oxdellname')}]</div>
        [{if $order->getFieldData('oxdeladdinfo')}]
            <div class="addinfo">[{$order->getFieldData('oxdeladdinfo')}]</div>
        [{/if}]
        <div class="street">[{$order->getFieldData('oxdelstreet')}] [{$order->getFieldData('oxdelstreetnr')}]</div>
        <div class="location">[{$order->getFieldData('oxdelzip')}] [{$order->getFieldData('oxdelcity')}]</div>
        <div class="country">[{$order->getFieldData('oxdelcountry')}]</div>
    [{else}]
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
    [{/if}]
[{/block}]