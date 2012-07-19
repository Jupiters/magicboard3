<?php if(!defined("__MAGIC__")) exit; 

$_POST['bo_no'] = implode(',',$_POST['bo_no']);
$data = Widget::Inst()->Action('data_implode', $_POST);

$key_name = $this->KN();
$key = GV::Number($key_name);
DB::Get()->Update(
	$this->TBN(),
	$data,
	"where {$key_name}='{$key}' "
);
?>
<script>
window.opener.location.reload();
window.close();
</script>
<?php exit;

