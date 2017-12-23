	<html>
	<head>
	<title>BOT SEND</title>
	</head>
	<body>

	<?php
		$nodeID = $_GET["NodeID"];
		$gid = $_GET["GroupID"];
		$temp = $_GET["temp"];
		$humi = $_GET["humi"];
		$mois = $_GET["mois"];
		$access_token = 'mUd6BJCUnUQ3hZYv21TIXefVDh1kYQb4zU5d0l9c0LNfFkL/qc4q/IVN0GyGpFk36ev3qsgFS9nDKGWad84TCbUcqaOrkFNAE7oNgkg19u8cYp3sG3oQ++dd/eZQ2vdPVNs9z66ylHff8LqqfaztjQdB04t89/1O/w1cDnyilFU=';			
		$messages = [
			'type' => 'text',
			'text' => 'NodeID : '.$nodeID."\r\n" .'Temperature : '. $temp .'°C'."\r\n" .'Humidity : '.$humi. '%'."\r\n Moisture : ".$mois."\r\n"
		];
		
		$url = 'https://api.line.me/v2/bot/message/push';
		$data = [
			'to' => $gid,//Ub0c1ec272ac44dbb11f1defdcfed1f2e,
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

	?>

	</body>
	</html>
	
