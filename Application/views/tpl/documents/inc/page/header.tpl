[{assign var="showLogo" value=$showLogo|default:true}]

[{block name="pdfHeader"}]
    <div class="header">
        [{if $showLogo}]
            [{* pdf logo is available only in non admin theme *}]
            [{assign var="isAdmin" value=$oViewConf->isAdmin()}]
            [{$oViewConf->setAdminMode(false)}]
            <img class="logo" alt="Logo" src="[{$oViewConf->getImageUrl('pdf_logo.jpg')}]">
            [{$oViewConf->setAdminMode($isAdmin)}]
        [{/if}]
    </div>
[{/block}]