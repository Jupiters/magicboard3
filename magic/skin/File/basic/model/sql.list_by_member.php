<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$sql_result = DB::Get()->Sql_query_list("
	SELECT * 
	FROM `{$tbn}`
	WHERE mb_no='{$att[1]}' AND wr_no=0
");
