<?php if(!defined("__MAGIC__")) exit; 

/*
 * ajax
 * 데이터베이스 접속 점검을 위함
 * ajax로 호출하여 접속성공하면 공백을 반환함
 */
$host = $_POST['mysql_host'];
$user = $_POST['mysql_user'];
$pass = $_POST['mysql_pass'];
$db = $_POST['mysql_db'];

if(!@mysql_connect($host, $user, $pass)) {
	echo '데이터베이스 접속정보가 잘못되었습니다.';
} else {
	if(!@mysql_select_db($db)) {
		echo '데이터베이스 이름이 잘못되었습니다.';
	}
}
exit;

