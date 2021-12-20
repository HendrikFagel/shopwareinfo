<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../vendor/autoload.php';
use GuzzleHttp\Client;


###############################################
# read => 3 Produkten                         #
###############################################
	
$responseMethod = 'POST';
$apiRoute ='/api/search/media';


$body = '{
/*     "includes": { */
        /* "product": ["id", "name"] */
    /* } */
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

/**
 * TokenAcces Ausgabe.
 * print_r($token);
**/




//Hier bekomme ich nur einen einzigen produkt angezeigt.
//$body ='{
    //"filter": [{ "type": "equals", "field": "productNumber", "value": "SWDEMO10002" }],
    //"includes": {"product": ["id", "name", "productNumber"]
    //}
//}';




//echo $body;

$body = json_decode($body, JSON_PRETTY_PRINT);
//echo $body;

//$request->setBody('{\n    "filter": [\n        { "type": "equals", "field": "productNumber", "value": "SWDEMO10002" }\n    ],\n    "includes": {\n        "product": ["id", "name", "productNumber"]\n    }\n}');




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

/*
 *echo $response->getBody();
 *return $response;
 */

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

    } else {
        return response()->json(['error' => request('error')]);
    }

?>
