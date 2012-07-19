<?php if(!defined("__MAGIC__")) exit; 

if(!$att[1] || !is_array($att[1]))
	$sql_result = false;
else 
	$sql_result = DB::Get()->InsertEx($this->TBN(), $att[1]);

