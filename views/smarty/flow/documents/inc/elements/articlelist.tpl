[{assign var="currency"   value=$order->getOrderCurrency()}]
[{assign var="showPrices" value=$showPrices|default:true}]

[{block name="articlelist"}]
    <table class="article_table[{if $showPrices}]_prices[{/if}]">
        <tr>
            <th class="amount">
                [{oxmultilang ident="D3_PDFDOCUMENTS_AMOUNT"}]
            </th>
            <th class="description">
                [{oxmultilang ident="D3_PDFDOCUMENTS_DESCRIPTION"}]
            </th>
            [{if $showPrices}]
                <th class="tax">
                    [{oxmultilang ident="D3_PDFDOCUMENTS_USTPERCENTAGE"}]
                </th>
                <th class="unitPrice">
                    [{oxmultilang ident="D3_PDFDOCUMENTS_UNITPRICE"}]
                </th>
                <th class="totalPrice">
                    [{oxmultilang ident="D3_PDFDOCUMENTS_TOTALPRICE"}]
                </th>
            [{/if}]
        </tr>
        [{foreach from=$order->getOrderArticles(true) item=orderArticle}]
            <tr>
                <td class="amount">
                    [{$orderArticle->getFieldData('oxamount')}]
                </td>
                <td class="description">
                    [{$orderArticle->getFieldData('oxtitle')}] [{$orderArticle->getFieldData('oxselvariant')}]
                    <br>
                    <span class="artnr">
                        [{oxmultilang ident="D3_PDFDOCUMENTS_ARTNR"}] [{$orderArticle->getFieldData('oxartnum')}]
                    </span>
                </td>
                [{if $showPrices}]
                    <td class="tax">
                        [{$orderArticle->getFieldData('oxvat')}]
                    </td>
                    <td class="unitPrice">
                        [{$orderArticle->getBrutPriceFormated()}] [{$currency->name}]
                    </td>
                    <td class="totalPrice">
                        [{$orderArticle->getTotalBrutPriceFormated()}] [{$currency->name}]
                    </td>
                [{/if}]
            </tr>
        [{/foreach}]
    </table>
[{/block}]
[{if $showPrices}]
    [{block name="articleCosts"}]
        <nobreak>
            <table class="article_costs_table">
                [{block name="d3_article_costs_summary"}]
                    [{include file="@d3PdfDocuments/documents/inc/elements/d3pdfarticlecostsummary.tpl"}]
                [{/block}]
            </table>
        </nobreak>
    [{/block}]
[{/if}]