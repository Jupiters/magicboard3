<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$key_name = $this->KN();
$sql = "
	DELETE FROM `{$tbn}`
	WHERE {$key_name}='$att[1]' 
";
DB::Get()->sql_query($sql);