[{block name="conclusion"}]
    <table class="conclusion_table">
        [{block name="conclusion_paymethod"}]
            <tr>
                <td>
                    [{oxmultilang ident="D3_PDFDOCUMENTS_USED_PAYMENTMETHOD" suffix="COLON"}]
                    [{$payment->getFieldData('oxdesc')}]
                </td>
            </tr>
        [{/block}]
        <tr>
            <td>
                [{oxmultilang ident="D3_PDFDOCUMENTS_THANKYOU_1"}]
            </td>
        </tr>
        <tr>
            <td>
                [{oxmultilang ident="D3_PDFDOCUMENTS_THANKYOU_2" args=$shop->getFieldData('oxname')}]
            </td>
        </tr>
    </table>
[{/block}]
