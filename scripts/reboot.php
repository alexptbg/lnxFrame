<?php
//sudo chmod u+s /sbin/reboot
include("../inc/config.php");
$val=shell_exec($scripts."reboot.sh 2>&1");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($val);
?>
