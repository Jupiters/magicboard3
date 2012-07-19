<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$bo_no = $this->bo_no;

$sql_result = DB::Get()->sql_query_list("
	SELECT
  DATE_FORMAT(wr_datetime,'%Y-%m') as wr_datetime,
  DATE_FORMAT(wr_datetime,'%Y년 %m월') as wr_datetime_text
	FROM `{$tbn}`
	WHERE bo_no='{$bo_no}'
");


