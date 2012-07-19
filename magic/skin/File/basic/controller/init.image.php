<?php if(!defined("__MAGIC__")) exit; 

$key = GV::Number($this->KN());
$file = $this->Sql('fetch', $key);
$path = Path::Group($file['file_path']);

// 무단 링크 검사
// 무단링크시에는 hotlink.gif이미지를 뿌려준다.
$check_hotlink = GV::String(File::hotlink);
if(!$check_hotlink || $_SESSION[File::hotlink]!=$check_hotlink) {
	$path = Path::img('hotlink.gif');
}

if (file_exists($path)) {
	header("content-type: {$file['file_type']}");
	header("content-length: ".filesize($path));
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

exit;
