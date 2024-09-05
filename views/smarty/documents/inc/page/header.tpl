[{assign var="showLogo" value=$showLogo|default:true}]

[{block name="pdfHeader"}]
    <div class="header">
        [{if $showLogo}]
            [{* pdf logo is available only in non admin theme *}]
            [{assign var="isAdmin" value=$viewConfig->isAdmin()}]
            [{$viewConfig->setAdminMode(false)}]
            <img class="logo" alt="Logo" src="[{$viewConfig->getImageUrl('pdf_logo.jpg')}]">
            [{$viewConfig->setAdminMode($isAdmin)}]
        [{/if}]
    </div>
[{/block}]