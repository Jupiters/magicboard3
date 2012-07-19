<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$wr_no = $att[1];
$parent_no = $att[2];

$sql = "
	SELECT
		*, 
		INET_NTOA(cmt_ip) as ip,
		DATE_FORMAT(cmt_datetime, '%Y년 %c월 %e일 %p %l:%i') as cmt_datetime_text
	FROM `{$tbn}`
	WHERE wr_no='{$wr_no}' AND cmt_parent_no='{$parent_no}'
	ORDER BY cmt_datetime
";
$sql_result = DB::Get()->sql_query_list($sql);

foreach ($sql_result as $k => $v) {
	$sql_result[$k]['cmt_content'] = $this->Action('content', $v['cmt_is_secret'], $v['cmt_content'], $v['mb_no']);
	$sql_result[$k]['ip'] = preg_replace("/(\d*).(\d*).(\d*).(\d*)/","\\1.\\2.***.\\4", $sql_result[$k]['ip']);
}
