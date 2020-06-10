[{assign var="backaddressfile" value=$backaddressfile|default:"d3pdfbackaddress.tpl"}]

<div class="addressarea">
    <div class="backaddress">
        <div>
            [{include file=$backaddressfile}]
        </div>
    </div>
    <div class="recipientaddress">
        [{include file=$addressfile}]
    </div>
</div>