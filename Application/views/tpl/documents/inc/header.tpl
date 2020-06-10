[{assign var="showLogo" value=$showLogo|default:true}]

[{block name="pdfToping"}]
    <div class="pdf_header_positioning">
        [{if $showLogo}]
            <img alt="" src="[{$oViewConf->getImageUrl('pdf_logo.jpg')}]">
        [{/if}]
    </div>
[{/block}]