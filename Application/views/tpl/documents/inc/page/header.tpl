[{assign var="showLogo" value=$showLogo|default:true}]

[{block name="pdfHeader"}]
    <div class="header">
        [{if $showLogo}]
            <img class="logo" alt="Logo" src="[{$oViewConf->getImageUrl('pdf_logo.jpg')}]">
        [{/if}]
    </div>
[{/block}]