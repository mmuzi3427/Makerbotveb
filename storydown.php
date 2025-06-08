<?php
date_default_timezone_set('Asia/Tashkent');

define('API_KEY', "8020960733:AAG4tx0QozBLXKZEBhoKBz0ms-d4oLeGQiA");
$admin = "7989030060"; // Admin Telegram ID

function bot($method, $datas = []) {
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $datas,
    ]);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        error_log('CURL error: ' . curl_error($ch));
    }
    curl_close($ch);
    return json_decode($res, true);
}

$update = json_decode(file_get_contents('php://input'), true);

$message  = $update['message'] ?? null;
$callback = $update['callback_query'] ?? null;

if ($message) {
    $chat_id    = $message['chat']['id'];
    $message_id = $message['message_id'];
    $text       = $message['text'] ?? '';
    $name       = htmlspecialchars($message['from']['first_name']);
    $username   = $message['from']['username'] ?? '';
    $from_id    = $message['from']['id'];
}

if ($callback) {
    $data       = $callback['data'];
    $chat_id    = $callback['message']['chat']['id'];
    $message_id = $callback['message']['message_id'];
    $from_id    = $callback['from']['id'];
    $name       = htmlspecialchars($callback['from']['first_name']);
    $username   = $callback['from']['username'] ?? '';
}

// /start komandasi
if ($text === "/start") {
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'reply_to_message_id' => $message_id,
        'text' => "👋 Salom <b>$name</b>, men sizga Telegram story (hikoya) yuklab olishda yordam beraman.\n\nIltimos, menga @username ko‘rinishida foydalanuvchi yoki kanal nomini yuboring.",
        'parse_mode' => 'html',
    ]);
    exit;
}

// Username yuborilgan holat
if (!empty($text)) {
    $id = 1; // 1-story yuklash
    $api_url = "https://cosmoai.uz/story/index.php?user=" . urlencode($text) . "&id=$id";
    $get_url = json_decode(file_get_contents($api_url), true);

    if (empty($get_url['result'])) {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'reply_to_message_id' => $message_id,
            'text' => "❌ Hech qanday hikoya topilmadi.",
        ]);
    } else {
        $caption = $get_url['caption'] ?? '';
        $count   = $get_url['count'] ?? '?';
        $type    = $get_url['type'];
        $media   = $get_url['result'];

        if ($type === "video") {
            bot('sendVideo', [
                'chat_id' => $chat_id,
                'reply_to_message_id' => $message_id,
                'video' => $media,
                'caption' => $caption,
            ]);
        } elseif ($type === "photo") {
            bot('sendPhoto', [
                'chat_id' => $chat_id,
                'reply_to_message_id' => $message_id,
                'photo' => $media,
                'caption' => $caption,
            ]);
        }

        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "🔍 <b>$text</b> profilida <b>$count</b> ta story mavjud.",
            'parse_mode' => 'html',
        ]);
    }
}
?>
