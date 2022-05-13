<?php
/**
Abra o seu php.ini, e procure por "php_soap.dll" ou "extension=soap"
Remova o ; (ponto e virgula) do início da linha
Restart o apache  
*/

try {
    $opts = array(
        'http' => array(
            'user_agent' => 'PHPSoapClient'
        )
    );
    $context = stream_context_create($opts);

    $wsdlUrl = 'http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl';
    $soapClientOptions = array(
        'stream_context' => $context,
        'cache_wsdl' => WSDL_CACHE_NONE
    );

    $client = new SoapClient($wsdlUrl, $soapClientOptions);

    $checkVatParameters = array(
        'countryCode' => 'DK',
        'vatNumber' => '47458714'
    );

    $result = $client->checkVat($checkVatParameters);
    print_r($result);
}
catch(Exception $e) {
    echo $e->getMessage();
}


