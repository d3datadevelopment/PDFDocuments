[{block name="pdfPastThankFile"}]
    <table class="past_thank_width100 borderSpacingUnset paddingTop10">
        <tr>
            <td class="paddingTop15 past_thank_width100 fontSize12">
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USED_PAYMENTMETHOD"}]
                [{$payment->getFieldData('oxdesc')}]
            </td>
        </tr>
    [{* +++++++Individueller Zahlungstext+++++++ *}]
    [{if $order->getFieldData('d3pdftextbestellbestaetigung')}]
        <tr>
            <td class="past_thank_width100 fontSize12">
                [{$order->getFieldData('d3pdftextbestellbestaetigung')|nl2br}]
            </td>
        </tr>
    [{/if}]
        [{d3modcfgcheck modid="d3heidelpay"}][{/d3modcfgcheck}]
        [{if $order->getHeidelpayBankTransferData()}]
            <tr>
                <td class="eraseBug past_thank_width100 paddingTop10 fontSize12">
                    [{include file="d3Heidelpay_bank_data.tpl"}]
                </td>
            </tr>
        [{else}]
            <tr>
                <td class="past_thank_width100 paddingTop10 fontSize12">
                    [{$payment->getFieldData('d3shortdescpdf')|nl2br}]
                </td>
            </tr>
        [{/if}]
        [{**Schlusstext/ Abschied***}]
        <tr>
            <td class="eraseBug past_thank_width100 fontSize12">
                [{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_1"}]
            </td>
        </tr>
        <tr>
            <td class="past_thank_width100 fontSize12">
                [{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_2"}]
            </td>
        </tr>
    </table>
[{/block}]
