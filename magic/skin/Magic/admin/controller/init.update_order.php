<?php if(!defined("__MAGIC__")) exit; 

foreach ($_POST['order'] as $k => $v) {
	$this->Sql('update', $v, array('m_order'=>$k));
}

exit;
		
