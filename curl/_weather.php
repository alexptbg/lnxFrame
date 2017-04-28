<?php
/*
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
ini_set('log_errors', true);
ini_set('html_errors', false);
ini_set('error_log', dirname(__FILE__).'script_error.log');
ini_set('display_errors', true);
*/
$url = "http://eesystems.net/weather/api.php";

//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a beauty json :3
$resp = json_decode($result,true);

//$data = array("TEMP" => $resp[1]);
$data = $resp;
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>
