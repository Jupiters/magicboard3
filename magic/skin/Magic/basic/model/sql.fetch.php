<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$m_no = $att[1];
$sql_result = DB::Get()->sql_fetch("
	SELECT *
	FROM {$tbn}
	WHERE m_no='{$m_no}'
	LIMIT 1
");
