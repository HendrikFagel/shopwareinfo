<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../vendor/autoload.php';
use GuzzleHttp\Client;

$responseMethod = 'POST';
$apiRoute = '/api/product/';

###########################################################################
# Hier erstelle ich ein neues Produkt mit dem StandardSteuerSatz von 19%  #
# Dafür bitte die Datei getTaxID.php verwenden                           #
###########################################################################

$body = '{
    "name": "Pronomen",
    "productNumber": "77w5624352345",
    "stock": 10,
    "taxId": "ffed26b3194143518140ea11d87b8a26",
    "price": [
        {
            "currencyId" : "b7d2554b0ce847cd82f3ac9bd1c0dfca", 
            "gross": 15, 
            "net": 10, 
            "linked" : false
        }
    ]
}';


$client = new GuzzleHttp\Client([
          'base_uri' => 'https://www.example.com',
          'timeout' => 2.0,
          'headers' => ['Content-Type' => 'application/json'],'verify' => false,]);

$clientId = "SWIAYUNXUW5SMMDIA2XJATHJTG";
$clientSecret = "ZTNuMTFtMEhmbzQwVkNYSm5zRVVQSU1GR2xPQTY0bk4zQm42SnY";

$body1 = json_encode([
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
	    'grant_type' => 'client_credentials',
	    'scopes' => 'write',
    ]);

$response = $client->post(
	    '/api/oauth/token',
	    [
		'Content-Type' => 'application/json',
		'body' => $body1
	    ]
	);
$token = json_decode($response->getBody()->getContents(), true);

echo $body;
$body = json_decode($body, JSON_PRETTY_PRINT);

$token = json_decode((string) $response->getBody(), true)['access_token'];
    // mit access_token endpunkt auslesen
    if (isset($token)) {
	    $response = $client->request($responseMethod,$apiRoute, 
		['body' =>json_encode($body),
	    	'headers' => [
			//'User-agent'=> 'Mozilla/5.0',
			'Authorization' => 'Bearer ' . $token,
			'Content-Type' => 'application/json',
			//'Content-Length' => '0',
			'Accept'=> '*/*',
			 //'Accept-Encoding'=> 'gzip',
			]
	]
);

#############################
#  Hier beginnt die Ausgabe #
#############################
/*
 *echo $response->getBody();
 *return $response;
 */

$end = $response->getBody();
//reines json
echo $end;

$json_string = json_decode($end, JSON_PRETTY_PRINT);
//echo $json_string;
//print_r($json_string);
//var_dump($json_string);

############################
#  Hier endet die Ausgabe  #
############################

    } else {
        return response()->json(['error' => request('error')]);
    }

?>
