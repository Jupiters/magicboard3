<?php if(!defined("__MAGIC__")) exit; 

/*
 * 설치
 * 입력받은 정보를 통해
 * 홈페이지를 구성함
 */

include $this->path_controller('install_script/lib.php');
include $this->path_controller('install_script/config.php');

$mysql_host  = $_POST['mysql_host'];
$mysql_user  = $_POST['mysql_user'];
$mysql_pass  = $_POST['mysql_pass'];
$mysql_db    = $_POST['mysql_db'];
$prefix		 = $_POST['db_prefix'];

$admin_id    = $_POST['admin_id'];
$admin_pass  = $_POST['admin_pass'];
$admin_name  = $_POST['admin_name'];

$hp_title	 = $_POST['hp_title'];

unset($cfg['dbinfo']);		// POST값을 우선시 한다
unset($cfg['admin_info']);	// POST값을 우선시 한다
unset($cfg['hp_info']);		// POST값을 우선시 한다


$fail=false;
$this->msg=array();
// 데이터베이스 접속
if(!@mysql_connect($mysql_host, $mysql_user, $mysql_pass)) {
	$this->msg[] = '데이터베이스 접속정보가 잘못되었습니다.';
	$fail=true;
}
// 데이터베이스 선택
if(!$fail && !@mysql_select_db($mysql_db)) {
	$this->msg[] = '데이터베이스 이름이 잘못되었습니다.';
	$fail=true;
}

if(!$fail) {
	mysql_query("set character_set_client = utf8;");
	mysql_query("set character_set_connection = utf8;");
	mysql_query("set character_set_results = utf8;");
	$this->msg[] = '데이터베이스 접속성공';

	// dbconfig 파일 생성
	CreateDBConfig($prefix, $mysql_host, $mysql_user, $mysql_pass, $mysql_db);
	$this->msg[] = 'dbconfig.php 파일생성';

	// 테이블 생성
	foreach($cfg['tables'] as $k=>$v) {
		$this->msg[] = CreateTable($prefix.$k, $v);
	}

	// 데이터 폴더 생성
	foreach($cfg['data_folder'] as $k=>$v) {
		@mkdir($k,$v);
		@chmod($k,$v);
		$this->msg[] = '디렉토리 ['.$k.'] create -> chmod '.$v;
	
		// 디렉토리에 있는 파일의 목록을 보이지 않게 한다.
		$file = $k."/index.php";
		$f = @fopen($file, "w");
		@fwrite($f, "");
		@fclose($f);
		@chmod($file, 0606);
		$this->msg[] = '목록방지파일 ['.$file.'] create -> chmod 0606';
	}

	/* 환경설정 정보 입력 */
	$tbn_cfg = Config::Inst()->TBN();
  /*
	mysql_query("
		INSERT INTO `$tbn_cfg` 
			SET
			`cf_id` = 'hp_title',
			`cf_type` = 'str',
			`cf_value` = '$hp_title',
			`cf_desc` = '홈페이지 타이틀'
	");
	$this->msg[] = 'insert to config `hp_title`';

  //*/

	// 관리자 회원가입
	$tbn_mb = Member::Inst()->TBN();
	mysql_query("
		INSERT INTO `$tbn_mb` 
			SET
			`mb_no` = NULL,
			`mb_id` = '$admin_id',
			`mb_passwd` = PASSWORD('$admin_pass'),
			`mb_nick` = '$admin_name',
			`mb_email` = '',
			`mb_level` = 10,
			`mb_grade` = 'admin',
			`mb_memo` = '',
			`mb_datetime` = NOW(),
			`mb_leave` = '0'
	");
	$this->msg[] = '관리자 아이디 생성완료';

  $sql_data = file_get_contents($this->path_view('data.sql'));
  $sql_data = str_replace('m3_board',$prefix.'board',$sql_data);
  $sql_data = str_replace('m3_comment',$prefix.'comment',$sql_data);
  $sql_data = str_replace('m3_config',$prefix.'config',$sql_data);
  $sql_data = str_replace('m3_file',$prefix.'file',$sql_data);
  $sql_data = str_replace('m3_magic',$prefix.'magic',$sql_data);
  $sql_data = str_replace('m3_member',$prefix.'member',$sql_data);
  $sql_data = str_replace('m3_widget',$prefix.'widget',$sql_data);
  $sql_data = str_replace('m3_write',$prefix.'write',$sql_data);
  foreach(explode(";\n", $sql_data) as $v) {
    if(trim($v)) {
      mysql_query($v) or die(mysql_error());
    }
  }

  // 최고관리자 아이디 지정
	mysql_query("
		UPDATE `$tbn_cfg` 
			SET `cf_value` = '$admin_id'
    WHERE cf_id='admin'
    LIMIT 1
	");

  /*
	$menu = Realign($cfg['default_data']);
	foreach($menu as $v) {
		InsertDefaultData($v);
	}
	// magicboard.jpg 파일 복사
	// 나중에는 fils폴더 모두를 복사함
	copy($this->path_view('magicboard.jpg'), Path::data('cheditor').'/magicboard.jpg');
  */
  /*
   * magic/js/ 폴더의 파일은 모두 인크루드함
   */
  $imgs = array();
  $dir = dir($this->path_view('files/file/'));
  while($name = $dir->read()) {
    if(is_file($this->path_view('files/file/'.$name))) {
      $imgs[] = $name;
    }
  }
  foreach($imgs as $v) {
    copy($this->path_view('files/file/'.$v), Path::data('file').'/'.$v);
  }

}

Scripts::Add(Path::Root('magic/js/plugin/external/jquery.cookie.js'));
	

