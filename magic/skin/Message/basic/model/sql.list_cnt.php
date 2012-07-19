<?php if(!defined("__MAGIC__")) exit; 

$mb_no = Member::no();
$tbn = $this->TBN();

$state_x = intval(GV::Number('state_x'));
$state_o = intval(GV::Number('state_o'));
if($state_o) {
	$state_o = " (A.msg_state & {$state_o}) = {$state_o} AND ";
} else {
	$state_o = '';
}
if($state_x) {
	$state_x = " (A.msg_state & {$state_x}) = 0 AND ";
} else {
	$state_x = '';
}

$sql = "
SELECT 
	count(A.mb_no) as cnt
FROM `{$tbn}` A
WHERE
	A.mb_no={$mb_no} AND
	$state_o
	$state_x
	A.msg_parent=0
";

$sql_result = DB::Get()->sql_fetch($sql);
if($sql_result) $sql_result = intval(array_pop($sql_result));