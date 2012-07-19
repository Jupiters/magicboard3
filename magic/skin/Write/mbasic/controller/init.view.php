<?php if(!defined("__MAGIC__")) exit; 

// 게시글 조회수 업데이트
$key = GV::Number($this->KN());
$this->wr_no = $key;
// 세션이 끊어 졌을때만 다시 업데이트 함
if(!$_SESSION[$this->Config('hit_check').$key]) {
	$this->Sql('update_hit',$key);
	$_SESSION[$this->Config('hit_check').$key] = true;
}
$data = $this->Sql('fetch', $key);
$data['wr_content'] = Editor::Inst(Board::Inst()->bo_no($this->bo_no)->bo_editor)->db_out($data['wr_content']);

$this->sql['fetch'.$key] = $data;

/*
 * 파일의 Protection 함수를 호출함으로써 핫링크를 방지함
 * 세션에 임의의 값을 저장해두고 비교하는 루틴으로 핫링크를 검사한다.
 * 게시글을 볼때마다 갱신한다.
 */
File::Inst()->Protection();
