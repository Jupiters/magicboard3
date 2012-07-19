<?php if(!defined("__MAGIC__")) exit; 

$key = GV::Number($this->KN());
$file = $this->Sql('fetch', $key);
$path = Path::Group($file['file_path']);
$width = GV::Number('width');
$height = GV::Number('height');


// 원본 파일 검사
if (!file_exists($path)) {
	Dialog::Alert("파일을 찾을 수 없습니다.");
	exit;
}

$thumb_path = substr($path, 0, strrpos($path, '.')).'_T_'.$width.'_'.$height;
$thumb_path.= strrchr($path,'.'); 

// 무단 링크 검사
// 무단링크시에는 hotlink.gif이미지를 뿌려준다.
$check_hotlink = GV::String(File::hotlink);
if(!$check_hotlink || $_SESSION[File::hotlink]!=$check_hotlink) {
	$thumb_path = Path::img('hotlink.gif');
}

// 썸네일이 없으면 썸네일 생성
// TODO 무분별한 썸네일을 생성에 대한 대처를 해야함
if(!file_exists($thumb_path)) {
	$thumb = new Thumbnail();
	$thumb->create($width, $height, $path, $thumb_path);
	chmod($thumb_path, 0606);
}

// 이미지 출력
header("content-type: {$file['file_type']}");
header("content-length: ".filesize($thumb_path));
header("pragma: no-cache");
header("expires: 0");
flush();

$fp = fopen($thumb_path, "rb");

while(!feof($fp)) { 
	echo fread($fp, 100*1024); 
	flush(); 
} 
fclose ($fp); 
flush();

exit;

	
	
