<?php if(!defined("__MAGIC__")) exit; 

$tbn = self::TBN();
$msg_no = GV::Number('msg_no');

$list = $_POST['check'];
if($msg_no) $list[] = $msg_no;

if(sizeof($list)==0) Dialog::alert('보관할 글을 선택해 주세요.');
foreach($list as $v) {
DB::Get()->sql_query("
UPDATE {$tbn} SET msg_state=msg_state|{$this->Config('state', 'archive')}
WHERE msg_no='{$v}'
");
}

Url::Go($this->Link('list'));
exit;