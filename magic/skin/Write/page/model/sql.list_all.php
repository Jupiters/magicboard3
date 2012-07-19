<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$sql = "
	SELECT 
		A.*
	FROM `{$tbn}` A
	WHERE A.bo_no=0
";

$sql_result = DB::Get()->sql_query_list($sql);

