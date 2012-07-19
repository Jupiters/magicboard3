<?php

/*
 * 메뉴구성 및 기본 컨텐츠 설정
 * database insert 형식으로 제작함
 * 기본 폼
 ---------------
 array(
	'tbn'=>'테이블명',
	'return'=>'데이터를 삽입하고 삽입된 키값을 반환해야 할경우',
	'data'=>array(
		'필드명'=>'값'
	)
 )
 ---------------
 삽입할 데이터 배열 '키'=>'값'의 쌍으로 배열을 생성함
 'data'내부 값에서 array()값이 있을 경우 또다른 데이터 삽입을 의미함
$cfg['default_data'][] = array( // index 페이지
	'tbn' => 'magic',
	'data' => array(
		'm_no' => 1,
		'm_id' => 'index',
		'm_parent' => '0',
		'm_layout' => 'index',
		'm_contents' => array(
			// 페이지 위젯을 입력
			'tbn'=>'widget',
			'return'=>'[[Widget|$key]]',	// 입력된 데이터의 key값을 $key에 저장하여 반환해줌
			'data'=>array(
				'wg_skin' => 'page',
				'wg_width' => 100,
				'wg_width_unit' => '%',
				'wg_param' => array(
					// 게시글 입력 하여 반환
					'tbn'=>'write',
					'return'=>'wr_no=$key[]editor=cheditor[]editor_width=100%[]editor_height=500px',
					'data'=>array(
						'bo_no'=>0,
						'wr_subject'=>'page',
						'wr_content'=>'include=>index.html', // 이건 페이지 내용을 인크루드 하라는 말!! 이미지 파일등은 무조건 cheditor폴더로 옮겨짐
						'wr_writer'=>'페이지',
						'last_id'=>'index'
					)
				)
			)
		)
	)
);
 */

