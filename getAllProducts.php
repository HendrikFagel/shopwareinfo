<?php

/**
 * Die hier erstellt Datei ermöglicht es dir alle Produkte von Shopware v6.4.7.0-Stable-Version abzufragen.
 * Wichtigt: Normaerweise wird die Datei in dem Ordner /var/www/example.com/public abgelegt.
 * Diese Datei befindet sich jedoch unter folgendem Pfad: /var/www/example.com/public/api/getAllProducts.php
 * Die Datei kann über Browser aufgerufen werden.
 * Wichtig 2: Folgende Punkte sollten angepasst werden:
 * Die URL, hier ist eine example.com muss angepasst werden und die API Keys müsssen angepasst werden.
 * Dann steht der Abfrage nichts mehr im Wege.
 * Zusatzinformation:
**/

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../vendor/autoload.php';
use GuzzleHttp\Client;



$responseMethod = 'POST';
$apiRoute ='/api/search/product';


$body = '{
    "includes": {
        "product": ["id", "name"]
    }
}';


##############################################
# Hier beginnt der Cleint seinen Dienst :-)  #
##############################################


$client = new GuzzleHttp\Client([
          'base_uri' => 'https://www.example.com/',
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
//Das ist die TokenAcces ausgebe!!
print_r($token);


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


$end = $response->getBody();
//reines json
echo $end;

$json_string = json_decode($end, JSON_PRETTY_PRINT);
/* echo $json_string;
 * print_r($json_string);
 * var_dump($json_string);
**/

    } else {
        return response()->json(['error' => request('error')]);
    }

?>

