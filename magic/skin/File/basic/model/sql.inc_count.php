<?php if(!defined("__MAGIC__")) exit; 

$sql = "
	UPDATE {$this->TBN()} SET
	file_download=file_download+1
	WHERE {$this->KN()}={$att[1]} 
	LIMIT 1
";
DB::Get()->sql_query($sql);