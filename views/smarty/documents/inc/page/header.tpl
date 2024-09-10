[{assign var="showLogo" value=$showLogo|default:true}]

[{block name="pdfHeader"}]
    <div class="header">
        [{if $showLogo}]
            [{block name="pdfHeaderLogo"}]
                <img class="logo" alt="Logo" src="[{$oViewConf->getModulePath('d3PdfDocuments', 'out/img/clogo.jpg')}]">
            [{/block}]
        [{/if}]
    </div>
[{/block}]