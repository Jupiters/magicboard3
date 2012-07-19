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

// 위젯 추가
$params = $this->Config('add_widget');
$link['write']['include'][$mode_name] = 'write';
$link['write']['include'][$params['pos']] = $att[1];
$link['write']['include'][$params['table']] = $att[2];
$link['write']['include'][$params['key_name']] = $att[3];
$link['write']['include'][$params['key']] = $att[4];
$link['write']['include'][$params['field']] = $att[5];
$link['write']['include'][Magic::Inst()->Config('root')] = 'popup';
$link['write']['exclude'][] = 'id1';
$link['write']['exclude'][] = 'id2';

// 위젯 수정
$link['edit']['include'][$mode_name] = 'write';
$link['edit']['include'][$key_name] = $att[1];
$link['edit']['include'][Magic::Inst()->Config('root')] = 'popup';
$link['edit']['exclude'][] = 'id1';
$link['edit']['exclude'][] = 'id2';

// 위젯 삭제
$link['delete']['include'][$mode_name] = 'delete';
$link['delete']['include'][$key_name] = $att[1];
$link['delete']['include']['ret_url'] = $att[2];
$link['delete']['include'][Magic::Inst()->Config('root')] = 'popup';
$link['delete']['exclude'][] = 'id1';
$link['delete']['exclude'][] = 'id2';

// 위젯 스킨 선택시 이동
$link['skin']['include']['wgSkin'] = $att[1];

// 위젯 스킨 선택 해제
$link['skin_cancel']['exclude'] = 'wgSkin';

$link['list']['exclude'][] = $mode_name;
$link['list']['exclude'][] = $key_name;

