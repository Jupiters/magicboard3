<?php if(!defined("__MAGIC__")) exit; 

$table = array();
$table['file'] = array(
	'pri_key'=>'file_no',
	'COMMENT'=>'파일',
	'DEFAULT CHARSET'=>'utf8',
	'ENGINE'=>'MyISAM',
	'cols' => array(
		'file_no'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'extra'=>'AUTO_INCREMENT',
			'comment'=>'파일번호'
		),
		'mb_no'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'파일 권리자'
		),
		'wr_no'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'파일에 대한 게시글'
		),
		'file_name'=>array(
			'type'=>'varchar(256)',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'원본 파일명'
		),
		'file_path'=>array(
			'type'=>'varchar(256)',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'파일 경로'
		),
		'file_download'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'파일다운로드 횟수'
		),
		'file_size'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'파일크기'
		),
		'file_type'=>array(
			'type'=>'varchar(128)',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'파일 종류'
		),
		'file_datetime'=>array(
			'type'=>'datetime',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'파일업로드시간'
		)
	)
);


