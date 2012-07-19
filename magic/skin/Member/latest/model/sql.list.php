<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$rows = $this->Config('rows');

$sql_result = DB::Get()->sql_query_list("
	SELECT *
	FROM `$tbn`
  ORDER BY mb_datetime desc
  LIMIT {$rows}
");

