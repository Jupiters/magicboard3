<?php if(!defined("__MAGIC__")) exit; 

/*
 * 링크 정의법
 * ---------
 * $link['링크명']['include']['포함할 쿼리명'] = '쿼리값'; // 포함할 값
 * $link['링크명']['exclude'][] = '현재주소에서 제거할 쿼리명'; // 제거할 값
 * $link['링크명']['path'] = '현재주소와 다른 경로값 : 공백이면 현재주소 경로';
 *
 * 함수 추가 파라메터
 * delete, update등에서 키값을 활용할때 사용함
 * --------------------------------------
 * $att[1], $att[2], $att[3] 
 *
 */

// 링크 생성에 필요한 값들 정의
$mode_name = $this->Mode('name');	// 모드명
$mode = GV::String($mode_name);		// 현재모드
$key_name = $this->KN();		// 테이블의 키 이름
											
$link = array();

$link['delete']['include'][$mode_name] = 'delete';
$link['insert']['include'][$mode_name] = 'insert';
$link['update']['include'][$mode_name] = 'update';


