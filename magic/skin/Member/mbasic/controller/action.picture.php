<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 회원 이미지 경로
 */

$list = File::Inst()->mb_no($this->mb_no)->Action('files');

if(is_array($list) && sizeof($list)!=0) {
	$result = File::Inst()->Link('thumb', $list[0]['file_no'], 50, 50);
} else {
	$result = $this->path_img('noimg.gif');
}