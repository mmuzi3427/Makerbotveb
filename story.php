<?php
date_Default_timezone_set('Asia/Tashkent');

define('API_KEY', "LITE_TOKEN"); 

$admin = "LITE_ID";

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
    }
}

$update = json_decode(file_get_contents('php://input'));

$message = $update->message;
$callback = $update->callback_query;

if($message){
    $chat_id = $message->chat->id;
    $message_id = $message->message_id;
    $text = $message->text;
    $name = $message->from->first_name; $name = str_replace(["<",">","/"],["","",""],$name);
    $username = $message->from->username;
    $from_id = $message->from->id;
}

if($callback){
    $data = $callback->data;
    $call_id = $callback->id;
    $chat_id = $callback->message->chat->id;
    $message_id = $callback->message->message_id;
    $from_id = $callback->from->id;
    $name = $callback->from->first_name; $name = str_replace(["<",">","/"],["","",""],$name);
    $username = $callback->from->username;
}

$bot_user = bot('getme',['bot'])->result->username;
$bot_id = bot('getme',['bot'])->result->id;

$soat = date("H:i"); 
$sana = date("d-m-Y");

if($text=="/start"){
    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'reply_to_message_id'=>$message_id,
        'text'=>"ðŸ‘‹ Salom <b>$name</b>, men sizga telegram story yuklab olishingizga yordam beraman. Iltimos menga foydalanuvchi yoki kanal, guruh @username ni yuboring.",
        'parse_mode'=>'html',
    ]);
    exit();
}

if(isset($text)){
    $id = 1; // birinchi stories ni yuklash
    $get_url = json_decode(file_get_contents("https://cosmoai.uz/story/index.php?user=$text&id=$id"),true);
    if($get_url['result']==null){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'reply_to_message_id'=>$message_id,
            'text'=>"Hech narsa topilmadi",
            'parse_mode'=>"html",
        ]);
    }else{
        $count = $get_url['count'];
        if($get_url['type']=="video"){
            bot('sendvideo',[
                'chat_id'=>$chat_id,
                'reply_to_message_id'=>$message_id,
                'video'=>$get_url['result'],
                'caption'=>$get_url['caption']
            ]);
            bot('sendMessage',[
                'chat_id'=>$chat_id,
                'text'=>"$text da $count ta stories bor",
                'parse_mode'=>"html",
            ]);
        }elseif($get_url['type']=="photo"){
            bot('sendphoto',[
                'chat_id'=>$chat_id,
                'reply_to_message_id'=>$message_id,
                'photo'=>$get_url['result'],
                'caption'=>$get_url['caption']
            ]);
            bot('sendMessage',[
                'chat_id'=>$cid,
                'text'=>"$text da $count ta stories bor",
                'parse_mode'=>"html",
            ]);
        }
    }
}

?>
