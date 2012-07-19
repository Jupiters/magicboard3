<?php if(!defined("__MAGIC__")) exit; 

$data = $this->Sql('fetch', GV::Number($this->KN()));

if(Config::Inst('config.php')->admin == $data['mb_id'])
	Dialog::alert("최고관리자는 회원탈퇴할 수 없습니다.");

// 파일들은 지움 
// 다시한번 확인하여 지움
$f = File::Inst();
$files = array();
foreach ($f->mb_no($data['mb_no'])->Action('files') as $v)
	$files[] = $v['file_no'];

// 삭제해야할 파일들 삭제
foreach ($files as $v) {
	$f->Action('delete', $v);
}

$this->Sql('delete', $data['mb_no']);

Url::GoReplace($this->Link('list'));
exit;
