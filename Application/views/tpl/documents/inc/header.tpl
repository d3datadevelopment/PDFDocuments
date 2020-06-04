[{assign var="showLogo" value=$showLogo|default:true}]

[{block name="pdfToping"}]
    <div class="pdf_header_positioning">
        [{if $showLogo}]
            [{assign var="logoUrl" value=$oViewConf->getImageUrl('Elektroversand-Schmidt_Logo_180.jpg')}]
            [{if $logoUrl}]
                <img alt="" src="[{$logoUrl}]">
            [{/if}]
        [{/if}]
    </div>
[{/block}]