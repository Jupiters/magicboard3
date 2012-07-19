<?php if(!defined("__MAGIC__")) exit; 

DB::Get()->sql_query("
	UPDATE `{$this->TBN()}` 
	SET wr_hit=(wr_hit+1) 
	WHERE wr_no='$att[1]' 
");