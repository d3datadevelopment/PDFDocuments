[{block name="informations"}]
    <div class="documentinformations">
        [{block name="pdfDocumentInformations"}]
            <div>
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILLNR"}][{$order->getFieldData('oxbillnr')}]
            </div>
            <div>
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_CUSTOMERNR"}] [{$user->getFieldData('oxcustnr')}]
            </div>
            <div>
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DATE"}][{$order->getFieldData('oxbilldate')|date_format:"%d.%m.%Y"}]
            </div>
            <div>
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTIDNR"}][{$shop->getFieldData('oxvatnumber')}]
            </div>
        [{/block}]
    </div>
[{/block}]