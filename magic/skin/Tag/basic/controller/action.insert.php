<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 태그 입력
 * $att[1] = 게시판번호
 * $att[2] = 게시글번호
 * $att[3] = 입력데이터 : 배열형식
 */

$bo_no = isset($att[1])?$att[1]:false;
$wr_no = isset($att[2])?$att[2]:false;
$data = $att[3];

if(is_array($data)) {
  // 기존데이터 불러 들이기
  // keyword 비교를 위해 tag_name을 key로 변경함
  $exists = array();
  foreach($this->Sql('list', $bo_no, $wr_no) as $v) {
    $exists[$v['tag_name']] = $v;
  }

  foreach($data as $v) {
    /*
      배열에 존재하지 않는다면 추가
      배열에 존재한다면 unset
     */
    if(!array_key_exists(trim($v), $exists)) {
      $this->Sql('insert', $bo_no, $wr_no, trim($v));
    } else {
      unset($exists[$v]);
    }
  }
  // 추가하고 남은 데이터는 삭제
  foreach($exists as $v) {
    $this->Sql('delete', $v['tag_no']);
  }
}

	
