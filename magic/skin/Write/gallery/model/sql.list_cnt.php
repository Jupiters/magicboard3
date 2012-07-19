<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$bo_no = $this->bo_no;
$notice_flag = $this->Config('state','notice');//wr_state & '{$this->Config('state','notice')}' AND

// 개수 카운트
$sql = "
	SELECT count(wr_no) as cnt 
	FROM `{$tbn}` 
	WHERE bo_no={$bo_no} AND wr_parent_no=0 AND
    (wr_state & {$notice_flag})=0
";
$sql.= Search::Inst()->Sql(array('wr_subject','wr_content'));

$ca1 = urldecode(GV::String('ca1'));
$ca2 = urldecode(GV::String('ca2'));
$category='';
if($ca1) {
  $category = $ca1;
  if($ca2) {
    $category.= '|'.$ca2;
  }
}
if(trim($category)!='') $sql.= " AND wr_category LIKE '{$category}%' ";

$cnt = DB::Get()->sql_fetch($sql);
$sql_result = $cnt['cnt']?$cnt['cnt']:0;
