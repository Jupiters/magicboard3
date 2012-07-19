<?php if(!defined("__MAGIC__")) exit; 

$rows = $this->Config('rows');
$tbn = $this->TBN();
$tbn_board = Board::Inst()->TBN();

$sql = "
	SELECT
		A.wr_no,
		A.wr_subject,
		A.wr_parent_no,
		B.bo_subject,
		A.wr_writer,
		A.last_id,
		A.wr_datetime
	FROM `{$tbn}` A
	INNER JOIN `{$tbn_board}` B ON A.bo_no=B.bo_no
  WHERE A.wr_writer<>'페이지'
	ORDER BY A.wr_datetime desc
	LIMIT {$rows}
";
$sql_result = DB::Get()->sql_query_list($sql);

