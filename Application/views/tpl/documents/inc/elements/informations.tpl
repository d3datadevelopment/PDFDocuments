<div class="informations">
    <div>
        [{block name="pdfContactInformations"}]
            <div class="aligning"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_GET_IN_CONTACT"}]</strong></div>
            <div class="aligning fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_TELEFON"}][{$shop->getFieldData('oxtelefon')}]</div>
            <div class="aligning fontSize12">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_FAX"}][{$shop->getFieldData('oxtelefax')}]</div>
            <div class="aligning fontSize12">[{$shop->getFieldData('oxinfoemail')}]</div>
        [{/block}]
    </div>

    <div>
        [{block name="pdfBankaccountInformations"}]
            <div class="aligning heading_order_paddingTop10"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_BANKVERBINDUNG"}]</strong></div>
            <div class="aligning">[{$shop->getFieldData('oxbankname')}]</div>
            <div class="aligning">[{oxmultilang ident="ORDER_OVERVIEW_PDF_ACCOUNTNR"}][{$shop->getFieldData('oxibannumber')}]</div>
            <div class="aligning">[{oxmultilang ident="ORDER_OVERVIEW_PDF_BANKCODE_HEADER"}][{$shop->getFieldData('oxbiccode')}]</div>
        [{/block}]
    </div>
    <div>
        [{block name="pdfDocumentInformations"}]
            <div class="aligning heading_order_paddingTop10">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILLNR"}][{$order->getFieldData('oxbillnr')}]</div>
            <div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_CUSTOMERNR"}] [{$user->getFieldData('oxcustnr')}]</div>
            <div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DATE"}][{$order->getFieldData('oxbilldate')|date_format:"%d.%m.%Y"}]</div>
            <div class="aligning">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTIDNR"}][{$shop->getFieldData('oxvatnumber')}]</div>
        [{/block}]
    </div>
</div>