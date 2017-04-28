<?php
$url = "http://eesystems.net/kas/live_temp_out.php?ar_id=AR_0007_2015_1.0";

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
$temp = $resp[1];
$data = array("TEMP" => $temp);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>
