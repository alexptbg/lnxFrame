<?php
//error_reporting(0);
define('start',TRUE);
include("inc/db.php");
include("inc/classes.php");
include("inc/functions.php");
DataBase::getInstance()->connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//once a day
$del_old1 = mysql_query("DELETE FROM `temperatures` WHERE `datetime` < DATE_SUB(NOW(), INTERVAL 1 DAY);");
confirm_query($del_old1);
echo "Done.";
?>