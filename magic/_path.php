<?php
/*
 * 이 파일은 수정하는 파일이 아닙니다.
 * 절대 수정하지 마세요..
 */
$depth=count(debug_backtrace());
$path_root='.';
for($i=0; $i<$depth-1; $i++) {$path_root.='/..';}

// 현재파일이 최상위 파일이면 mb_path.php를 로드하고
// 아니면 다시 한단계 위의 파일을 로드함
if(is_file($path_root.'/../_path.php')) {
  include_once($path_root.'/../_path.php');
} else {
  include_once($path_root.'/magic/mb_path.php');
}