<?php
/*
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
ini_set('log_errors', true);
ini_set('html_errors', false);
ini_set('error_log', dirname(__FILE__).'script_error.log');
ini_set('display_errors', true);
*/
$data = array();
$login = 'admin';
$password = 'admin';
$url = "https://eesystems.net/weather/api.php";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch,CURLOPT_USERPWD, $login.":".$password);
$result = curl_exec($ch);
curl_close($ch);  
//echo($result);
$resp = json_decode($result,true);
$data = $resp;
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>
