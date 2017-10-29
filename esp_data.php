<?php
date_default_timezone_set('asia/bangkok');
$access_token = 'mUd6BJCUnUQ3hZYv21TIXefVDh1kYQb4zU5d0l9c0LNfFkL/qc4q/IVN0GyGpFk36ev3qsgFS9nDKGWad84TCbUcqaOrkFNAE7oNgkg19u8cYp3sG3oQ++dd/eZQ2vdPVNs9z66ylHff8LqqfaztjQdB04t89/1O/w1cDnyilFU=';

$espSn = $_GET['EspSN'];
$type = $_GET['Type'];

echo $espSn. ' ' . $type;

if ($type == 'temp_humi'){
	$temp = $_GET['Temp'];
	$humi = $_GET['Humi'];

	$messages = [
	'type' => 'text',
	'text' => "Send from ".$espSn. "\r\n" . "Temperature =".$temp. "\r\n" . "Humidity = ". $humi . "\r\n"
	];
					// Make a POST Request to Messaging API to reply to sender
	$url = 'https://api.line.me/v2/bot/message/push';
	$data = [
	'to' => 'C8dd7de85e3c1e6113065db983b8ffb5b',
	'messages' => [$messages],
	];
	$post = json_encode($data);
	$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	echo $result . "\r\n";

}
?>
