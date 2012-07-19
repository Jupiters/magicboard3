<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$sql = "
	DELETE FROM `{$tbn}`
	WHERE tag_no='$att[1]' 
";
DB::Get()->sql_query($sql);
