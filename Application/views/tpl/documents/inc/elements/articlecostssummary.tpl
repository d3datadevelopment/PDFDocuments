<td class="description">
    <div class="sumbrutto">
        [{oxmultilang ident="D3_PDFDOCUMENTS_SUMBRUTTO"}]
    </div>
    [{if $order->getFormattedDiscount() != 0}]
        <div class="discount">
            [{oxmultilang ident="D3_PDFDOCUMENTS_DISCOUNT"}]
        </div>
    [{/if}]
    <div class="sumnetto">
        [{oxmultilang ident="D3_PDFDOCUMENTS_SUMNETTO"}]
    </div>
    [{foreach from=$productVats key=VatKey item=oVat}]
        <div class="producttax">
            [{oxmultilang ident="D3_PDFDOCUMENTS_TAX" args=$VatKey}]
        </div>
    [{/foreach}]
    <div class="delivery">
        [{oxmultilang ident="D3_PDFDOCUMENTS_DELIVERY"}]
    </div>
    <div class="deliverytax">
        [{oxmultilang ident="D3_PDFDOCUMENTS_TAX" args=$VatKey}]
    </div>
    <div class="totalsum">
        [{oxmultilang ident="D3_PDFDOCUMENTS_TOTALSUMBRUT"}]
    </div>
</td>
<td class="values">
    <div class="sumbrutto">
        [{$order->getFormattedTotalBrutSum()}] [{$currency->name}]
    </div>
    [{if $order->getFormattedDiscount() != 0}]
        <div class="discount">
            -[{$order->getFormattedDiscount()}] [{$currency->name}]
        </div>
    [{/if}]
    <div class="sumnetto">
        [{$order->getFormattedTotalNetSum()}] [{$currency->name}]
    </div>
[{* ToDo: kein foreach wie oben ??? *}]
    <div class="producttax">
        [{$lang->formatCurrency($oVat, $currency)}] [{$currency->name}]
    </div>
    <div class="delivery">
        [{$lang->formatCurrency($deliveryPrice->getNettoPrice(), $currency)}] [{$currency->name}]
    </div>
    <div class="deliverytax">
        [{$lang->formatCurrency($deliveryPrice->getVATValue(), $currency)}] [{$currency->name}]
    </div>
[{* ToDo: keine payment costs ??? *}]
    <div class="totalsum">
        [{$order->getFormattedTotalOrderSum()}] [{$currency->name}]
    </div>
</td>