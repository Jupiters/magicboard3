<?php if(!defined("__MAGIC__")) exit; 

$sql_result = DB::Get()->sql_fetch(" SELECT PASSWORD('$att[1]') ");
$sql_result = array_pop($sql_result);
