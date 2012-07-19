<?php
include('_path.php');
$title="매직보드 백업";

$is_window=true;
if(strpos($_SERVER['PATH'], ':\\')===false) {
	$is_window=false;
}

if($_POST['backup']==1) {
	
	// 데이터베이스 접속정보
	include Path::MB('dbconfig.php');
	
	// mysqldump 파일위치
	$bindir='';
	foreach(DB::Get()->sql_query_list("show variables") as $v) {
		if($v[0] == "basedir")
			$bindir = $v[1]."bin/";
	}

	// 백업 파일 생성위치
	$file_name = 'backup_'.date('Ymd_His').'.sql';
	$sql_file = Path::data('cache/'.$file_name);
	
	// 백업 스트립트 생성 및 백업
	$backup_script=$bindir."mysqldump --user={$mysql_user} --password={$mysql_password} {$mysql_db} ";
	foreach($_POST['tables'] as $v) {
		$backup_script.=" {$v} ";
	}
	$backup_script.=' > '.$sql_file;
	passthru($backup_script);
	
	if(!$is_window) {
		$file_name.='.tgz';
	}
	
	// 데이터 다운로드
	header('Content-Type: application/octet-stream'); 
	header('Content-Disposition: attachment; filename='.$file_name); 
	
	if($is_window) {
		$fp = fopen($sql_file, "rb"); 
		fpassthru($fp);
		fclose($fp);
	} else {
		// 데이터폴더 백업일때에는 데이터 폴더 통째로 압축하여 백업함
		if($_POST['data_folder']==1) {
			passthru("tar cjf - ".Path::data());
		// 아닐때에는 sql만 백업함
		} else {
			passthru("tar cjf - $sql_file");
		}
	}
	
	unlink($sql_file);
	exit;
}

/*
 * 데이터베이스 테이블 구하기
 */
$db_prefix = DB::Get()->prefix();
$table_list = DB::Get()->sql_query_list("show tables LIKE '{$db_prefix}%' ");

/*
 * 디렉토리 용량 구하기 bytes
 */
function get_dirsize($file_dir) { 
	$size = 0; 
	$d = dir($file_dir); 
	while ($entry = $d->read()) { 
		if ($entry != "." && $entry != "..") {
			if(is_dir($file_dir.'/'.$entry)) {
				$size += get_dirsize($file_dir.'/'.$entry);
			} else {
				$size += filesize("$file_dir/$entry"); 
			}
		}
		
	} 
	$d->close(); 
	return $size; 
}

ob_start();
?>
<style>
.ui-form h2 {
	margin:10px 0;
	font-family:"맑은 고딕";
	font-size:14px;
	color:#614AEA;
}
.ui-form .contents {
	line-height:1.6;
	padding:5px 10px;
	border:1px solid #ccc;
	margin-bottom:5px;
}
.warn {
	color:#f00;
}
</style>
<script>
$(function(){
	$("#check_all").click(function(){
		if($(this).attr("checked")) {
			$("input[name='tables[]']").attr("checked", "checked");
		} else {
			$("input[name='tables[]']").removeAttr("checked");
		}
	});
});
</script>
<form class="ui-form" method="post" action="">
<input type="hidden" name="backup" value="1"/>

<h2>데이터베이스 백업</h2>
<div class="contents ui-corner-all">
<ul>
<?php foreach($table_list as $v) {?>
	<li><input name="tables[]" type="checkbox" id="<?php echo $v[0]?>" value="<?php echo $v[0]?>" checked/>&nbsp;<label for="<?php echo $v[0]?>"><?php echo $v[0]?></label></li>
<?php }?>
<li><input id="check_all" type="checkbox"/>&nbsp;<label for="check_all">모두체크</label></li>
</ul>
<p>백업하고 싶은 테이블을 선택하세요.</p>
</div>

<h2>데이터 폴더 백업</h2>
<div class="contents">
<?php if($is_window){?>
<p class="warn">윈도우 서버에서는 데이터 폴더 자동 백업을 지원하지 않습니다.</p>
<p class="warn">직업 폴더 복사를 하시거나 FTP를 통해서 백업해 주세요.</p>
<p>리눅스 서버사용 시 데이터 폴더 자동백업 옵션을 지원합니다.</p>
<?php } else {?>
<p>현재 파일 디렉토리 용량은 <strong><?php echo number_format(get_dirsize(Path::data()))?> bytes</strong> 입니다.</p>
<p>이곳에서 data 폴더를 백업할 경우 홈페이지 전체 트래픽에 영향을 미치게 됩니다.</p>
<p>data폴더 용량이 많을때에는 ftp로 접속하여 백업하는 것을 권장합니다.</p>
<p>data폴더를 백업합니다.</p>
<p><input id="data_folder" name="data_folder" type="checkbox" value="1" <?php echo $is_window?'disabled':''?>/>&nbsp;<label for="data_folder">데이터 폴더를 백업합니다.</label></p>
<?php }?>
</div>

<div class="tip">
<p>윈도우 서버에서 실행할 경우 파일을 자동으로 압축하지 않습니다.</p>
</div>

<div>
<input class="button" type="submit" value="백업 (파일로 다운받기)"/>
</div>
</form>
<?php
$contents = ob_get_contents();
ob_end_clean();

echo Layout::Inst('admin'
	)->Contents(array($contents)
	)->html(
);
