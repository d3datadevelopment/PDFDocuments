[{block name="salutation"}]
    <div class="salutation">
        <div class="documenttype">[{oxmultilang ident="D3_PDFDOCUMENTS_INVOICE"}]</div>
        <div class="documentnumber">[{oxmultilang ident="D3_PDFDOCUMENTS_ORDERNR"}] [{$order->getFieldData('oxordernr')}]</div>

        [{assign var="dateFormat" value='D3_PDFDOCUMENTS_DATE_FORMAT'|oxmultilangassign}]
        [{assign var="sArgs" value=$order->getFieldData('oxorderdate')|date_format:$dateFormat|cat:"//"|cat:$shop->getFieldData('oxname')}]
        [{assign var="aArgs" value="//"|explode:$sArgs}]

        <div>[{oxmultilang ident="D3_PDFDOCUMENTS_ORDER_FROM_AT" args=$aArgs}]</div>
    </div>
[{/block}]