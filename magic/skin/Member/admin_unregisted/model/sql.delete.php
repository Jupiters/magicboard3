<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$key_name = $this->KN();

$sql_result = false;
if($att[1]) {
	$sql_result = DB::Get()->sql_query("
		DELETE FROM `$tbn`
		WHERE {$key_name}='{$att[1]}'
		LIMIT 1
	");
}

