[{block name="informations"}]
    <div class="documentinformations">
        [{block name="pdfDocumentInformations"}]
            <div>
                [{assign var="dateFormat" value='D3_PDFDOCUMENTS_DATE_FORMAT'|oxmultilangassign}]
                [{oxmultilang ident="D3_PDFDOCUMENTS_DATE"}] [{$smarty.now|date_format:$dateFormat}]
            </div>
        [{/block}]
    </div>
[{/block}]