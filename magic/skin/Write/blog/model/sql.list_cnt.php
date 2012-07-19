<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$tbn_tag = Tag::Inst()->TBN();
$bo_no = $this->bo_no;
$category = urldecode(GV::Category());

// 개수 카운트
$sql = "
	SELECT count(wr_no) as cnt 
	FROM `{$tbn}` 
	WHERE bo_no={$bo_no} AND wr_parent_no=0
";

// 월별보기 저장소 쿼리
$archive=trim($_GET['archive']);
if($archive) {
  $archive = explode(' ', $archive);
  $archive[0] = preg_replace('/[^0-9]/','',$archive[0]);
  $archive[1] = preg_replace('/[^0-9]/','',$archive[1]);
  $sql.=" AND DATE_FORMAT(wr_datetime,'%Y%m')=DATE_FORMAT('{$archive[0]}-{$archive[1]}-01','%Y%m') ";
}

$sql.= Search::Inst()->Sql(array('wr_subject','wr_content'));

$ca1 = trim($_GET['ca1']);
$ca2 = trim($_GET['ca2']);
if($ca1) $sql.= " AND wr_category LIKE '{$ca1}%' ";
if($ca2) $sql.= " AND wr_category LIKE '%{$ca2}' ";


// 태그
$tag = $_GET['tag'];
if($tag) {
  $sql.=" AND wr_no IN (
			SELECT wr_no
			FROM {$tbn_tag}
			WHERE bo_no='{$this->bo_no}'
        AND tag_name='{$tag}'
  )";
}

$cnt = DB::Get()->sql_fetch($sql);
$sql_result = $cnt['cnt']?$cnt['cnt']:0;
