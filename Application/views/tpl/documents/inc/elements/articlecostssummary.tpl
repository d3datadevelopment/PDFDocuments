[{block name="sumbrutto"}]
    <tr class="sumbrutto">
        <td class="description">
            [{oxmultilang ident="D3_PDFDOCUMENTS_SUMBRUTTO" suffix="COLON"}]
        </td>
        <td class="values">
            [{$order->getFormattedTotalBrutSum()}] [{$currency->name}]
        </td>
    </tr>
[{/block}]
[{block name="discount"}]
    [{if $order->getFormattedDiscount() != 0}]
        <tr class="discount">
            <td class="description">
                [{oxmultilang ident="D3_PDFDOCUMENTS_DISCOUNT" suffix="COLON"}]
            </td>
            <td class="values">
                -[{$order->getFormattedDiscount()}] [{$currency->name}]
            </td>
        </tr>
    [{/if}]
[{/block}]
[{block name="sumnetto"}]
    <tr class="sumnetto">
        <td class="description">
            [{oxmultilang ident="D3_PDFDOCUMENTS_SUMNETTO" suffix="COLON"}]
        </td>
        <td class="values">
            [{$order->getFormattedTotalNetSum()}] [{$currency->name}]
        </td>
    </tr>
[{/block}]
[{block name="producttax"}]
    [{foreach from=$productVats key=VatKey item=oVat}]
        <tr class="producttax">
            <td class="description">
                [{oxmultilang ident="D3_PDFDOCUMENTS_TAX" args=$VatKey suffix="COLON"}]
            </td>
            <td class="values">
                [{$lang->formatCurrency($oVat, $currency)}] [{$currency->name}]
            </td>
        </tr>
    [{/foreach}]
[{/block}]
[{block name="delivery"}]
    <tr class="delivery">
        <td class="description">
            [{oxmultilang ident="D3_PDFDOCUMENTS_DELIVERY" suffix="COLON"}]
        </td>
        <td class="values">
            [{$lang->formatCurrency($deliveryPrice->getNettoPrice(), $currency)}] [{$currency->name}]
        </td>
    </tr>
    <tr class="deliverytax">
        <td class="description">
            [{oxmultilang ident="D3_PDFDOCUMENTS_TAX" args=$VatKey suffix="COLON"}]
        </td>
        <td class="values">
            [{$lang->formatCurrency($deliveryPrice->getVATValue(), $currency)}] [{$currency->name}]
        </td>
    </tr>
[{/block}]
[{* ToDo: keine payment costs ??? *}]
[{block name="totalsum"}]
    <tr class="totalsum">
        <td class="description">
            [{oxmultilang ident="D3_PDFDOCUMENTS_TOTALSUMBRUT" suffix="COLON"}]
        </td>
        <td class="values">
            [{$order->getFormattedTotalOrderSum()}] [{$currency->name}]
        </td>
    </tr>
[{/block}]