<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$bo_no = $this->bo_no;
$category = urldecode(GV::Category());

// 개수 카운트
$sql = "
	SELECT count(wr_no) as cnt 
	FROM `{$tbn}` 
	WHERE bo_no={$bo_no} AND wr_parent_no=0
";
$sql.= Search::Inst()->Sql(array('wr_subject','wr_content'));
if(trim($category)!='') $sql.= " AND wr_category='{$category}' ";

$cnt = DB::Get()->sql_fetch($sql);
$sql_result = $cnt['cnt']?$cnt['cnt']:0;
