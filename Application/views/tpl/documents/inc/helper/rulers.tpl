[{assign var="defaultPagePadding" value=","|explode:"45,20,10,25"}] [{* top, right, bottom, left *}]
[{assign var="pagePadding" value=$pagePadding|default:$defaultPagePadding}]

[{* rulers *}]
[{* include file="d3pdfrulers.tpl" pagePadding=$pagePadding *}]

<style type="text/css">
    .rulerItemHorizontal {
        position: absolute;
        top: 0;
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
    <div class="rulerItemVertical" style="top: [{$smarty.section.rulerItemsVe.index}]mm">[{$smarty.section.rulerItemsVertical.index}]</div>
[{/section}]


