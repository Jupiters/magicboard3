<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$key_name = $this->KN();

// 게시판 삭제
$sql = "
	DELETE FROM {$tbn}
	WHERE {$key_name}='{$att[1]}'
	LIMIT 1
";
DB::Get()->sql_query($sql);