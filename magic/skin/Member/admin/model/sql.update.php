<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$key_name = $this->KN();
$where = " WHERE {$key_name}='$att[1]' ";
DB::Get()->update($tbn, $att[2], $where, $att[3]);