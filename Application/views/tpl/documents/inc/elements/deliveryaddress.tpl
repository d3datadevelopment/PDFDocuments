[{block name="deliveryaddress"}]
    [{if $order->getFieldData('oxdelstreet')}]
        <div class="deliveryaddress">
            <div class="headline">
                [{oxmultilang ident="D3_PDFDOCUMENTS_DELIVERYADDRESS" suffix="COLON"}]
            </div>
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
        </div>
    [{/if}]
[{/block}]