<?php
$admin = "7268400523"; // Admin ID raqami
$token = "8076360971:AAG2di3Xlp76eMoQF-ZE8gJXlZNsWPzccYM"; // Botiz token


$users = file("konkurs.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (count($users) == 0) {
    echo json_encode(['error' => 'Hech kim ishtirok etmagan']);
    exit;
}

// Tarqatildi @ProKometa_uz
//Dasturchi @Qora_Koder
$winner = trim($users[array_rand($users)]);
list($id, $name) = explode(" ", $winner, 2);

// Tarqatildi @ProKometa_uz
//Dasturchi @Qora_Koder
$phoneFile = "number/$id.txt";
$phone = file_exists($phoneFile) ? file_get_contents($phoneFile) : "Topilmadi";

// Tarqatildi @ProKometa_uz
//Dasturchi @Qora_Koder
$msg = "<b> Konkurs g‘olibi aniqlandi!</b>\n\n";
$msg .= " Ismi: <b>$name</b>\n";
$msg .= " ID: <code>$id</code>\n";
$msg .= " Tel: <code>$phone</code>";

$button = json_encode([
    'inline_keyboard' => [
        [['text' => " Foydalanuvchiga yozish", 'url' => "tg://user?id=$id"]]
    ]
]);

file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query([
    'chat_id' => $admin,
    'text' => $msg,
    'parse_mode' => 'html',
    'reply_markup' => $button
]));

// Tarqatildi @ProKometa_uz
//Dasturchi @Qora_Koder
echo json_encode([
    'id' => $id,
    'name' => $name,
    'phone' => $phone
]);