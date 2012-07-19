<?php
define('__MAGIC__', TRUE);
define('__DEBUG__', TRUE); // When developing site, use this line.

/*
 * 가장 먼저 실행되는 파일이면서
 * 사이트의 경로를 정의해주는 파일
 * 각종 초기화를 수행함
 */

// 메모리 용량 40메가로 업그레이드.
ini_set("memory_limit", "40M");

// 보안 설정
if(defined('__DEBUG__')) error_reporting(E_ALL ^ E_NOTICE);
else error_reporting(0);

// 빼면 ajax에서 "-1072896658" 스크립트 오류 발생
header("Content-type: text/html; charset=UTF-8");
// 보안설정이나 프레임이 달라도 쿠키가 통하도록 설정
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');

// First include, this is essential for webpage.
include_once(dirname(__FILE__).'/core/Path.class.php');
Path::SetRoot($path_root);
unset($path_root);

// 브라우저 설정
Path::SetBrowser();

/*
	클래스 자동 로드 설정
	절대경로는 지원하지않는다. 상대경로만 적도록..
	core에 찾는 클래스가 없다면 확장 클래스에서 찾는다.
*/
function __autoload($name) {
	if(file_exists(Path::classExt($name.".class.php"))) include_once(Path::classExt($name.".class.php"));
	else if(file_exists(Path::core($name.".class.php"))) include_once(Path::core($name.".class.php"));
}

if (!isset($set_time_limit)) $set_time_limit = 0;
@set_time_limit($set_time_limit);

// configure session
@ini_set("session.use_trans_sid", 0);    // PHPSESSID를 자동으로 넘기지 않음
@ini_set("url_rewriter.tags",""); // 링크에 PHPSESSID가 따라다니는것을 무력화

// 나중에 세션폴더 따로생성
//session_save_path("$root/data/session2");

if (isset($SESSION_CACHE_LIMITER)) 
	@session_cache_limiter($SESSION_CACHE_LIMITER);
else 
	@session_cache_limiter("no-cache, must-revalidate");
	//session_cache_limiter("must-revalidate");

//session_cache_expire(60);
//ini_set("session.cache_expire", 180); // 세션 캐쉬 보관시간 (분)
//ini_set("session.gc_maxlifetime", 10800); // session data의 gabage collection 존재 기간을 지정 (초)

//session_set_cookie_params(0, "/");
//ini_set("session.cookie_domain", $magic['cookie_domain']); 

session_start();
// PHPSESSID 가 틀리면 로그아웃한다.
if ($_REQUEST['PHPSESSID'] && $_REQUEST['PHPSESSID'] != session_id())
	Dialog::alert('로그아웃 합니다.', Path::logout());

// Set the global variables [_POST / _GET / _COOKIE]
GV::Init();
Url::This();



