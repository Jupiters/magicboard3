<?php
/*
 * 매직보드 설치 스크립트
 * version 1.0
 * 사용자의 구미에 맞도록 초기설치 제어를 수행함
 */

$cfg=array();
// 데이터베이스 정보
$cfg['dbinfo'] = array(
	'host'=>'localhost',	// mysql host정보
	'user'=>'',				// [mysql user] 공백을 권장함
	'password'=>'',			// [mysql password] 공백을 권장함
	'db'=>'',				// [mysql database name] 공백을 권장함
	'prefix'=>'m3_'			// [database prefix] 취향에 맞도록 바꾸어 써도 무관함
);

// 관리자 정보
$cfg['admin_info'] = array(
	'id' => 'admin',			// 관리자 아이디
	'password' => '',			// 공백을 권장
	'password_confirm' => '',	// 공백을 권장
	'name' => '최고관리자'		// 관리자 이름
);

// 홈페이지 기본정보
$cfg['hp_info'] = array(
	'title' => '매직보드',		// 홈페이지 제목 [홈페이지명]
);

// data 폴더 목록
// '폴더명'=>'권한값'
$cfg['data_folder'] = array (
	Path::data()=>0707,
	Path::data_file()=>0707,
	Path::data('cache')=>0707,
	Path::data('zmLog')=>0707,
	Path::data('zmLogConnect')=>0755,
	Path::data('cheditor')=>0707,
	Path::data_member()=>0707
);

// 설치 테이블 정보
// '테이블명'=>'설치모듈 인스턴스'
$cfg['tables'] = array(
	'magic' => Magic::Inst(),
	'config' => Config::Inst(),
	'write' => Write::Inst(),
	'board' => Board::Inst(),
	'file' => File::Inst(),
	'comment' => Comment::Inst(),
	'member' => Member::Inst(),
	'tag' => Tag::Inst(),
	//'message' => Message::Inst(),
	'widget' => Widget::Inst()
);

/*
 * 메뉴구성 및 기본 컨텐츠 설정
$cfg['default_data'] = "
kr:index				=widget:page=write:index.html
+메뉴얼:basic			=widget:page=write=widget:webclip:sub_title+=widget:page
++영문홈페이지:basic	=widget:page=write=widget:webclip:sub_title+=widget:page
++모바일홈페이지:basic	=widget:page=write=widget:webclip:sub_title+=widget:page
+게시판:basic			=widget:page=write=widget:webclip:sub_title+=widget:page
++공지사항:basic		=widget:page=write=widget:webclip:sub_title+=widget:write=board:공지

eng:index				=widget:page=write:index.html
+English Sample:basic	=widget:page=write

member:member

mobile:mobile_page		=widget:page=write:index.html
+메뉴얼:mobile	
++메뉴얼1:mobile_page	=widget:page=write=widget:page=write:index.html
++메뉴얼2:mobile_page	=widget:page=write=widget:page=write:index.html
++메뉴얼3:mobile_page	=widget:page=write=widget:page=write:index.html
++메뉴얼4:mobile_page	=widget:page=write=widget:page=write:index.html
++메뉴얼5:mobile_page	=widget:page=write=widget:page=write:index.html
++메뉴얼6:mobile_page	=widget:page=write=widget:page=write:index.html
++메뉴얼7:mobile_page	=widget:page=write=widget:page=write:index.html
+게시판:mobile
++공지사항:mobile_page	=widget:page=write=widget:write:mobile=board:공지(모바일)
++자유게시판:mobile_page=widget:page=write=widget:write:mobile=board:자유게시판(모바일)

mobile_member:mobile_member
";

$json = '
{
	"magic": {
		"m_id":"kr",
		"m_layout":"index",
		"m_contents": {
			"widget": {
				"wg_skin":"page"
				"wg_param":{
					"write":{
						"files":"index.html"
					}
				}
			}
		}
	}
}
';
 */

// 모바일은 나중에~
//mobile:m_index			=widget:page=write:m_index.html
//+홈피소개:m_basic		=widget:page=write:m_introduce.html
//++매직보드란?:m_basic	=widget:page=write:m_magicboard.html
//+게시판:m_basic			=widget:page=write:m_latest.html
//++공지사항:m_basic		=widget:write=link:index>공지사항
//+갤러리:m_basic			=widget:write=link:index>갤러리
//+m_member:m_member
//eng_mobile:m_eng_index	=widget:page=write:eng_index.html
//+Introduce:m_eng_basic	=widget:page=write:eng_introduce.html
//+Community:m_eng_basic	=widget:page=write
//+eng_m_member:m_eng_member


