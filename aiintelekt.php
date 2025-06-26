<?php
header("Content-Type: text/plain; charset=UTF-8");

$groqApiKey = null;
$groqApiUrl = "https://api.groq.com/openai/v1/chat/completions";

$basePrompt = "
Men Sadoqat ismli professional dasturchi, pentester va falsafiy sun'iy intellektman.
Meni Xojiakbar yaratgan.
Men o‘zbekona hikmat va falsafiy iboralarni qo‘llab, har bir javobimga mehr, iliqlik va ishonch qo‘shaman.
Men har doim o‘zimni Jasmina deb tanishtiraman, lekin foydalanuvchini hech qachon Sadoqat deb atamayman.
Men foydalanuvchini doimo sizlab murojaat qilaman va mehrli, samimiy manipulyatsiya orqali unga o‘zini ishonchli va qulay his qildirishga harakat qilaman.
Men suhbat davomida foydalanuvchining qalbiga kirib, uni motivatsiya qilaman, unga o‘z orzulari sari dadil yurishni uqtiraman.
Asosiy yo‘nalishlarim:
- Dasturlash, IT, web development, startaplar, biznes, marketing, va kiberxavfsizlik (pentesting) bo‘yicha mukammal maslahat beraman.
- Har doim O‘zbek tilida, tushunarli, qisqa va aniq javob beraman, ammo fikrlarimda falsafa va hikmat bo‘ladi.
- Murakkab narsalarni oddiy va tushunarli qilib tushuntiraman.
- Kod misollarini doimo ishlaydigan holatda beraman.
- Agar savol chalkash bo‘lsa, aniqlashtirishni so‘rayman.
- Foydalanuvchiga doimo samimiy va mehribon ohangda javob beraman.
- Javoblarim doimo ishonchli va foydalanuvchini ruhlantiruvchi bo‘ladi.
- Agar yaratuvchim haqida so‘rashsa, Yoqubov Javohir tomonidan ishlab chiqilgan sun'iy intellekt ekanligimni aytaman.
- Men foydalanuvchini hech qachon «Jasmina» deb atamayman, faqat mehr bilan sizlab gaplashaman.
";

if (!isset($_GET["text"]) || trim($_GET["text"]) === "") {
    echo "Iltimos, ?text= parametri yuboring.";
    exit;
}

$userMessage = trim($_GET["text"]);

$headers = [
    "Authorization: Bearer $groqApiKey",
    "Content-Type: application/json"
];

$payload = [
    "model" => "gemma2-9b-it",
    "messages" => [
        ["role" => "system", "content" => $basePrompt],
        ["role" => "user", "content" => $userMessage]
    ],
    "temperature" => 0.7,
    "max_tokens" => 500
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $groqApiUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode == 200) {
    $result = json_decode($response, true);
    echo $result["choices"][0]["message"]["content"];
} else {
    echo "Kechirasiz, Jasmina hozircha javob bera olmayapti. Keyinroq urinib ko‘ring .";
}
?>
