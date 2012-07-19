<?php if(!defined("__MAGIC__")) exit; 

$table = array();
$table['widget'] = array(
	'pri_key'=>'wg_no',
	'COMMENT'=>'개시글',
	'DEFAULT CHARSET'=>'utf8',
	'ENGINE'=>'MyISAM',
	'cols' => array(
		'wr_no'=>array(
			'type'=>'int(11)',
			'null'=>'NOT NULL',
			'extra'=>'AUTO_INCREMENT',
			'comment'=>'글번호'
		),
		'wr_bad'=>array(
			'type'=>'tinyint(4)',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'비추천'
		)
	)
);


