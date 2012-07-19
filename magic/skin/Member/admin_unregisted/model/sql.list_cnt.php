<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();

$sql = "
	SELECT count(mb_no) as cnt
	FROM {$tbn}
	WHERE mb_passwd=''
";
$sql.= Search::Inst()->Sql(array('A.wr_subject','A.wr_content'));

$cnt = DB::Get()->sql_fetch($sql);
$sql_result = $cnt['cnt']?$cnt['cnt']:0;

