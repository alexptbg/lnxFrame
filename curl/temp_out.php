<?php
$login = 'admin';
$password = 'admin';
$url = "https://eesystems.net/kas/live_temp_out.php?ar_id=AR_0007_2015_1.0";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, $login.":".$password);
$result = curl_exec($ch);
curl_close($ch);  
//echo($result);
$resp = json_decode($result,true);
$temp = $resp[1];
$data = array("TEMP" => $temp);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>
