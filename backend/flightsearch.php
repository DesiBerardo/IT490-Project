<?php


$flight_search_url = "https://www.test.api.amadeus.com/v2/shopping/flight-offers";

$body = array(
    "currencyCode"=> "USD",
    "originDestinations"=> array(
      
        "id" => "1",
        "originLocationCode" => "NYC",
        "destinationLocationCode"=> "MAD",
        "departureDateTimeRange"=>array(
          "date"=> "2023-11-01",
          "time"=> "10:00:00"
        )
      
    ),
    "travelers"=> array(
        "id"=> "1",
        "travelerType"=> "ADULT"
      
    ),
    "sources" => "GDS"
    ,
    "searchCriteria" => array(
      "maxFlightOffers"=> 2,
      "flightFilters"=> array(
        "cabinRestrictions" => array (
          
            "cabin" => "BUSINESS",
            "coverage" => "MOST_SEGMENTS",
            "originDestinationIds" => "1"
        
            )
        )
    )
);

$headers = [
    'Content-type: X-HTTP-Method-Override',
    'Authorization: ${auth_token}',
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $flight_search_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$data = curl_exec($curl);
var_dump($data);
curl_close($curl);

if(curl_errno($curl)){
    echo 'Curl error: ' . curl_error($curl);
}
//print_r(curl_getinfo($curl));
?>