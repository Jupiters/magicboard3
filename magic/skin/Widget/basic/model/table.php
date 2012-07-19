<?php if(!defined("__MAGIC__")) exit; 

$table = array();
$table['widget'] = array(
	'pri_key'=>'wg_no',
	'COMMENT'=>'위젯',
	'DEFAULT CHARSET'=>'utf8',
	'ENGINE'=>'MyISAM',
	'cols' => array(
		'wg_no'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'extra'=>'AUTO_INCREMENT',
			'comment'=>'글번호'
		),
		'wg_skin'=>array(
			'type'=>'varchar(256)',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'위젯명'
		),
		'wg_width'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'위젯너비'
		),
		'wg_width_unit'=>array(
			'type'=>'varchar(2)',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'위젯너비의 단위'
		),
		'wg_param'=>array(
			'type'=>'varchar(4096)',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'위젯 파라메터'
		)
	)
);


