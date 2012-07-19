<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();

$sql_result = DB::Get()->sql_query_list("
	SELECT *
	FROM {$tbn}
	ORDER BY m_parent, m_order
");

