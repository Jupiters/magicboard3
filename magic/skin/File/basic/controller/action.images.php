<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * $att[1] 첫번째 파라메터는 이미지 너비다.
 */
$width = $att[1];
$height = $att[2];
$content_img = isset($att[3])?$att[3]:true;

$this->Action('files');

$result = array();
foreach ($this->list as $k=>$v) {
	if(substr($v['file_type'],0,5)=='image') {
		$imgInfo = getimagesize(Path::Group($v['file_path']));
		$v['width'] = $imgInfo[0];
		$v['height'] = $imgInfo[1];
		$v['link'] = Path::Group($v['file_path']);//$this->Link('image', $v['file_no']);
		$v['link_original'] = Path::Group($v['file_path']);
		if($width) {
			if($v['width']>$width) {
				// 너비만큼 높이도 비율로 줄임
        if($height) $v['height'] = $height;
        else $v['height'] = round($width*$v['height']/$v['width']);
				$v['width'] = $width;
				/*
				 * 썸네일 생성
				 */
				$file = $this->Sql('fetch', $v['file_no']);
				$path = Path::Group($file['file_path']);
				// 원본 파일 검사
				if (!file_exists($path)) {
					Dialog::Alert("파일을 찾을 수 없습니다.");
					exit;
				}
				$thumb_path = substr($path, 0, strrpos($path, '.')).'_T_'.$v['width'].'_'.$v['height'];
				$thumb_path.= strrchr($path,'.'); 
				// 썸네일이 없으면 썸네일 생성
				if(!file_exists($thumb_path)) {
					$thumb = new Thumbnail();
					$thumb->create($v['width'], $v['height'], $path, $thumb_path);
					chmod($thumb_path, 0606);
				}
				$v['link'] = $thumb_path;
			}
		}
		$result[] = $v;
	}
}

if($content_img) {
	$img = $this->list_content_img;
	if($this->list_content_img) {
		$imgInfo = getimagesize(Path::Root($img['file_path']));
		$img['width'] = $imgInfo[0];
		$img['height'] = $imgInfo[1];
		$img['link'] = Path::Root($img['file_path']);
		$img['link_original'] = Path::Root($img['file_path']);
		if($width) {
			if($img['width']>$width) {
				// 너비만큼 높이도 비율로 줄임
        if($height) $img['height'] = $height;
        else $img['height'] = round($width*$img['height']/$img['width']);
				$img['width'] = $width;
				/*
				 * 썸네일 생성
				 */
				//$file = $this->Sql('fetch', $img['file_no']);
				$path = Path::Root($img['file_path']);
				// 원본 파일 검사
				if (!file_exists($path)) {
					Dialog::Alert("파일을 찾을 수 없습니다.");
					exit;
				}
				$thumb_path = substr($path, 0, strrpos($path, '.')).'_T_'.$img['width'].'_'.$img['height'];
				$thumb_path.= strrchr($path,'.'); 
				// 썸네일이 없으면 썸네일 생성
				if(!file_exists($thumb_path)) {
					$thumb = new Thumbnail();
					$thumb->create($img['width'], $img['height'], $path, $thumb_path);
					chmod($thumb_path, 0606);
				}
				$img['link'] = $thumb_path;
			}
		}
		$result[] = $img;
	}
}
