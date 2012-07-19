<?php if(!defined("__MAGIC__")) exit; 

$mb_no = $this->key;
if($mb_no==='') $mb_no = $this->Action('is_login');
if($mb_no) {
  $this->member = $this->Sql('fetch', $mb_no);
} else {
	$m['mb_no'] = 0;
	$m['mb_nick'] = '손님';
	$m['mb_level'] = 1;
	$this->member = $m;
}

