[{block name="articlelist"}]
    <table class="article_table">
        <tr>
            <th class="amount">
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_AMOUNT"}]
            </th>
            <th class="description">
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_DESCRIPTION"}]
            </th>
            <th class="tax">
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_USTPERCENTAGE"}]
            </th>
            <th class="unitPrice">
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_UNITPRICE"}]
            </th>
            <th class="totalPrice">
                [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_TOTALPRICE"}]
            </th>
        </tr>
        [{foreach from=$order->getOrderArticles(true) item=oOrderArticle}]
            <tr>
                <td class="amount">
                    [{$oOrderArticle->oxorderarticles__oxamount->value }]
                </td>
                <td class="description">
                    [{$oOrderArticle->oxorderarticles__oxtitle->getRawValue() }] [{ $oOrderArticle->oxorderarticles__oxselvariant->getRawValue() }]
                    <br>
                    <span class="artnr">
                        [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ARTNR"}] [{$oOrderArticle->oxorderarticles__oxartnum->value }]
                    </span>
                </td>
                <td class="tax">
                    [{$oOrderArticle->oxorderarticles__oxvat->value }]
                </td>
                <td class="unitPrice">
                    [{$oOrderArticle->getBrutPriceFormated()}] [{$currency->name}]
                </td>
                <td class="totalPrice">
                    [{$oOrderArticle->getTotalBrutPriceFormated()}] [{$currency->name}]
                </td>
            </tr>
        [{/foreach}]
    </table>
[{/block}]
[{block name="articleCosts"}]
    <table class="article_costs_table border-bottom">
        <tr>
            [{block name="d3_article_costs_summary"}]
                [{include file="d3pdfarticlecostsummary.tpl"}]
            [{/block}]
        </tr>
    </table>
[{/block}]