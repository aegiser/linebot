<?php
$access_token = 'mUd6BJCUnUQ3hZYv21TIXefVDh1kYQb4zU5d0l9c0LNfFkL/qc4q/IVN0GyGpFk36ev3qsgFS9nDKGWad84TCbUcqaOrkFNAE7oNgkg19u8cYp3sG3oQ++dd/eZQ2vdPVNs9z66ylHff8LqqfaztjQdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
$groupId = 0;
$userId = 0;
if (!is_null($events['events'])) {
	// Loop through each event

	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			if ($text == 'ShowId'){

				// Get replyToken
				$replyToken = $event['replyToken'];
				$groupId = $event['source']['groupId'];
				$userId = $event['source']['userId'];
				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => 'groupId '.$groupId. "\r\n" .' userId '.$userId. "\r\n" .' replyToken '.$replyToken. "\r\n" .' text '.$text
				];

				// Make a POST Request to Messaging API to reply to sender
				$url = 'https://api.line.me/v2/bot/message/push';
				$data = [
					'to' => Ub0c1ec272ac44dbb11f1defdcfed1f2e,
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
		}
	}
}
echo "OK";
