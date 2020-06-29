[{block name="conclusion"}]
    <table class="conclusion_table">
        [{block name="conclusion_paymethod"}]
            <tr>
                <td>
                    [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USED_PAYMENTMETHOD"}]
                    [{$payment->getFieldData('oxdesc')}]
                </td>
            </tr>
        [{/block}]
        <tr>
            <td>
                [{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_1"}]
            </td>
        </tr>
        <tr>
            <td>
                [{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_2"}] [{$shop->oxshops__oxname->value}]
            </td>
        </tr>
    </table>
[{/block}]
