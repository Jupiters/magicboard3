<?php
/*
 * 파일 다운로드를 위한 파일
 * 파일 다운로드만을 위해서 쓰인다.
 * download.php?file_no=
 * 위와 같은 주소에 파일번호만 연결시켜 주면 해당 파일을 다운받는다.
 * 핫링크 방지를 위해 File::Inst()->Protection()이 호출된 페이지에서 누른 링크였을 경우에만 다운로드 가능하다. 
 */
include_once('_path.php');
File::Inst()->init();
