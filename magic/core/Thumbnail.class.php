<?php
/*!
 *	\class		Thumbnail
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\author		Computer Science in Inje Univ.
 *	\version	0.1	
 *	\date		2010.01.19
 *	\brief		일단 그누보드의 썸네일 함수를 그대로 가져옴.
 *	\bug 
 *	\warning 
 */
class Thumbnail
{
	// 원본 이미지를 넘기면 비율에 따라 썸네일 이미지를 생성함
	// 가로, 세로, 파일경로, 생성경로, true

	/*! 
	 *	\fn		create
	 *	\brief	썸네일 생성
	 *	\param  imgWidth 이미지 너비
	 *	\param  imgHeight 이미지 높이
	 *	\param  imgSource 원본 이미지
	 *	\param  imgThumb 결과이미지 인자를 주지 않으면 원본이미지를 대체함
	 */
	static function create($imgWidth, $imgHeight, $imgSource, $imgThumb='', $iscut=false) {
		
		if (!$imgThumb)
			$imgThumb = $imgSource;

		$size = getimagesize($imgSource);

		if ($size[2] == 1) 
			$source = imagecreatefromgif($imgSource);
		else if ($size[2] == 2) 
			$source = imagecreatefromjpeg($imgSource);
		else if ($size[2] == 3) 
			$source = imagecreatefrompng($imgSource);
		else 
			continue;

		/*
		//$rate = $imgWidth / $size[0];
		//$height = (int)($size[1] * $rate);
		if ($height < intval($imgHeight)) {
			$target = @imagecreatetruecolor($imgWidth, $height);
		} else {
		}
		//*/
		$target = @imagecreatetruecolor($imgWidth, $imgHeight);

		@imagecopyresampled($target, $source, 0, 0, 0, 0, $imgWidth, $imgHeight, $size[0], $size[1]);
		if($imgSource==$imgThumb) unlink($imgSource);
		@imagejpeg($target, $imgThumb, 100);
		@chmod($imgThumb, 0606); // 추후 삭제를 위하여 파일모드 변경
	}
}
