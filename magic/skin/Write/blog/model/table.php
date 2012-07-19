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
$table['write'] = array(
	'pri_key'=>'wr_no',
	'COMMENT'=>'개시글',
	'DEFAULT CHARSET'=>'utf8',
	'ENGINE'=>'MyISAM',
	'cols' => array(
		'wr_no'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'extra'=>'AUTO_INCREMENT',
			'comment'=>'글번호'
		),
		'bo_no'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'게시판 번호 0은 페이지 게시판'
		),
		'wr_parent_no'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'부모글 번호'
		),
		'wr_subject'=>array(
			'type'=>'varchar(512)',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'게시글 제목'
		),
		'wr_link'=>array(
			'type'=>'varchar(2048)',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'게시글 참조링크'
		),
		'wr_content'=>array(
			'type'=>'longtext',
			'filter'=>'html',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'글내용'
		),
		'wr_category'=>array(
			'type'=>'varchar(128)',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'분류'
		),
		'wr_hit'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'조회수'
		),
		'mb_no'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'회원번호'
		),
		'wr_writer'=>array(
			'type'=>'varchar(256)',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'글쓴이'
		),
		'wr_password'=>array(
			'type'=>'varchar(256)',
			'filter'=>'password',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'비밀번호:비회원글쓰기시 사용됨'
		),
		'wr_datetime'=>array(
			'type'=>'datetime',
			'filter'=>'datetime',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'글 생성시간'
		),
		'wr_update'=>array(
			'type'=>'datetime',
			'filter'=>'datetime',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'마지막수정시간'
		),
		'wr_ip'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'글작성아이피'
		),
		'wr_state'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'각종 플래그'
		),
		'wr_spam'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'스팸신고'
		),
		'wr_good'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'추천'
		),
		'wr_bad'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'extra'=>'',
			'comment'=>'비추천'
		),
		'last_id'=>array(
			'type'=>'varchar(255)',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'마지막업데이트된 아이디:최근게시글에서 사용됨'
		)
	)
);


