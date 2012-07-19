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
$table['config'] = array(
	'pri_key'=>'cf_id',
	'COMMENT'=>'개시글',
	'DEFAULT CHARSET'=>'utf8',
	'ENGINE'=>'MyISAM',
	'cols' => array(
		'cf_id'=>array(
			'type'=>'varchar(255)',
			'filter'=>'id',
			'null'=>'NOT NULL',
			'comment'=>'설정명'
		),
		'cf_type'=>array(
			'type'=>'varchar(255)',
			'filter'=>'id',
			'null'=>'NOT NULL',
			'default'=>'str',
			'extra'=>'',
			'comment'=>'종류'
		),
		'cf_value'=>array(
			'type'=>'text',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'환경설정값'
		),
		'cf_desc'=>array(
			'type'=>'varchar(255)',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'설명'
		)
	)
);


