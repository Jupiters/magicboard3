<?php if(!defined("__MAGIC__")) exit; 

// 스킨 변경시 업데이트
$_POST['wg_skin'] = GV::String('wgSkin');
// POST 데이터 변환
$data = Widget::Inst()->Action('data_implode', $_POST);
//insert
$key = DB::Get()->InsertEx($this->TBN(), $data);
if(!$key) Dialog::Alert('정확한 정보를 입력하세요.');
// add widget
Widget::Inst()->Action('add_widget', $key);
?>
<script>
window.opener.location.reload();
window.close();
</script>
<?php exit;






