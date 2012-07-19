<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();

$sql_result = DB::Get()->sql_fetch("
	SELECT *
	FROM `$tbn`
	WHERE mb_id='{$att[1]}'
	LIMIT 1
");
