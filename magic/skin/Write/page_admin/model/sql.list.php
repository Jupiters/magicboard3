<?php if(!defined("__MAGIC__")) exit; 

/*
 * sql
 * -------------------
 * 목록보기
 */

$tbn = $this->TBN();

$sql = "
	SELECT *
	FROM `{$tbn}`
	WHERE bo_no='{$this->bo_no}'
  ORDER BY wr_update
";

$sql_result = DB::Get()->sql_query_list($sql);

