[{assign var="defaultPagePadding" value=","|explode:"45,20,20,25"}]
[{assign var="pagePadding" value=$pagePadding|default:$defaultPagePadding}]

[{* fold marks *}]
<div class="marks foldtop">a</div>
<div class="marks foldbottom">b</div>

[{* punch mark *}]
<div class="marks punch">c</div>

<style type="text/css">
    .marks {
        position: absolute;
        left: [{math equation="left - padding" left=5 padding=$pagePadding.3}]mm ;
        margin-left: 0;
        width: 7px;
        height: 0;
        border-top: 1px solid silver;
    }

    .marks.foldtop {
        top: [{math equation="top - padding" top=105 padding=$pagePadding.0}]mm
    }

    .marks.foldbottom {
        top: [{math equation="top - padding" top=210 padding=$pagePadding.0}]mm
    }

    .marks.punch {
        top: [{math equation="top - padding" top=148.5 padding=$pagePadding.0}]mm
    }
</style>