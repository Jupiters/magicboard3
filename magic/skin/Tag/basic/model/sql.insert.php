<?php if(!defined("__MAGIC__")) exit; 

/*
 * $att[1] = 게시판번호
 * $att[2] = 게시글번호
 * $att[3] = 회원번호
 */
$bo_no = isset($att[1])?$att[1]:0;
$wr_no = isset($att[2])?$att[2]:0;
$tag_name = $att[3];
$mb_no = $this->Config('mb', 'no');

if($tag_name) {
  $tbn = $this->TBN();
  $sql = "
    INSERT INTO `{$tbn}` (bo_no, wr_no, mb_no, tag_name) VALUES ('{$bo_no}','{$wr_no}','{$mb_no}','{$tag_name}');
  ";
  DB::Get()->sql_query($sql);
}

