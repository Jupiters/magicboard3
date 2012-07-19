<?php if(!defined("__MAGIC__")) exit; 

/*
 * 공지사항 출력 SQL
 * bit operation으로 공지사항 유무를 체크한다
 */
$sql_result = DB::Get()->sql_query_list("
	SELECT 
		wr_no,
		wr_datetime,
		wr_subject
	FROM `{$this->TBN()}`
	WHERE
		bo_no='{$this->bo_no}' AND
		wr_state & '{$this->Config('state','notice')}' AND
		wr_parent_no='0' 
	ORDER BY wr_datetime desc
");