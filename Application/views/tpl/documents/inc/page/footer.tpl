[{assign var="defaultPagePadding" value=","|explode:"45,15,25,25"}] [{* top, right, bottom, left *}]
[{assign var="pagePadding" value=$pagePadding|default:$defaultPagePadding}]

[{block name="pdfFooter"}]
    <div class="footer" style="margin: 0 [{$pagePadding.1}]mm 10mm [{$pagePadding.3}]mm">
        <table>
            <tr>
                [{block name="pdfFooterLeft"}]
                    <td class="footerLeft">
                        <div>[{$shop->oxshops__oxname->value}]</div>
                        <div>[{$shop->oxshops__oxstreet->value}]</div>
                        <div>[{$shop->oxshops__oxzip->value}] [{$shop->oxshops__oxcity->value}]</div>
                        <div>[{$shop->oxshops__oxcountry->value}]</div>
                        <div>[{$shop->oxshops__oxurl->value}]</div>
                        <div>[{$shop->oxshops__oxinfoemail->value}]</div>
                    </td>
                [{/block}]
                [{block name="pdfFooterCenter"}]
                    <td class="footerCenter">
                        <div>[{oxmultilang ident="D3_PDFDOCUMENTS_MANAGINGDIRECTOR"}] [{$shop->getFieldData('oxfname')}] [{$shop->getFieldData('oxlname')}]</div>
                        <div>[{oxmultilang ident="D3_PDFDOCUMENTS_COURT"}] [{$shop->getFieldData('oxcourt')}]</div>
                        <div>[{oxmultilang ident="D3_PDFDOCUMENTS_HRBNR"}] [{$shop->getFieldData('oxhrbnr')}]</div>
                        <div>[{oxmultilang ident="D3_PDFDOCUMENTS_USTID"}] [{$shop->getFieldData('oxvatnumber')}]</div>
                    </td>
                [{/block}]
                [{block name="pdfFooterRight"}]
                    <td class="footerRight">
                        <div>[{oxmultilang ident="D3_PDFDOCUMENTS_BANK_ACCOUNT"}]</div>
                        <div>[{$shop->getFieldData('oxbankname')}]</div>
                        <div>[{oxmultilang ident="D3_PDFDOCUMENTS_BANK_ACCOUNTNR"}] [{$shop->getFieldData('oxibannumber')}]</div>
                        <div>[{oxmultilang ident="D3_PDFDOCUMENTS_BANK_BANKCODE"}] [{$shop->getFieldData('oxbiccode')}]</div>
                    </td>
                [{/block}]
            </tr>
        </table>
    </div>

[{/block}]