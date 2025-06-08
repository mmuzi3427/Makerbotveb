<?php
ob_start();
error_reporting(0);
date_Default_timezone_set('Asia/Tashkent');

define('API_KEY',"API_TOKEN");//token
$shakh_akn = "ADMIN_ID";//asosiy admin


$admins = file_get_contents("admins.txt");
$admin = explode("n", $admins);
array_push($admin,$shakh_akn);

$bot = bot('getme',['bot'])->result->username;
$valyuta="so`m";




$servername = "localhost";
$username = "LOGIN"; //mysql baza nomi
$password = "PAROL"; //mysql baza paroli
$connect = new mysqli($servername, $username, $password, $username);

if($connect){
    echo "Ulandi";
}else{
    echo "Ulanmadi $connect->error";
}


/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/

function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}}



/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/



function joinchat($id){
global $mid;
$array = array("inline_keyboard");
$get = file_get_contents("step/kanal.txt");
$ex = explode("\n", $get);

if ($get == null) {
return true;
} else {
$uns = false;  /
for ($i = 0; $i < count($ex); $i++) {
$url = trim($ex[$i]);  
if (empty($url)) continue;  
            
$a = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getchat?chat_id=$url"));
$name = $a->result->title;

$ret = bot("getChatMember", [
"chat_id" => "$url",
"user_id" => $id,
]);

$stat = $ret->result->status;
if (($stat == "creator" or $stat == "administrator" or $stat == "member")) {
$array['inline_keyboard'][$i][0]['text'] = "✅ ". $name;
$array['inline_keyboard'][$i][0]['url'] = "https://t.me/".str_replace('@','',$url);
} else {
$array['inline_keyboard'][$i][0]['text'] = "❌ ". $name;
$array['inline_keyboard'][$i][0]['url'] = "https://t.me/".str_replace('@','',$url);
$uns = true;
}
}

if ($uns == true) {
bot('sendMessage', [
'chat_id' => $id,
'text' => "⛔️ <b>Botdan to'liq foydalanish uchun</b> quyidagi kanallarga obuna bo'ling va /start bosing:",
'parse_mode' => 'html',
'disable_web_page_preview' => true,
'reply_markup' => json_encode($array),
]);  
exit();
return false;
} else {
return true;
}
}
}



/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/


function number($cid){
$raqam = file_get_contents("number/$cid.txt");
if($raqam == true){
return true;
}else{
file_put_contents("step/$cid.step",'request_contact');
bot("sendMessage",[
"chat_id"=>$cid,
'text'=>"📲 <b>Botdan ro'yxatdan o'tish uchun quyidagi tugma orqali telefon raqamingizni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📱 Telefon raqamni yuborish","request_contact"=>true]],
]]),
]);
return false;
}}

$turi = file_get_contents("number/turi.txt");
$raqam = file_get_contents("number/$cid.txt");



///Avto Webhook!
$a=file_get_contents("https://api.telegram.org/bot".API_KEY."/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']);
echo $a;
//

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$cid = $message->chat->id;
$name = $message->chat->first_name;
$tx = $message->text;
$step = file_get_contents("step/$cid.step");
$mid = $message->message_id;
$type = $message->chat->type;
$text = $message->text;
$uid= $message->from->id;
$name = $message->from->first_name;
$familya = $message->from->last_name;
$bio = $message->from->about;
$username = $message->from->username;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$reply = $message->reply_to_message->text;
$nameru = "<a href='tg://user?id=$uid'>$name $familya</a>";
$botdel = $update->my_chat_member->new_chat_member; 
$botdelid = $update->my_chat_member->from->id; 
$userstatus= $botdel->status; 
$contact = $message->contact;
$contact_id = $contact->user_id;
$contact_user = $contact->username;
$contact_name = $contact->first_name;
$phone = $contact->phone_number;
$data = $update->callback_query->data;
$qid = $update->callback_query->id;
$id = $update->inline_query->id;
$query = $update->inline_query->query;
$query_id = $update->inline_query->from->id;
$cid2 = $update->callback_query->message->chat->id;
$mid2 = $update->callback_query->message->message_id;
$callfrid = $update->callback_query->from->id;
$callname = $update->callback_query->from->first_name;
$calluser = $update->callback_query->from->username;
$surname = $update->callback_query->from->last_name;
$about = $update->callback_query->from->about;
$nameuz = "<a href='tg://user?id=$callfrid'>$callname $surname</a>";
$photo = $message->photo;
$file = $photo[count($photo)-1]->file_id;

mkdir("number");
mkdir("step");
mkdir("orders");

$ordeer = file_get_contents("orders/$cid.txt");
$test = file_get_contents("step/test.txt");
$test1 = file_get_contents("step/test1.txt");
$test2 = file_get_contents("step/test2.txt");
$test3 = file_get_contents("step/test3.txt");
$test4 = file_get_contents("step/test4.txt");
$test5 = file_get_contents("step/test5.txt");
$test6 = file_get_contents("step/test6.txt");
$test7 = file_get_contents("step/test7.txt");
$test10 = file_get_contents("step/test10.txt");
$ref1 = file_get_contents("step/$cid2.txt");
$ref2 = file_get_contents("step/$cid2.id");
$mt = file_get_contents("step/$cid.mt");
$mt2 = file_get_contents("step/$cid.mt2");

if(file_get_contents("holat.txt")){
	}else{
		if(file_put_contents("holat.txt","Yoqilgan"));
}
if(file_get_contents("admins.txt")){
	}else{
		if(file_put_contents("admins.txt","$shakh_akn"));
}
if(file_get_contents("yetkazish.txt")){
	}else{
		if(file_put_contents("yetkazish.txt","30000"));
}
$dostafka = file_get_contents("yetkazish.txt");

if($botdel){ 
if($userstatus=="kicked"){ 
mysqli_query($connect,"UPDATE users SET holat = '❌' WHERE user_id = $botdelid");
}}
if(isset($message)){
mysqli_query($connect,"UPDATE users SET holat = '✅' WHERE user_id = $cid");
}

$umum_d = date("d.m.Y H:i");
if(isset($message)){
$result = mysqli_query($connect,"SELECT * FROM users WHERE user_id = $cid");
$row = mysqli_fetch_assoc($result);
if(!$row){
mysqli_query($connect,"INSERT INTO users(`user_id`,`number`,`holat`,`ban`,`vaqt`) VALUES ('$cid','null','✅','unban','$umum_d')");
}
}

$kanal_uz = file_get_contents("step/kanal.txt");
$tkanal_uz = file_get_contents("step/kanal.txt");
$ban= mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM users WHERE user_id = $cid"))['ban'];
$ban2= mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM users WHERE user_id = $cid2"))['ban'];

$mt = file_get_contents("step/$cid.mt");
$mt2 = file_get_contents("step/$cid.mt2");

$menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🔎 ish izlash"]],
[['text'=>"❤Saqlanmalar"],['text'=>"☎️ Bogʻlanish"]],
]
]);


$menus = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🔎 ish izlash"]],
[['text'=>"❤Saqlanmalar"],['text'=>"☎️ Bogʻlanish"]],
]
]);

$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"⚙️ Elon sozlamalari"]],
[['text'=>"📢 Kanallar"],['text'=>"📬 Xabar Yuborish"]],
[['text'=>"🤖 Bot holati"],['text'=>"📋 Adminlar"]],
[['text'=>"📊 Statistika"],['text'=>"◀️ Orqaga"]],
]
]);

$shoxrux = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📂 Boʻlimlar"],['text'=>"📝Elonlar"]],
[['text'=>"🗄 Boshqarish"]],
]
]);


/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/

$back = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]
]);

$boshqarish = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]
]);

if(in_array($cid,$admin)){
$main_menu = $menus;
}else{
$main_menu = $menu;
}

if(in_array($cid,$admin)){
$main_menu = $menus;
}else{
$main_menu = $menu;
}

if(in_array($cid2,$admin)){
$main_menus = $menus;
}else{
$main_menus = $menu;
}


$holat = file_get_contents("holat.txt");
if($text){
 if($holat == "O'chirilgan"){
	if(in_array($cid,$admin)){
}else{
	bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"⛔️ <b>Bot vaqtinchalik o'chirilgan!</b>

<i>Botda ta'mirlash ishlari olib borilayotgan bo'lishi mumkin!</i>",
'parse_mode'=>'html',
]);
exit();
}
}
}

if($data){
 if($holat == "O'chirilgan"){
	if(in_array($cid2,$admin)){
}else{
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⛔️ Bot vaqtinchalik o'chirilgan!

Botda ta'mirlash ishlari olib borilayotgan bo'lishi mumkin!",
		'show_alert'=>true,
		]);
exit();
}
}
}

if($text){
	if($ban == "ban"){
	exit();
}
}

if($data){
	if($ban2 == "ban"){
	exit();
}
}

if($text == "/start" and number($cid)=="true"){	
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"🖥️ Asosiy menyudasiz:",
	'parse_mode'=>'html',
'disable_web_page_preview'=>true,
	'reply_markup'=>$main_menu
	]);
exit();
}

if($text == "◀️ Orqaga"){        
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>🖥 Asosiy menyuga qaytdingiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$main_menu,
]);
unlink("step/$cid.step");
unlink("step/$cid.mt");
unlink("step/test.txt");
unlink("step/test1.txt");
unlink("step/test2.txt");
unlink("step/test3.txt");
exit();
}
if($data == "yoqot"){
bot('deleteMessage',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🖥 Asosiy menyuga qaytdingiz</b>",
'parse_mode'=>'html',
'reply_markup'=>$main_menu,
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$del,
]);
exit();
}



/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/


if($step=="request_contact"){
$phone = str_replace("+", "", "$phone"); 

if($contact_id == $cid){
file_put_contents("number/$cid.txt", "$phone"); 

bot("sendMessage", [
"chat_id" => $cid,
"text" => "<b>✅ Telefon raqamingiz qabul qilindi:</b> $phonenn<i>Botdan foydalanishni boshlash uchun quyidagi tugmani bosing:</i>",
"parse_mode" => "html",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "✅ Davom etish", 'callback_data' => "davom"]]
]
])
]);

mysqli_query($connect, "UPDATE users SET number = '$phone' WHERE user_id = $cid"); // Telefon raqami bazaga saqlanmoqda
unlink("step/$cid.step");
} else {
bot('sendMessage', [
'chat_id' => $cid,
'text' => "📲 <b>Botdan ro'yxatdan o'tish uchun quyidagi tugma orqali telefon raqamingizni yuboring:</b>",
'parse_mode' => 'html',
'reply_markup' => json_encode([
'resize_keyboard' => true,
'keyboard' => [
[['text' => "📱 Telefon raqamni yuborish", "request_contact" => true]],
]
]),
]);
}
}

if($data == "davom"){
if($cid2 != $shakh_akn){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"🖥 <b>Asosiy menyudasiz.</b>",
'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
}else{
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$shakh_akn,
'text'=>"🖥 <b>Asosiy menyudasiz.</b>",
'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
}}

if($text == "☎️ Bogʻlanish" and number($cid)=="true"){	
if(joinchat($cid)==true){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"📑Savol va Takliflar bo'lsa pastdagi manzilimizga murojaat qilishingiz mumkin!",
	'parse_mode'=>'html',
'disable_web_page_preview'=>true,
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"☎️ Qoʻllab Quvvatlash",'url'=>"https://t.me/ishkeremi_admin"]],
]
])
	]);
exit();
}}


/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/

if($text == "🛍 Buyurtmalarim" and number($cid)=="true"){	
if(joinchat($cid)=="true"){
	$key = [];
$yukla = mysqli_query($connect, "SELECT * FROM `buyurtmalarim` WHERE `user_id` = '$cid'");
while($us = mysqli_fetch_assoc($yukla)){
$user = $us['buyurtma_id'];
$key[] = ["text"=>"🛍️ $user","callback_data"=>"orders:$user"];
}
$keyboard2 = array_chunk($key, 3);
$keyboard2[] = [['text'=>"🏡 Bosh sahifa",'callback_data'=>"yoqot"]];
$bolim = json_encode([
'inline_keyboard'=>$keyboard2
]);
$result = mysqli_query($connect, "SELECT * FROM `buyurtmalarim` WHERE `user_id` = '$cid' LIMIT 0,100");
$row = mysqli_fetch_assoc($result);
if($row){
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>🛍️ Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
'disable_web_page_preview'=>true,
	'reply_markup'=>$bolim,
	]);
exit();
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔴 Buyurtmangiz mavjud emas</b>",
'parse_mode'=>'html',
'reply_markup'=>$main_menu,
]);
exit();
}}}

if(mb_stripos($data,"orders:")!==false){
$ex = explode("orders:",$data);
$exe = $ex[1];
$res = mysqli_query($connect,"SELECT*FROM buyurtmalarim WHERE buyurtma_id = '$exe'");
while($a = mysqli_fetch_assoc($res)){
$haqida = $a['buyurtma'];
$holatii = $a['holat'];
$vaqtiii = $a['vaqt'];
$jamii = $a['jami'];
$ids_or = $a['buyurtma_id'];
}
if($holatii == "♻️"){
	$holatiii = "Tekshirilmoqda...";
}
	if($holatii == "✅"){
	$holatiii = "Roʻyhatdan oʻtkazilgan.";
}
if($holatii == "❌"){
	$holatiii = "Roʻyhatdan oʻtkazilmagan.";
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendmessage',[
'chat_id'=>$cid2,
'text'=>"<b>🛍️ Buyurtma ID: $ids_or
-------------------------
$haqida
-------------------------
⏳Buyurtma berilgan vaqt: $vaqtiii
-------------------------
💡 Holat: $holatiii
💵 Jami: $jamii $valyuta</b>",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔴 Bekor qilish",'callback_data'=>"yoqot"]],
]
])
]);
}

if ($text == "❤Saqlanmalar" and joinchat($cid) == true) {
$key = [];
$barchasi = "";
    
   
$sql = "SELECT s.*, k.haqida 
FROM `savatcha` s
LEFT JOIN `kates` k ON s.name = k.name
WHERE s.user_id = '$cid'
LIMIT 0,100";
$res = mysqli_query($connect, $sql);


$result = "SELECT SUM(haridi) AS total FROM savatcha WHERE user_id = '$cid'";
$reses = mysqli_query($connect, $result);
$rows = mysqli_fetch_assoc($reses);
$jamisum = $rows['total'] + $dostafka;

while ($row = mysqli_fetch_assoc($res)) {
$namesu = $row['name'];
$narxii = $row['narxi'];
$soniku = $row['soni'];
$haridii = $row['haridi'];
$savatcha_id = $row['savatcha_id'];
$telon = $row['haqida']; 

$barchasi .= "n📜 Nomi: $namesu
💰 Oyligi: $narxii $valyutan"; 

$key[] = ["text" => "❌ $namesu", "callback_data" => "delsavatcha=$savatcha_id=$namesu"];
}

$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text' => "🗑️ Saqlanmalarni tozalash", 'callback_data' => "delsaveds"]];
$keyboard2[] = [['text' => "🔴 Bekor qilish", 'callback_data' => "yoqot"]];
$bolim = json_encode([
'inline_keyboard' => $keyboard2
]);

if (mysqli_num_rows($res) > 0) {
bot('sendMessage', [
'chat_id' => $cid,
'text' => "<b>#️⃣ Hozir saqlanmada: 
----------------------------
$barchasi
----------------------------
📄 Elon haqida Ma'lumot: 

$telon
-------------------------------</b>",
'parse_mode' => 'html',
'reply_markup' => $bolim,
]);
} else {
bot('sendMessage', [
'chat_id' => $cid,
'text' => "<b>❤ Saqlanmalar boʻsh</b>",
'parse_mode' => 'html',
'reply_markup' => $main_menu,
]);
}
}

if(mb_stripos($data, "delsavatcha=")!==false){
$ex = explode("=",$data);
$explodee = $ex[1];
$namesu = $ex[2];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	mysqli_query($connect, "DELETE FROM `savatcha` WHERE `savatcha_id` = '$explodee'");
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<b>✅️  $namesu oʻchirildi....</b>",
'parse_mode'=>'html',
'reply_markup'=>$main_menu
]);
}

if($data == "delsaveds"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	mysqli_query($connect, "DELETE FROM `savatcha` WHERE `user_id` = '$cid2'");
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<b>❤Saqlanma tozalandi....</b>",
'parse_mode'=>'html',
'reply_markup'=>$main_menu
]);
}



/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/

if($text == "🔎 ish izlash" and joinchat($cid)==true){
	if(number($cid)=="true"){
$key = [];
$yukla = mysqli_query($connect, "SELECT * FROM `bolimlar` WHERE `turi` = 'menyu'");
while($us = mysqli_fetch_assoc($yukla)){
$user = $us['nomi'];
$key[] = ["text"=>"$user","callback_data"=>"nexts:$user"];
}
$keyboard2 = array_chunk($key, 2);
$keyboard2[] = [['text'=>"🏡 Bosh sahifa",'callback_data'=>"yoqot"]];
$bolim = json_encode([
'inline_keyboard'=>$keyboard2
]);
$result = mysqli_query($connect, "SELECT * FROM `bolimlar`");
$row = mysqli_fetch_assoc($result);
if($row){
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$del,
]);
$del = bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"<b>Kuting...</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'remove_keyboard'=>true
])
])->result->message_id;
sleep(0.1);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$del,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🗂️ Quyidagi bolimlardan birini tanlang.</b>",
'parse_mode'=>'html',
'reply_markup'=>$bolim,
]);
exit();
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤷‍♂️ Hech qanday boʻlim topilmadi...</b>",
'parse_mode'=>'html',
'reply_markup'=>$main_menu,
]);
exit();
}}
}

if(mb_stripos($data,"nexts:")!==false){
$ex = explode("nexts:",$data);
$exe = $ex[1];
$key = [];
$yukla = mysqli_query($connect, "SELECT * FROM `kates` WHERE `bolim_name` = '$exe'");
while($us = mysqli_fetch_assoc($yukla)){
$user = $us['name'];
$narxi = $us['narxi'];
$ids = $us['kates_id'];
$key[] = ["text"=>"$user - $narxi $valyuta","callback_data"=>"bought:$ids"];
}
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"🏡 Bosh sahifa",'callback_data'=>"yoqot"]];
$ichki = json_encode([
'inline_keyboard'=>$keyboard2
]);
$result = mysqli_query($connect, "SELECT * FROM `kates` WHERE `bolim_name` = '$exe'");
$row = mysqli_fetch_assoc($result);
if($holat == "Oʻchirilgan"){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"⚙️ Ushbu bo'limda tamirlash ishlari olib borilmoqda...",
'show_alert'=>true,
]);
}else{
if($row){
bot('deleteMessage',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📃Elonlardan birini tanlang: 🔽</b>",
'parse_mode'=>'html',
'reply_markup'=>$ichki,
]);
exit();
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"🤷‍♂️ Hech narsa topilmadi...",
'show_alert'=>true,
]);
exit();
}
}
}


if(mb_stripos($data,"bought:")!==false){
$ex = explode("bought:",$data);
$exe = $ex[1];
$res = mysqli_query($connect,"SELECT*FROM kates WHERE kates_id = '$exe'");
while($a = mysqli_fetch_assoc($res)){
$name = $a['name'];
$narxi = $a['narxi'];
$soni = $a['soni'];
$about = $a['haqida'];
$photo_id = $a['ids'];
}
if($about == "Kiritilmagan"){
	$haqida = "";
}else{
	$haqida = "$about";
	}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendphoto',[
'chat_id'=>$cid2,
'photo'=>$photo_id,
'caption'=>"<b>$name 

Oyligi $narxi $valyuta

$haqida</b>",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"❤SAQLASH",'callback_data'=>"saqlash_s=$narxi=$exe=1"]],
[['text'=>"🔴 Bekor qilish",'callback_data'=>"yoqot"]],
]
])
]);
}

if(mb_stripos($data,"ayir=")!==false){
$exe = explode("=",$data)[2];
$count = explode("=",$data)[1];
$ta=$count-1;
if($ta=="0"){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"⚠️ 1 Tadan kam buyurtma qilolmaysiz..",
'show_alert'=>true
]);
}else{
$res = mysqli_query($connect,"SELECT*FROM kates WHERE kates_id = '$exe'");
while($a = mysqli_fetch_assoc($res)){
$name = $a['name'];
$narxi = $a['narxi'];
$soni = $a['soni'];
$about = $a['haqida'];
$photo_id = $a['ids'];
}
if($about == "Kiritilmasin"){
}else{$haqida = "$about";}
$um=$narxi*$ta;
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendPhoto',[
'photo'=>$photo_id,
'chat_id'=>$cid2,
'caption'=>"<b>$name({$ta}×) - $um $valyuta

$haqida</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➖",'callback_data'=>"ayir=$ta=$exe"],['text'=>"$ta",'callback_data'=>"#"],['text'=>"➕",'callback_data'=>"qow=$ta=$exe"]],
[['text'=>"🛒 Savatchaga saqlash",'callback_data'=>"saqlash_s=$um=$exe=$ta"]],
[['text'=>"🔴 Bekor qilish",'callback_data'=>"yoqot"]],
]])
]);
}}

if(mb_stripos($data,"qow=")!==false){
$exe = explode("=",$data)[2];
$count = explode("=",$data)[1];
$ta=$count+1;
$res = mysqli_query($connect,"SELECT*FROM kates WHERE kates_id = '$exe'");
while($a = mysqli_fetch_assoc($res)){
$name = $a['name'];
$narxi = $a['narxi'];
$soni = $a['soni'];
$about = $a['haqida'];
$photo_id = $a['ids'];
}
if($about == "Kiritilmasin"){
	$haqida = "";
}else{
	$haqida = "$about";
	}
$um=$narxi*$ta;
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendPhoto',[
'photo'=>$photo_id,
'chat_id'=>$cid2,
'caption'=>"<b>$name({$ta}×) - $um $valyuta

$haqida</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➖",'callback_data'=>"ayir=$ta=$exe"],['text'=>"$ta",'callback_data'=>"#"],['text'=>"➕",'callback_data'=>"qow=$ta=$exe"]],
[['text'=>"🛒 Savatchaga saqlash",'callback_data'=>"saqlash_s=$um=$exe=$ta"]],
[['text'=>"🔴 Bekor qilish",'callback_data'=>"yoqot"]],
]])
]);
}

if(mb_stripos($data,"saqlash_s=")!==false){
$ex = explode("=",$data);
$sump = $ex[1];
$exe = $ex[2];
$sonii = $ex[3];
$name = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kates WHERE kates_id = $exe"))['name'];
$haqida = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kates WHERE kates_id = $exe"))['haqida'];
$narxi = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kates WHERE kates_id = $exe"))['narxi'];
mysqli_query($connect, "INSERT INTO `savatcha`(`user_id`,`name`,`narxi`,`soni`,`haridi`) VALUES ('$cid2','$name','$narxi','$sonii','$sump')");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>❤SAQLANDI...</b>",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>$main_menu,
]);
}



/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/

if($data == "buyurtma"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendmessage',[
'chat_id'=>$cid2,
'text'=>"📍 Geolokatsiyani yuboring yoki yetkazib berish manzilini kiriting",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
            'resize_keyboard'=>true,
            'keyboard'=>[
[['text'=>"❗ Manzilni Yuborish","request_location"=>true]],
[['text'=>"◀️ Orqaga"]],
]
]),
]);
file_put_contents("step/$cid2.step",'request_location');
}

if($step=="request_location"){
	$number = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM users WHERE user_id = $cid"))['number'];
$sql = "SELECT * FROM `savatcha` WHERE `user_id` = '$cid' LIMIT 0,100";
$res = mysqli_query($connect,$sql);
while($row = mysqli_fetch_assoc($res)){
$namesu = $row['name'];
$narxii = $row['narxi'];
$soniku = $row['soni'];
$haridii = $row['haridi'];
$savatcha_id = $row['savatcha_id'];
$result = "SELECT SUM(haridi) AS total FROM savatcha WHERE user_id = '$cid' LIMIT 0,100";
$reses= mysqli_query($connect, $result);
$rows = mysqli_fetch_assoc($reses);
$jamisum = $rows['total']+$dostafka;
$barchasi .= "nNomi: $namesu
Narxi: $narxii $valyuta
Soni: $soniku dona 
Harid narxi: $haridii $valyutan";
}
file_put_contents("orders/$cid.txt",$barchasi);
$top=mysqli_query($connect,"SELECT * FROM buyurtmalarim ORDER BY buyurtma_id DESC LIMIT 1");
$a = mysqli_fetch_assoc($top);
$soni=$a['buyurtma_id'];
$s=$soni+1;
mysqli_query($connect,"INSERT INTO buyurtmalarim(`user_id`,`holat`,`buyurtma`,`jami`,`vaqt`) VALUES ('$cid','♻️','$barchasi','$jamisum','$umum_d')");
bot('SendMessage', [
'chat_id' => $shakh_akn,
'text' => "👤 Foydalanuvchi savdo qildi
📊 ID: <code>$s</code>

----------------------------
$barchasi
----------------------------

🚖DOSTAFKA: $dostafka $valyuta

<b>💵 Jami:</b> $jamisum $valyuta
<b>📞 Telefon raqami:</b> <code>$number</code>",
'disable_web_page_preview' => true,
'parse_mode' => 'html',
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "✅", 'callback_data' => "on-$s"], ['text' => "❌", 'callback_data' => "off-$s"]],
]
])
]);
bot('forwardMessage', [
'chat_id' => $shakh_akn,
'from_chat_id' => $cid,
'message_id' => $mid,
]);
bot('sendMessage', [
'chat_id' => $cid,
'text' => "<b>Sizning soʻrovingiz adminga yuborildi.

Tez orada siz bilan bog'lanadi</b>",
'parse_mode' => 'html',
'reply_markup' =>$main_menu,
]);
unlink("step/$cid.step");
}

if(mb_stripos($data,"on-")!==false){
$ex = explode("-",$data);
$idss = $ex[1];
mysqli_query($connect, "UPDATE buyurtmalarim SET holat='✅' WHERE buyurtma_id='$idss'");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendmessage',[
'chat_id'=>$cid2,
'text'=>"✅ Buyurtma qabul qilindi",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>$main_menu,
]);
}

if(mb_stripos($data,"off-")!==false){
$ex = explode("-",$data);
$idss = $ex[1];
mysqli_query($connect, "DELETE FROM `buyurtmalarim` WHERE `buyurtma_id` = '$idss'");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendmessage',[
'chat_id'=>$cid2,
'text'=>"❌ Bekor qilindi",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>$main_menu,
]);
}


/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/


if($text == "🗄 Boshqarish" or $text=="/panel"){
	if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Admin paneliga xush kelibsiz!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
   unlink("step/test.txt");
   unlink("step/$cid.txt");
	exit();
}
}

if($data == "boshqarish"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Admin paneliga xush kelibsiz!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	exit();
}


if($text == "📢 Kanallar"){
	if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🔐 Majburiy obunalar",'callback_data'=>"majburiy"]],
	[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}
}

if($data == "kanallar"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🔐 Majburiy obunalar",'callback_data'=>"majburiy"]],
    [['text'=>"🔐 havola kanal",'callback_data'=>"thavola"]],
	[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}

if($data == "majburiy"){
	bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>"<b>Majburiy obunalarni sozlash bo'limidasiz:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Qo'shish",'callback_data'=>"qoshish"]],
[['text'=>"📑 Ro'yxat",'callback_data'=>"royxat"],['text'=>"🗑 O'chirish",'callback_data'=>"ochirish"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kanallar"]]
]
])
]);
}

if($data == "qoshish"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<i>Kanalingiz manzilini yuborishdan avval botni kanalingizga admin qilib olishingiz kerak!</i>

📢 <b>Kerakli kanalni manzilini yuboring:

Namuna:</b> @ProKometa_uz",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step","qo'shish");
exit();
}

if($step == "qo'shish"){
if(in_array($cid,$admin)){
if(isset($text)){		
if(mb_stripos($text, "@")!==false){
if($kanal_uz == null){
file_put_contents("step/kanal.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}else{
file_put_contents("step/kanal.txt","$kanal_uz\n$text");
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}
}else{
	bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qayta urunib ko'ring:</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}
}


/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/

if($data == "ochirish"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<b>O'chirilishi kerak bo'lgan kanalning manzilini yuboring:

Namuna:</b> @ProKometa_uz",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step","Kanal_o'chirish");
exit();
}

if($step == "Kanal_o'chirish"){
if(in_array($cid,$admin)){
if(isset($text)){	
if(mb_stripos($text, "@")!==false){
$files = file_get_contents("step/kanal.txt");
$file = str_replace("\n".$text."","",$files);
file_put_contents("step/kanal.txt",$file);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}else{
	bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qayta urunib ko'ring:</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}
}


if($data == "royxat"){
$soni = substr_count($kanal_uz,"@");
if($kanal_uz == null){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Hech qanday kanallar ulanmagan!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy"]],
]
])
]);
}else{
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>📢 Kanallar ro'yxati:</b>

$kanal_uz

<b>Ulangan kanallar soni:</b> $soni ta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy"]],
]
])
]);
}
}



/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/




if($text == "📊 Statistika"){
	if(in_array($cid,$admin)){
$res = mysqli_query($connect, "SELECT * FROM `users`");
$stat = mysqli_num_rows($res);
$start_time = round(microtime(true) * 1000);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"",
'parse_mode'=>'html',
]);
$end_time = round(microtime(true) * 1000);
$ping = $end_time - $start_time;
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"💡 <b>O'rtacha yuklanish:</b> <code>$ping</code>

👥 <b>Foydalanuvchilar:</b> $stat ta",
'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"Orqaga",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}
}


if($text == "⚙️ Elon sozlamalari"){
	if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Asosiy sozlamalar boʻlimidasiz</b>",
'parse_mode'=>'html',
	'reply_markup'=>$shoxrux,
]);
exit();
}
}

$hour = date('H:i');
$send = mysqli_query($connect, "SELECT * FROM send"); 
$send1 = mysqli_fetch_assoc($send); 
$xabar = $send1['message']; 
$type = $send1['type']; 
$member = $send1['start']; 
$limit = $send1['limit']; 
$succes = $send1['succes']; 
$left = $send1['left']; 
$time1 = $send1['time1']; 
$time2 = $send1['time2']; 
$time3 = $send1['time3']; 
$time4 = $send1['time4']; 
$time5 = $send1['time5']; 
$infosend = $send1['mesid']; 
if($hour==$time1 or $hour==$time2 or $hour==$time3 or $hour==$time4 or $hour==$time5){ 
$sql="SELECT * FROM users LIMIT $succes,$limit"; 
$res = mysqli_query($connect,$sql); 
while($a = mysqli_fetch_assoc($res)){ 
$id =  $a['user_id']; 
if($id==$left){ 
bot('deleteMessage',[ 
'chat_id'=>$shakh_akn, 
'message_id'=>$infosend, 
]); 
bot("$type",[ 
'from_chat_id'=>$shakh_akn, 
'chat_id'=>$left, 
'message_id'=>$xabar, 
'disable_web_page_preview'=>true, 
]); 
bot('sendMessage',[ 
'chat_id'=>$shakh_akn, 
'text'=>"<b>Xabar yuborish jarayoni:</b> Yakunlandi! 
 
<b>Yuborildi:</b> ($member) - <b>Kutilmoqda:</b> (0)", 
'parse_mode'=>'html', 
]); 
mysqli_query($connect, "DELETE FROM send"); 
exit(); 
}else{ 
bot("$type",[ 
'from_chat_id'=>$shakh_akn, 
'chat_id'=>$id, 
'message_id'=>$xabar, 
'disable_web_page_preview'=>true, 
]); 
} 
$time1 = date('H:i', strtotime('+1 minutes')); 
$time2 = date('H:i', strtotime('+2 minutes')); 
$time3 = date('H:i', strtotime('+3 minutes')); 
$time4 = date('H:i', strtotime('+4 minutes')); 
$time5 = date('H:i', strtotime('+5 minutes')); 
mysqli_query($connect, "UPDATE send SET time1 = '$time1', time2 = '$time2', time3 = '$time3', time4 = '$time4', time5 = '$time5'"); 
$plus=$succes+$limit; 
mysqli_query($connect, "UPDATE send SET succes = '$plus'"); 
$minus=$member-$plus; 
} 
bot('deleteMessage',[ 
'chat_id'=>$shakh_akn, 
'message_id'=>$infosend, 
]); 
if($infosend=="null"){ 
$info=bot('SendMessage',[ 
'chat_id'=>$shakh_akn, 
'text'=>"<b>Xabar yuborish jarayoni:</b> Boshlandi! 
 
<b>Yuborildi:</b> ($plus) - <b>Kutilmoqda:</b> ($minus)", 
'parse_mode'=>'html', 
])->result->message_id; 
mysqli_query($connect, "UPDATE send SET mesid = '$info'"); 
}else{ 
$minus=$member-$plus; 
bot('editMessageText',[ 
'chat_id'=>$shakh_akn, 
'message_id'=>$infosend+1, 
'text'=>"<b>Xabar yuborish jarayoni:</b> Jarayonda.. 
 
<b>Yuborildi:</b> ($plus) - <b>Kutilmoqda:</b> ($minus)", 
'parse_mode'=>'html', 
])->result->message_id; 
mysqli_query($connect, "UPDATE send SET mesid = '$info'"); 
}}


if($text == "📬 Xabar Yuborish" and $cid == $shakh_akn){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📤 Foydalanuvchilarga yuboriladigan xabarni botga yuboring!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
  'inline_keyboard'=>[
  [['text'=>"↪️ Foward xabar",'callback_data'=>"send-ForwardMessage"]],
  [['text'=>"👥 Userlarga xabar",'callback_data'=>"send-CopyMessage"]],
  [['text'=>"👤 Foydalanuvchiga xabar",'callback_data'=>"user"]],
  [['text'=>"⏳ Xabar holati",'callback_data'=>"holaat"]],
  [['text'=>"🔴 Xabarni yakunlash",'callback_data'=>"off"]],
  ]])
]);
}

if($data=="holaat"){
$result = mysqli_query($connect, "SELECT * FROM `send`");
$row = mysqli_fetch_assoc($result);
if(!$row){
bot ('answerCallbackQuery', [
'callback_query_id'=> $qid,
'text'=>"Xabar mavjud emas ❗",
'show_alert'=>true,
]);}else{
bot('answercallbackquery',[
'callback_query_id'=>$qid,
'text'=>"📊 Yangilandi",
'show_alert'=>false,
]);
$send = mysqli_query($connect, "SELECT * FROM send"); 
$send1 = mysqli_fetch_assoc($send); 
$xabar = $send1['message']; 
$member = $send1['start']; 
$limit = $send1['limit']; 
$succes = $send1['succes']; 
$time1 = $send1['time1']; 
$holatiii = $send1['holat']; 
$type = $send1['type']; 
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>🗒️ Xabar xaqida:
🕛 Boshlangan vaqti: $time1
⤴️ Kimga: Userlarga
📤 Yuborildi: $succes ta
⚙️ Xabar turi: $type
📈 Status: $holatiii </b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
  'inline_keyboard'=>[
  [['text'=>"🔄 Yangilash",'callback_data'=>"gov"]],
  ]])
]); exit();
}
}


if($data=="gov"){
$result = mysqli_query($connect, "SELECT * FROM `send`");
$row = mysqli_fetch_assoc($result);
if(!$row){
bot ('answerCallbackQuery', [
'callback_query_id'=> $qid,
'text'=>"Xabar mavjud emas ❗",
'show_alert'=>true,
]);}else{
bot('answercallbackquery',[
'callback_query_id'=>$qid,
'text'=>"📊 Yangilandi",
'show_alert'=>false,
]);
$send = mysqli_query($connect, "SELECT * FROM send"); 
$send1 = mysqli_fetch_assoc($send); 
$xabar = $send1['message']; 
$member = $send1['start']; 
$limit = $send1['limit']; 
$succes = $send1['succes']; 
$time1 = $send1['time1']; 
$holatiii = $send1['holat']; 
$type = $send1['type']; 
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,

'text'=>"<b>🗒️ Xabar xaqida:
🕛 Boshlangan vaqti: $time1
⤴️ Kimga: Userlarga
📤 Yuborildi: $succes ta
⚙️ Xabar turi: $type
📈 Status: $holatiii </b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
  'inline_keyboard'=>[
  [['text'=>"🔄 Yangilash",'callback_data'=>"holat"],['text'=>"❌ Bosh Menu", 'callback_data'=>"boshqarish"]],
  ]])
]); exit();
}
}

if($data =="off"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>😳 Xabar yuborish toʻxtatilsinmi  </b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
  'inline_keyboard'=>[
[['text'=>"⛔ Toʻxtatish", 'callback_data'=>"sendP"]],
  ]]),
]); exit ();
}


if($data =="sendP"){
$result = mysqli_query($connect, "SELECT * FROM `send`");
$row = mysqli_fetch_assoc($result);
if(!$row){
bot ('answerCallbackQuery', [
'callback_query_id'=> $qid,
'text'=>"Xabar mavjud emas ❗",
'show_alert'=>true,
]);exit ();}else{
mysqli_query($connect, "DELETE FROM send"); 
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>🛑 Muofaqyatli yakunlandi. </b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
  'inline_keyboard'=>[
[['text'=>"⛔ Bosh Menu", 'callback_data'=>"boshqarish"]],
  ]]),
]); exit ();
}
}


if(mb_stripos($data,"send-")!==false){
	$ex = explode("-",$data)[1];
	$result = mysqli_query($connect, "SELECT * FROM `send`");
$row = mysqli_fetch_assoc($result);
if(!$row){
$memSQL = mysqli_query($connect, "SELECT * FROM users"); 
$mem_ta = mysqli_num_rows($memSQL); 
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>$mem_ta ta foydalanuvchiga yuboriladigan xabarni yuboring:</b>", 
'parse_mode'=>'html', 
'reply_markup'=>json_encode([ 
'resize_keyboard'=>true, 
'keyboard'=>[ 
[['text'=>"🗄 Boshqarish"]], 
]]) 
]); 
file_put_contents("step/$cid2.step","send");
file_put_contents("step/test10.txt","$ex");
}else{
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🔵 Botda habar yuborish davom etmoqda..</b>", 
'parse_mode'=>'html', 
'reply_markup'=>$panel,
]);
}}
 
if($step == "send"){ 
if($text=="🗄 Boshqarish"){ 
unlink("step/$cid.step");    
}else{ 
$res = mysqli_query($connect,"SELECT * FROM users"); 
$mem_ta = mysqli_num_rows($res); 
$resmem = mysqli_query($connect,"SELECT * FROM users ORDER BY users_id DESC LIMIT 1"); 
$row = mysqli_fetch_assoc($resmem); 
$left = $row['user_id'];
bot('sendMessage',[ 
'chat_id'=>$cid, 
'text'=>"<b>Qabul qilindi. 
 
Minutiga yuboriladi:</b> 100 ta(odamga) 
 
Diqqat, Xabar yuborish jarayonida muammo chiqmasligi uchun miqdorni kamroq belgilash tavsiya etiladi!", 
'parse_mode'=>'html', 
"reply_markup"=>json_encode([  
'inline_keyboard'=>[  
[['text'=>"50",'callback_data'=>"limit-50"],['text'=>"✅ 100",'callback_data'=>"limit-100"],['text'=>"150",'callback_data'=>"limit-150"]], 
[['text'=>"✉️ Xabarni boshlash",'callback_data'=>"startsend"]], 
]]) 
]); 
mysqli_query($connect, "INSERT INTO send (`message`,`start`,`limit`,`succes`,`left`,`time1`,`time2`,`time3`,`time4`,`time5`,`mesid`,`mesid2`,`holat`,`type`) VALUES ('$message_id','$mem_ta','100','0','$left','null','null','null','null','null','null','null','active','null')"); 
unlink("step/$cid.step");    
exit(); 
}} 
 
if(mb_stripos($data,"limit-")!==false){
$ex = explode("-",$data);
$limit = $ex[1];
if($limit=="50"){$i50="✅ 50";}else{$i50="50";} 
if($limit=="100"){$i100="✅ 100";}else{$i100="100";} 
if($limit=="150"){$i150="✅ 150";}else{$i150="150";} 
mysqli_query($connect, "UPDATE send SET limit = '$limit'"); 
bot('editMessageText',[ 
'chat_id'=>$cid2, 
'message_id'=>$mid2, 
'text'=>"<b>Muvaffaqiyatli o'zgartirildi. 
 
Minutiga yuboriladi:</b> $limit ta(odamga) 
 
Ma'lumotlarni sozlab chiqing hamda tayyor bo'lgach tekshirib (<b>✉️ Xabarni boshlash</b>) tugmasini bosing!", 
'parse_mode'=>'html', 
"reply_markup"=>json_encode([  
'inline_keyboard'=>[ 
[['text'=>"$i50",'callback_data'=>"limit-50"],['text'=>"$i100",'callback_data'=>"limit-100"],['text'=>"$i150",'callback_data'=>"limit-150"]], 
[['text'=>"✉️ Xabarni boshlash",'callback_data'=>"startsend"]], 
]]) 
]); 
} 
 
if($data=="startsend"){ 
$time1 = date('H:i', strtotime('+1 minutes')); 
$time2 = date('H:i', strtotime('+2 minutes')); 
$time3 = date('H:i', strtotime('+3 minutes')); 
$time4 = date('H:i', strtotime('+4 minutes')); 
$time5 = date('H:i', strtotime('+5 minutes')); 
mysqli_query($connect, "UPDATE `send` SET time1 = '$time1', time2 = '$time2', time3 = '$time3', time4 = '$time4', time5 = '$time5'"); 
mysqli_query($connect, "UPDATE `send` SET type = '$test10'"); 
bot('deleteMessage',[ 
'chat_id'=>$cid2, 
'message_id'=>$mid2, 
]); 
$send = mysqli_query($connect, "SELECT * FROM `send`"); 
$send1 = mysqli_fetch_assoc($send); 
$member = $send1['start']; 
$info=bot('SendMessage',[ 
'chat_id'=>$shakh_akn, 
'text'=>"<b>Xabar yuborish jarayoni:</b> Kutilmoqda.. 
 
<b>Yuborildi:</b> (0) - <b>Kutilmoqda:</b> ($member)", 
'parse_mode'=>'html', 
])->result->message_id; 
mysqli_query($connect, "UPDATE `send` SET mesid2 = '$info'"); 
}



/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/


if($data == "user"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Foydalanuvchi iD raqamini kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'user');
exit();
}

if($step == "user"){
if(in_array($cid,$admin)){
if(is_numeric($text)=="true"){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Foydalanuvchiga yubormoqchi bo'lgan xabaringizni kiriting:</b>",
	'parse_mode'=>'html',
	]);
file_put_contents("step/$cid.step","xabar-$text");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}

if(mb_stripos($step, "xabar-") !== false){
if(in_array($cid,$admin)){
$id = explode("-", $step)[1];
$get = bot('getChat',[
'chat_id'=>$id,
]);
$first = $get->result->first_name;
$users = $get->result->username;
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM users WHERE user_id=$id"))['balance'];
$odam = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM users WHERE user_id = $id"))['referal'];
$text = str_replace(["%first%","%id%","%user%","%balance%","%refcount%","%currency%","%hour%","%date%"],[$first,$id,$user,$pul,$odam,$valyuta,$soat,$sana],$text);
	bot('SendMessage',[
	'chat_id'=>$id,
	'text'=>"$text",
        'parse_mode'=>'html',
'disable_web_page_preview'=>true,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"✅ <b>Foydalanuvchiga xabaringiz yuborildi!</b>",
       'parse_mode'=>'html',
        'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
	exit();
}
}

if($text == "🤖 Bot holati"){
	if(in_array($cid,$admin)){
	if($holat == "Yoqilgan"){
		$xolat = "O'chirish";
	}
	if($holat == "O'chirilgan"){
		$xolat = "Yoqish";
	}
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Hozirgi holat:</b> $holat",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"$xolat",'callback_data'=>"bot"]],
[['text'=>"Orqaga",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}
}

if($data == "xolat"){
	if($holat == "Yoqilgan"){
		$xolat = "O'chirish";
	}
	if($holat == "O'chirilgan"){
		$xolat = "Yoqish";
	}
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Hozirgi holat:</b> $holat",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"$xolat",'callback_data'=>"bot"]],
[['text'=>"Orqaga",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}

if($data == "bot"){
if($holat == "Yoqilgan"){
file_put_contents("holat.txt","O'chirilgan");
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"xolat"]],
]
])
]);
}else{
file_put_contents("holat.txt","Yoqilgan");
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"xolat"]],
]
])
]);
}
}


/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/

if($text == "🔎 Foydalanuvchini boshqarish"){
if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Kerakli foydalanuvchining ID raqamini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish
	]);
file_put_contents("step/$cid.step",'iD');
exit();
}
}

if($step == "iD"){
if(in_array($cid,$admin)){
$result = mysqli_query($connect,"SELECT * FROM stat WHERE user_id = '$text'");
$row = mysqli_fetch_assoc($result);
if(!$row){
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Foydalanuvchi topilmadi.</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
exit();
}else{
$ban = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM users WHERE user_id = $text"))['ban'];
$numberi = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM users WHERE user_id = $text"))['number'];
if($ban == unban){
	$bans = "🔔 Banlash";
}else{
	$bans = "🔕 Bandan olish";
}
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qidirilmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$mid + 1,
        'text'=>"<b>Qidirilmoqda...</b>",
       'parse_mode'=>'html',
]);
bot('editMessageText',[
      'chat_id'=>$cid,
     'message_id'=>$mid + 1,
'text'=>"<b>Foydalanuvchi topildi!

ID:</b> <a href='tg://user?id=$text'>$text</a>
<b>Tel raqami: $numberi</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"$bans",'callback_data'=>"ban-$text"]],
]
])
]);
unlink("step/$cid.step");
exit();
}
}
}

if(mb_stripos($data, "ban-")!==false){
$id = explode("-", $data)[1];
$ban = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM users WHERE user_id = $id"))['ban'];
if($shakh_akn != $id){
	if($ban == "ban"){
		$text = "<b>Foydalanuvchi ($id) bandan olindi!</b>";
		mysqli_query($connect,"UPDATE users SET ban = 'unban' WHERE user_id = $id");
}else{
	$text = "<b>Foydalanuvchi ($id) banlandi!</b>";
	mysqli_query($connect,"UPDATE users SET ban = 'ban' WHERE user_id = $id");
}
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>$text,
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"yoqot"]]
]
])
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Asosiy adminlarni blocklash mumkin emas!",
'show_alert'=>true,
]);
}
}

if($text == "📂 Boʻlimlar"){
bot('SendMessage',[
'chat_id'=>$shakh_akn,
    'text'=>"<b>⏬ Quyidagilardan birini tanlang:</b>",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
       'reply_markup'=>json_encode([
          'inline_keyboard'=>[
            [['text'=>"📋 Boʻlimlar roʻyhati",'callback_data'=>"royhatb"]],
            [['text'=>"➕ Boʻlim qoʻshish",'callback_data'=>"new_bolim"]],
            ]
           ])      
]);
exit();
}

if($data == "bolmalarnomk"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<b>⏬ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Boʻlimlar roʻyhati",'callback_data'=>"royhatb"]],
 [['text'=>"➕ Boʻlim qoʻshish",'callback_data'=>"new_bolim"]],
]
]),
]);
}


/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/


if($data=="royhatb"){
$key = [];
$sql = mysqli_query($connect, "SELECT * FROM `bolimlar` WHERE `turi` = 'menyu'");
while($us = mysqli_fetch_assoc($sql)){
$user = $us['nomi'];
$idss = $us['bolim_id'];
$key[] = ["text"=>"$user","callback_data"=>"bolims:$idss"];
}
$keyboard2 = array_chunk($key, 2);
$keyboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"bolmalarnomk"]];
$ichki = json_encode([
'inline_keyboard'=>$keyboard2
]);
$result = mysqli_query($connect, "SELECT * FROM `bolimlar` WHERE `turi` = 'menyu'");
$row = mysqli_fetch_assoc($result);
if($row){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b> «📋 Quyidagilardan»lardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ichki,
]);
exit();
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"🤷‍♂️ Hech narsa topilmadi...",
'show_alert'=>true,
]);
exit();
}
}

if(mb_stripos($data,"bolims:")!==false){
$ex = explode("bolims:",$data);
$exe = $ex[1];
$res = mysqli_query($connect,"SELECT*FROM bolimlar WHERE bolim_id = '$exe'");
while($a = mysqli_fetch_assoc($res)){
$names= $a['nomi'];
$exes = $a['bolim_id'];
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📋Boʻlim nomi:  $names

*️⃣ Quyidagilardan birini tanlang:</b>",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🗑️ Oʻchirib tashlash",'callback_data'=>"bolmarss=$exes"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bolmalarnomk"]],
]
])
]);
}

if(mb_stripos($data,"bolmarss1:")!==false){
$ex = explode("bolmarss1:",$data);
$exe = $ex[1];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<b>📝 Boʻlim nomini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'bolmarss21:$exe');
}

if(mb_stripos($step,"bolmarss21:")!==false){
$ex = explode("bolmarss21:",$step);
$exes = $ex[1];
mysqli_query($connect,"UPDATE `bolimlar` SET `nomi` = '$text' WHERE `` = '$exes'");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅ Muvaffaqiyatli o'zgartirildi. $explodee</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
unlink("step/$cid.step");
exit();
}


/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/


if(mb_stripos($data, "bolmarss=")!==false){
$ex = explode("=",$data);
$explodee = $ex[1];
$res = mysqli_query($connect,"SELECT*FROM bolimlar WHERE bolim_id = '$explodee'");
while($a = mysqli_fetch_assoc($res)){
$name = $a['nomi'];
}
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	mysqli_query($connect, "DELETE FROM `bolimlar` WHERE `bolim_id` = '$explodee'");
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<b>🗑️ $name Boʻlim bazadan oʻchirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"bolmalarnomk"]],
]
])
]);
}


if($text == "📝Elonlar"){
bot('SendMessage',[
'chat_id'=>$shakh_akn,
    'text'=>"<b>⏬ Quyidagilardan birini tanlang:</b>",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
       'reply_markup'=>json_encode([
          'inline_keyboard'=>[
            [['text'=>"📋 Elonlar roʻyhati",'callback_data'=>"azashox"]],
[['text'=>"➕ Elon qoʻshish",'callback_data'=>"ooops"]],
            ]
           ])      
]);
exit();
}

if($data == "mahsulotlarn"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<b>⏬ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Elonlar roʻyhati",'callback_data'=>"azashox"]],
[['text'=>"➕ 📝Elon qoʻshish",'callback_data'=>"ooops"]],
]
]),
]);
}

if($data=="azashox"){
$key = [];
$sql = mysqli_query($connect, "SELECT * FROM `bolimlar` WHERE `turi` = 'menyu'");
while($us = mysqli_fetch_assoc($sql)){
$user = $us['nomi'];
$idss = $us['bolim_id'];
$key[] = ["text"=>"$user","callback_data"=>"uskaa:$user"];
}
$keyboard2 = array_chunk($key, 2);
$keyboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"bolmalarnomk"]];
$ichki = json_encode([
'inline_keyboard'=>$keyboard2
]);
$result = mysqli_query($connect, "SELECT * FROM `bolimlar` WHERE `turi` = 'menyu'");
$row = mysqli_fetch_assoc($result);
if($row){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b> «📋 Quyidagilardan»lardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ichki,
]);
exit();
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"🤷‍♂️ Hech narsa topilmadi...",
'show_alert'=>true,
]);
exit();
}
}

if(mb_stripos($data,"uskaa:")!==false){
$ex = explode("uskaa:",$data);
$exe = $ex[1];
$key = [];
$yukla = mysqli_query($connect, "SELECT * FROM `kates` WHERE `bolim_name` = '$exe'");
while($us = mysqli_fetch_assoc($yukla)){
$user = $us['name'];
$narxi = $us['narxi'];
$ids = $us['kates_id'];
$key[] = ["text"=>"$user","callback_data"=>"tanlashh:$ids"];
}
$keyboard2 = array_chunk($key, 2);
$keyboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"mahsulotlarn"]];
$ichki = json_encode([
'inline_keyboard'=>$keyboard2
]);
$result = mysqli_query($connect, "SELECT * FROM `kates` WHERE `bolim_name` = '$exe'");
$row = mysqli_fetch_assoc($result);
if($holat == "Oʻchirilgan"){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"⚙️ Ushbu bo'limda tamirlash ishlari olib borilmoqda...",
'show_alert'=>true,
]);
}else{
if($row){
bot('deleteMessage',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📃Elonlardan birini tanlang: 🔽</b>",
'parse_mode'=>'html',
'reply_markup'=>$ichki,
]);
exit();
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"🤷‍♂️ Hech narsa topilmadi...",
'show_alert'=>true,
]);
exit();
}
}
}

if(mb_stripos($data,"tanlashh:")!==false){
$ex = explode("tanlashh:",$data);
$exe = $ex[1];

$res = mysqli_query($connect,"SELECT * FROM kates WHERE kates_id = '$exe'");
if($a = mysqli_fetch_assoc($res)){
$name = $a['name'];
$narxi = $a['narxi'];
$soni = $a['soni'];
$about = $a['haqida'];
$haqida = ($about == "Kiritilmasin") ? "Kiritilmagan.." : $about;

bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);

bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🛒 Mahsulot nomi: $name

📋 Mahsulot haqida: $haqida

💵 Narxi: $narxi soʻm
🔢 Soni: $soni ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📝 Nomini sozlash",'callback_data'=>"nomiss=$exe"]],
[['text'=>"📋 Mahsulot haqida",'callback_data'=>"haqidas=$exe"]],
[['text'=>"🔢 Mahsulot soni",'callback_data'=>"sonii=$exe"]],
[['text'=>"💵 Mahsulot narxi",'callback_data'=>"narxiss=$exe"]],
[['text'=>"🖼 Rasmni o‘zgartirish",'callback_data'=>"rasmupdate=$exe"]],
[['text'=>"🗑️ Mahsulotni Oʻchirish",'callback_data'=>"delettt=$exe"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"mahsulotlarn"]],
]
])
]);
}
}


if(mb_stripos($data, "rasmupdate=")!==false){
  $ex = explode("rasmupdate=", $data);
  $product_id = $ex[1];

  // Admindan rasm so‘raymiz
  bot('deleteMessage',[
      'chat_id'=>$cid2,
      'message_id'=>$mid2,
  ]);
  bot('sendMessage',[
      'chat_id'=>$cid2,
      'text'=>"🖼 Iltimos, yangi rasmni yuboring:",
      'reply_markup'=>json_encode([
          'inline_keyboard'=>[
              [['text'=>"◀️ Bekor qilish",'callback_data'=>"tanlashh:$product_id"]],
          ]
      ])
  ]);
  file_put_contents("rasmupdate.txt", $cid2."|".$product_id);
}


if(isset($message->photo)){
$photo = end($message->photo);
$photo_id = $photo->file_id;

if(file_exists("rasmupdate.txt")){
$info = explode("|", file_get_contents("rasmupdate.txt"));
$admin_id = $info[0];
$product_id = $info[1];

if($cid == $admin_id){
mysqli_query($connect, "UPDATE `kates` SET `ids` = '$photo_id' WHERE `kates_id` = '$product_id'");
unlink("rasmupdate.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"✅ Rasm muvaffaqiyatli yangilandi.",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"tanlashh:$product_id"]],
]
])
]);
}
}
}





/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/





if(mb_stripos($data, "delettt=")!==false){
$ex = explode("=",$data);
$explodee = $ex[1];
$res = mysqli_query($connect,"SELECT*FROM kates WHERE kates_id = '$explodee'");
while($a = mysqli_fetch_assoc($res)){
$name = $a['name'];
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
mysqli_query($connect, "DELETE FROM `kates` WHERE `kates_id` = '$explodee'");
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🗑️ $name Mahsulot oʻchirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"mahsulotlarn"]],
]
])
]);
}

if (mb_stripos($data, "nomiss=") !== false) {
  $ex = explode("=", $data);
  $product_id = $ex[1];
  
  bot('deleteMessage', [
      'chat_id' => $cid2,
      'message_id' => $mid2,
  ]);
  bot('sendMessage', [
      'chat_id' => $cid2,
      'text' => "<b>📝 Yangi nomni yuboring:</b>",
      'parse_mode' => 'html',
      'reply_markup' => $boshqarish,
  ]);

  file_put_contents("step/$cid2.step", 'nomiss=' . $product_id);
}

if (mb_stripos($step, "nomiss=") !== false) {
  $ex = explode("=", $step);
  $product_id = $ex[1];

  mysqli_query($connect, "UPDATE `kates` SET `name` = '$text' WHERE `kates_id` = '$product_id'");

  bot('sendMessage', [
      'chat_id' => $cid,
      'text' => "<b>✅ Muvaffaqiyatli nom yangilandi.</b>",
      'parse_mode' => 'html',
      'reply_markup' => $boshqarish,
  ]);

  unlink("step/$cid.step");
  exit();
}

if (mb_stripos($data, "haqidas=") !== false) {
  $ex = explode("=", $data);
  $product_id = $ex[1];
  
  bot('deleteMessage', [
      'chat_id' => $cid2,
      'message_id' => $mid2,
  ]);
  bot('sendMessage', [
      'chat_id' => $cid2,
      'text' => "<b>📝 Yangi mahsulot haqida ma'lumot yuboring:</b>",
      'parse_mode' => 'html',
      'reply_markup' => $boshqarish,
  ]);
  
  file_put_contents("step/$cid2.step", 'haqidas=' . $product_id);
}

if (mb_stripos($step, "haqidas=") !== false) {
  $ex = explode("=", $step);
  $product_id = $ex[1];

  mysqli_query($connect, "UPDATE `kates` SET `haqida` = '$text' WHERE `kates_id` = '$product_id'");

  bot('sendMessage', [
      'chat_id' => $cid,
      'text' => "<b>✅ Muvaffaqiyatli mahsulot haqida yangilandi.</b>",
      'parse_mode' => 'html',
      'reply_markup' => $boshqarish,
  ]);

  unlink("step/$cid.step"); 
  exit();
}

if (mb_stripos($data, "sonii=") !== false) {
  $ex = explode("=", $data);
  $product_id = $ex[1];
  
  bot('deleteMessage', [
      'chat_id' => $cid2,
      'message_id' => $mid2,
  ]);
  bot('sendMessage', [
      'chat_id' => $cid2,
      'text' => "<b>📝 Yangi mahsulot sonini yuboring:</b>",
      'parse_mode' => 'html',
      'reply_markup' => $boshqarish,
  ]);
  
  file_put_contents("step/$cid2.step", 'sonii=' . $product_id);
}

if (mb_stripos($step, "sonii=") !== false) {
  $ex = explode("=", $step);
  $product_id = $ex[1];

  mysqli_query($connect, "UPDATE `kates` SET `soni` = '$text' WHERE `kates_id` = '$product_id'");

  bot('sendMessage', [
      'chat_id' => $cid,
      'text' => "<b>✅ Muvaffaqiyatli mahsulot soni yangilandi.</b>",
      'parse_mode' => 'html',
      'reply_markup' => $boshqarish,
  ]);

  unlink("step/$cid.step"); 
  exit();
}

if (mb_stripos($data, "narxiss=") !== false) {
  $ex = explode("=", $data);
  $product_id = $ex[1];
  
  bot('deleteMessage', [
      'chat_id' => $cid2,
      'message_id' => $mid2,
  ]);
  bot('sendMessage', [
      'chat_id' => $cid2,
      'text' => "<b>📝 Yangi mahsulot narxini yuboring:</b>",
      'parse_mode' => 'html',
      'reply_markup' => $boshqarish,
  ]);
 
  file_put_contents("step/$cid2.step", 'narxiss=' . $product_id);
}

if (mb_stripos($step, "narxiss=") !== false) {
  $ex = explode("=", $step);
  $product_id = $ex[1];

  mysqli_query($connect, "UPDATE `kates` SET `narxi` = '$text' WHERE `kates_id` = '$product_id'");

  bot('sendMessage', [
      'chat_id' => $cid,
      'text' => "<b>✅ Muvaffaqiyatli mahsulot narxi yangilandi.</b>",
      'parse_mode' => 'html',
      'reply_markup' => $boshqarish,
  ]);

  unlink("step/$cid.step"); 
  exit();
}


if($text == "*️⃣ Birlamchi sozlamalar"){
	if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>*️⃣ Birlamchi sozlamalardasiz:

🚚Dostafka narxi: $dostafka soʻm</b>",
'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
   [['text'=>"🚚 Dostafka narxi",'callback_data'=>"dostfkas"]],
	[['text'=>"🔴 Yopish",'callback_data'=>"boshqarish"]]
	]
	]),
]);
exit();
}
}


/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/


if($data == "dostfkas"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<i>🚚 Dostafka narxini kiriting:</i>

💡<b>Holat: $dostafka so'm</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step","qo'siish");
exit();
}

if($step == "qo'siish"){
if(in_array($cid,$admin)){
file_put_contents("yetkazish.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
]);
}
}

if($data == "new_bolim"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Yangi bo'lim uchun nom yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$back,
]);
file_put_contents("step/$cid2.step",'addsss');
exit();
}

if($step == "addsss"){
mysqli_query($connect, "INSERT INTO `bolimlar`(`nomi`,`turi`,`holat`) VALUES ('$text','menyu','active')");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$text

<b>Ushbu nomdagi bo'lim muvaffaqiyatli qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
exit();
}

if($data == "ooops"){
    $key = [];
    $yukla = mysqli_query($connect, "SELECT * FROM `bolimlar` WHERE `turi` = 'menyu'");
    while($us = mysqli_fetch_assoc($yukla)){
        $id = $us['bolim_id'];
        $name = $us['nomi'];
        $key[] = ["text"=>"$name","callback_data"=>"newxiz=$id=$name"];
    }
    $keyboard2 = array_chunk($key, 1);
    $keyboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"mahsulotlarn"]];
    $addxiz = json_encode(['inline_keyboard'=>$keyboard2]);

    $result = mysqli_query($connect, "SELECT * FROM `bolimlar` WHERE `turi` = 'menyu'");
    $row = mysqli_fetch_assoc($result);
    
    if($row){
        bot('deleteMessage',[
            'chat_id'=>$cid2,
            'message_id'=>$mid2,
        ]);
        bot('sendMessage',[
            'chat_id'=>$cid2,
            'text'=>"<b>Asosiy bo'lim</b>",
            'parse_mode'=>'html',
            'reply_markup'=>$addxiz,
        ]);
        exit();
    } else {
        bot('answerCallbackQuery',[
            'callback_query_id'=>$qid,
            'text'=>"🤷‍♂️ Hech narsa topilmadi...",
            'show_alert'=>true,
        ]);
        exit();
    }
}

if(mb_stripos($data, "newxiz=")!==false){
    $ex = explode("=",$data);
    $ids = $ex[1];
    $names = $ex[2];

    bot('deleteMessage',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
    ]);
    bot('sendMessage',[
        'chat_id'=>$cid2,
        'text'=>"<b>Elon nomini yuboring:</b>",
        'parse_mode'=>'html',
        'disable_web_page_preview'=>true,
        'reply_markup'=>$back,
    ]);

    file_put_contents("step/test.txt", $names);
    file_put_contents("step/$cid2.step", 'matda');
}

if($step == "matda" && in_array($cid,$admin)){
    if(isset($text)){
        bot('SendMessage',[
            'chat_id'=>$cid,
            'text'=>"<b>$text Qabul qilindi!</b>\n\nOylik narxini yuboring:",
            'parse_mode'=>'html',
            'reply_markup'=>$back,
        ]);

        file_put_contents("step/test1.txt", $text);
        file_put_contents("step/$cid.step", 'matdauuu');
        exit();
    }
}

if($step == "matdauuu" && in_array($cid,$admin)){
    if(isset($text)){
        bot('SendMessage',[
            'chat_id'=>$cid,
            'text'=>"<b>$text Qabul qilindi!</b>\n\nElon haqida qisqa ma’lumot yuboring yoki «Kiritilmasin» tugmasini bosing:",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
                'resize_keyboard'=>true,
                'keyboard'=>[
                    [['text'=>"Kiritilmasin"]],
                ]
            ]),
        ]);

        file_put_contents("step/test2.txt", $text);
        file_put_contents("step/$cid.step", 'matdau7uu');
        exit();
    }
}

if($step == "matdau7uu" && in_array($cid,$admin)){
    if(isset($text)){
        bot('SendMessage',[
            'chat_id'=>$cid,
            'text'=>"<b>$text Qabul qilindi!</b>\n\nElon uchun rasm yuboring:",
            'parse_mode'=>'html',
            'reply_markup'=>$back,
        ]);

        file_put_contents("step/test3.txt", $text);
        file_put_contents("step/$cid.step", 'rasmni_kutish');
        exit();
    }
}

if($step == "rasmni_kutish" && in_array($cid,$admin)){
    if(isset($message->photo)){
        $rasm = end($message->photo)->file_id; 
        $test  = mysqli_real_escape_string($connect, file_get_contents("step/test.txt"));  
        $test1 = mysqli_real_escape_string($connect, file_get_contents("step/test1.txt")); 
        $test2 = mysqli_real_escape_string($connect, file_get_contents("step/test2.txt")); 
        $test3 = mysqli_real_escape_string($connect, file_get_contents("step/test3.txt")); 

        $query = "INSERT INTO `kates`(`bolim_name`,`name`,`narxi`,`soni`,`haqida`,`ids`) 
                  VALUES ('$test','$test1','$test2','1','$test3','$rasm')";
        $result = mysqli_query($connect, $query);

        if($result){
            bot('SendMessage',[
                'chat_id'=>$cid,
                'text'=>"<b>✅ Mahsulot muvaffaqiyatli qo‘shildi!</b>",
                'parse_mode'=>'html',
                'reply_markup'=>$back,
            ]);

          
            unlink("step/$cid.step");
            unlink("step/test.txt");
            unlink("step/test1.txt");
            unlink("step/test2.txt");
            unlink("step/test3.txt");
        } else {
            bot('SendMessage',[
                'chat_id'=>$cid,
                'text'=>"<b>❌ Xatolik! Ma'lumotlar bazaga qo‘shilmadi.</b>\n\nMySQL xatosi: ".mysqli_error($connect),
                'parse_mode'=>'html',
                'reply_markup'=>$back,
            ]);
        }
    }
}
if($text == "📋 Adminlar"){
if(in_array($cid,$admin)){
	if($cid == $shakh_akn){
	bot('SendMessage',[
	'chat_id'=>$shakh_akn,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
   [['text'=>"➕ Yangi admin qo'shish",'callback_data'=>"add"]],
   [['text'=>"📑 Ro'yxat",'callback_data'=>"list"],['text'=>"🗑 O'chirish",'callback_data'=>"remove"]],
	[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}else{	
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
   [['text'=>"📑 Ro'yxat",'callback_data'=>"list"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}
}
}


/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/




if($data == "admins"){
if($cid2 == $shakh_akn){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);	
bot('SendMessage',[
	'chat_id'=>$shakh_akn,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
   [['text'=>"➕ Yangi admin qo'shish",'callback_data'=>"add"]],
   [['text'=>"📑 Ro'yxat",'callback_data'=>"list"],['text'=>"🗑 O'chirish",'callback_data'=>"remove"]],
	[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}else{
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);	
bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
   [['text'=>"📑 Ro'yxat",'callback_data'=>"list"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}
}

if($data == "list"){
	$admins = file_get_contents("admins.txt");
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>👮 Adminlar ro'yxati:</b>

$admins",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"admins"]],
]
])
]);
}

if($data == "add"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$shakh_akn,
'text'=>"*Kerakli iD raqamni kiriting:*",
'parse_mode'=>'MarkDown',
'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step",'add-admin');
exit();
}
if($step == "add-admin" and $cid == $shakh_akn){
if(is_numeric($text)=="true"){
if($text != $shakh_akn){
file_put_contents("admins.txt","$adminsn$text");
bot('SendMessage',[
'chat_id'=>$shakh_akn,
'text'=>"✅ *$text* endi botda admin.",
'parse_mode'=>'MarkDown',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
exit();
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
exit();
}
}

if($data == "remove"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$shakh_akn,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step",'remove-admin');
exit();
}
if($step == "remove-admin" and $cid == $shakh_akn){
if(is_numeric($text)=="true"){
if($text != $shakh_akn){
$files = file_get_contents("admins.txt");
$file = str_replace("n".$text."","",$files);
file_put_contents("admins.txt",$file);
bot('SendMessage',[
'chat_id'=>$shakh_akn,
'text'=>"✅ *$text* endi botda admin emas.",
'parse_mode'=>'MarkDown',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
exit();
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
exit();
}
}



/*

Ushbu kod @QoraKoder tomonidan yozib chiqilgan 
iltimos dasturchi mehnatimi qadrlang manbaga tegilmasin

*/




?>