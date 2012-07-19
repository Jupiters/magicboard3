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
$mode_name = $this->Config('mode', 'name');	// 모드명
$mode = GV::String($mode_name);				// 현재모드
$table = $this->Table();
$key_name = $table['pri_key'];		// 테이블의 키 이름
$path = $this->Path();
											
$link = array();
$link['list']['exclude'][] = $mode_name;
$link['list']['exclude'][] = $key_name;
$link['list']['path'] = $path;


$link['list_inbox']['include']['state_x'] = $this->Config('state','archive')|$this->Config('state','trash');
$link['list_inbox']['exclude'][] = $mode_name;
$link['list_inbox']['exclude'][] = $key_name;
$link['list_inbox']['exclude'][] = 'state_o';
$link['list_inbox']['exclude'][] = 'receivers';
$link['list_inbox']['path'] = $path;

$link['list_star']['include']['state_x'] = $this->Config('state','trash');
$link['list_star']['include']['state_o'] = $this->Config('state','star');
$link['list_star']['exclude'][] = $mode_name;
$link['list_star']['exclude'][] = $key_name;
$link['list_star']['exclude'][] = 'receivers';
$link['list_star']['path'] = $path;

$link['list_all']['include']['state_x'] = $this->Config('state','trash');
$link['list_all']['exclude'][] = $mode_name;
$link['list_all']['exclude'][] = $key_name;
$link['list_all']['exclude'][] = 'state_o';
$link['list_all']['exclude'][] = 'receivers';
$link['list_all']['path'] = $path;

$link['list_trash']['include']['state_o'] = $this->Config('state','trash');
$link['list_trash']['exclude'][] = $mode_name;
$link['list_trash']['exclude'][] = $key_name;
$link['list_trash']['exclude'][] = 'state_x';
$link['list_trash']['exclude'][] = 'receivers';
$link['list_trash']['path'] = $path;

$link['archive']['include'][$mode_name] = 'archive';
$link['archive']['include'][$key_name] = $att[1];
$link['archive']['include']['ret_mode'] = $mode;
$link['archive']['path'] = $path;

$link['trash']['include'][$mode_name] = 'trash';
$link['trash']['include'][$key_name] = $att[1];
$link['trash']['path'] = $path;

$link['restore']['include'][$mode_name] = 'restore';
$link['restore']['include'][$key_name] = $att[1];
$link['restore']['path'] = $path;

$link['star']['include'][$mode_name] = 'star';
$link['star']['include'][$key_name] = $att[1];
$link['star']['path'] = $path;

$link['delete']['include'][$mode_name] = 'delete';
$link['delete']['include'][$key_name] = $att[1];
$link['delete']['path'] = $path;

$link['write']['include'][$mode_name] = 'write';
$link['write']['exclude'][] = $key_name;
$link['write']['exclude'][] = 'state_x';
$link['write']['exclude'][] = 'state_o';
$link['write']['path'] = $path;

$link['insert']['include'][$mode_name] = 'insert';
$link['insert']['path'] = $path;

$link['new_msg']['include'][$mode_name] = 'write';
$link['new_msg']['include']['receivers'] = $att[1];
$link['new_msg']['exclude'][] = $key_name;
$link['new_msg']['path'] = $path;

$link['view']['include'][$key_name] = $att[1];
$link['view']['exclude'][] = $mode_name;
$link['view']['exclude'][] = 'state';
$link['view']['path'] = $path;

$link['subject']['include'][$key_name] = $att[1];
$link['subject']['path'] = $path;

$link['state_add']['include'][$mode_name] = 'state_add';
$link['state_add']['include']['state'] = $att[1];
$link['state_add']['path'] = $path;

$link['state_remove']['include'][$mode_name] = 'state_remove';
$link['state_remove']['include']['state'] = $att[1];
$link['state_remove']['path'] = $path;


