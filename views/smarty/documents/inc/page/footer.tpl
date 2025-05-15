[{assign var="defaultPagePadding" value=","|explode:"45,15,25,25"}] [{* top, right, bottom, left *}]
[{assign var="pagePadding" value=$pagePadding|default:$defaultPagePadding}]

[{block name="pdfFooter"}]
    <div class="footer" style="margin: 0 [{$pagePadding.1}]mm 10mm [{$pagePadding.3}]mm">
        [{block name="pdfFooterTable"}]
            <table>
                <tr>
                    [{block name="pdfFooterLeft"}]
                        <td class="footerLeft">
                            <div>[{$shop->getFieldData('oxname')}]</div>
                            <div>[{$shop->getFieldData('oxstreet')}]</div>
                            <div>[{$shop->getFieldData('oxzip')}] [{$shop->getFieldData('oxcity')}]</div>
                            <div>[{$shop->getFieldData('oxcountry')}]</div>
                            <div>[{$shop->getFieldData('oxurl')}]</div>
                            <div>[{$shop->getFieldData('oxinfoemail')}]</div>
                        </td>
                    [{/block}]
                    [{block name="pdfFooterCenter"}]
                        <td class="footerCenter">
                            <div>[{oxmultilang ident="D3_PDFDOCUMENTS_MANAGINGDIRECTOR" suffix="COLON"}] [{$shop->getFieldData('oxfname')}] [{$shop->getFieldData('oxlname')}]</div>
                            <div>[{oxmultilang ident="D3_PDFDOCUMENTS_COURT" suffix="COLON"}] [{$shop->getFieldData('oxcourt')}]</div>
                            <div>[{oxmultilang ident="D3_PDFDOCUMENTS_HRBNR" suffix="COLON"}] [{$shop->getFieldData('oxhrbnr')}]</div>
                            <div>[{oxmultilang ident="D3_PDFDOCUMENTS_USTID" suffix="COLON"}] [{$shop->getFieldData('oxvatnumber')}]</div>
                        </td>
                    [{/block}]
                    [{block name="pdfFooterRight"}]
                        <td class="footerRight">
                            <div>[{oxmultilang ident="D3_PDFDOCUMENTS_BANK_ACCOUNT"}]</div>
                            <div>[{$shop->getFieldData('oxbankname')}]</div>
                            <div>[{oxmultilang ident="D3_PDFDOCUMENTS_BANK_ACCOUNTNR" suffix="COLON"}] [{$shop->getFieldData('oxibannumber')}]</div>
                            <div>[{oxmultilang ident="D3_PDFDOCUMENTS_BANK_BANKCODE" suffix="COLON"}] [{$shop->getFieldData('oxbiccode')}]</div>
                        </td>
                    [{/block}]
                </tr>
            </table>
        [{/block}]
    </div>
[{/block}]