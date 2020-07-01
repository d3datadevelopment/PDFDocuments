[{block name="conclusion"}]
    <nobreak>
        [{block name="conclusion_paymethod"}]
            <div class="conclusion_payment">
                [{oxmultilang ident="D3_PDFDOCUMENTS_USED_PAYMENTMETHOD" suffix="COLON"}]
                [{$payment->getFieldData('oxdesc')}]<br>

                [{include file="d3invoice_pdf_payinfo.tpl"}]
            </div>
        [{/block}]

        [{block name="conclusion_thankyou"}]
            <div class="conclusion_thankyou">
                [{oxmultilang ident="D3_PDFDOCUMENTS_THANKYOU_1"}]<br>
                [{oxmultilang ident="D3_PDFDOCUMENTS_THANKYOU_2" args=$shop->getFieldData('oxname')}]
            </div>
        [{/block}]
    </nobreak>
[{/block}]
