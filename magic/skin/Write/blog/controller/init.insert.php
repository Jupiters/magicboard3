<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$key = GV::Number($this->KN());
$board = Board::Inst()->bo_no($this->bo_no);
$bo_no = $board->bo_no;

$clear = $this->Clear();
$clear['wr_content'] = Editor::Inst('',$board->bo_editor)->db_in($_POST['wr_content']);

$clear['wr_state'] = 0;
if($_POST['opt_notice']) {
	$clear['wr_state'] = $clear['wr_state']|$this->Config('state', 'notice');
}
if($_POST['opt_secret']) {
	$clear['wr_state'] = $clear['wr_state']|$this->Config('state', 'secret');
}

// 비회원일 경우에 비밀번호 검사를 함
if(!$this->Config('mb','login')) {
	$clear['mb_no'] = 0;
	if($clear['wr_password']!=$_POST['wr_password_check'])
		Dialog::alert('[비밀번호/비밀번호확인]이 일치하지 않습니다.');
	if(!$clear['wr_password'])
		Dialog::alert('비밀번호를 입력해 주세요.');
	$clear['wr_password'] = $this->Sql('password', $clear['wr_password']);
} else {
	$clear['wr_writer'] = Member::Inst()->mb_nick;
}

$r = GV::String('r');
$id1 = GV::String('id1');
$id2 = GV::String('id2');
$qstr = array();
if($r) $qstr[] = 'r='.$r;
if($id1) $qstr[] = 'id1='.$id1;
if($id2) $qstr[] = 'id2='.$id2;
$clear['last_id'] = '?'.implode('&', $qstr);

// 기타 필수 입력 검사
if(!$clear['wr_subject'])	 Dialog::alert('제목을 입력해 주세요.');
if(!$clear['wr_writer'])	 Dialog::alert('글쓴이를 입력해 주세요.');
if(!$clear['wr_content'])	 Dialog::alert('내용을 입력해 주세요.');


// 회원이면 자신의 회원번호를 입력함
if($this->Config('mb','login')) $clear['mb_no'] = $this->Config('mb','no');
// 기본 정보들 자동입력
$clear['wr_datetime'] = 'NOW()';
$clear['wr_update'] = 'NOW()';
$clear['wr_ip'] = "INET_ATON('".Util::GetRealIPAddr()."')";
$clear['bo_no'] = $bo_no;

if($_POST['ca1']) $clear['wr_category'][] = $_POST['ca1']; 
if($_POST['ca2']) $clear['wr_category'][] = $_POST['ca2']; 
$clear['wr_category'] = implode('|',$clear['wr_category']); 

// 공지사항
$clear['wr_state'] = 0;
if($_POST['opt_notice']) {
	$clear['wr_state'] = $clear['wr_state']|$this->Config('state', 'notice');
}

// 데이터 입력
$key = DB::Get()->InsertEx($tbn, $clear, array('wr_ip','wr_datetime','wr_update'));
if(!$key) Dialog::Alert('정확한 정보를 입력하세요.');

// 태그 입력
$tags = $_POST['tags'];
if($tags) {
  Tag::Inst()->Action('insert', $bo_no, $key, array_unique(array_filter(explode(',', $tags))));
}

// 파일 업로드
File::Inst()->Action('upload', $key);

$url = $this->Link('view', $key);
if($clear['wr_is_secret']) $url = $this->Link('list');

Url::GoReplace($url);


