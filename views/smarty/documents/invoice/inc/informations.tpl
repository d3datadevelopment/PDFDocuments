[{block name="informations"}]
    <div class="documentinformations">
        [{block name="pdfDocumentInformations"}]
            <div>
                [{oxmultilang ident="D3_PDFDOCUMENTS_ORDERBILLNR" suffix="COLON"}] [{$order->getFieldData('oxbillnr')}]
            </div>
            <div>
                [{oxmultilang ident="D3_PDFDOCUMENTS_CUSTOMERNR" suffix="COLON"}] [{$user->getFieldData('oxcustnr')}]
            </div>
            <div>
                [{assign var="dateFormat" value='D3_PDFDOCUMENTS_DATE_FORMAT'|oxmultilangassign}]
                [{oxmultilang ident="D3_PDFDOCUMENTS_DATE" suffix="COLON"}] [{$order->getFieldData('oxbilldate')|date_format:$dateFormat}]
            </div>
            [{if $shop->getFieldData('oxvatnumber')}]
                <div>
                    [{oxmultilang ident="D3_PDFDOCUMENTS_USTIDNR" suffix="COLON"}] [{$shop->getFieldData('oxvatnumber')}]
                </div>
            [{/if}]
        [{/block}]
    </div>
[{/block}]