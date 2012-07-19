<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 파일을 삭제하는 스크립트이다.
 * $att[1] 첫번째 파라메터는 삭제할 파일번호다.
 */

if(!$att[1]) $att[1]=$this->file_no;
$file_no = $att[1];

/*
	function list_category($selected, $use_script=false) {
		if(!$this->board->bo_use_category) return '';

		$categories = explode('|',$this->board->bo_category);
		$list=array('선택하세요.'=>'');
		foreach($categories as $k=>$v) {
			if(trim($v)!='') $list[$v] = $v;
		}

		$script='';
		if($use_script) {
			$script.='ChangeCategory(';
			$script.="'".Url::Get('', 'category')."'";
			$script.=')';
		}

		return Html::select('wr_category', $list, $selected, array('id'=>'select_category', 'size'=>'1', 'onchange'=>$script));
	}
	//&/
	