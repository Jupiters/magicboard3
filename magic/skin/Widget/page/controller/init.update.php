<?php if(!defined("__MAGIC__")) exit; 

// 스킨 변경시 업데이트
$_POST['wg_skin'] = GV::String('wgSkin');


$data = Widget::Inst()->Action('data_explode', $this->wg_no);
if(!$data['wr_no']) { // wr_no가 없으면 입력
  // 게시글 입력
  $tbn = Write::Inst()->TBN();
  $clear = array();
  $clear['mb_no'] = Member::Inst()->mb_no;
  $clear['bo_no'] = 0;
  $clear['wr_datetime'] = 'NOW()';
  $clear['wr_update'] = 'NOW()';
  $clear['wr_ip'] = "INET_ATON('".Util::GetRealIPAddr()."')";
  $clear['wr_content'] = '';
  $clear['wr_subject'] = '페이지(일반형)';
  $key = DB::Get()->InsertEx($tbn, $clear, array('wr_ip','wr_datetime','wr_update'));
  // 게시글번호 저장
  $_POST['wr_no'] = $key;
} else {
  $_POST['wr_no'] = $data['wr_no'];
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






