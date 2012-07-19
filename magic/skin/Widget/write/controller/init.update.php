<?php if(!defined("__MAGIC__")) exit; 

if($_POST['bo_no']=='') {
	$data['bo_subject'] = GV::String('bo_subject');
	$_POST['bo_no'] = Board::Inst()->Action('insert_record', $data);
	unset($_POST['bo_subject']);
}

$_POST['columns'] = implode('|', $_POST['columns']);
if(!$_POST['list_view']) $_POST['list_view'] = 0;
if(!$_POST['show_notice']) $_POST['show_notice'] = 0;
if(!$_POST['use_comment']) $_POST['use_comment'] = 0;
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

