<?php if(!defined("__MAGIC__")) exit; 

$tbn = self::TBN();
$msg_no = GV::Number('msg_no');
$mb_no = Member::No();

$list = $_POST['check'];
if($msg_no) $list[] = $msg_no;

if(sizeof($list)==0) Dialog::alert('복구할 글을 선택해 주세요.');
foreach($list as $v) {
	$sql = "
	UPDATE {$tbn} SET msg_state=msg_state&~{$this->Config('state', 'trash')}
	WHERE msg_no={$v}
	";
	DB::Get()->sql_query($sql);
}
Url::Go($this->Link('list'));
exit;