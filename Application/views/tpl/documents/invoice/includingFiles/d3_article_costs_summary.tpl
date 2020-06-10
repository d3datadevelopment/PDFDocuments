[{* ++++++Beschreibung der Kostensummierung++++++ *}]
<td class="article_costs_table_paddingRight article_costs_table_desc_width70 ">
    <div class="order_sum fontSize12 border-bottom  order_article_PaddingBottom5">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_SUMBRUTTO"}]</div>
    [{if $order->getFormattedDiscount() != 0}]
    <div class="order_sum fontSize12 border-bottom spacing_order_info">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_DISCOUNT"}]</div>
    [{/if}]
    <div class="order_sum fontSize12 order_article_PaddingTop5">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_SUMNETTO"}]</div>
    [{foreach from=$productVats key=VatKey item=oVat}]
    <div class="order_sum fontSize12 border-bottom spacing_order_info">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAX"}] [{$VatKey}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_PERCENTAGE"}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAXPERCVALUE"}]</div>
    [{/foreach}]
    <div class="order_sum fontSize12 order_article_PaddingTop5">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_DELIVERY"}]</div>
    <div class="order_sum fontSize12 border-bottom spacing_order_info">[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAX"}] [{$VatKey}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_PERCENTAGE"}] [{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TAXPERCVALUE"}]</div>
    <div class="order_sum fontSize12 order_article_PaddingTop5 order_article_PaddingBottom5"><strong>[{oxmultilang ident="D3_ORDER_OVERVIEW_PDF_ORDERBILL_TOTALSUMBRUT"}]</strong></div>
</td>
[{* ++++++Kostensummierung++++++ *}]
<td class="article_costs_table_sum_width30">
    <div class="order_sumNum aligning fontSize12 border-bottom  order_article_PaddingBottom5">[{$order->getFormattedTotalBrutSum()}] [{$currency->name}]</div>
    [{if $order->getFormattedDiscount() != 0}]
    <div class="spacing_order_info order_sumNum aligning fontSize12 border-bottom">-[{$order->getFormattedDiscount()}] [{$currency->name}]</div>
    [{/if}]
    <div class="order_article_PaddingTop5 order_sumNum aligning fontSize12">[{$order->getFormattedTotalNetSum()}] [{$currency->name}]</div>
    <div class="spacing_order_info order_sumNum aligning fontSize12 border-bottom">[{$lang->formatCurrency($oVat, $currency)}] [{$currency->name}]</div>
    <div class="order_article_PaddingTop5 order_sumNum aligning fontSize12">[{$lang->formatCurrency($deliveryPrice->getNettoPrice(), $currency)}] [{$currency->name}]</div>
    <div class="order_article_PaddingTop5 order_article_PaddingBottom5 order_sumNum aligning fontSize12 border-bottom">[{$lang->formatCurrency($deliveryPrice->getVATValue(), $currency)}] [{$currency->name}]</div>
    <div class="order_article_PaddingTop5 order_article_PaddingBottom5 order_sumNum aligning fontSize12"><strong>[{$order->getFormattedTotalOrderSum()}] [{$currency->name}]</strong></div>
</td>