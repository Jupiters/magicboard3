<?php if(!defined("__MAGIC__")) exit; 

/*
 * 게시글 목록을 불러옴
 * join을 통해서 댓글 갯수등을 파악함
 * 파일은 파일이 업로드 되었는지 아닌지만 파악하면 되기 때문에
 * 서브쿼리로 불러오고 있음
 * 공지사항과 비밀글은 비트연산을 통해서 결과를 얻어냄
 */

$tbn = $this->TBN();
$tbn_file = File::Inst()->TBN();
$tbn_cmt = Comment::Inst()->TBN();

$mb_no = $this->Config('mb','no');
$key = GV::Number($this->KN());
$bo_no = $this->bo_no;
$notice_flag = $this->Config('state','notice');//wr_state & '{$this->Config('state','notice')}' AND

$sql = "
	SELECT 
		A.*,
		(
			SELECT
				file_no
			FROM {$tbn_file}
			WHERE wr_no=A.wr_no
			LIMIT 1
		) as file_no,
		A.wr_state&{$this->Config('state', 'secret')} as is_secret,
		B.cmt_no,
		count(B.cmt_no) as cmt_count
	FROM `{$tbn}` A
	LEFT JOIN `{$tbn_cmt}` B ON A.wr_no=B.wr_no
	WHERE 
		A.bo_no='{$bo_no}' AND
    (A.wr_state & {$notice_flag})=0 AND
		A.wr_parent_no='0'
";
$sql.= Search::Inst()->Sql(array('A.wr_subject','A.wr_content'));

$ca1 = urldecode(GV::String('ca1'));
$ca2 = urldecode(GV::String('ca2'));
$category='';
if($ca1) {
  $category = $ca1;
  if($ca2) {
    $category.= '|'.$ca2;
  }
}
if(trim($category)!='') $sql.= " AND A.wr_category LIKE '{$category}%' ";

$sql.="
	GROUP BY A.wr_no
	ORDER BY A.wr_datetime desc
	LIMIT 
";
$sql.= Paging::Inst()->Sql($this->Config('rows')*$this->Config('cols'));
$sql_result = DB::Get()->sql_query_list($sql);

// 게시글 번호를 위해
$tot = $this->Sql('list_cnt');
$page = Paging::Inst()->CurrentPage();
$rows = $this->Config('rows')*$this->Config('cols');
$tot-=($page-1)*$rows;

foreach ($sql_result as $k=>$v) {
	// 게시판 번호
	$sql_result[$k]['no'] = $tot--;
	// 아이콘들 정의
	$sql_result[$k]['wr_subject'] = array();
	$sql_result[$k]['wr_subject']['text'] = $v['wr_subject'];
	$sql_result[$k]['wr_subject']['href'] = $this->Link('subject', $v['wr_no']);
	// 댓글 갯수
	if($v['cmt_count']!=0) {
		$sql_result[$k]['wr_subject']['cmt'] = "<span class='cmt'>({$v['cmt_count']})</span>";
	}
	$sql_result[$k]['wr_subject']['imgs'] = array();
	// 비밀글 아이콘
	// 비밀글이 아닐 경우에만 다른 아이콘들을 출력함
	if($v['is_secret']) {
		$sql_result[$k]['wr_subject']['imgs'][] = array(
			'src'=>$this->path_img('write_icon_secret.gif'),
			'alt'=>'secret'
		);
		// 비밀글일때 제목을 숨김
		$sql_result[$k]['wr_subject']['text'] = '<b class="secret">비밀글 입니다</b>';
	} else {
		// 파일 아이콘
		if($v['file_no']) {
			$sql_result[$k]['wr_subject']['imgs'][] = array(
				'src'=>$this->path_img('write_icon_file.gif'),
				'alt'=>'file'
			);
		}
		// new아이콘
		if($this->Action('new', $v['wr_datetime'])) {
			$sql_result[$k]['wr_subject']['imgs'][] = array(
				'src'=>$this->path_img('write_icon_new.gif'),
				'alt'=>'new'
			);
		}
		// 링크 아이콘
		if($v['wr_link']) {
			$sql_result[$k]['wr_subject']['imgs'][] = array(
				'src'=>$this->path_img('write_icon_link.gif'),
				'alt'=>'link'
			);
		}
	}
}


