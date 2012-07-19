<?php if(!defined("__MAGIC__")) exit; 

$wr_no = GV::Number('wr_no');
$cmt_no = GV::Number($this->KN());
$is_admin = $this->Config('mb','admin');

if(!$this->Can('delete',$cmt_no)) {
	Dialog::Alert('삭제 권한이 없습니다.');
}

/*
 * 댓글의 댓글 검사
 */
$children = $this->Sql('list_children', $wr_no, $cmt_no);
if(sizeof($children)!=0) {
	Dialog::Alert('댓글이 있어서 삭제할수 없습니다.');
}

/*
 * 비회원 글일경우
 * 비밀번호 비교 후 제거 
 */
$data = $this->Sql('fetch',$cmt_no);
if(!$is_admin && $data['mb_no']==0) {
	$password = GV::Password('password','post');
	if($password) $password = $this->Sql('password', $password);
	if($password!=$data['cmt_password'])
		$this->state = 'password';
}

if($this->state!='password') {
	$this->Sql('delete', $cmt_no);
	Url::GoReplace($this->Link('list'));	
}
