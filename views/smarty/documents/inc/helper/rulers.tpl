[{assign var="defaultPagePadding" value=","|explode:"45,15,25,25"}] [{* top, right, bottom, left *}]
[{assign var="pagePadding" value=$pagePadding|default:$defaultPagePadding}]

[{* rulers *}]
[{* include file="@d3PdfDocuments/documents/inc/helper/rulers" pagePadding=$pagePadding *}]

<style>
    .rulerItemHorizontal {
        position: absolute;
        top: -[{$pagePadding.0}]mm;
        width: 0;
        height: 7px;
        color: blue;
        border-left: 1px solid blue
    }

    .rulerItemVertical {
        position: absolute;
        left: -[{$pagePadding.3}]mm;
        width: 7px;
        height: 0;
        color: blue;
        border-top: 1px solid blue
    }
</style>

[{* horizontal *}]
[{section name=rulerItemsHorizontal start=10 step=10 loop=600}]
    <div class="rulerItemHorizontal" style="left: [{math equation="left - padding" left=$smarty.section.rulerItemsHorizontal.index padding=$pagePadding.3}]mm">
        [{$smarty.section.rulerItemsHorizontal.index}]
    </div>
[{/section}]

[{* vertical *}]
[{section name=rulerItemsVertical start=0 step=10 loop=600}]
    <div class="rulerItemVertical" style="top: [{math equation="top - padding" top=$smarty.section.rulerItemsVertical.index padding=$pagePadding.0}]mm">
        [{$smarty.section.rulerItemsVertical.index}]
    </div>
[{/section}]


