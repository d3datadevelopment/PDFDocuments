[{assign var= currency      value= $order->getOrderCurrency()}]
[{assign var= deliveryPrice value= $order->getOrderDeliveryPrice()}]

<style type="text/css">
	[{include file="d3delnote_pdf_style.css"}],
	[{include file="d3pdfstyle.css"}]
</style>

<page backtop="30mm" backbottom="30mm" backleft="10mm" backright="10mm" pageset="new">
	<page_header>
        [{block name="pdfTopingFile"}]
		    [{include file="d3pdfheader.tpl" showLogo=true}]
        [{/block}]
	</page_header>
	<page_footer>
        [{block name="pdfFooterFile"}]
            [{include file="d3pdffooter.tpl"}]
        [{/block}]
	</page_footer>

	[{* +++++ main page part +++++ *}]
    [{block name="pdfHeadingFile"}]
        [{block name="pdfHeaderFile"}]
            [{include file="d3delnote_pdf_addressarea.tpl"}]
        [{/block}]
    [{/block}]
	[{* +++++Artikeltabelle+++++*}]
    [{block name="articleListing"}]
        <table class="deliveryNote_table border-bottom" cellspacing="0">
            <tr>
                <td class="dN_width20 order_article_PaddingBottom5 border-bottom">
                    <div class="vertical-a dN_fontSize12">
                        [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_AMOUNT"}]
                    </div>
                </td>
                <td class="dN_width80 order_article_PaddingBottom5 border-bottom">
                    <div class="dN_fontSize12">
                        [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DESCRIPTION"}]
                    </div>
                </td>
            </tr>
        [{foreach from=$order->getOrderArticles(true) item=oOrderArticle}]
						<tr>
                <td class="dN_width20 dN_paddingTopBottom5 vertical-a">
                    <div class="dN_width20 dN_paddingLeft12 dN_fontSize12">
                        [{$oOrderArticle->getFieldData('oxamount')}]
                    </div>
                </td>
                <td class="dN_width80 dN_paddingTopBottom5 vertical-a">
                    <div class="dN_fontSize12">
                        [{$oOrderArticle->getFieldData('oxtitle')}] [{$oOrderArticle->getFieldData('oxselvariant')}]<br>
                        <span class="dN_fontSize8">
                            [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ARTNR"}] [{$oOrderArticle->getFieldData('oxartnum')}]
                        </span>
                    </div>
                </td>
            </tr>
        [{/foreach}]
        </table>
    [{/block}]
	<nobreak>
  [{block name="articleCosts"}][{/block}]
	[{block name="pdfPastThankFile"}]
        [{include file="d3delnote_pdf_conclusion.tpl"}]
	[{/block}]
	</nobreak>
</page>