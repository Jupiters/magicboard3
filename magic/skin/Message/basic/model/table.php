<?php if(!defined("__MAGIC__")) exit; 

$table = array();
$table['message'] = array(
	'pri_key'=>'msg_no',
	'COMMENT'=>'쪽지',
	'DEFAULT CHARSET'=>'utf8',
	'ENGINE'=>'MyISAM',
	'cols' => array(
		'msg_no'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'extra'=>'AUTO_INCREMENT',
			'comment'=>'번호'
		),
		'msg_parent'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'부모 메시지'
		),
		'mb_no'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'메시지 소유주'
		),
		'msg_with'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'대화상대'
		),
		'msg_writer'=>array(
			'type'=>'varchar(256)',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'메시지 작성자'
		),
		'msg_state'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'메시지 상태'
		),
		'msg_datetime'=>array(
			'type'=>'datetime',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'작성시간'
		),
		'msg_subject'=>array(
			'type'=>'varchar(512)',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'메시지 제목'
		),
		'msg_content'=>array(
			'type'=>'text',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'내용'
		),
		'msg_file'=>array(
			'type'=>'varchar(512)',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'첨부파일'
		),
		'msg_ip'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'작성아이피'
		)
	)
);
