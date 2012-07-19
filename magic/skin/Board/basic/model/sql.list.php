<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$tbn_write = Write::Inst()->TBN();

$sql_result = DB::Get()->Sql_query_list("
	SELECT 
		A.*, 
		B.wr_no,
		count(A.bo_no) as cnt
	FROM `{$tbn}` A
	LEFT JOIN `{$tbn_write}` B ON A.bo_no=B.bo_no
  WHERE A.bo_kind=''
	GROUP BY A.bo_no
");

foreach ($sql_result as $k=>$v) {
	if($v['wr_no']==null) {
		$sql_result[$k]['cnt'] = 0;
	}
}
