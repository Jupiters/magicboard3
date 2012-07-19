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
$table['board'] = array(
	'pri_key'=>'bo_no',
	'COMMENT'=>'게시판번호',
	'DEFAULT CHARSET'=>'utf8',
	'ENGINE'=>'MyISAM',
	'cols' => array(
		'bo_no'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'extra'=>'AUTO_INCREMENT',
			'comment'=>'번호'
		),
		'bo_subject'=>array(
			'type'=>'varchar(256)',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'게시판 제목'
		),
		'bo_use_secret'=>array(
			'type'=>'tinyint(1)',
			'filter'=>'bool',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'비밀글 사용'
		),
		'bo_use_link'=>array(
			'type'=>'tinyint(1)',
			'filter'=>'bool',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'링크사용유무'
		),
		'bo_del_comment'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'삭제불가 댓글 수'
		),
		'bo_mod_comment'=>array(
			'type'=>'int(11)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'수정불가 댓글 수'
		),
		'bo_level_list'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'1',
			'extra'=>'',
			'comment'=>'목록보기 레벨'
		),
		'bo_level_view'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'1',
			'extra'=>'',
			'comment'=>'글보기 레벨'
		),
		'bo_level_write'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'2',
			'extra'=>'',
			'comment'=>'글쓰기 레벨'
		),
		'bo_level_modify'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'2',
			'extra'=>'',
			'comment'=>'글수정 레벨'
		),
		'bo_level_delete'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'2',
			'extra'=>'',
			'comment'=>'글삭제 레벨'
		),
		'bo_use_category'=>array(
			'type'=>'tinyint(1)',
			'filter'=>'bool',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'분류사용'
		),
		'bo_category'=>array(
			'type'=>'text',
			'filter'=>'text',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'json data'
		),
		'bo_use_file'=>array(
			'type'=>'tinyint(1)',
			'filter'=>'bool',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'파일업로드 사용'
		),
		'bo_file_num'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'1',
			'extra'=>'',
			'comment'=>'최대 파일 갯수'
		),
		'bo_file_level_list'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'1',
			'extra'=>'',
			'comment'=>'파일 목록보기 레벨'
		),
		'bo_file_level_down'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'2',
			'extra'=>'',
			'comment'=>'파일 다운로드 레벨'
		),
		'bo_file_level_upload'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'2',
			'extra'=>'',
			'comment'=>'파일 업로드 레벨'
		),
		'bo_use_comment'=>array(
			'type'=>'tinyint(1)',
			'filter'=>'bool',
			'null'=>'NOT NULL',
			'default'=>'1',
			'extra'=>'',
			'comment'=>'댓글사용'
		),
		'bo_comment_use_secret'=>array(
			'type'=>'tinyint(1)',
			'filter'=>'bool',
			'null'=>'NOT NULL',
			'default'=>'0',
			'extra'=>'',
			'comment'=>'비밀댓글사용'
		),
		'bo_comment_level_write'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'2',
			'extra'=>'',
			'comment'=>'댓글 쓰기 레벨'
		),
		'bo_comment_level_delete'=>array(
			'type'=>'tinyint(4)',
			'filter'=>'number',
			'null'=>'NOT NULL',
			'default'=>'2',
			'extra'=>'',
			'comment'=>'댓글 삭제 레벨'
		),
		'bo_editor'=>array(
			'type'=>'varchar(255)',
			'filter'=>'string',
			'null'=>'NOT NULL',
			'default'=>'TxtEditor',
			'extra'=>'',
			'comment'=>'사용할 에디터 이름'
		),
		'bo_admin_path'=>array(
			'type'=>'varchar(255)',
			'filter'=>'string',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'관리자 페이지 게시판 설정 경로'
		),
		'bo_kind'=>array(
			'type'=>'varchar(255)',
			'filter'=>'string',
			'null'=>'NOT NULL',
			'default'=>'',
			'extra'=>'',
			'comment'=>'게시판종류'
		)
	)
);

