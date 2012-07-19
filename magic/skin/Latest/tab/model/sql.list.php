<?php if(!defined("__MAGIC__")) exit; 

$rows = $this->Config('rows');
$tbn = $this->TBN();
$tbn_board = Board::Inst()->TBN();
$tbn_comment = Comment::Inst()->TBN();
$bo_no = $att[1];

$sql = "
  SELECT
    A.wr_no,
    A.wr_subject,
    A.wr_datetime,
    A.wr_content,
    A.last_id,
    B.bo_subject,
    count(C.wr_no) as cnt_comment
  FROM `$tbn` A
  RIGHT JOIN `{$tbn_board}` B ON A.bo_no=B.bo_no
  LEFT JOIN `{$tbn_comment}` C ON A.wr_no=C.wr_no
  WHERE B.bo_no='$bo_no'
  GROUP BY A.wr_no
  ORDER BY A.wr_datetime desc
  LIMIT {$rows}
";
$sql_result = DB::Get()->sql_query_list($sql);

