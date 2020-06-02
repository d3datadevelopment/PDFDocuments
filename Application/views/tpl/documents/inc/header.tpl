[{assign var="showLogo" value=$showLogo|default:true}]

[{block name="pdfToping"}]
    <div class="pdf_header_positioning">
        [{if $showLogo}]
            <img alt="" src="[{$oViewConf->getImageUrl('Elektroversand-Schmidt_Logo_180.jpg')}]">
        [{/if}]
    </div>
[{/block}]