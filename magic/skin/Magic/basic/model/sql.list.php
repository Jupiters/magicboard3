<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
if($tbn) {
	$sql = "
		SELECT *
		FROM {$tbn}
		ORDER BY m_parent, m_order
	";
	$sql_result = DB::Get()->sql_query_list($sql);
} else {
	$sql_result = array();
}
