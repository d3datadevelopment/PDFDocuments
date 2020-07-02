[{capture name="sumnetto"}]
    [{block name="sumnetto"}]
        <tr class="sumnetto">
            <td class="indent"></td>
            <td class="description">
                [{oxmultilang ident="D3_PDFDOCUMENTS_SUMNETTO" suffix="COLON"}]
            </td>
            <td class="values">
                [{$order->getFormattedTotalNetSum()}] [{$currency->name}]
            </td>
        </tr>
    [{/block}]
[{/capture}]

[{capture name="discount"}]
    [{block name="discount"}]
        <tr class="discount">
            <td class="indent"></td>
            <td class="description">
                [{oxmultilang ident="D3_PDFDOCUMENTS_DISCOUNT" suffix="COLON"}]
            </td>
            <td class="values">
                [{$order->getFormattedDiscount()}] [{$currency->name}]
            </td>
        </tr>
    [{/block}]
[{/capture}]

[{capture name="producttax"}]
    [{block name="producttax"}]
        [{foreach from=$order->getProductVats(false) key=VatKey item=oVat}]
            <tr class="producttax">
                <td class="indent"></td>
                <td class="description">
                    [{oxmultilang ident="D3_PDFDOCUMENTS_TAX" args=$VatKey suffix="COLON"}]
                </td>
                <td class="values">
                    [{$lang->formatCurrency($oVat, $currency)}] [{$currency->name}]
                </td>
            </tr>
        [{/foreach}]
    [{/block}]
[{/capture}]

[{capture name="sumbrutto"}]
    [{block name="sumbrutto"}]
        <tr class="sumbrutto">
            <td class="indent"></td>
            <td class="description">
                [{oxmultilang ident="D3_PDFDOCUMENTS_SUMBRUTTO" suffix="COLON"}]
            </td>
            <td class="values">
                [{$order->getFormattedTotalBrutSum()}] [{$currency->name}]
            </td>
        </tr>
    [{/block}]
[{/capture}]

[{if $order->getFieldData('oxdiscount')}]
    [{if $order->isNettoMode()}]
        [{$smarty.capture.sumnetto}]
        [{$smarty.capture.discount}]
        [{$smarty.capture.producttax}]
        [{$smarty.capture.sumbrutto}]
    [{else}]
        [{$smarty.capture.sumbrutto}]
        [{$smarty.capture.discount}]
        [{$smarty.capture.sumnetto}]
        [{$smarty.capture.producttax}]
    [{/if}]
[{else}]
    [{$smarty.capture.sumnetto}]
    [{$smarty.capture.producttax}]
    [{$smarty.capture.sumbrutto}]
[{/if}]

[{if $order->getFieldData('oxvoucherdiscount')}]
    [{block name="voucherdiscount"}]
        <tr class="voucherdiscount">
            <td class="indent"></td>
            <td class="description">
                [{oxmultilang ident="D3_PDFDOCUMENTS_VOUCHERDISCOUNT" suffix="COLON"}]
            </td>
            <td class="values">
                -[{$order->getFormattedTotalVouchers()}] [{$currency->name}]
            </td>
        </tr>
    [{/block}]
[{/if}]

[{block name="delivery"}]
    [{if $config->getConfigParam('blShowVATForDelivery')}]
        [{assign var="deliveryPrice" value=$order->getOrderDeliveryPrice()}]
        <tr class="delivery">
            <td class="indent"></td>
            <td class="description">
                [{oxmultilang ident="D3_PDFDOCUMENTS_DELIVERY_NET" suffix="COLON"}]
            </td>
            <td class="values">
                [{$lang->formatCurrency($deliveryPrice->getNettoPrice(), $currency)}] [{$currency->name}]
            </td>
        </tr>
        <tr class="deliverytax">
            <td class="indent"></td>
            <td class="description">
                [{if $config->getConfigParam('sAdditionalServVATCalcMethod') != 'proportional'}]
                    [{oxmultilang ident="D3_PDFDOCUMENTS_TAX" args=$order->getFieldData('oxdelvat') suffix="COLON"}]
                [{else}]
                    [{oxmultilang ident="D3_PDFDOCUMENTS_PROPORTIONAL_TAX" suffix="COLON"}]
                [{/if}]
            </td>
            <td class="values">
                [{$lang->formatCurrency($deliveryPrice->getVATValue(), $currency)}] [{$currency->name}]
            </td>
        </tr>
    [{else}]
        <tr class="delivery">
            <td class="indent"></td>
            <td class="description">
                [{oxmultilang ident="D3_PDFDOCUMENTS_DELIVERY" suffix="COLON"}]
            </td>
            <td class="values">
                [{$lang->formatCurrency($order->getFieldData('oxdelcost'), $currency)}] [{$currency->name}]
            </td>
        </tr>
    [{/if}]
[{/block}]

[{block name="payment"}]
    [{if $config->getConfigParam('blShowVATForPayCharge')}]
        [{assign var="paymentPrice" value=$order->getOrderPaymentPrice()}]
        <tr class="payment">
            <td class="indent"></td>
            <td class="description">
                [{oxmultilang ident="D3_PDFDOCUMENTS_PAYMENT_NET" suffix="COLON"}]
            </td>
            <td class="values">
                [{$lang->formatCurrency($paymentPrice->getNettoPrice(), $currency)}] [{$currency->name}]
            </td>
        </tr>
        <tr class="paymenttax">
            <td class="indent"></td>
            <td class="description">
                [{if $config->getConfigParam('sAdditionalServVATCalcMethod') != 'proportional'}]
                    [{oxmultilang ident="D3_PDFDOCUMENTS_TAX" args=$order->getFieldData('oxpayvat') suffix="COLON"}]
                [{else}]
                    [{oxmultilang ident="D3_PDFDOCUMENTS_PROPORTIONAL_TAX" suffix="COLON"}]
                [{/if}]
            </td>
            <td class="values">
                [{$lang->formatCurrency($paymentPrice->getVATValue(), $currency)}] [{$currency->name}]
            </td>
        </tr>
    [{else}]
        <tr class="payment">
            <td class="indent"></td>
            <td class="description">
                [{oxmultilang ident="D3_PDFDOCUMENTS_PAYMENT" suffix="COLON"}]
            </td>
            <td class="values">
                [{$lang->formatCurrency($order->getFieldData('oxpaycost'), $currency)}] [{$currency->name}]
            </td>
        </tr>
    [{/if}]
[{/block}]

[{block name="wrapping"}]
    [{if $order->getFieldData('oxwrapcost')}]
        [{if $config->getConfigParam('blShowVATForWrapping')}]
            [{assign var="wrappingPrice" value=$order->getOrderWrappingPrice()}]
            <tr class="wrapping">
                <td class="indent"></td>
                <td class="description">
                    [{oxmultilang ident="D3_PDFDOCUMENTS_WRAPPING_NET" suffix="COLON"}]
                </td>
                <td class="values">
                    [{$lang->formatCurrency($wrappingPrice->getNettoPrice(), $currency)}] [{$currency->name}]
                </td>
            </tr>
            <tr class="wrappingtax">
                <td class="indent"></td>
                <td class="description">
                    [{oxmultilang ident="D3_PDFDOCUMENTS_UNDEFINED_TAX" suffix="COLON"}]
                </td>
                <td class="values">
                    [{$lang->formatCurrency($wrappingPrice->getVATValue(), $currency)}] [{$currency->name}]
                </td>
            </tr>
        [{else}]
            <tr class="wrapping">
                <td class="indent"></td>
                <td class="description">
                    [{oxmultilang ident="D3_PDFDOCUMENTS_WRAPPING" suffix="COLON"}]
                </td>
                <td class="values">
                    [{$lang->formatCurrency($order->getFieldData('oxwrapcost'), $currency)}] [{$currency->name}]
                </td>
            </tr>
        [{/if}]
    [{/if}]
[{/block}]

[{block name="giftcard"}]
    [{if $order->getFieldData('oxgiftcardcost')}]
        [{if $config->getConfigParam('blShowVATForWrapping')}]
            [{assign var="giftCardPrice" value=$order->getOrderGiftCardPrice()}]
            <tr class="giftcard">
                <td class="indent"></td>
                <td class="description">
                    [{oxmultilang ident="D3_PDFDOCUMENTS_GIFTCARD_NET" suffix="COLON"}]
                </td>
                <td class="values">
                    [{$lang->formatCurrency($giftCardPrice->getNettoPrice(), $currency)}] [{$currency->name}]
                </td>
            </tr>
            <tr class="wrappingtax">
                <td class="indent"></td>
                <td class="description">
                    [{oxmultilang ident="D3_PDFDOCUMENTS_UNDEFINED_TAX" suffix="COLON"}]
                </td>
                <td class="values">
                    [{$lang->formatCurrency($giftCardPrice->getVATValue(), $currency)}] [{$currency->name}]
                </td>
            </tr>
        [{else}]
            <tr class="wrapping">
                <td class="indent"></td>
                <td class="description">
                    [{oxmultilang ident="D3_PDFDOCUMENTS_GIFTCARD" suffix="COLON"}]
                </td>
                <td class="values">
                    [{$lang->formatCurrency($order->getFieldData('oxgiftcardcost'), $currency)}] [{$currency->name}]
                </td>
            </tr>
        [{/if}]
    [{/if}]
[{/block}]

[{block name="totalsum"}]
    <tr class="totalseparator">
        <td class="indent"></td>
        <td class="description"></td>
        <td class="values"></td>
    </tr>
    <tr class="totalsum">
        <td class="indent"></td>
        <td class="description">
            [{oxmultilang ident="D3_PDFDOCUMENTS_TOTALSUMBRUT" suffix="COLON"}]
        </td>
        <td class="values">
            [{$order->getFormattedTotalOrderSum()}] [{$currency->name}]
        </td>
    </tr>
[{/block}]