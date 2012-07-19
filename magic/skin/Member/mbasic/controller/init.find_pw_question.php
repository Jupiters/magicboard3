<?php if(!defined("__MAGIC__")) exit; 

$mb_id = GV::Id('mb_id', 'POST');
if(Config::Inst('config.php')->admin==$mb_id)
	Dialog::Alert("최고관리자는 질문 답변으로 비밀번호를 찾을수 없습니다.");
	
$ret = $this->Sql('fetch_by_id', $mb_id);

if(!$ret['mb_question'])
	Dialog::alert("비밀번호 찾기 질문을 등록하지 않았습니다.\n질문 답변으로 비밀번호를 찾을수 없습니다.\n관리자에게 문의하세요.", Path::Group());