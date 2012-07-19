<?php if(!defined("__MAGIC__")) exit; 

$key = GV::Number($this->KN());
$tbn = $this->TBN();

$sql = "
	DELETE FROM `{$tbn}`
	WHERE wr_no='{$key}' 
";
DB::Get()->sql_query($sql);
Url::GoReplace($this->Link('list'));
