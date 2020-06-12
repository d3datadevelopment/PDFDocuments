[{block name="heidelpay_bank_data"}]
    [{d3modcfgcheck modid="d3heidelpay"}][{/d3modcfgcheck}]

    [{if $mod_d3heidelpay}]
    [{assign var="oPrePaymentData" value=$order->getHeidelpayBankTransferData()}]
        [{if $oPrePaymentData}]
            <div>
                <h3 style="font-size: 16px;"><strong>[{oxmultilang ident="BANK_DETAILS"}]</strong></h3>
                <p>
                    [{oxmultilang ident="D3_HEIDELPAY_BANK_INFO"}]<br>
                    [{oxmultilang ident="D3_HEIDELPAY_PURPOSE_OF_USE"}]<br/><br/>
                    [{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_ACCOUNTHOLDER"}] [{$oPrePaymentData->Holder}]<br/>
                    [{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_IBAN"}] [{$oPrePaymentData->Iban}]<br/>
                    [{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_BIC"}] [{$oPrePaymentData->Bic}]<br/>
                    hier shortID: [{$oPrePaymentData->getShortId()}]
                    <strong>[{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_AMOUNT"}] [{$order->getFormattedTotalOrderSum()}] [{$oPrePaymentData->Currency}]</strong><br/>
                    <strong class="color">[{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_REASON"}] [{$oPrePaymentData->Reference}]</strong>
                </p>
            </div>
            <br><br>
        [{/if}]
    [{/if}]
[{/block}]