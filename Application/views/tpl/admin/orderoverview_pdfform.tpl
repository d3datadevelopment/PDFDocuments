[{if $edit && $oView->d3CanExport()}]
    <br>
    <form name="myedit2" id="myedit2" action="[{$oViewConf->getSelfLink()}]" method="post" target="expPDF">
        [{$oViewConf->getHiddenSid()}]
        <input type="hidden" name="cl" value="order_overview">
        <input type="hidden" name="fnc" value="d3CreatePDF">
        <input type="hidden" name="oxid" value="[{$oxid}]">
        <table style="border-spacing: 0;border-collapse: collapse;padding: 5px;border : 1px #A9A9A9 solid; width:220px">
            <tr>
                <td rowspan="3">
                    <img src="[{$oViewConf->getImageUrl()}]/pdf_icon.gif" style="width: 41px; height: 38px; border: none;" alt="" hspace="0" vspace="0" align="absmiddle">
                </td>
                <td style="vertical-align: top; text-align: right" class="edittext">
                    <label for="pdftype">[{oxmultilang ident="D3_PDFDOCUMENTS_PDF_TYPE"}]</label>:&nbsp;
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
                    <label for="pdflanguage">[{oxmultilang ident="GENERAL_LANGUAGE"}]</label>
                    <select id="pdflanguage" name="pdflanguage" class="saveinnewlanginput" style="width:80px;">
                        [{foreach from=$alangs key=lang item=slang}]
                            <option value="[{$lang}]" [{if $lang == "0"}]SELECTED[{/if}]>[{$slang}]</option>
                        [{/foreach}]
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: right" class="edittext"><br/>
                    <input type="submit" class="edittext" name="save" value="[{oxmultilang ident="D3_PDFDOCUMENTS_PDF_GENERATE"}]">
                    <iframe name="expPDF" style="width: 0; height: 0; border: none; display:none;"></iframe>
                </td>
            </tr>
        </table>
    </form>
[{/if}]
