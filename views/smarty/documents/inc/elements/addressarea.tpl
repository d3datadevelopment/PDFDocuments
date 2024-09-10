[{assign var="backaddressfile" value=$backaddressfile|default:"@d3PdfDocuments/documents/inc/page/returnaddress.tpl"}]
[{assign var="addressfile" value=$addressfile|default:"@d3PdfDocuments/documents/inc/elements/recipientAddress.tpl"}]

<div class="addressarea">
    <div class="returnAddress">
        <div>
            [{include file=$backaddressfile}]
        </div>
    </div>
    <div class="recipientAddress">
        [{include file=$addressfile}]
    </div>
</div>