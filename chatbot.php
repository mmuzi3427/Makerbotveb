<?php
define('API_KEY', LITE_TOKEN); // <- Bu yerga bot tokeningizni yozing

function bot($method, $datas = []) {
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        error_log(curl_error($ch));
    } else {
        return json_decode($res);
    }
}

$content = file_get_contents("php://input");
$update = json_decode($content);

if (isset($update->message)) {
    $chat_id = $update->message->chat->id;
    $text = $update->message->text;
    $name = $update->message->from->first_name;

    if ($text == "/start") {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "Salom, <b>$name</b>! Men sizga yordam beruvchi chatbotman. Nima qilishni xohlaysiz?",
            'parse_mode' => 'html'
        ]);
    } else {
        // Echo javob
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "Siz yozdingiz: <i>$text</i>",
            'parse_mode' => 'html'
        ]);
    }
}
?>
