<?php if(!defined("__MAGIC__")) exit; 

$sql = "
	UPDATE {$this->TBN()} SET bo_category='{$_POST['bo_category']}' WHERE bo_no='{$_GET['bo_no']}'
";
DB::Get()->sql_query($sql);

exit;


