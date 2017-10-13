<?php

$host = "http://showphone.market.alicloudapi.com";
$path = " ";
$method = "GET";
$appcode = "a0a9ecfc19fa4a1696a269dfa77ff1cb";
$headers = array();
array_push($headers, "Authorization:APPCODE " . $appcode);
$querys = "num=15828470641";
$bodys = "";
$url = $host . $path . "?" . $querys;
$curl = curl_init();
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_FAILONERROR, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false); //不返回头信息
if (1 == strpos("$".$host, "https://")) {
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
}

//echo curl_exec( $curl );

//var_dump(curl_exec($curl));

//$data = json_encode( curl_exec($curl) );
$data = json_decode( curl_exec($curl), true );
echo $data['showapi_res_body']['num'];

//print_r( curl_exec($curl) );

//$data = json_decode( curl_exec($curl) );
//echo $data['showapi_res_code'];
//print_r( $data['showapi_res_body'] );