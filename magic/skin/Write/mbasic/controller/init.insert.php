<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$key = GV::Number($this->KN());
$board = Board::Inst()->bo_no($this->bo_no);
$bo_no = $board->bo_no;

$clear = $this->Clear();
$clear['wr_content'] = nl2br(htmlspecialchars($_POST['wr_content']));
$clear['wr_state'] = 0;
$clear['wr_writer'] = Member::Inst()->mb_nick;
$clear['last_id'] = GV::String('id1');

// 기타 필수 입력 검사
/*
if(!$clear['wr_subject'])	 Dialog::alert('제목을 입력해 주세요.');
if(!$clear['wr_writer'])	 Dialog::alert('글쓴이를 입력해 주세요.');
if(!$clear['wr_content'])	 Dialog::alert('내용을 입력해 주세요.');
//*/


// 회원이면 자신의 회원번호를 입력함
$clear['mb_no'] = $this->Config('mb','no');
// 기본 정보들 자동입력
$clear['wr_datetime'] = 'NOW()';
$clear['wr_update'] = 'NOW()';
$clear['wr_ip'] = "INET_ATON('".Util::GetRealIPAddr()."')";
$clear['bo_no'] = $bo_no;


$this->key = DB::Get()->InsertEx($tbn, $clear, array('wr_ip','wr_datetime','wr_update'));
//if(!$this->key) Dialog::Alert('정확한 정보를 입력하세요.');

//$url = $this->Link('view', $key);

//Url::GoReplace($url);


