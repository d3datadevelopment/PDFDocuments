[{assign var="showLogo" value=$showLogo|default:true}]

[{block name="pdfHeader"}]
    <div class="header header-[[page_cu]]">
        [{if $showLogo}]
            [{block name="pdfHeaderLogo"}]
                [{assign var="logoUrlSetting" value=$config->getConfigParam('d3PdfDocumentsLogoUrl')}]
                [{assign var="logoUrlDefault" value=$oViewConf->getModulePath('d3PdfDocuments', 'out/img/clogo.jpg')}]
                [{assign var="logoUrl" value=$logoUrlSetting|default:$logoUrlDefault}]
                <img class="logo" alt="Logo" src="[{$logoUrl}]">
            [{/block}]
        [{/if}]
    </div>
[{/block}]