<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$wr_no = $att[1];

$sql = "
	SELECT count(cmt_no) as cnt
	FROM `{$tbn}`
	WHERE wr_no='{$wr_no}'
";

$cnt = DB::Get()->sql_fetch($sql);
$sql_result = $cnt['cnt']?$cnt['cnt']:0;
