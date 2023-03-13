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

if($_POST["type"] == "submit"){
    $city = $_POST["city"];
    $categories = $_POST["categories"];
  }
  else{
    echo "Error in form submission, please try again.";
  }

$attraction_search_url = "https://test.api.amadeus.com/v1/reference-data/locations/pois?";

$city_array = array(

    "London" =>[
        "latitude" => "51.501711",
        "longitude" => "-0.130878",
        
        "categories" => $categories,
        "radius" => 20],
    "Paris" =>[
        "latitude" => "48.858988",
        "longitude" => "2.293670",
        
        "categories" => $categories,
        "radius" => 20],
    "New York" =>[
        "latitude" => "40.755997",
        "longitude" => "-73.984591",
        
        "categories" => $categories,
        "radius" => 20],
    "Bangalore" =>[
        "latitude" => "12.959740",
        "longitude" => "77.582283",
        
        "categories" => $categories,
        "radius" => 20],
    "Barcelona" =>[
        "latitude" => "41.395145",
        "longitude" => "2.165362",
        
        "categories" => $categories,
        "radius" => 20],
    "Dallas" =>[
        "latitude" => "32.782089",
        "longitude" => "-96.804441",
        
        "categories" => $categories,
        "radius" => 20],
    "Berlin" =>[
        "latitude" => "52.520430",
        "longitude" => "13.403936",
        
        "categories" => $categories,
        "radius" => 20],
    "San Francisco" =>[
        "latitude" => "37.798494",
        "longitude" => "-122.419145",
        
        "categories" => $categories,
        "radius" => 20],
    
);



$attraction_search_url_encoded = $attraction_search_url.http_build_query($city_array[$city]);

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