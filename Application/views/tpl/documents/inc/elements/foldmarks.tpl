[{assign var="defaultPagePadding" value=","|explode:"45,15,25,25"}] [{* top, right, bottom, left *}]
[{assign var="pagePadding" value=$pagePadding|default:$defaultPagePadding}]

<style type="text/css">
    .marks {
        position: absolute;
        left: [{math equation="left - padding" left=5 padding=$pagePadding.3}]mm ;
        margin-left: 0;
        width: 7px;
        height: 0;
        border-top: 1px solid silver;
    }

    .foldtop {
        top: [{math equation="top - padding" top=105 padding=$pagePadding.0}]mm
    }

    .foldbottom {
        top: [{math equation="top - padding" top=210 padding=$pagePadding.0}]mm
    }

    .punch {
        top: [{math equation="top - padding" top=148.5 padding=$pagePadding.0}]mm
    }
</style>

[{* fold marks *}]
<div class="marks foldtop"></div>
<div class="marks foldbottom"></div>

[{* punch mark *}]
<div class="marks punch"></div>