<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$tbn_file = File::Inst()->TBN();
$tbn_cmt = Comment::Inst()->TBN();

$mb_no = $this->Config('mb','no');
$key = GV::Number($this->KN());
$bo_no = $this->bo_no;
//$category = urldecode(GV::Category());

$sql = "
	SELECT 
		wr_category,
		count(wr_no) as cnt
	FROM `{$tbn}`
	WHERE 
		bo_no='{$bo_no}' AND
		wr_parent_no='0'
	GROUP BY wr_category
";

$sql_result = DB::Get()->sql_query_list($sql);


