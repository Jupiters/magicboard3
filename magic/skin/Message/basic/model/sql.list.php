<?php if(!defined("__MAGIC__")) exit; 

// 로그인한 회원번호
$mb_no = Member::no();
$rows = $this->Config('rows');
$page = GV::Page();
$tbn = $this->TBN();
$tbn_member = Member::TBN();
$state_x = intval(GV::Number('state_x'));
$state_o = intval(GV::Number('state_o'));
$search = new Search();

$limit = '0,'.$rows;
if($page!='') $limit = ((intval($page)-1)*intval($rows)).','.intval($rows);

if($state_o) {
	$state_o = " (msg_state & {$state_o}) = {$state_o} AND ";
} else {
	$state_o = '';
}
if($state_x) {
	$state_x = " (msg_state & {$state_x}) = 0 AND ";
} else {
	$state_x = '';
}

$stx = $search->GetKey();
if($stx) {
	$stx = " (
		msg_writer like '%{$search->GetKey()}%' OR
		msg_subject like '%{$search->GetKey()}%'
	) AND
	";
}

$sql_result = DB::Get()->sql_query_list("

SELECT *
FROM `{$tbn}`
WHERE
	mb_no={$mb_no} AND
	{$stx}
	$state_o
	$state_x
	msg_parent=0
ORDER BY msg_datetime desc
	LIMIT {$limit}
");
	
	

foreach ($sql_result as $k=>$v) {
	if($v['msg_subject']) {
		$sql_result[$k]['msg_content'] = '<span class="subject">'.$v['msg_subject'].'</span> - '.strip_tags($v['msg_content']);
	} else {
		$sql_result[$k]['msg_content'] = strip_tags($v['msg_content']);
	}
}
