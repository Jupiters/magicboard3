<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$key = GV::Number($this->KN());
$tbn_write = Write::Inst()->TBN();

// 게시판의 모든 게시글의 첨부파일 삭제
$sql = "
	SELECT wr_no
	FROM `{$tbn_write}`
	WHERE bo_no='{$key}'
";
$write_list = DB::Get()->sql_query_list($sql);

if(is_array($write_list)) {
	foreach($write_list as $k => $v) {
		// TODO File 클래스의 Board 사용
		//$file = new File($board, $v['wr_no']);
		//$file->DeleteAll();
	}
}

// 게시글 모두 삭제
$sql = "
	DELETE FROM `{$tbn_write}` 
	WHERE bo_no='{$key}'
";
DB::Get()->sql_query($sql);

Dialog::Alert("게시판의 모든 게시글/파일 삭제 완료!", $this->Link('list'));
