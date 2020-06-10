[{assign var="pageset" value=$pageset|default:"new"}]
[{assign var="orientation" value=$orientation|default:"P"}]
[{assign var="format" value=$format|default:"A4"}]

<style type="text/css">
    [{foreach from=$pdfBlock_style item="_block"}]
        [{$_block}]
    [{/foreach}]
</style>

<page pageset="[{$pageset}]" orientation="[{$orientation}]" format="[{$format}]">
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