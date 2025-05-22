[{assign var="showLogo" value=$showLogo|default:true}]

[{block name="pdfHeader"}]
    <div class="header header-[[page_cu]]">
        [{if $showLogo}]
            [{block name="pdfHeaderLogo"}]
                [{assign var="logoUrl" value=$config->getConfigParam('d3PdfDocumentsLogoUrl')|default:[{$oViewConf->getModulePath('d3PdfDocuments', 'out/img/clogo.jpg')}]}]
                <img class="logo" alt="Logo" src="[{$logoUrl}]">
            [{/block}]
        [{/if}]
    </div>
[{/block}]