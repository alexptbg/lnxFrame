<?php
define('start',TRUE);
include("../inc/db.php");
include("../inc/classes.php");
include("../inc/functions.php");
DataBase::getInstance()->connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$data = array();
$names = array("temp1","temp2");
$errors = array();
$c=0;
foreach($names as $name) {

  $query = "SELECT * FROM `temperatures` WHERE `name`='".$name."' ORDER BY `id` DESC LIMIT 1";
  $result = mysql_query($query);
  confirm_query($result);

  if (mysql_num_rows($result) != 0 ) {
    while($rows = mysql_fetch_assoc($result)) {
      $data[$c] = $rows;
    }
    $c++;
  }

}
/*
print "<pre>";
print_r($data);
print "</pre>";
*/
if(!empty($data)) {
  //init
  $e=0;
  foreach($data as $single) {
    $dbdate = $single['timestamp'];
    if ((time() - $dbdate) < (1 * 60)) {
      //do nothing
    } else {
      $errors[$e] = [
          "name" => "Err",
          "Error" => "Data is older than one minute on ".$single['name']
      ];
      $e++;
    }
  }
} else {
  echo "empty";
}

if(empty($errors)) {
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data);
} else {
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($errors);
}
?>