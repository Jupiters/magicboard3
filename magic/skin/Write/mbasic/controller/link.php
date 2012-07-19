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

$link['list']['exclude'][] = $mode_name;
$link['list']['exclude'][] = $key_name;
$link['list']['exclude'][] = $this->Config('need_password');

$link['write']['include'][$mode_name] = 'write';
$link['write']['exclude'][] = $key_name;

$link['insert']['include'][$mode_name] = 'insert';
$link['subject']['include'][$key_name] = $att[1];

$link['view']['include'][$key_name] = $att[1];
$link['view']['exclude'][] = $mode_name;

$link['modify']['include'][$mode_name] = 'modify';
$link['modify']['include'][$key_name] = $att[1];

$link['delete']['include'][$mode_name] = 'delete';
$link['delete']['include'][$key_name] = $att[1];

$link['update']['include'][$mode_name] = 'update';

$link['check']['include'][$this->Config('need_password')] = '1';


/*
	protected function link_admin($bo_no='') {
		return  Url::Get(array('bo_no'=>$bo_no, $this->mode_name=>self::mode_modify), array('wr_no','bo_id'), Path::admin('menu_2_0.php'));
	}

	protected function link_delete_selected() {
		return  Url::Get(array($this->mode_name=>self::mode_delete_selected));
	}

//*/