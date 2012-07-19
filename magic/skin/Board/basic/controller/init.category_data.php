<?php if(!defined("__MAGIC__")) exit; 

$sql = "
	SELECT bo_category FROM {$this->TBN()} WHERE bo_no='{$_GET['bo_no']}'
";

$data = trim(array_pop(DB::Get()->sql_fetch($sql)));
if($data=='') $data=json_encode(array());

echo $data;

exit;

