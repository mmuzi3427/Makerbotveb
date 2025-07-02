<?php
ob_start();
date_Default_timezone_set('Asia/Tashkent');
define("QoraKoder",'API_TOKEN');
$admin = "DMIN_ID";
$user = file_get_contents("admin/user.txt");
$bot = bot('getme',['bot'])->result->username;
$soat = date('H:i');
$sana = date("d.m.Y");
$botname=$bot;

$htmldomen = "domen html"; //html turgan url qoʻyiladi bu muhim

function getAdmin($chat){
$url = "https://api.telegram.org/bot".QoraKoder."/getChatAdministrators?chat_id=@".$chat;
$result = file_get_contents($url);
$result = json_decode ($result);
return $result->ok;
}

function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".QoraKoder."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}
}

function getName($id){
    $getname = bot('getchat', ['chat_id' => $id])->result->first_name . bot('getchat', ['chat_id' => $id])->result->last_name;
    if (!empty($getname)) {
        return $getname;
    } else {
        return bot('getchat', ['chat_id' => $id])->result->title;
    }
}

function reytingref(){
    $text = "🏆 TOP 10 eng ko'p taklif qilganlar:\n\n";
    $daten = [];
    $rev = [];
    $fayllar = glob("./odam/*.*");
    foreach($fayllar as $file){
        if(mb_stripos($file,".txt")!==false){
        $value = file_get_contents($file);
        $id = str_replace(["./odam/",".txt"],["",""],$file);
        $daten[$value] = $id;
        $rev[$id] = $value;
        }
        echo $file;
    }

    asort($rev);
    $reversed = array_reverse($rev);
    for($i=0;$i<10;$i+=1){
        $order = $i+1;
        $id = $daten["$reversed[$i]"];
        $ismi = getName($id);
        $text.= "<b>{$order}</b>. <a href='tg://user?id={$id}'>{$ismi}</a> - "."<code>".$reversed[$i]."</code>"." <b>ta</b>"."\n";
    }
    return $text;
}

function reytingpul(){
    $text = "🏆 TOP 10 eng ko'p balllar:\n\n";
    $daten = [];
    $rev = [];
    $fayllar = glob("./pul/*.*");
    foreach($fayllar as $file){
        if(mb_stripos($file,".txt")!==false){
        $value = file_get_contents($file);
        $id = str_replace(["./pul/",".txt"],["",""],$file);
        $daten[$value] = $id;
        $rev[$id] = $value;
        }
        echo $file;
    }
    
asort($rev);
    $reversed = array_reverse($rev);
    for($i=0;$i<10;$i+=1){
        $order = $i+1;
        $id = $daten["$reversed[$i]"];
        $ismi = getName($id);
        $text.= "<b>{$order}</b>. <a href='tg://user?id={$id}'>{$ismi}</a> - "."<code>".$reversed[$i]."</code>"." <b>ball</b>"."\n";
    }
    return $text;
}


function joinchat($id){
    global $mid;
    $array = array("inline_keyboard"=>[]);
    $kanallar = file_get_contents("admin/kanal.txt");
    $insta_url = "https://instagram.com/1.samad0v"; 

    if($kanallar == null){
        return true;
    } else {
        $ex = explode("\n", $kanallar);
        $uns = false;

        for($i=0; $i < count($ex); $i++){
            $first_line = $ex[$i];
            $first_ex = explode("@", $first_line);
            $url = $first_ex[1];

            $ism = bot('getChat', ['chat_id'=>"@".$url])->result->title;
            $ret = bot("getChatMember", [
                "chat_id"=>"@$url",
                "user_id"=>$id,
            ]);
            $stat = $ret->result->status;

            if($stat == "creator" or $stat == "administrator" or $stat == "member"){
                $array['inline_keyboard'][$i][0] = [
                    'text' => "✅ $ism",
                    'url' => "https://t.me/$url"
                ];
            } else {
                $array['inline_keyboard'][$i][0] = [
                    'text' => "❌ $ism",
                    'url' => "https://t.me/$url"
                ];
                $uns = true;
            }
        }
        $array['inline_keyboard'][] = [
            ['text' => "❌ Azo bo'lish", 'url' => $insta_url]
        ];

        $array['inline_keyboard'][] = [
            ['text' => "🔄 Tekshirish", 'callback_data' => "check"]
        ];


        if($uns == true){
            bot('sendMessage', [
                'chat_id' => $id,
                'text' => "<b>⚠️ Botdan to'liq foydalanish uchun quyidagi kanallarimizga obuna bo'ling!</b>",
                'parse_mode' => 'html',
                'disable_web_page_preview' => true,
                'reply_markup' => json_encode($array),
            ]);
            return false;
        } else {
            return true;
        }
    }
}


function number($cid){
$raqam = file_get_contents("number/$cid.txt");
if($raqam == true){
return true;
}else{
file_put_contents("step/$cid.step",'request_contact');
$getPhone = str_replace("getPhone","📱 Telefon raqamni yuborish",file_get_contents("tugma/getPhone.txt"));
$textPhone = str_replace(["textPhone","%first%","%last%","%id%","%hour%","%date%"],["📲 <b>Botdan ro'yxatdan o'tish uchun quyidagi tugma orqali telefon raqamingizni yuboring:</b>",$name,$last,$cid,$soat,$sana],file_get_contents("matn/textPhone.txt"));
bot("sendMessage",[
"chat_id"=>$cid,
'text'=>"$textPhone",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$getPhone","request_contact"=>true]],
]]),
]);
return false;
}}

$update = json_decode(file_get_contents('php://input'));
$botname = $bot;
$ref = file_get_contents("admin/taklif.txt");
$message = $update->message;
$tx = $message->text;
$cid = $message->chat->id;
$mid = $message->message_id;
$text = $message->text;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$from_id = $message->from->id;
$name = $message->from->first_name;
$last = $message->from->last_name;
$username = $message->from->username;
$bio = $message->from->about;

$contact = $message->contact;
$contact_id = $contact->user_id;
$contact_user = $contact->username;
$contact_name = $contact->first_name;
$phone = $contact->phone_number;

$data = $update->callback_query->data;
$qid = $update->callback_query->id;
$cid2 = $update->callback_query->message->chat->id;
$mid2 = $update->callback_query->message->message_id;
$callback = $update->callback_query;
$callfrid = $update->callback_query->from->id;
$callname = $update->callback_query->from->first_name;
$calluser = $update->callback_query->from->username;
$surname = $update->callback_query->from->last_name;
$about = $update->callback_query->from->about;

$step = file_get_contents("step/$cid.step");
$pul = file_get_contents("pul/$cid.txt");
$odam = file_get_contents("odam/$cid.txt");
$ban = file_get_contents("ban/$cid.txt");
$baza = file_get_contents("azo.dat");
$saved = file_get_contents("step/pulbot.txt");
$tugma = file_get_contents("step/tugma.txt");
$matn = file_get_contents("step/matn.txt");
// Tarqatildi @ProKometa_uz
//Dasturchi @Qora_Koder
$turi = file_get_contents("number/turi.txt");
$raqam = file_get_contents("number/$cid.txt");
$taklif = file_get_contents("admin/taklif.txt");
$kanal = file_get_contents("admin/kanal.txt");

$orqa = str_replace("back","◀️ Orqaga",file_get_contents("tugma/back.txt"));
$getPhone = str_replace("getPhone","📱 Telefon raqamni yuborish",file_get_contents("tugma/getPhone.txt"));
$check = str_replace("check","🔄 Tekshirish",file_get_contents("tugma/check.txt"));
$contiune = str_replace("contiune","✅ Davom etish",file_get_contents("tugma/contiune.txt"));

$manuals = str_replace(["manuals","%first%","%last%","%id%","%username%","%botname%","%user%","%balance%","%refcount%","%currency%","%solve%","%hour%","%date%"], ["<b>Qo'shilmadi!</b>",$name,$last,$cid,$username,$bot,$user,$pul,$odam,$valyuta,$solv,$soat,$sana],file_get_contents("matn/manuals.txt"));
$reklama = str_replace(["advertising","%first%","%last%","%id%","%username%","%botname%","%user%","%balance%","%refcount%","%currency%","%solve%","%hour%","%date%"], ["🤖 <b>Rasmiy botimiz:</b> @$bot",$name,$last,$cid,$username,$bot,$user,$pul,$odam,$valyuta,$solv,$soat,$sana],file_get_contents("matn/advertising.txt"));
$welcome = str_replace(["welcome","%first%","%last%","%id%","%hour%","%date%"],["🖥 <b>Asosiy menyudasiz.</b>",$name,$last,$cid,$soat,$sana],file_get_contents("matn/welcome.txt"));
$subChannels = str_replace(["subChannels","%first%","%last%","%id%","%hour%","%date%"],["⚠️ <b>Botdan foydalanish uchun, quyidagi kanallarga obuna bo'ling:</b>",$name,$last,$cid,$soat,$sana],file_get_contents("matn/subChannels.txt"));
$tolovtext = str_replace(["tolovtext","%first%","%last%","%id%","%hour%","%date%"],["<b>⤵️ Quyidagi kanal orqali to'livlarni kuzatib boring:</b>",$name,$last,$cid,$soat,$sana],file_get_contents("matn/tolovtext.txt"));
$newRef = str_replace(["newRef","%reffirst%","%reflast%","%refpay%","%refid%","%currency%"],["📳 <b>Sizda yangi</b> <a href='tg://user?id=%refid%'>taklif</a> <b>mavjud!</b>",$name,$last,$taklif,$cid,$valyuta],file_get_contents("matn/newRef.txt"));
$checkRef = str_replace(["checkRef","%reffirst%","%reflast%","%refpay%","%refid%","%currency%"],["✅ <b>Hisobingizga %refpay% %currency% qo'shildi!</b>",$name,$last,$taklif,$cid,$valyuta],file_get_contents("matn/checkRef.txt"));
$backHome = str_replace(["backHome","%first%","%last%","%id%","%hour%","%date%"],["🖥 <b>Asosiy menyuga qaytdingiz.</b>",$name,$last,$cid,$soat,$sana],file_get_contents("matn/backHome.txt"));
$textPhone = str_replace(["textPhone","%first%","%last%","%id%","%hour%","%date%"],["📲 <b>Botdan ro'yxatdan o'tish uchun quyidagi tugma orqali telefon raqamingizni yuboring:</b>",$name,$last,$cid,$soat,$sana],file_get_contents("matn/textPhone.txt"));
$conPhone = str_replace(["conPhone","%first%","%last%","%id%","%hour%","%date%","%phone%"],["<b>✅ Telefon raqamingiz qabul qilindi:</b> %phone%\n\n<i>Botdan foydalanish boshlash uchun quyidagi tugmani bosing:</i>",$name,$last,$cid,$soat,$sana,$phone],file_get_contents("matn/conPhone.txt"));
$noPhone = str_replace(["noPhone","%first%","%last%","%id%","%hour%","%date%"],["<b>Kechirasiz, Botdan faqat O'zbekiston fuqarolari foydalanishi mumkin.</b>",$name,$last,$cid,$soat,$sana],file_get_contents("matn/noPhone.txt"));

if(file_get_contents("tugma/back.txt")){
}else{
if(file_put_contents("tugma/back.txt",'back'));
}
if(file_get_contents("tugma/getPhone.txt")){
}else{
if(file_put_contents("tugma/getPhone.txt",'getPhone'));
}
if(file_get_contents("tugma/check.txt")){
}else{
if(file_put_contents("tugma/check.txt",'check'));
}
if(file_get_contents("tugma/contiune.txt")){
}else{
if(file_put_contents("tugma/contiune.txt",'contiune'));
}
if(file_get_contents("tugma/share.txt")){
}else{
if(file_put_contents("tugma/share.txt",'share'));
}
if(file_get_contents("tugma/cancellation.txt")){
}else{
if(file_put_contents("tugma/cancellation.txt",'cancellation'));
}
if(file_get_contents("tugma/confirm.txt")){
}else{
if(file_put_contents("tugma/confirm.txt",'confirm'));
}
if(file_get_contents("tugma/transition.txt")){
}else{
if(file_put_contents("tugma/transition.txt",'transition'));
}

//matn
if(file_get_contents("matn/welcome.txt")){
}else{
if(file_put_contents("matn/welcome.txt",'welcome'));
}
if(file_get_contents("matn/subChannels.txt")){
}else{
if(file_put_contents("matn/subChannels.txt",'subChannels'));
}
if(file_get_contents("matn/tolovtext.txt")){
}else{
if(file_put_contents("matn/tolovtext.txt",'tolovtext'));
}
if(file_get_contents("matn/newRef.txt")){
}else{
if(file_put_contents("matn/newRef.txt",'newRef'));
}
if(file_get_contents("matn/checkRef.txt")){
}else{
if(file_put_contents("matn/checkRef.txt",'checkRef'));
}
if(file_get_contents("matn/backHome.txt")){
}else{
if(file_put_contents("matn/backHome.txt",'backHome'));
}
if(file_get_contents("matn/textPhone.txt")){
}else{
if(file_put_contents("matn/textPhone.txt",'textPhone'));
}
if(file_get_contents("matn/conPhone.txt")){
}else{
if(file_put_contents("matn/conPhone.txt",'conPhone'));
}
if(file_get_contents("matn/noPhone.txt")){
}else{
if(file_put_contents("matn/noPhone.txt",'noPhone'));
}
if(file_get_contents("matn/earnRef.txt")){
}else{
if(file_put_contents("matn/earnRef.txt",'earnRef'));
}

if(file_get_contents("admin/taklif.txt")){
}else{
if(file_put_contents("admin/taklif.txt","250"));
}

mkdir("step");
mkdir("ban");
mkdir("pul");
mkdir("odam");
mkdir("admin");
mkdir("tugma");
mkdir("matn");
mkdir("number");

$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"⚙ Asosiy sozlamalar"]],
[['text'=>"📢 Kanallar"],['text'=>"📊 Statistika"]],
[['text'=>"🔎 Foydalanuvchini boshqarish"]],
[['text'=>"📨 Xabarnoma"],['text'=>"$orqa"]],
]]);

$menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🥇️ Qoshilish"]],
[['text'=>"🖥 ️Kabinet"],['text'=>"🏆Sovrinlar"]],
]]);

$menus = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🥇️ Qoshilish"]],
[['text'=>"🖥 ️Kabinet"],['text'=>"🏆Sovrinlar"]],
[['text'=>"🗄 Boshqarish"]],
]]);

$back = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$orqa"]],
]]);

$boshqarish = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]]);

if($text){
if($ban == "ban"){
if($cid == $admin){
}else{
}}else{}}

if($text){
$ban = file_get_contents("ban/$cid2.txt");
if($ban == "ban"){
if($cid2 == $admin){
}else{
}}else{}}

if($step=="request_contact"){
$phone = str_replace("+","","$phone");
if((strlen($phone)==12) and (mb_stripos($phone,"998")!==false)){
if($contact_id == $cid){
file_put_contents("number/$cid.txt","$phone");
bot("sendMessage",[
"chat_id"=>$cid,
"text"=>"$conPhone",
"parse_mode"=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"$contiune",'callback_data'=>"davom"]],
]])
]);
unlink("step/$cid.step");
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"$textPhone",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$getPhone","request_contact"=>true]],
]]),
]);
}}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"$noPhone",
'parse_mode'=>'html',
'reply_to_message_id'=>$mid,
'reply_markup'=>json_encode([
'remove_keyboard'=>true,
]),
]);
file_put_contents("ban/$cid.txt",'ban');
unlink("step/$cid.step");
}}
// Tarqatildi @ProKometa_uz
//Dasturchi @Qora_Koder
if($data == "davom"){
$welcome = str_replace(["welcome","%first%","%last%","%id%","%hour%","%date%"],["🖥 <b>Asosiy menyudasiz.</b>",$callname,$surname,$cid2,$soat,$sana],file_get_contents("matn/welcome.txt"));
if($cid2 != $admin){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"$welcome",
'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
}else{
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"$welcome",
'parse_mode'=>'html',
'reply_markup'=>$menus,
]);
}}

if(isset($message)){
$pul = file_get_contents("pul/$cid.txt");
$mm = $pul + 0;
file_put_contents("pul/$cid.txt","$mm");
$solv = file_get_contents("pul/$cid.dat");
$m = $solv + 0;
file_put_contents("pul/$cid.dat","$m");
$odam = file_get_contents("odam/$cid.txt");
$kkd = $odam + 0;
file_put_contents("odam/$cid.txt","$kkd");
}

if(isset($callback)){
$get = file_get_contents("azo.dat");
if(mb_stripos($get,$callfrid)==false){
file_put_contents("azo.dat", "$get\n$callfrid");
bot('sendMessage',[
'chat_id'=>$admn,
'text'=>"<b>👤 Yangi obunachi botg qo'shildi!\n <code>$callfrid</code></b>",
'parse_mode'=>"html"
]);
}}
// Tarqatildi @ProKometa_uz
//Dasturchi @Qora_Koder
if(isset($message)){
$get = file_get_contents("azo.dat");
if(mb_stripos($get,$from_id)==false){
file_put_contents("azo.dat", "$get\n$from_id");
bot('sendMessage',[
'chat_id'=>$admi,
'text'=>"<b>👤 Yangi obunachi botga qo'shildi! \n <code>$from_id</code></b>",
'parse_mode'=>"html"
]);
}}

if($text=="/start" and joinchat($cid)=="true" and number($cid)=="true"){
if($cid != $admin){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$welcome",
'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
}else{
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"$welcome",
'parse_mode'=>'html',
'reply_markup'=>$menus,
]);
}}

if(mb_stripos($text,"/start")!==false){
$refid = explode(" ",$text);
$refid = $refid[1];
if(strlen($refid)>0 and $refid>0){
if($refid == $cid){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$welcome",
'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
}else{
if(mb_stripos($baza,"$cid")!==false){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$welcome",
'parse_mode'=>'html',
'reply_markup'=>$menus,
]);
}else{
bot('SendMessage',[
'chat_id'=>$refid,
'text'=>"$newRef",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.id","$refid");
file_put_contents("step/$cid.cid","$refid");
$joinkey = joinchat($cid);
if($joinkey != null){
$pulim = file_get_contents("pul/$refid.txt");
$a = $pulim + $taklif;
file_put_contents("pul/$refid.txt","$a");
$odam = file_get_contents("odam/$refid.txt");
$b = $odam + 1;
file_put_contents("odam/$refid.txt","$b");
bot('SendMessage',[
'chat_id'=>$refid,
'text'=>"$checkRef",
'parse_mode'=>'html',
]);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$welcome",
'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
unlink("step/$cid.id");
unlink("step/$cid.cid");
}}}}}

if($data == "check"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
if(joinchat($cid2)==true and number($cid2)=="true"){
$refid = file_get_contents("step/$cid2.id");
$cid3 = file_get_contents("step/$cid2.cid");
if($refid !=$cid3){
if($cid2 != $admin){
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"$welcome",
'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
}else{
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"$welcome",
'parse_mode'=>'html',
'reply_markup'=>$menus,
]);
}}else{
$pulim = file_get_contents("pul/$cid3.txt");
$a = $pulim + $taklif;
$odam = file_get_contents("odam/$cid3.txt");
$b = $odam + 1;
file_put_contents("pul/$cid3.txt","$a");
file_put_contents("odam/$cid3.txt","$b");
if($ccid != $admin){
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"$welcome",
'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
}else{
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"$welcome",
'parse_mode'=>'html',
'reply_markup'=>$menus,
]);
}
bot('SendMessage',[
'chat_id'=>$cid3,
'text'=>"$checkRef",
'parse_mode'=>'html',
]);
unlink("step/$cid2.id");
unlink("step/$cid2.cid");
}}}
// Tarqatildi @ProKometa_uz
//Dasturchi @Qora_Koder
if($text == "$orqa"){
if($cid != $admin){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$backHome",
'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"$backHome",
'parse_mode'=>'html',
'reply_markup'=>$menus,
]);
unlink("step/$cid.step");
}}


if($text=="🏆 Reyting" and joinchat($cid)=="true"){
 bot('sendmessage',[
 'chat_id'=>$cid,
 'text'=>"✍️ <b>Reyting nima bo'yicha ko'rsatilsin?</b>",
  'parse_mode'=>html,
  'reply_markup'=>json_encode([
  'inline_keyboard'=>[
 [['text'=>"🏆 Top Ballar",'callback_data'=>"reytingpul"]],
[['text'=>"🏆 Top Takliflar",'callback_data'=>"reytingref"]],
 ]
 ]),
 ]);
}

if($data=="reytin" and joinchat($cid2)=="true"){
    bot('deletemessage',[
 'chat_id'=>$cid2,
 'message_id'=>$mid2,
 ]);
 bot('sendmessage',[
 'chat_id'=>$cid2,
 'text'=>"✍️ <b>Reyting nima bo'yicha ko'rsatilsin?</b>",
  'parse_mode'=>html,
  'reply_markup'=>json_encode([
  'inline_keyboard'=>[
 [['text'=>"🏆 Top Ballar",'callback_data'=>"reytingpul"]],
[['text'=>"🏆 Top Takliflar",'callback_data'=>"reytingref"]],
 ]
 ]),
 ]);
}
  if(mb_stripos($data, "reyting")!==false){
  $top = $data();
  bot('deletemessage',[
  'chat_id'=>$cid2,
  'message_id'=>$mid2,
  ]);
  bot('sendmessage',[
  'chat_id'=>$cid2,
   'text'=>"$top",
   'parse_mode'=>html,
   'reply_markup'=>json_encode([
  'inline_keyboard'=>[
  [['text'=>"« Oraqaga",'callback_data'=>"reytin"]],
  ]
  ]),
     ]);
 }
 
 if($text == "🥇️ Qoshilish" and joinchat($cid) == "true"){

    $file = "konkurs.txt";
    $userLine = "$cid | $name";

// Tarqatildi @ProKometa_uz
//Dasturchi @Qora_Koder
    $alreadyJoined = false;
    if(file_exists($file)){
        $users = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($users as $user){
            if(strpos($user, "$cid |") === 0){
                $alreadyJoined = true;
                break;
            }
        }
    }

    if($alreadyJoined){
        bot('SendMessage',[
            'chat_id'=>$cid,
            'text'=>"<b>Siz konkurs ishtirokchisisiz ✅\nKonkurs tugashini kuting, g'olib aniqlanadi. Omad sizga!</b>",
            'parse_mode'=>"html"
        ]);
    } else {
        file_put_contents($file, $userLine . PHP_EOL, FILE_APPEND);
        bot('SendMessage',[
            'chat_id'=>$cid,
            'text'=>"<b>Siz konkurs ishtirokchisiga aylandingiz ✅\nOmad tilaymiz!</b>",
            'parse_mode'=>"html"
        ]);
    }
}



if($text == "🖥 ️Kabinet" and joinchat($cid) == true){
$nomeri = file_get_contents("number/$cid.txt");
$file = "konkurs.txt";
$status = "Qatnashmayapsiz ❌";
if(file_exists($file)){
$users = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach($users as $user){
if(strpos($user, "$cid |") === 0){
$status = "Qatnashyapsiz ✅";
break;
}
}
}
bot('sendMessage',[
'chat_id'=>$cid,
'message_id'=>$mid,
'text'=>"🗄 Kabinetingizga xush kelibsiz!

🆔 ID raqamingiz: <code>$cid</code> 
🎯 Konkursda: <b>$status</b>
➖➖➖➖➖➖➖➖➖➖
Telefon raqam: +$nomeri",
'parse_mode'=>"html",
]);
}


if($text=="🏆Sovrinlar" and number($cid)=="true"){
if(joinchat($cid)==true){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$manuals",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
]);
}}


if($text=="🗄 Boshqarish" or $text == "/panel" and $cid == $admin){
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Boshqaruv panelidasiz.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/iTDevo.txt");
unlink("step/$cid.step");
unlink("step/tugma.txt");
unlink("step/matn.txt");
}

if($data == "yopish"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
}

if($text == "🔎 Foydalanuvchini boshqarish"){
if($cid == $admin){
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Kerakli foydalanuvchining ID raqamini kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid.step",'iD');
}}
// Tarqatildi @ProKometa_uz
//Dasturchi @Qora_Koder
if($step == "iD"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(file_exists("pul/$text.txt")){
file_put_contents("step/pulbot.txt","$text");
$pul = file_get_contents("pul/$text.txt");
$odam = file_get_contents("odam/$text.txt");
$ban = file_get_contents("ban/$text.txt");
if($ban == null){
$bans = "🔔 Banlash";
}
if($ban == "ban"){
$bans = "🔕 Bandan olish";
}
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi topildi!

ID:</b> <a href='tg://user?id=$text'>$text</a>
<b>Balans: $pul $valyuta
Takliflar: $odam ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$bans",'callback_data'=>"ban"]],
[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]]
]])
]);
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Foydalanuvchi topilmadi.</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
}}}

if($data == "foydalanuvchi"){
$pul = file_get_contents("pul/$saved.txt");
$odam = file_get_contents("odam/$saved.txt");
$ban = file_get_contents("ban/$saved.txt");
if($ban == null){
$bans = "🔔 Banlash";
}
if($ban == "ban"){
$bans = "🔕 Bandan olish";
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Foydalanuvchi topildi!

ID:</b> <a href='tg://user?id=$saved'>$saved</a>
<b>Balans: $pul $valyuta
Takliflar: $odam ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$bans",'callback_data'=>"ban"]],
[['text'=>"➕ Ball qo'shish",'callback_data'=>"plus"],['text'=>"➖ Ball ayirish",'callback_data'=>"minus"]]
]])
]);
}

if($data == "plus"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha Ball qo'shmoqchisiz?</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]])
]);
file_put_contents("step/$cid2.step",'plus');
}

if($step == "plus"){
if($data=="Foydalanuvchi"){
unlink("step/$ccid.step");
}else{
if($cid == $admin){
if(is_numeric($text)=="true"){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Adminlar tomonidan hisobingiz $text Ball to'ldirildi</b>",
'parse_mode'=>"html",
'reply_markup'=>$menu,
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Foydalanuvchi hisobiga $text Ball qo'shildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$pul = file_get_contents("pul/$saved.txt");
$miqdor = $pul + $text;
file_put_contents("pul/$saved.txt",$miqdor);
unlink("step/pulbot.txt");
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}}

if($data=="minus"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha Ball ayirmoqchisiz?</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]])
]);
file_put_contents("step/$cid2.step",'minus');
}

if($step == "minus"){
if($data=="foydalanuvchi"){
unlink("step/$ccid.step");
}else{
if($cid == $admin){
if(is_numeric($text)=="true"){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Adminlar tomonidan hisobingizdan $text Ball olib tashlandi</b>",
'parse_mode'=>"html",
'reply_markup'=>$menu,
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Foydalanuvchi hisobidan $text Ball olib tashlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$pul = file_get_contents("pul/$saved.txt");
$miqdor = $pul - $text;
file_put_contents("pul/$saved.txt",$miqdor);
unlink("step/pulbot.txt");
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}}
// Tarqatildi @ProKometa_uz
//Dasturchi @Qora_Koder
if($data=="ban"){
$ban = file_get_contents("ban/$saved.txt");
if($admin != $saved){
if($ban == "ban"){
unlink("ban/$saved.txt");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Foydalanuvchi ($saved) bandan olindi!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]])
]);
}else{
file_put_contents("ban/$saved.txt",'ban');
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Foydalanuvchi ($saved) banlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]])
]);
}}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Asosiy adminlarni blocklash mumkin emas!",
'show_alert'=>true,
]);
}}

if($text == "📢 Kanallar"){
if($cid == $admin){
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔐 Majburiy obunalar",'callback_data'=>"majburiy"]],
[['text'=>"Yopish",'callback_data'=>"yopish"]]
]])
]);
}}

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
[['text'=>"Yopish",'callback_data'=>"yopish"]]
]])
]);
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
]])
]);
}

if($data == "qoshish"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Kanalingiz userini kiriting:

Namuna:</b> @Prokometa_uz",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step","qo'shish");
}

if($step == "qo'shish"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if($cid == $admin){
if(isset($text)){
if(mb_stripos($text, "@")!==false){
if($kanal == null){
file_put_contents("admin/kanal.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>$text - kanal qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}else{
file_put_contents("admin/kanal.txt","$kanal\n$text");
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>$text - kanal qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}}else{
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Kanalingiz useri yuboring:

Namuna:</b> @ProKometa_uz",
'parse_mode'=>'html',
]);
}}}}}



if($data == "ochirish"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Kanallar o'chirildi</b>",
'parse_mode'=>'html',
]);
unlink("admin/kanal.txt");
}

if($data == "royxat"){
$soni = substr_count($kanal,"@");
if($kanal == null){
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
'text'=>"📂 <b>Kanallar ro'yxati bo'sh!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy"]],
]])
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

$kanal

<b>Ulangan kanallar soni:</b> $soni ta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy"]],
]])
]);
}}



if($data == "vazifa"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Kanalingiz userini kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step","vazifa");
}

if($step == "vazifa" and $cid == $admin){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(mb_stripos($text,"@")!==false){
$get = bot('getChat',[
'chat_id'=>$text
]);
$types = $get->result->type;
$ch_name = $get->result->title;
$ch_user = $get->result->username;
if(getAdmin($ch_user)== true){
file_put_contents("admin/vazifa.txt","@$ch_user");
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot ushbu kanalda admin emas yoki noto'g'ri kanal manzili yuborildi!</b>",
'parse_mode'=>'html',
]);
}}else{
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"⚠️ <b>Kanal manzili kiritishda xatolik!</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
}}}



if($text == "📨 Xabarnoma" and $cid==$admin){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Yuboriladigan xabar turini tanlang;</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Oddiy xabar",'callback_data'=>"send"],['text'=>"Forward xabar",'callback_data'=>"forsend"]],
[['text'=>"Foydalanuvchiga xabar",'callback_data'=>"user"]],
]])
]);
}

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
}



if($step == "user"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if($cid == $admin){
if(is_numeric($text)=="true"){
file_put_contents("step/pulbot.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Xabaringizni kiriting:</b>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step",'xabar');
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}}



if($step == "xabar"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if($cid == $admin){
bot('SendMessage',[
'chat_id'=>$saved,
'text'=>"$text",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Xabaringiz yuborildi ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
unlink("step/pulbot.txt");
}}}

if($data == "send"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"*Xabaringizni kiriting:*",
'parse_mode'=>"markdown",
'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step","users");
}
if($step=="users"){
if($cid == $admin){
$lich = file_get_contents("azo.dat");
$lichka = explode("\n",$lich);
foreach($lichka as $lichkalar){
$okuser=bot("sendmessage",[
'chat_id'=>$lichkalar,
'text'=>$text,
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
]);
}}}
if($okuser){
bot("sendmessage",[
'chat_id'=>$admin,
'text'=>"<b>Hammaga yuborildi ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}

if($data == "forsend"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"*Xabaringizni yuboring:*",
'parse_mode'=>"markdown",
'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step","forusers");
}
if($step=="forusers"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if($cid == $admin){
$lich = file_get_contents("azo.dat");
$lichka = explode("\n",$lich);
foreach($lichka as $lichkalar){
$okforuser=bot("forwardMessage",[
'from_chat_id'=>$cid,
'chat_id'=>$lichkalar,
'message_id'=>$mid,
]);
}}}}
if($okforuser){
bot("sendmessage",[
'chat_id'=>$admin,
'text'=>"<b>Hammaga yuborildi ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}

if($text == "📊 Statistika" and $cid == $admin){
$baza = file_get_contents("azo.dat");
$obsh = substr_count($baza, "\n");
$konkurs_soni = 0;
if(file_exists("konkurs.txt")){
$konkurs = file("konkurs.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$konkurs_soni = count($konkurs);
}
$load = sys_getloadavg();
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

👥 <b>Foydalanuvchilar: $obsh ta</b>
🥇 <b>Konkurs ishtirokchilari: $konkurs_soni ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Yopish", 'callback_data'=>"yopish"]],
]
])
]);
}


if($text == "⚙ Asosiy sozlamalar"){
if($cid == $admin){
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Quyidagilardan birini tanlamg:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text' => "🎯 G‘olibni aniqlash",'web_app' => ['url' => "$htmldomen"]]],
[['text'=>"📑 Hozirgi holat",'callback_data'=>"holat"]],
[['text'=>"🗑 Konkursni tozalash", 'callback_data'=>"konkursclear"]],
[['text'=>"🏆Sovrinlar",'callback_data'=>"malia"]],
[['text'=>"Yopish",'callback_data'=>"yopish"]],
]])
]);
}}

if($data == "asosiy"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Quyidagilardan birini tanlamg:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text' => "🎯 G‘olibni aniqlash",'web_app' => ['url' => "https://67f7e0abc45ae.xvest4.ru/Zakasbotlar/referalKonkurs/index.html"]]],
[['text'=>"📑 Hozirgi holat",'callback_data'=>"holat"]],
[['text'=>"🗑 Konkursni tozalash",'callback_data'=>"konkursclear"]],
[['text'=>"🏆Sovrinlar",'callback_data'=>"malia"]],
[['text'=>"Yopish",'callback_data'=>"yopish"]],
]])
]);
}

if($data == "konkursclear"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
unlink("konkurs.txt"); 
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Konkurs ishtirokchilari muvaffaqiyatli tozalandi 🧹</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga", 'callback_data'=>"asosiy"]],
]
])
]);
}




if($data == "holat"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Hozirgi holat:</b>

<b>2. Malumot: </b> $manuals",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]],
]])
]);
}

if($data == "taklif"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Taklif narxini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step","taklifpul");
}

if($step == "taklifpul"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if($cid == $admin){
if(isset($text)){
file_put_contents("admin/taklif.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}}}}

if($data == "malia"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Malumotlarni kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step","manama");
}

if($step == "manama"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if($cid == $admin){
if(isset($text)){
file_put_contents("matn/manuals.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}}}}

?>