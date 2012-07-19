<?php if(!defined("__MAGIC__")) exit; 

$key = GV::Number($this->KN());
$file = $this->Sql('fetch', $key);
$this->Sql('inc_count', $key);
$path = Path::Group($file['file_path']);

// 무단 링크 검사
$check_hotlink = GV::String(File::hotlink);
if(!$check_hotlink || $_SESSION[File::hotlink]!=$check_hotlink) {
	Dialog::Alert("무단링크 입니다.\n정상적인 경로로 접속하세요");
}

// IE는 EUC로 해석하기 때문에 EUC로 바꿔주어야 함
$filename = $file['file_name'];
if($this->msie()) {
	$filename = iconv('UTF-8', 'EUC-KR', $filename);
}

if (file_exists($path))
{
	if($this->msie5()) {
		header("content-type: doesn/matter");
		header("content-length: ".filesize($path));
		header("content-disposition: attachment; filename=\"{$filename}\"");
		header("content-transfer-encoding: binary");
	} else {
		header("content-type: file/unknown");
		header("content-length: ".filesize($path));
		header("content-disposition: attachment; filename=\"{$filename}\"");
		header("content-description: php generated data");
	}
	header("pragma: no-cache");
	header("expires: 0");
	flush();

	$fp = fopen($path, "rb");

	while(!feof($fp)) { 
		echo fread($fp, 100*1024); 
		flush(); 
	} 
	fclose ($fp); 
	flush();

} else {
	Dialog::Alert("파일을 찾을 수 없습니다.");
}
