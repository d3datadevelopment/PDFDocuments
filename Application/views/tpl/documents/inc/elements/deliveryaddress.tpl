[{block name="deliveryaddress"}]
    [{if $order->getFieldData('oxdelstreet')}]
        <div class="deliveryaddress">
            <div class="heading_order_fontSize10 heading_order_paddingBottom8">
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DELIVERYADDRESS"}]
            </div>
            [{if $order->getFieldData('oxdelcompany')}]
                <div>[{$order->getFieldData('oxdelcompany')}]</div>
            [{/if}]
            <div>[{$order->getFieldData('oxdelfname')}] [{$order->getFieldData('oxdellname')}]</div>
            <div>[{$order->getFieldData('oxdelstreet')}] [{$order->getFieldData('oxdelstreetnr')}]</div>
            <div><strong>[{$order->getFieldData('oxdelzip')}] [{$order->getFieldData('oxdelcity')}]</strong></div>
            <div>[{$shop->getFieldData('oxcountry')}]</div>
            <div>[{$shop->getFieldData('oxdeladdinfo')}]</div>
        </div>
    [{/if}]
[{/block}]