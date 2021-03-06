<div class="informations">
    <div class="contactinformations">
        [{block name="pdfContactInformations"}]
            <div class="headline">
                [{oxmultilang ident="D3_PDFDOCUMENTS_GET_IN_CONTACT"}]
            </div>
            <div>
                [{oxmultilang ident="D3_PDFDOCUMENTS_TELEFON" suffix="COLON"}] [{$shop->getFieldData('oxtelefon')}]
            </div>
            <div>
                [{oxmultilang ident="D3_PDFDOCUMENTS_FAX" suffix="COLON"}] [{$shop->getFieldData('oxtelefax')}]
            </div>
            <div>
                [{oxmultilang ident="D3_PDFDOCUMENTS_EMAIL" suffix="COLON"}] [{$shop->getFieldData('oxinfoemail')}]
            </div>
        [{/block}]
    </div>

    <div class="bankaccountinformations">
        [{block name="pdfBankaccountInformations"}]
            <div class="headline">
                [{oxmultilang ident="D3_PDFDOCUMENTS_BANK_ACCOUNT"}]
            </div>
            <div>
                [{$shop->getFieldData('oxbankname')}]
            </div>
            <div>
                [{oxmultilang ident="D3_PDFDOCUMENTS_BANK_ACCOUNTNR" suffix="COLON"}] [{$shop->getFieldData('oxibannumber')}]
            </div>
            <div>
                [{oxmultilang ident="D3_PDFDOCUMENTS_BANK_BANKCODE_HEADER" suffix="COLON"}] [{$shop->getFieldData('oxbiccode')}]
            </div>
        [{/block}]
    </div>

    [{if $documentinformationfile}]
        [{include file=$documentinformationfile}]
    [{/if}]
</div>