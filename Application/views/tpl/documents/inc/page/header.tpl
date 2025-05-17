[{assign var="showLogo" value=$showLogo|default:true}]

[{block name="pdfHeader"}]
    <div class="header">
        [{if $showLogo}]
            [{* pdf logo is available only in non admin theme *}]
            [{assign var="isAdmin" value=$viewConfig->isAdmin()}]
            [{$viewConfig->setAdminMode(false)}]
            [{assign var="logoUrl" value=$config->getConfigParam('d3PdfDocumentsLogoUrl')|default:$viewConfig->getImageUrl('pdf_logo.jpg')}]
            <img class="logo" alt="Logo" src="[{$logoUrl}]">
            [{$viewConfig->setAdminMode($isAdmin)}]
        [{/if}]
    </div>
[{/block}]