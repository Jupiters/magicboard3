<?php if(!defined("__MAGIC__")) exit; 

/*
 * 파일 생성 가능 검사
 * 리눅스 시스템에서는 권한이 없으면 파일 생성을 할수 없음으로
 * 권한검사를 수행함
 * 권한검사를 통과하지 못하면 실패 페이지로 넘어감
 */
if (!is_writeable(Path::MB())) {
	Url::Go($this->Link('permission'));
}

