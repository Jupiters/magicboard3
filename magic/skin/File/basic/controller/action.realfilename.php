<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 서버에 저장될 파일명 생성
 * $att[1] 첫번째 파라메터는 삭제할 파일번호다.
 */

$file_name = $att[1];
$mb_no = Member::Inst()->mb_no;

// 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
$file_name = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $file_name);

$mb_no = sprintf("%05d", $mb_no);
$datetime = date("ymd_His");

do{
	$realname = $mb_no.'_'.$datetime.'_'.substr(md5(uniqid(time())),0,4);
	$realname.= strrchr($file_name,'.'); 
	$path = $this->Config('upload_path').$realname;
} while(is_file($path));

$result = $realname;
