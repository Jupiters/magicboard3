<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 해당 개시글이 새로운 글인지 검사함
 * $att[1] 첫번째 파라메터는 삭제할 파일번호다.
 */

$tbn = $this->TBN();		// 테이블명
$clear = $att[1];
unset($clear['bo_no']);		///< 게시판 번호는 자동생성

if(!$clear['bo_subject']) Dialog::alert('게시판 명을 입력하세요.');

foreach ($this->Config('default') as $k=>$v) {
	if(!isset($clear[$k])) {
		$clear[$k] = $v;
	}
}

$result = DB::Get()->insertEx($tbn, $clear);
