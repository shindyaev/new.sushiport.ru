<?php

$url = urldecode($_POST['url']);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
$out = curl_exec($curl);
curl_close($curl);
	
echo $out;

die();	

?>
