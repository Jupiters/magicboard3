<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$key_name = $this->KN();
$where = " WHERE {$key_name}='$this->mb_no' ";
$encrypt_password = $this->Sql('password', $att[1]);
DB::Get()->update($tbn, array('mb_passwd'=>$encrypt_password), $where);
