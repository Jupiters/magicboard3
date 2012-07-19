<?php if(!defined("__MAGIC__")) exit; 

$file = new File(GV::Number('wr_no'), $this->board);
$file->Download(GV::Number('file_no'));