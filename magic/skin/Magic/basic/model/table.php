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
$table['magic'] = array(
	'pri_key'=>'m_no',
	'COMMENT'=>'메뉴/레이아웃',
	'DEFAULT CHARSET'=>'utf8',
	'ENGINE'=>'MyISAM',
	'cols' => array(
		'm_no'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'extra'=>'AUTO_INCREMENT',
			'comment'=>'식별자'
		),
		'm_id'=>array(
			'type'=>'varchar(255)',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'아이디'
		),
		'm_order'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'순서'
		),
		'm_parent'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'부모'
		),
		'm_layout'=>array(
			'type'=>'varchar(255)',
			'filter'=>'id',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'레이아웃스킨'
		),
		'm_redirection'=>array(
			'type'=>'varchar(255)',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'페이지이동'
		),
		'm_hidden'=>array(
			'type'=>'tinyint(1)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'메뉴에서감추기'
		),
		'm_contents'=>array(
			'type'=>'varchar(2048)',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'컨텐츠 ,로 구분'
		),
		'm_image'=>array(
			'type'=>'varchar(255)',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'메뉴이미지'
		),
		'm_desc'=>array(
			'type'=>'varchar(2048)',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'메뉴설명'
		)
	)
);


