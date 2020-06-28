<div class="informations">
    <div class="contactinformations">
        [{block name="pdfContactInformations"}]
            <div class="headline">
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_GET_IN_CONTACT"}]
            </div>
            <div>
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_TELEFON"}][{$shop->getFieldData('oxtelefon')}]
            </div>
            <div>
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_FAX"}][{$shop->getFieldData('oxtelefax')}]
            </div>
            <div>
                [{$shop->getFieldData('oxinfoemail')}]
            </div>
        [{/block}]
    </div>

    <div class="bankaccountinformations">
        [{block name="pdfBankaccountInformations"}]
            <div class="headline">
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_BANKVERBINDUNG"}]
            </div>
            <div>
                [{$shop->getFieldData('oxbankname')}]
            </div>
            <div>
                [{oxmultilang ident="ORDER_OVERVIEW_PDF_ACCOUNTNR"}][{$shop->getFieldData('oxibannumber')}]
            </div>
            <div>
                [{oxmultilang ident="ORDER_OVERVIEW_PDF_BANKCODE_HEADER"}][{$shop->getFieldData('oxbiccode')}]
            </div>
        [{/block}]
    </div>

    [{if $documentinformationfile}]
        [{include file=$documentinformationfile}]
    [{/if}]
</div>