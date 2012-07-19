<?php if(!defined("__MAGIC__")) exit; 

$data = Widget::Inst()->Action('data_implode', $_POST);
$key = DB::Get()->InsertEx($this->TBN(), $data);
if(!$key) Dialog::Alert('정확한 정보를 입력하세요.');

Widget::Inst()->Action('add_widget', $key);
?>
<script>
window.opener.location.reload();
window.close();
</script>
<?php exit;

