<?php
date_default_timezone_set('Asia/Tashkent');

$text = $_GET['text'] ?? 'Assalomu alaykum, bu yozilgan test matnidir. Alloh barchamizga Makkaga borish nasib qilsin!';
$ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
$date = date('Y-m-d H:i:s');

$log_entry = [
    'timestamp' => $date,
    'ip' => $ip,
    'text' => $text
];

file_put_contents(__DIR__ . '/logs.json', json_encode($log_entry, JSON_UNESCAPED_UNICODE) . PHP_EOL, FILE_APPEND);

$bg_image = imagecreatefromjpeg(__DIR__ . '/bg.jpg');
$font_path = __DIR__ . '/handwriting.ttf';

function wrapTextToLines($text, $font, $fontSize, $maxWidth) {
    $words = explode(' ', $text);
    $lines = [];
    $currentLine = '';

    foreach ($words as $word) {
        $testLine = $currentLine ? $currentLine . ' ' . $word : $word;
        $bbox = imagettfbbox($fontSize, 0, $font, $testLine);
        $lineWidth = $bbox[2] - $bbox[0];

        if ($lineWidth > $maxWidth && $currentLine !== '') {
            $lines[] = $currentLine;
            $currentLine = $word;
        } else {
            $currentLine = $testLine;
        }
    }

    if ($currentLine) {
        $lines[] = $currentLine;
    }

    return $lines;
}

$text_img = imagecreatetruecolor(500, 300);
imagesavealpha($text_img, true);
$transparent = imagecolorallocatealpha($text_img, 0, 0, 0, 127);
imagefill($text_img, 0, 0, $transparent);

$ink_color = imagecolorallocate($text_img, 40, 26, 13);
$font_size = 20;
$max_width = 420;
$line_height = 32;

$lines = wrapTextToLines($text, $font_path, $font_size, $max_width);

$start_x = 10;
$start_y = 40;

foreach ($lines as $i => $line) {
    $y = $start_y + $i * $line_height;
    imagettftext($text_img, $font_size, 0, $start_x, $y, $ink_color, $font_path, $line);
}

$rotated = imagerotate($text_img, 18, $transparent);
imagecopy($bg_image, $rotated, 135, 220, 0, 0, imagesx($rotated), imagesy($rotated));

header('Content-Type: image/png');
imagepng($bg_image);

imagedestroy($text_img);
imagedestroy($rotated);
imagedestroy($bg_image);
?>