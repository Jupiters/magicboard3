<?php if(!defined("__MAGIC__")) exit; 

// 걸러진 결과값
$clear = $this->Clear();

if(!$clear['mb_id']) Dialog::alert("아이디를 입력하세요.");
if(!$clear['mb_nick']) Dialog::alert("별명을 입력하세요.");

// 임시비밀번호
$clear['mb_passwd'] = $this->Sql('password', uniqid());
$clear['mb_level'] = 2;
$clear['mb_datetime'] = 'NOW()';

// 회원정보 업데이트
$this->Sql('insert', $clear);

Url::Go($this->Link('list'));

exit;