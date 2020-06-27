[{block name="conclusion"}]
    <table class="past_thank_width100 borderSpacingUnset paddingTop10">
        <tr>
            <td class="paddingTop15 past_thank_width100 fontSize12">
                [{block name="conclusion_paymethod"}]
                    [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USED_PAYMENTMETHOD"}]
                    [{$payment->getFieldData('oxdesc')}]
                [{/block}]
            </td>
        </tr>
        <tr>
            <td class="past_thank_width100 fontSize12">
                [{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_1"}]
            </td>
        </tr>
        <tr>
            <td class="past_thank_width100 fontSize12">
                [{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_2"}] [{$shop->oxshops__oxname->value}]
            </td>
        </tr>
    </table>
[{/block}]
