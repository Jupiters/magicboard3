<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$sql = "
	DELETE FROM `{$tbn}`
	WHERE wr_no='$att[1]' 
";
DB::Get()->sql_query($sql);