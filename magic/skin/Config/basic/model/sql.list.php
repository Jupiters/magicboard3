<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$sql_result = array();
if($tbn) {
  foreach(DB::Get()->sql_query_list(" SELECT * FROM $tbn ") as $k=>$v) {
    $sql_result[$v['cf_id']] = $v;
  }
}


