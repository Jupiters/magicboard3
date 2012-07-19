<?php if(!defined("__MAGIC__")) exit; 

foreach($_POST['cf_id'] as $k=>$v) {
	$clear = array(
		'cf_value' => $_POST['cf_value'][$k],
		'cf_desc' => $_POST['cf_desc'][$k]
	);

  // 관리자 아이디 업데이트 함
  if($v=='admin') {
    $sql = " SELECT * from {$this->TBN()} WHERE cf_id='{$v}' ";
    $fetch = DB::Get()->sql_fetch($sql);
    DB::Get()->update(Member::Inst()->TBN(), array('mb_id'=>$clear['cf_value']), " WHERE mb_id='{$fetch['cf_value']}' ");
  }

	DB::Get()->update($this->TBN(), $clear, " WHERE cf_id='{$v}' ");
}

Url::GoReplace($this->Link('list'));


