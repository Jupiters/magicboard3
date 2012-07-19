<?php if(!defined("__MAGIC__")) exit; 
// 스킨 변경시 업데이트
$_POST['wg_skin'] = GV::String('wgSkin');
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

