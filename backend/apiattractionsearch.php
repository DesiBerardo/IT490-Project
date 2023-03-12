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
  }
  else{
    echo "Error in form submission, please try again.";
  }

$attraction_search_url = "https://test.api.amadeus.com/v1/reference-data/locations/pois/by-square?";

$city_array = array(

    "London" =>[
        "north" => "51.520180",
        "west" => "-0.169882",
        "south" => "51.484703",
        "east" => "-0.061048",
        "categories" => "SIGHTS"
    ],
    "Paris" =>[
        "north" => "48.91",
        "west" => "2.25",
        "south" => "48.80",
        "east" => "2.46",
        "categories" => "SIGHTS"],
    "New York" =>[
        "north" => "40.792027",
        "west" => "-74.058204",
        "south" => "40.697607",
        "east" => "-73.942847",
        "categories" => "SIGHTS"],
    "Bangalore" =>[
        "north" => "13.023577",
        "west" => "77.536856",
        "south" => "12.923210",
        "east" => "77.642256",
        "categories" => "SIGHTS"],
    "Barcelona" =>[
        "north" => "41.42",
        "west" => "2.11",
        "south" => "41.347463",
        "east" => "2.228208",
        "categories" => "SIGHTS"],
    "Dallas" =>[
        "north" => "32.806993",
        "west" => "-96.836857",
        "south" => "32.740310",
        "east" => "-96.737293",
        "categories" => "SIGHTS"],
    "Berlin" =>[
        "north" => "52.541755",
        "west" => "13.354201",
        "south" => "52.490569",
        "east" => "13.457198",
        "categories" => "SIGHTS"],
    "San Francisco" =>[
        "north" => "37.810980",
        "west" => "-122.483716",
        "south" => "37.732007",
        "east" => "-122.370076",
        "categories" => "SIGHTS"],
    
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