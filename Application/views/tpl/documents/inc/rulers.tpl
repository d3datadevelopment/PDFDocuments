[{* rulers *}]

<style type="text/css">
    .rulerItemHo {
        position: absolute;
        top: 0;
        width: 0;
        height: 7px;
        color: blue;
        border-left: 1px solid blue
    }

    .rulerItemVe {
        position: absolute;
        left: 0;
        width: 7px;
        height: 0;
        color: blue;
        border-top: 1px solid blue
    }
</style>

[{* horizontal *}]
[{section name=rulerItemsHo start=10 step=10 loop=600}]
    <div class="ruleritemHo" style="left: [{$smarty.section.rulerItemsHo.index}]mm">[{$smarty.section.rulerItemsHo.index}]</div>
[{/section}]

[{* vertical *}]
[{section name=rulerItemsVe start=0 step=10 loop=600}]
    <div class="ruleritemVe" style="top: [{$smarty.section.rulerItemsVe.index}]mm">[{$smarty.section.rulerItemsVe.index}]</div>
[{/section}]


