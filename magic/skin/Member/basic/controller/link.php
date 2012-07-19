<?php if(!defined("__MAGIC__")) exit; 

/*
 * 링크 정의법
 * ---------
 * $link['링크명']['include']['포함할 쿼리명'] = '쿼리값'; // 포함할 값
 * $link['링크명']['exclude'][] = '현재주소에서 제거할 쿼리명'; // 제거할 값
 * $link['링크명']['path'] = '현재주소와 다른 경로값 : 공백이면 현재주소 경로';
 *
 * 함수 추가 파라메터
 * delete, update등에서 키값을 활용할때 사용함
 * --------------------------------------
 * $att[1], $att[2], $att[3] 
 *
 */

// 링크 생성에 필요한 값들 정의
$mode_name = $this->Mode('name');	// 모드명
$mode = GV::String($mode_name);		// 현재모드
$key_name = $this->KN();		// 테이블의 키 이름
$page_id = Config::Inst()->path_member;

											
$link = array();

/*
 * 회원정보 보기 : 정해진 경로로 이동
 */
$link['view']['include'][$mode_name] = 'view';
/*
 * 로그인 페이지 : 정해진 경로로 이동
 */
$link['login']['include'][$mode_name] = 'login';
$link['login']['exclude'][] = $key_name;
/*
 * 회원가입 : 정해진 경로로 이동
 */
$link['regist']['include'][$mode_name] = 'regist';
/*
 * 회원가입 약관
 */
$link['agrement']['include'][$mode_name] = 'agrement';
/*
 * 회원정보수정
 */
$link['modify']['include'][$mode_name] = 'modify';
$link['modify']['include'][$key_name] = $att[1];
/*
 * 패스워드수정 페이지
 */
$link['modify_passwd']['include'][$mode_name] = 'modify_passwd';
$link['modify_passwd']['include'][$key_name] = $att[1];
/*
 * 패스워드 업데이트
 */
$link['update_passwd']['include'][$mode_name] = 'update_passwd';
$link['update_passwd']['include'][$key_name] = $att[1];
/*
 * 로그인 아이디/비번 체크 : 정해진 경로로 이동
 */
$link['login_check']['include'][$mode_name] = 'login_check';
/*
 * 로그아웃 : 정해진 경로로 이동
 */
$link['logout']['include'][$mode_name] = 'logout';
$link['logout']['path'] = Path::Root();
/*
 * 회원정보 업데이트
 */
$link['update']['include'][$mode_name] = 'update';
$link['update']['include'][$key_name] = $att[1];
/*
 * 회원정보 삽입
 */
$link['insert']['include'][$mode_name] = 'insert';
/*
 * 정보수정 전에 비번 체크
 */
$link['check']['include']['check'] = '1';
/*
 * 회원탈퇴 확인 페이지 -> unregist
 */
$link['unregist_confirm']['include'][$mode_name] = 'unregist_confirm';
$link['unregist_confirm']['include'][$key_name] = $att[1];
/*
 * 회원탈퇴
 */
$link['unregist']['include'][$mode_name] = 'unregist';
$link['unregist']['include'][$key_name] = $att[1];
/*
 * 비밀번호 찾기 : 아이디 입력
 */
$link['find_pw']['include'][$mode_name] = 'find_pw';
/*
 * 비밀번호 찾기 : 비밀번호 찾기 질문
 */
$link['find_pw_question']['include'][$mode_name] = 'find_pw_question';
/*
 * 비밀번호 찾기 : 비밀번호 찾기 질문 체크
 */
$link['find_pw_question_check']['include'][$mode_name] = 'find_pw_question_check';


foreach($link as $k=>$v) {
	$link[$k]['include']['r'] = 'kr';
	$link[$k]['include']['id1'] = $page_id;
}

