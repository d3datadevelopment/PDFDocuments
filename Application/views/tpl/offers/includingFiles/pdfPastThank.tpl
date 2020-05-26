[{block name="pdfPastThankFile"}]
    <table class="past_thank_width100 helvetica" cellspacing="0">
        <tr><td class="past_thank_width100">&nbsp;</td></tr>
        [{* material info *}]
        <tr><td style="font-size: 10px;" class="offers_pstThank_margin_top20 past_thank_width100"><i>[{oxmultilang ident="D3_OFFER_PDF_INFO"}][{$payment->oxpayments__oxdesc->value}]</i></td></tr>
        [{* price is inkl. *}]
        <tr><td class="offers_pstThank_margin_top20 past_thank_width100 fontSize12"><strong>[{oxmultilang ident="D3_OFFER_PDF_PRICEINFO"}]</strong></td></tr>
        <tr><td class="offers_pstThank_margin_top20 past_thank_width100 fontSize12">[{oxmultilang ident="D3_OFFER_PDF_OFFERTIME"}]</td></tr>
        [{* offer delay *}]
        <tr><td class="past_thank_width100 fontSize12">[{oxmultilang ident="D3_OFFER_PDF_OFFER"}]</td></tr>
        <tr><td class="offers_pstThank_margin_top20 past_thank_width100 fontSize12">[{oxmultilang ident="ORDER_OVERVIEW_PDF_GREETINGS_AUFTRAG_2"}]</td></tr>
    </table>
[{/block}]