<?php if(!defined("__MAGIC__")) exit; 
/*
	'number';	///< 숫자 데이터
	'english';///< 영문 데이터 : 대소문자 구별없는 영문만 남기고 반환함
	remove_special';///< 특수문자 제거
	'id';		///< 아이디 데이터 영문 숫자의 조합 아이디에 들어갈수 있는 것을 필터링 해줌 현재는 영문숫자의 조합
	'passwd';	///< 패스워드 데이터
	'korean';	///< 한글 데이터 : 한글만 남기고 반환함
	'mail';	///< 메일 : 메일 형식이 맞는지 체크한다.
	'date';	///< 날짜 데이터
	'time';	///< 시간 데이터
	'datetime'; ///< 날짜/시간 데이터
	'bool';	///< 참/거짓값 : 참거짓 값인지 판별함
	'html';	///< html데이터 : html 원본 그대로 저장함
	'text';	///< 텍스트 데이터 : html문자는 &;등으로 변환
 */
$table = array();
$table['member'] = array(
	'pri_key'=>'mb_no',
	'COMMENT'=>'회원',
	'DEFAULT CHARSET'=>'utf8',
	'ENGINE'=>'MyISAM',
	'cols' => array(
		'mb_no'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'extra'=>'AUTO_INCREMENT',
			'comment'=>'회원번호'
		),
		'mb_id'=>array(
			'type'=>'varchar(256)',
			'filter'=>'id',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'회원아이디'
		),
		'mb_passwd'=>array(
			'type'=>'varchar(256)',
			'filter'=>'password',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'비밀번호'
		),
		'mb_nick'=>array(
			'type'=>'varchar(256)',
			'filter'=>'string',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'별명'
		),
		'mb_name'=>array(
			'type'=>'varchar(256)',
			'filter'=>'string',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'본명'
		),
		'mb_email'=>array(
			'type'=>'varchar(256)',
			'filter'=>'mail',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'이메일'
		),
		'mb_grade'=>array(
			'type'=>"enum('member','manager','admin')",
			'filter'=>'english',
			'null'=>'NOT NULL',
			'default'=>'member',
			'extra'=>'',
			'comment'=>'회원종류'
		),
		'mb_level'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'1',
			'extra'=>'',
			'comment'=>'회원레벨'
		),
		'mb_memo'=>array(
			'type'=>'varchar(256)',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'자기소개'
		),
		'mb_datetime'=>array(
			'type'=>'datetime',
			'filter'=>'datetime',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'회원가입일'
		),
		'mb_leave'=>array(
			'type'=>'datetime',
			'filter'=>'datetime',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'회원탈퇴일'
		),
		'mb_question'=>array(
			'type'=>'varchar(256)',
			'filter'=>'string',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'회원가입질문'
		),
		'mb_answer'=>array(
			'type'=>'varchar(256)',
			'filter'=>'string',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'회원가입질문답변'
		)
	)
);


