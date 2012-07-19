<?php if(!defined("__MAGIC__")) exit; 


if(is_array($_POST['chk'])) {
  foreach($_POST['chk'] as $k=>$v) {
    // 게시글 하나 삭제
    $this->Sql('delete', $v);

    // 게시글에 포함된 파일 모두 삭제
    foreach(File::Inst()->wr_no($v)->Action('files') as $vv) {
      File::Inst()->Action('delete', $vv);
    }
  }
}

exit;


