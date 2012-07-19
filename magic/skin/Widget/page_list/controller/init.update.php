<?php if(!defined("__MAGIC__")) exit; 

// 스킨 변경시 업데이트
$_POST['wg_skin'] = GV::String('wgSkin');

// 게시판 추가하여 저장
if(!$_POST['bo_no']) {
  $r = GV::String('r');
  $id1 = GV::String('id1');
  $id2 = GV::String('id2');
  $clear['bo_subject'] = '페이지';
  $clear['bo_kind'] = 'page';
  $clear['bo_admin_path'] = Url::Get(array('r'=>$r,'id1'=>$id1,'id2'=>$id2,'bo_no'=>$clear['bo_no'], $this->Mode('name')=>'write'));
  $key = Board::Inst()->Action('insert_record', $clear);
  // 게시판 번호
  $_POST['bo_no'] = $key;
}

// POST 데이터 변환
$data = Widget::Inst()->Action('data_implode', $_POST);

// 업데이트
DB::Get()->Update($this->TBN(), $data, "where wg_no='{$this->wg_no}'");
?>
<script>
window.opener.location.reload();
window.close();
</script>
<?php exit;






