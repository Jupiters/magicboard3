<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$sql = "
	UPDATE `$tbn` 
	SET 
	mb_level=1,  
	mb_nick='',  
	mb_email='',  
	mb_question='',  
	mb_answer='',  
	mb_passwd='',  
	mb_memo='{$att[2]}',  
	mb_leave=NOW()
	WHERE mb_no='{$att[1]}'
	LIMIT 1 
";
DB::Get()->sql_query($sql);