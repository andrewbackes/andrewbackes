<?php

$ip = trim(file_get_contents('ip/ip.txt'));
$url = 'http://'.$ip.':8080/view';
header( 'Location: '.$url );
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_VERBOSE, true);
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_PORT, 8080);
//curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
//curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
//curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_TIMEOUT,30000);
$store = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo 'HTTP code: ' . $httpcode;
if (200==$httpcode) {
    header( 'Location: '.$url );
} else {
	//header( 'Location: http://www.dirty-bit.com/notlive.html' );
	echo('<br><br>');
	echo('Location: '.$url);
	echo('<br><br>');
	echo('Either the tourney isnt running or the machine is too bogged down to respond.');
	echo('<br><br>');
	echo 'Curl error: ' . curl_error($ch);

}

?>