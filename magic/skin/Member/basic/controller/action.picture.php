<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 회원 이미지 경로
 */

$pic_width = Config::Inst()->mb_pic_width;
$pic_height = Config::Inst()->mb_pic_height;

$list = File::Inst()->mb_no($this->mb_no)->Action('images', $pic_width, $pic_height);

if(is_array($list) && sizeof($list)!=0) {
  $result['is'] = true;
  $result['file_no'] = $list[0]['file_no'];
	$result['link'] = $list[0]['link'];
} else {
  $result['is'] = false;
	$result['link'] = $this->path_img('noimg.gif');
}

