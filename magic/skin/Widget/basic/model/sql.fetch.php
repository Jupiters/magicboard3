<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$key_name = $this->KN();
$sql_result = DB::Get()->sql_fetch("
	SELECT *
	FROM `$tbn`
	WHERE {$key_name}='{$att[1]}'
	LIMIT 1
");
