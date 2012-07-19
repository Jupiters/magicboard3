<?php
// ---------------------------------------------------------------------------

# 이미지가 저장될 디렉토리의 전체 경로를 설정합니다.
# 끝에 슬래쉬(/)는 붙이지 않습니다.
# 주의: 이 경로의 접근 권한은 쓰기, 읽기가 가능하도록 설정해 주십시오.

/*
 * 수정: kevinpark1981@gmail.com
 * -----
 * 서버 환경에 따라서 모두 동작하도록 수정
 * 윈도우든 리눅스든 모두 동작함
 * cwd값을 가져와서 해당 스킨 경로를 빼주면 최상위 경로가됨
 * 최상위 경로에서 에디터 파일이 저장될 위치를 지정해 주면됨
 */
$path = str_replace("\\", "/", getcwd());
$path = str_replace('skin/Editor/cheditor/view/imageUpload', '', $path);
define("SAVE_DIR", $path."magic/data/cheditor");

# 위에서 설정한 'SAVE_DIR'의 URL을 설정합니다.
# 끝에 슬래쉬(/)는 붙이지 않습니다.

$path = 'http://'.$_SERVER['HTTP_HOST'].'/magic/data/cheditor';

define("SAVE_URL", $path);

