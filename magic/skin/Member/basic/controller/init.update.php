<?php if(!defined("__MAGIC__")) exit; 

// 스펨  차단코드 검사
Captcha::Inst()->Check();

// 걸러진 결과값
$clear = $this->Clear();
// 로그인한 회원정보
$m = Member::Inst();

// 수정하지 않을 변수
unset($clear['mb_id']);
unset($clear['mb_passwd']);

if(!$clear['mb_nick']) Dialog::alert("별명을 입력하세요.");

$tbn = $this->TBN();
$sql = "
  SELECT
    mb_id,
    mb_nick,
    mb_name,
    mb_email
    FROM {$tbn}
  WHERE
    mb_no<>'{$m->mb_no}' AND (
    mb_id='{$clear['mb_id']}' OR
    mb_nick='{$clear['mb_nick']}' OR
    mb_name='{$clear['mb_name']}' OR
    mb_email='{$clear['mb_email']}'
    )
  LIMIT 1
";
$dup = DB::Get()->sql_fetch($sql);


if($dup!==false) {
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
  // 파일을 업로드 했을 때 이전 파일들은 지움 
  $f = File::Inst();
  $files = array();
  if($_FILES[$f->Config('form_name', 'file')]['name']) {
    foreach ($f->mb_no($m->mb_no)->Action('files') as $k=>$v)
      $files[] = $v['file_no'];
  }

  // 삭제파일
  $del_files = $_POST[File::Inst()->Config('form_name', 'del')];
  if(!$del_files) $del_files = array();

  // 삭제해야할 파일들 삭제
  foreach (array_merge($files, $del_files) as $v) {
    $f->Action('delete', $v);
  }

  // 파일 업로드
  $f->Action('upload', 0);

  // 회원정보 업데이트
  $this->Sql('update', $m->mb_no, $clear);
    
  Dialog::alertNReplace("회원정보가 수정되었습니다.", Path::Group());
}


exit;
		
