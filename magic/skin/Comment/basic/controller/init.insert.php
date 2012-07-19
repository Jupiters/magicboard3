<?php if(!defined("__MAGIC__")) exit; 

/*
 * 입력에 필요한 정보들 불러옴
 */
$tbn = $this->TBN();
$mb_no = $this->Config('mb','no');
$is_login = $this->Config('mb','login');
$mb_nick = $this->Config('mb','nick');
$key = GV::Number($this->KN());
$bo_no = Board::Inst()->bo_no($this->bo_no);

/*
 * POST 값 가져오기
 * 그리고 기본 정보들 자동입력 함
 */
$clear = $this->Clear();
$clear['mb_no'] = $mb_no;
$clear['cmt_datetime'] = 'NOW()';
$clear['cmt_ip'] = "INET_ATON('".Util::GetRealIPAddr()."')";
if($is_login) {
	$clear['cmt_writer'] = $mb_nick;
} else {
	if(!$clear['cmt_password']) Dialog::alert('비밀번호를 입력해 주세요.');
	$clear['cmt_password'] = $this->Sql('password', $clear['cmt_password']);
}
	
/*
 * 필수 입력 검사
 */
if(!$clear['cmt_content'])	 Dialog::alert('내용을 입력해 주세요.');
if(!$clear['cmt_writer'])	 Dialog::alert('글쓴이를 입력해 주세요.');

/*
 * 데이터 입력
 */
$key = DB::Get()->InsertEx($tbn, $clear, array('cmt_ip','cmt_datetime'));
if(!$key) Dialog::Alert('정확한 정보를 입력하세요.');

/*
 * 입력후 목록으로 돌아감
 */
Url::GoReplace($this->Link('list'));
