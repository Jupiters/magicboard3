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
$tbn_tag = Tag::Inst()->TBN();

$mb_no = $this->Config('mb','no');
$key = GV::Number($this->KN());
$bo_no = $this->bo_no;
//$category = urldecode(GV::Category());

$plus1 = $att[1];
$rows = $this->Config('rows');
if($plus1) $rows+=$plus1;

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
		A.wr_parent_no='0'
";

// 월별보기 저장소 쿼리
$archive=trim($_GET['archive']);
if($archive) {
  $archive = explode(' ', $archive);
  $archive[0] = preg_replace('/[^0-9]/','',$archive[0]);
  $archive[1] = preg_replace('/[^0-9]/','',$archive[1]);
  $sql.=" AND DATE_FORMAT(A.wr_datetime,'%Y%m')=DATE_FORMAT('{$archive[0]}-{$archive[1]}-01','%Y%m') ";
}

// 검색쿼리
$sql.= Search::Inst()->Sql(array('A.wr_subject','A.wr_content'));

// 분류쿼리
$ca1 = trim($_GET['ca1']);
$ca2 = trim($_GET['ca2']);
if($ca1) $sql.= " AND A.wr_category LIKE '{$ca1}%' ";
if($ca2) $sql.= " AND A.wr_category LIKE '%{$ca2}' ";

// 태그
$tag = $_GET['tag'];
if($tag) {
  $sql.=" AND A.wr_no IN (
			SELECT wr_no
			FROM {$tbn_tag}
			WHERE
        bo_no='{$this->bo_no}'
        AND tag_name='{$tag}'
  )";
}

$sql.="
	GROUP BY A.wr_no
	ORDER BY A.wr_datetime desc
	LIMIT 
";
$sql.= Paging::Inst()->Sql($rows);
$sql_result = DB::Get()->sql_query_list($sql);


// 게시글 번호를 위해
$tot = $this->Sql('list_cnt');
$page = Paging::Inst()->CurrentPage();
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


