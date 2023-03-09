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




$flight_search_url = "https://test.api.amadeus.com/v2/shopping/flight-offers";

$body = [
    'currencyCode' => 'USD',
    'originDestinations' => [
      0 => [
        'id' => '1',
        'originLocationCode' => 'BOS',
        'destinationLocationCode' => 'MAD',
        'departureDateTimeRange' => [
          'date' => '2023-11-01',
          'time' => '10:00:00',
        ],
      ],
      1 => [
        'id' => '2',
        'originLocationCode' => 'MAD',
        'destinationLocationCode' => 'BOS',
        'departureDateTimeRange' => [
          'date' => '2023-11-04',
          'time' => '17:00:00',
        ],
      ],
    ],
    'travelers' => [
      0 => [
        'id' => '1',
        'travelerType' => 'ADULT',
        'fareOptions' => [
          0 => 'STANDARD',
        ],
      ],
      1 => [
        'id' => '2',
        'travelerType' => 'CHILD',
        'fareOptions' => [
          0 => 'STANDARD',
        ],
      ],
    ],
    'sources' => [
      0 => 'GDS',
    ],
    'searchCriteria' => [
      'maxFlightOffers' => 2,
      'flightFilters' => [
        'cabinRestrictions' => [
          0 => [
            'cabin' => 'BUSINESS',
            'coverage' => 'MOST_SEGMENTS',
            'originDestinationIds' => [
              0 => '1',
            ],
          ],
        ],
        'carrierRestrictions' => [
          'excludedCarrierCodes' => [
            0 => 'AA',
            1 => 'TP',
            2 => 'AZ',
          ],
        ],
      ],
    ],
];

$headers = [
    'X-HTTP-Method-Override: GET',
    'Content-type: application/json',
    'accept: application/json',
    'Authorization: Bearer '.$bearer_token,
    sprintf('Content-Length: %d', strlen(json_encode($body)))
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $flight_search_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
 
$data = curl_exec($curl);
echo ($data);
curl_close($curl);
if(curl_errno($curl)){
    //echo 'Curl error: ' . curl_error($curl);
}
//print_r(curl_getinfo($curl));
?>