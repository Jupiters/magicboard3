<?php if(!defined("__MAGIC__")) exit; 

$rows = $this->Config('rows');
$tbn = $this->TBN();
$bo_no = $this->Config('bo_no');


$sql = "
	SELECT
		A.wr_no,
		A.wr_subject,
		count(B.wr_no) as cnt_comment
	FROM `$tbn` A
	LEFT JOIN `$tbn` B ON A.wr_no=B.wr_parent_no
	WHERE A.bo_no='$bo_no' AND A.wr_parent_no=0 AND A.wr_is_secret=0
	GROUP BY A.wr_no
	ORDER BY A.wr_datetime
	LIMIT {$rows}
";
$sql_result = DB::Get()->sql_query_list($sql);

/*
foreach ($sql_result as $k=>$v) {
}
//*/

