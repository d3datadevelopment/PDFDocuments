[{block name="pdfFooter"}]
<table class="pdf_footer_table" cellspacing="0">
    <tr>
        [{block name="shop_basic_information"}]
        <td class="footer_parts">
            <div>[{$shop->oxshops__oxname->value}]</div>
            <div>[{$shop->oxshops__oxstreet->value}]</div>
            <div>[{$shop->oxshops__oxzip->value}] [{$shop->oxshops__oxcity->value}]</div>
            <div>[{$shop->oxshops__oxcountry->value}]</div>
            <div>[{$shop->oxshops__oxurl->value}]</div>
            <div>[{$shop->oxshops__oxinfoemail->value}]</div>
        </td>
        [{/block}]
        [{block name="owner_basic_information"}]
        <td class="vertical-a footer_parts">
            <div>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_MANAGINGDIRECTOR"}][{$shop->oxshops__oxfname->value}] [{$shop->oxshops__oxlname->value}]</div>
            <div>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_COURT"}] [{$shop->oxshops__oxcourt->value}]</div>
            <div>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_HRBNR"}][{$shop->oxshops__oxhrbnr->value}]</div>
            <div>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTID"}][{$shop->oxshops__oxvatnumber->value}]</div>
        </td>
        [{/block}]
        [{block name="bank_basic_information"}]
        <td class="vertical-a footer_parts">
            <div>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_BANKVERBINDUNG"}]</div>
            <div>[{$shop->oxshops__oxbankname->value}]</div>
            <div>[{oxmultilang ident="ORDER_OVERVIEW_PDF_ACCOUNTNR"}][{$shop->oxshops__oxibannumber->value}]</div>
            <div>[{oxmultilang ident="ORDER_OVERVIEW_PDF_BANKCODE"}][{$shop->oxshops__oxbiccode->value}]</div>
        </td>
        [{/block}]
    </tr>
</table>
[{/block}]