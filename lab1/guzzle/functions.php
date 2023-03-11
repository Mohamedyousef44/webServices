<?php

function filterCities($country){

    $countryCities = [];
    $cities = json_decode(file_get_contents('./city.list.json') , true);

    foreach($cities as $city){
        if($city['country'] == $country ){

            $countryCities[] = $city ;
        }  
    }

    return $countryCities;
}

function getWeatherDataGuzzle($city){

    $city = str_replace(' ' , "+" , $city );

    $api_key = "b42ab03008524124ae28a26d07006197";
    $api_url = "https://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=".$api_key."&units=metric";

    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', $api_url);
    $decoded = json_decode($response->getBody() , true);
    
    return $decoded;

}

?>