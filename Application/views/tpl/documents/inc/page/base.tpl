[{assign var="pageset" value=$pageset|default:"new"}]
[{assign var="orientation" value=$orientation|default:"P"}]
[{assign var="format" value=$format|default:"A4"}]
[{assign var="defaultPagePadding" value=","|explode:"45,15,25,25"}] [{* top, right, bottom, left *}]
[{assign var="pagePadding" value=$pagePadding|default:$defaultPagePadding}]

<style>
    [{foreach from=$pdfBlock_style item="_block"}]
        [{$_block}]
    [{/foreach}]
</style>

<page
    [{block name="pageSettings"}]
        backtop="[{$pagePadding.0}]mm"
        backright="[{$pagePadding.1}]mm"
        backbottom="[{$pagePadding.2}]mm"
        backleft="[{$pagePadding.3}]mm"
        pageset="[{$pageset}]"
        orientation="[{$orientation}]"
        format="[{$format}]"
[{*        [{if $showLogo}]backimg="bgimg.jpg" [{/if}] *}]
[{*        backcolor="#FFF"  *}]
[{*        backimgx="center" *}]
[{*        backimgy="middle" *}]
[{*        backimgw="100%"   *}]
    [{/block}]
>
    <page_header>
        [{foreach from=$pdfBlock_header item="_block"}]
            [{$_block}]
        [{/foreach}]
    </page_header>

    <page_footer>
        [{foreach from=$pdfBlock_footer item="_block"}]
            [{$_block}]
        [{/foreach}]
    </page_footer>

    [{foreach from=$pdfBlock_content item="_block"}]
        [{$_block}]
    [{/foreach}]
</page>