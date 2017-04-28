<?php
//error_reporting(0);
header('Content-type: text/html; charset=utf-8');
defined('start') or die('Direct access not allowed.');
function confirm_query($query) { if (!$query) { die("Database Query failed!. Check Database Settings." . mysql_error()); } }
function mysql_prep($value) {
    $magic_quotes_active = get_magic_quotes_gpc();
    $new_enough_php = function_exists("mysql_real_escape_string");
    if ($new_enough_php) {
        if ($magic_quotes_active) { $value = stripslashes($value); }
        $value = mysql_real_escape_string($value);
    } else {
        if (!$magic_quotes_active) { $value = addslashes($value); }
    }
    return $value;
}

?>