<?php if(!defined("__MAGIC__")) exit; 

/*
 * $att[1] = 게시판번호
 * $att[2] = 회원번호
 * 필요없을때는 null로 넣어야함
 */
$bo_no = isset($att[1])?$att[1]:false;
$mb_no = isset($att[2])?$att[2]:false;

$tbn = $this->TBN();

$sql = "
	SELECT
    *,
    count(tag_no) as cnt
	FROM `{$tbn}`
	WHERE 1
";

if($bo_no!==false) {
  $sql.=" AND bo_no='{$bo_no}' ";
}

if($mb_no!==false) {
  $sql.=" AND mb_no='{$mb_no}' ";
}

$sql.="
  GROUP BY tag_name
";

$sql_result = DB::Get()->sql_query_list($sql);

