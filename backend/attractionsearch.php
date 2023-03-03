<?php
require "api_keys.php" ;


//getting api bearer token 
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.api.amadeus.com/v1/security/oauth2/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials&client_id=$api_key&client_secret=$api_secret");

$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$decoded_result = json_decode($result, true);
$bearer_token = $decoded_result["access_token"];
if (curl_errno($ch)) {
    //echo 'Error:' . curl_error($ch);
}
curl_close($ch);



$attraction_search_url = "https://test.api.amadeus.com/v1/shopping/activities?";

$by_square_body = array(
//box for NYC
//need to change URL for by-square search
    "north" => "40.792027",
    "west" => "-74.058204",
    "south" => "40.697607",
    "east" => "-73.942847"
    
);

$body = array(
    //coordinates for casa mila
        "latitude" => "41.397158",
        "longitude" => "2.160873",
        
    );
    

$attraction_search_url_encoded = $attraction_search_url.http_build_query($body);

$headers = [
    'X-HTTP-Method-Override: GET',
    'Content-type: application/json',
    'accept: application/json',
    'Authorization: Bearer '.$bearer_token,
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $attraction_search_url_encoded);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
 
$data = curl_exec($curl);
//echo ($attraction_search_url_encoded);
echo $data;
curl_close($curl);
if(curl_errno($curl)){
    echo 'Curl error: ' . curl_error($curl);
}
//print_r(curl_getinfo($curl));
?>