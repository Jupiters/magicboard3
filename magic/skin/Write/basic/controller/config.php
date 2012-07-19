<?php if(!defined("__MAGIC__")) exit; 

$cfg = array();

$cfg['mode']['name']		= 'writeMode';

/*
 * 상태정의
 * bit operation으로 처리함
 */
$cfg['state'] = array(
	'notice'=>0x00000001,	// 공지유무
	'secret'=>0x00000002	// 비밀글 유무
);

/*
 * 기본값
 */
$cfg['img_width'] = '600';
$cfg['rows'] = 20;
$cfg['list_view'] = 0;
$cfg['use_comment'] = 1;
$cfg['show_notice'] = 1;
$cfg['columns'] = array(
	'no' => 0,
	'wr_datetime' => 1,
	'wr_subject' => 1,
	'wr_writer' => 1,
	'wr_hit' => 1
);
$cfg['columns_name'] = array(
  'no'=>'번호',
  'wr_datetime'=>'날짜',
  'wr_subject'=>'제목',
  'wr_writer'=>'글쓴이',
  'wr_hit'=>'조회'
);


$cfg['editor']['width']		= '100%';
$cfg['editor']['height']	= '750px';

$cfg['hit_check'] = 'hit';

/*
 * 패스워드 필요시
 */
$cfg['need_password'] = 'check';
$cfg['pw_check'] = GV::Number($cfg['need_password']);

// 현재 로그인한 회원정보 저장
$m = Member::Inst();
$cfg['mb'] = array(
	'no' => $m->mb_no,
	'name' => $m->mb_name,
	'admin' => $m->Action('is_admin'),
	'login' => $m->Action('is_login'),
	'level' => $m->mb_level
);


