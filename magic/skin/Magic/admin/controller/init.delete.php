<?php if(!defined("__MAGIC__")) exit; 

$this->Sql('delete', GV::Number($this->KN()));
Url::GoReplace($this->Link('list'));
exit;
