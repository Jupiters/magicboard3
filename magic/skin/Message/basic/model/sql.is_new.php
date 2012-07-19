<?php if(!defined("__MAGIC__")) exit; 

$mb_no = Member::Inst()->mb_no;
$tbn = $this->TBN();

$sql = "
SELECT count(msg_no) cnt
FROM `{$tbn}`
WHERE
	mb_no={$mb_no} AND
	msg_parent=0 AND
	msg_state&{$this->State('read')}=0
";
$sql_result = DB::Get()->sql_fetch($sql);
if($sql_result) $sql_result = intval(array_pop($sql_result));