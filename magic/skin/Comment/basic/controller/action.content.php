<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 댓글 내용을 자동변환해줌
 * 자동링크와 개행문자를 br태그로 바꾸어줌
 * 그리고 비밀글은 내용을 "비밀글입니다" 로 변경
 */

$cmt_is_secret = $att[1];
$cmt_content = $att[2];
$cmt_mb_no = $att[3];

$is_admin = $this->Config('mb','admin');
$is_login = $this->Config('mb','login');
$mb_no = $this->Config('mb','no');

if( $cmt_is_secret=='1' && !$is_admin && ($mb_no==0 || $mb_no!=$cmt_mb_no) ) {
	$cmt_content = '<span class="secret">비밀글 입니다.</span>';
}

$result = nl2br(Util::auto_link($cmt_content));

	
