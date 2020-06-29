[{block name="salutation"}]
    <div class="salutation">
        <div class="documenttype">noch übersetzen: Lieferschein</div>
        <div class="documentnumber">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERNR"}][{$order->getFieldData('oxordernr')}]</div>
        <div>[{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSINCERELY"}][{$order->getFieldData('oxorderdate')|date_format:"%d.%m.%Y"}][{oxmultilang ident="ORDER_OVERVIEW_PDF_ORDERSAT"}] [{$shop->oxshops__oxname->value}]</div>
    </div>
[{/block}]