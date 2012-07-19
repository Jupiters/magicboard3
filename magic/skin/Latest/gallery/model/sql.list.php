<?php if(!defined("__MAGIC__")) exit; 

$rows = $this->Config('rows');
$cols = $this->Config('cols');
$tot = $rows*$cols;
$bo_no = $this->Config('bo_no');

$tbn = $this->TBN();
$tbn_board = Board::Inst()->TBN();
$tbn_file = File::Inst()->TBN();


$sql = "
	SELECT
		A.wr_no,
		A.wr_subject,
		B.file_no
	FROM `$tbn` A
	INNER JOIN {$tbn_file} B ON B.wr_no=A.wr_no
	WHERE A.bo_no='$bo_no' AND A.wr_parent_no=0 AND A.wr_is_secret=0
	ORDER BY A.wr_datetime
	LIMIT {$tot}
";

$sql_result = DB::Get()->sql_query_list($sql);
