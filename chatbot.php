<?php
$api_token = LITE_TOKEN
define('API_KEY', "$api_token"); // @OddiyMakerBot avtomatik o'rnatadi

function bot($method, $datas = []) {
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($datas)
        ]
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return json_decode($result);
}

$content = file_get_contents("php://input");
$update = json_decode($content);

// Loglash
file_put_contents("log.txt", $content);

if (isset($update->message)) {
    $chat_id = $update->message->chat->id;
    $text = $update->message->text;
    $name = $update->message->from->first_name;
