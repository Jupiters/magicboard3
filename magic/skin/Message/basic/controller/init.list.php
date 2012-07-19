<?php if(!defined("__MAGIC__")) exit; 

$state_x = GV::Number('state_x');
$state_o = GV::Number('state_o');

if($state_o==''&&$state_x=='') Url::Go(Url::Get(array('state_x'=>20)));
