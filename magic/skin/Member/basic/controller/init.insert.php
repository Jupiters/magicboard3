<?php if(!defined("__MAGIC__")) exit; 

// 스펨  차단코드 검사
Captcha::Inst()->Check();

// 걸러진 결과값
$clear = $this->Clear();

if(!$clear['mb_nick']) Dialog::alert("별명을 입력하세요.");
if(!$clear['mb_passwd']) Dialog::alert("비밀번호를 입력하세요.");
if(!$clear['mb_email']) Dialog::alert("이메일 주소를 입력하세요.");
if($clear['mb_passwd']!=$_POST['confirm_passwd']) Dialog::alert("비밀번호 확인이 일치하지 않습니다.");

$clear['mb_passwd'] = $this->Sql('password', $clear['mb_passwd']);
$clear['mb_datetime'] = 'NOW()';
$clear['mb_level'] = '2';

$tbn = $this->TBN();
$sql = "
  SELECT
    mb_id,
    mb_nick,
    mb_name,
    mb_email
    FROM {$tbn}
  WHERE
    mb_id='{$clear['mb_id']}' OR
    mb_nick='{$clear['mb_nick']}' OR
    mb_name='{$clear['mb_name']}' OR
    mb_email='{$clear['mb_email']}'
  LIMIT 1
";
$dup = DB::Get()->sql_fetch($sql);

if($duplication!==false) {
  if($dup['mb_id']==$clear['mb_id']) {
    Dialog::alertNReplace("동일한 회원아이디가 있습니다.", Path::Group());
  }
  if($dup['mb_nick']==$clear['mb_nick']) {
    Dialog::alertNReplace("동일한 회원닉네임이 있습니다.", Path::Group());
  }
  if($dup['mb_name']==$clear['mb_name']) {
    Dialog::alertNReplace("동일한 회원이름이 있습니다.", Path::Group());
  }
  if($dup['mb_email']==$clear['mb_email']) {
    Dialog::alertNReplace("동일한 이메일 주소가 있습니다.", Path::Group());
  }
} else {
  // 회원정보 입력
  $this->Sql('insert', $clear);
  Dialog::alertNReplace("회원가입을 환영합니다.\n가입하신 아이디와 비밀번호로 로그인하세요.", Path::Group());
}

exit;
