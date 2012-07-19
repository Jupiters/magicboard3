<?php if(!defined("__MAGIC__")) exit; 
// 비회원일 때 캡챠 검사
if(!$this->Config('mb','login')) Captcha::Inst()->Check();

$key = GV::Number($this->KN());
$tbn = $this->TBN();
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
// 기존의 비밀번호를 변경할때 사용함
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

// 최근게시글을 위해 게시글이 출력되는 아이디를 저장함
$clear['last_id'] = GV::String('id');

if(!$clear['wr_subject'])	 Dialog::alert('제목을 입력해 주세요.');
if(!$clear['wr_content'])	 Dialog::alert('내용을 입력해 주세요.');
if(!$clear['wr_writer'])	 Dialog::alert('글쓴이를 입력해 주세요.');
if($board->bo_use_category) if(!$clear['wr_category']) Dialog::alert('분류를 선택하세요.');

// 업데이트 날짜
$data['wr_update'] = 'NOW()';

DB::Get()->update($tbn, $clear, ' WHERE wr_no='.$key);
// 파일 업로드
File::Inst()->Action('upload', $key);
$del_files = $_POST[File::Inst()->Config('form_name', 'del')];
if(!is_array($del_files)) $del_files = array();
foreach ($del_files as $v) {
	File::Inst()->Action('delete', $v);
}

Dialog::alertNReplace("게시글 수정을 완료 하였습니다.", Url::Get('',$this->Mode('name')));
