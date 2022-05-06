<?php
function api(){
    $api = "https://api.openweathermap.org/data/2.5/weather?lat=40.7669&lon=29.9169&appid=3cea955d5d297dd5f3cf46080977e4a2";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $api);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
    $cikti = curl_exec($curl);
    $dizi = json_decode($cikti, true);
    $ilce = $dizi['name'];
    $hissedilen = $dizi['main']['feels_like'];
    $hissedilen = round(($hissedilen-273.15)*2)/2;
    curl_close($curl);
    return $ilce." | ".$hissedilen."°C";
}
function baglan($url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
    $cikti = curl_exec($curl);
    curl_close($curl);
    return $cikti;
}
function hissedilen(){
    $cek = baglan("https://weather.com/tr-TR/weather/today/l/33d1e415eb66f3e1ab35c3add45fccf4512715d329edbd91c806a6957e123b49");
    preg_match_all('#<span data-testid="TemperatureValue" class="CurrentConditions--tempValue--3a50n">(.*?)</span>#si', $cek, $hissedilen);
    preg_match_all('#<h1 class="CurrentConditions--location--kyTeL">(.*?)</h1>#si', $cek, $il);
    preg_match_all('#<div data-testid="wxPhrase" class="CurrentConditions--phraseValue--2Z18W">(.*?)</div>#si', $cek, $durum);
    $hissedilen = intval(strip_tags($hissedilen[0][0]))."°C";
    $il = strip_tags($il[0][0]);
    $durum = strip_tags($durum[0][0]);
    return $il." | ".$durum." | ".$hissedilen;
}
function renk($st){
    if($st == 0){
        return 'warning';
    }
    else{
        return 'success';
    }
}
