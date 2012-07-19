<?php if(!defined("__MAGIC__")) exit; 

/*
 * 게시글 목록을 불러옴
 * join을 통해서 댓글 갯수등을 파악함
 * 파일은 파일이 업로드 되었는지 아닌지만 파악하면 되기 때문에
 * 서브쿼리로 불러오고 있음
 * 공지사항과 비밀글은 비트연산을 통해서 결과를 얻어냄
 */

$tbn = $this->TBN();
$tbn_cmt = Comment::Inst()->TBN();
$tbn_tag = Tag::Inst()->TBN();

$mb_no = $this->Config('mb','no');
$key = GV::Number($this->KN());
$bo_no = $this->bo_no;

// 분류
$ca1 = trim($att[1]);
$ca2 = trim($att[2]);

$sql = "
  SELECT 
    A.*,
    count(B.cmt_no) as cmt_count
  FROM `{$tbn}` A
  LEFT JOIN `{$tbn_cmt}` B ON A.wr_no=B.wr_no
  WHERE 
    A.bo_no='{$bo_no}' AND
    A.wr_parent_no='0'
";

if($ca1) $sql.= " AND A.wr_category LIKE '{$ca1}%' ";
if($ca2) $sql.= " AND A.wr_category LIKE '%{$ca2}' ";

$sql.="
  GROUP BY A.wr_no
  ORDER BY A.wr_datetime desc
  LIMIT 
";
$sql.= Paging::Inst()->Sql($this->Config('rows'));
$sql_result = DB::Get()->sql_query_list($sql);


// 게시글 번호를 위해
$tot = $this->Sql('list_cnt');
$page = Paging::Inst()->CurrentPage();
$rows = $this->Config('rows');
$tot-=($page-1)*$rows;

foreach ($sql_result as $k=>$v) {
	// 게시판 번호
	$sql_result[$k]['no'] = $tot--;
	// 아이콘들 정의
	$sql_result[$k]['wr_subject'] = array();
	$sql_result[$k]['wr_subject']['text'] = $v['wr_subject'];
	$sql_result[$k]['wr_subject']['href'] = $this->Link('subject', $v['wr_no']);

  if($key==$v['wr_no']) $sql_result[$k]['active'] = true;
}


