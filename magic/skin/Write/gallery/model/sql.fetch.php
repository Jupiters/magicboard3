<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$key_name = $this->KN();

$sql_result = DB::Get()->sql_fetch("
	SELECT
		*,
		wr_state&{$this->Config('state','secret')} as wr_is_secret,
		wr_state&{$this->Config('state','notice')} as wr_is_notice,
		DATE_FORMAT(wr_datetime, '%Y년 %c월 %e일 %p %l:%i') as wr_datetime
	FROM `$tbn`
	WHERE {$key_name}='{$att[1]}'
	LIMIT 1
");

// 링크 앞에 http://를 안붙였을경우 붙여줌
if($sql_result['wr_link']) {
	if(strpos($sql_result['wr_link'], 'http://')===false) {
		$sql_result['wr_link'] = 'http://'.$sql_result['wr_link'];
	}
}

