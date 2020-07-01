[{block name="payinfo"}]
    [{if $payment->getId() == 'oxidinvoice'}]
        [{block name="payinfo_billable_till"}]
            [{assign var="dateFormat" value='D3_PDFDOCUMENTS_DATE_FORMAT'|oxmultilangassign}]
            [{oxmultilang ident="D3_PDFDOCUMENTS_PAYABLEUNTIL"}]
            [{$document->getPayableUntilDate()|date_format:$dateFormat}]
        [{/block}]
    [{elseif $payment->getId() == 'oxidpayadvance' || $payment->getId() == 'oxidcreditcard'}]
        [{block name="payinfo_payed"}]
            [{oxmultilang ident="D3_PDFDOCUMENTS_RECEIVED_PAYMENT"}]
        [{/block}]
    [{else}]
        [{block name="payinfo_other"}]
        [{/block}]
    [{/if}]
[{/block}]
