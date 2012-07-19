<?php if(!defined("__MAGIC__")) exit; 

		$tbn_member = Member::TBN();
		$data = array();

		$mb_no_list = explode('_', $_GET['mb_no']);
		foreach($mb_no_list as $k=>$v) {
			if(trim($v)=='' || !is_numeric($v)) unset($mb_no_list[$k]);
		}
		

		if(sizeof($mb_no_list)==0) return;

		$sql = "
			SELECT mb_no, mb_nick FROM `{$tbn_member}` WHERE 
		";

		foreach($mb_no_list as $v)
		{
			$sql .= " mb_no={$v} OR ";
		}
		$sql = substr($sql, 0, -3);
		$receiver = DB::Get()->sql_query_list($sql);

		$this->receiver = '';
		foreach($receiver as $v)
		{
			$this->receiver .= $v['mb_nick'].'('.$v['mb_no'].'),';
		}
		
		$data['link_action'] = $this->link_insert();
		$data['receivers'] = $this->receiver;
		$data['bo_no'] = $this->board->bo_no;
		$this->view->SetData($data);