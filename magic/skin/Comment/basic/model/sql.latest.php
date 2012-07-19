<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$bo_no = $att[1];
$limit = $att[2];
$is_admin = $this->Config('mb','admin');
$mb_no = $this->Config('mb','no');

$sql = "
  SELECT
    *,
    DATE_FORMAT(cmt_datetime, '%Y년 %c월 %e일 %p %l:%i') as cmt_datetime_text
  FROM `{$tbn}`
  WHERE bo_no='{$bo_no}'
  ORDER BY cmt_datetime desc
  LIMIT {$limit}
";
$sql_result = DB::Get()->sql_query_list($sql);
  
