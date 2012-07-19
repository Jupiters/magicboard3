<?php if(!defined("__MAGIC__")) exit; 

/*
 * 결과값
 * -----------------------------
 * true = 통과
 * false = 수정할 수 없음
 * password = 패스워드 입력 요함
 * incorrect = 패스워드 틀림
 */

$key = GV::Number($this->KN());
$check = $this->Can('delete', $key);

if($check==='password'){
	Url::GoReplace($this->Link('check'));
} else if($check==='incorrect') {
	Dialog::alert("패스워드가 틀렸습니다.");
} else if($check===false) {
	Dialog::alert("삭제권한이 없습니다.");
}