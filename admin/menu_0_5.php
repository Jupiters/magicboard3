<?php
include('_path.php');
$title="매직보드 삭제";

/*
 * 데이터베이스 테이블 구하기
 */
$db_prefix = DB::Get()->prefix();
$table_list = DB::Get()->sql_query_list("show tables LIKE '{$db_prefix}%' ");

if($_POST['delete']==1) {
	$ret_path = Path::Group();
	
	/*
	 * 데이터베이스 테이블 제거
	 */
	foreach ($table_list as $v) {
		DB::Get()->DropTable($v[0]);
	}
	
	/*
	 * data 폴더 제거 및 파일들 제거
	 */
	function remove_all( $path ) {
		if( is_file($path) ) {
			unlink($path);
		} elseif( is_dir($path) ) {
			$dir = opendir($path);
			while ($file = readdir($dir)) {
				if( $file!="." && $file!=".." ) {
					/* remove all recursively */
					remove_all($path."/".$file);
				}
			}
			closedir($dir);
			rmdir($path);
		} else {
			return FALSE;
		}
	}
	remove_all(Path::data());
	remove_all(Path::MB('dbconfig.php'));
	remove_all(Path::MB('config.php'));
	remove_all(Path::MB('config_member.php'));
	remove_all(Path::MB('PRIVACYOFUSE'));
	remove_all(Path::MB('TERMSOFUSE'));
	
	Url::Go($ret_path);
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
	$("form.ui-form").submit(function(){
		if(confirm("정말로 삭제하시겠습니까?\n신중히 생각하세요.")) {
			if(confirm("진짜로 삭제합니다!!\n되돌릴 수 없어요!!")) {
				return true;
			}
		}
		return false;
	});
});
</script>
<form class="ui-form" method="post" action="">
<input type="hidden" name="delete" value="1"/>
<h2>매직보드를 삭제합니다.</h2>
<div class="contents">
<p>magic/data 폴더에 있는 모든 파일을 삭제하며 설치시 생성된 파일들을 삭제합니다.</p>
<p>데이터베이스의 모든 테이블을 삭제합니다.</p>
<p>삭제될 데이터베이스 테이블 목록</p>
<p class="warn"><?php foreach($table_list as $v) { echo $v[0].'&nbsp;&nbsp;'; }?></p>
<p class="warn">한번 삭제하면 되돌릴수 없으니 신중히 선택하세요.</p>
</div>
<div class="tip">
<p>백업은 필수 입니다.</p>
<p>백업을 하신 다음 매직보드를 삭제하세요!!</p>
</div>
<div>
<input class="button hover" type="button" value="백업 바로가기!!!" onclick="location.href='./menu_0_4.php'"/>
<input class="button" type="submit" value="삭제"/>
</div>
</form>
<?php
$contents = ob_get_contents();
ob_end_clean();

echo Layout::Inst('admin'
	)->Contents(array($contents)
	)->html(
);
