[{assign var="backaddressfile" value=$backaddressfile|default:"d3pdfreturnaddress.tpl"}]

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