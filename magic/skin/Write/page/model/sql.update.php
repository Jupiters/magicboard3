<?php if(!defined("__MAGIC__")) exit; 

$key_name = $this->KN();
$key = GV::Number($key_name);
DB::Get()->update($this->TBN(), $att[1], " WHERE {$key_name}='{$key}' ");
