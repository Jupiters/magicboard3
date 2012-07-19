<?php if(!defined("__MAGIC__")) exit; 

$key_name = $this->KN();

foreach($_POST['order'] as $k=>$v) {
  DB::Get()->update($this->TBN(), array('wr_update'=>date("Y-m-d h:i:s", strtotime("+{$k} seconds"))), " WHERE {$key_name}='{$v}' ");
}

exit;


