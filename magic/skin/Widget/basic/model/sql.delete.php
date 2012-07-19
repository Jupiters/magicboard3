<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$key_name = $this->KN();
DB::Get()->sql_query("
	DELETE FROM `{$tbn}`
	WHERE {$key_name}='$att[1]' 
");