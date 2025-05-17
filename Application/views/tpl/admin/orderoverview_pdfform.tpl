[{if $edit && $oView->d3CanExport()}]
    <br>
    [{assign var="config" value=$oViewConf->getConfig()}]
    [{assign var="devmode" value=$config->getConfigParam('d3PdfDocumentsbDev')}]

    <form name="d3CreatePdf" id="d3CreatePdf" action="[{$oViewConf->getSelfLink()}]" method="post" target="d3ExpPDF">
        [{$oViewConf->getHiddenSid()}]
        <input type="hidden" name="cl" value="order_overview">
        <input type="hidden" name="fnc" value="d3CreatePDF">
        <input type="hidden" name="oxid" value="[{$oxid}]">
        [{if $devmode}]<input type="hidden" id="devmode" name="devmode" value="0">[{/if}]
        <fieldset style="padding: 5px">
            <legend>[{oxmultilang ident="D3_PDFDOCUMENTS"}]</legend>
            <table style="width: 100%">
                <tr>
                    <td rowspan="3">
                        <img src="[{$oViewConf->getModuleUrl('d3PdfDocuments', 'out/img/pdf.svg')}]" style="height:4em;width:4em" alt="[{oxmultilang ident="D3_PDFDOCUMENTS"}]">
                    </td>
                    <td style="vertical-align: top; text-align: right" class="edittext">
                        <label for="pdftype">[{oxmultilang ident="D3_PDFDOCUMENTS_PDF_TYPE" suffix="COLON"}]</label>:&nbsp;
                        <select id="pdftype" name="pdftype" class="editinput" style="width:80px;">
                            [{block name="d3_pdfdocuments_order_overview_pdfTypeOptions"}]
                                [{assign var="generatorList" value=$oView->d3getGeneratorList()}]
                                [{foreach from=$generatorList->getList() item="generator"}]
                                    <option value="[{$generator->getRequestId()}]">[{oxmultilang ident=$generator->getTitleIdent()}]</option>
                                [{/foreach}]
                            [{/block}]
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" class="edittext">
                        <label for="pdflanguage">[{oxmultilang ident="D3_PDFDOCUMENTS_LANGUAGE" suffix="COLON"}]</label>
                        <select id="pdflanguage" name="pdflanguage" class="saveinnewlanginput" style="width:80px;">
                            [{foreach from=$alangs key=lang item=slang}]
                                <option value="[{$lang}]" [{if $lang == "0"}]SELECTED[{/if}]>[{$slang}]</option>
                            [{/foreach}]
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" class="edittext"><br/>
                        [{if $devmode}]
                            <input type="submit" class="edittext" name="save" value="[{oxmultilang ident="D3_PDFDOCUMENTS_SGML_GENERATE"}]" onclick="document.getElementById('devmode').value = 1;">
                        [{/if}]
                        <input type="submit" class="edittext" name="save" value="[{oxmultilang ident="D3_PDFDOCUMENTS_PDF_GENERATE"}]" [{if $devmode}] onclick="document.getElementById('devmode').value = 0;"[{/if}]>
                        <iframe name="d3ExpPDF" style="width: 0; height: 0; border: none; display:none;"></iframe>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
[{/if}]
