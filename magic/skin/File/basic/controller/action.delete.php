<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 파일을 삭제하는 스크립트이다.
 * $att[1] 첫번째 파라메터는 삭제할 파일번호다.
 */

if(!$att[1]) $att[1]=$this->file_no;
$file_no = $att[1];

$file = $this->Sql('fetch', $file_no);
$path = Path::Group($file['file_path']);

// 파일명으로 검색되는 모든 파일을 다 삭제한다.
// 생성된 썸네일을 모두 삭제한다.
$glob = substr($path, 0, strrpos($path, '.')).'*'.strrchr($path,'.');
foreach (glob($glob) as $v) {
	if(is_file($v)) unlink($v);
}

// 데이터베이스 레코드 삭제
$sql = " DELETE FROM {$this->TBN()} WHERE {$this->KN()}='{$file_no}' ";
DB::Get()->sql_query($sql);
		
$result = true;