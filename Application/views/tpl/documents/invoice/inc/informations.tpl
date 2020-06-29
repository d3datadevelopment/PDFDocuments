[{block name="informations"}]
    <div class="documentinformations">
        [{block name="pdfDocumentInformations"}]
            <div>
                [{oxmultilang ident="D3_PDFDOCUMENTS_ORDERBILLNR"}] [{$order->getFieldData('oxbillnr')}]
            </div>
            <div>
                [{oxmultilang ident="D3_PDFDOCUMENTS_CUSTOMERNR"}] [{$user->getFieldData('oxcustnr')}]
            </div>
            <div>
                [{assign var="dateFormat" value='D3_PDFDOCUMENTS_DATE_FORMAT'|oxmultilangassign}]
                [{oxmultilang ident="D3_PDFDOCUMENTS_DATE"}] [{$order->getFieldData('oxbilldate')|date_format:$dateFormat}]
            </div>
            <div>
                [{oxmultilang ident="D3_PDFDOCUMENTS_USTIDNR"}] [{$shop->getFieldData('oxvatnumber')}]
            </div>
        [{/block}]
    </div>
[{/block}]