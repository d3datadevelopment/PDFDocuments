[{block name="pdfPastThankFile"}]
    <table class="past_thank_width100" cellspacing="0">
        <tr><td class="past_thank_width100">&nbsp;</td></tr>
        <tr><td class="past_thank_width100 fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USED_PAYMENTMETHOD"}][{$payment->oxpayments__oxdesc->value}]</td></tr>
    [{* +++++++Individueller Zahlungstext+++++++ *}]
    [{if $order->oxorder__d3pdftextbestellbestaetigung->value}]
        <tr><td class="past_thank_width100 fontSize12">[{$order->oxorder__d3pdftextbestellbestaetigung->value}]</td></tr>
    [{else}]
        <tr><td class="past_thank_width100 fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USED_GREETINGSORDER"}]</td></tr>
    [{/if}]
    [{*+++++++++++*}]
        <tr><td class="past_thank_width100">&nbsp;</td></tr>
        <tr><td class="past_thank_width100 fontSize12">[{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_1"}]</td></tr>
        <tr><td class="past_thank_width100 fontSize12">[{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_2"}]</td></tr>
    </table>
[{/block}]