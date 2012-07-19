<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 */

// 서브페이지 / 메인페이지 / 최상위페이지 순으로 호출
if($this->sub['m_no']) {
	$m_no = $this->sub['m_no'];
} else if($this->main['m_no']) {
	$m_no = $this->main['m_no'];
} else {
	$m_no = $this->root['m_no'];
}

/*
 * 매직보드가 설치되어 있는지 검사함
 * dbconfig파일 검사하여 알아냄
 * 설정된 아이디를 이용하여 해당 페이지 값을 가져옴
 * 없다면 인스톨 중이기 때문에 install로 변경함
 * 설치되어 있지 않을때에는 layout을 install로 만듦
 * !!!설치후 제거해도 상관없는 코드이다!!! 사이트가 커지기 전에는 크게 무관한듯함
 */
if(!is_file(Path::dbconfig())  ) {
	$result=array('m_layout'=>'install');
} else {
	if(
		!DB::Get()->existTB(DB::Get()->prefix().'magic') ||
		!DB::Get()->existTB(DB::Get()->prefix().'board') ||
		!DB::Get()->existTB(DB::Get()->prefix().'comment') ||
		!DB::Get()->existTB(DB::Get()->prefix().'file') ||
		!DB::Get()->existTB(DB::Get()->prefix().'member') ||
		//!DB::Get()->existTB(DB::Get()->prefix().'message') ||
		!DB::Get()->existTB(DB::Get()->prefix().'widget') ||
		!DB::Get()->existTB(DB::Get()->prefix().'write')
	) {
		$result=array('m_layout'=>'install');
	} else {
		$result=$this->Sql('fetch', $m_no);
		// id가 없을 경우
		if(!$result) {
			$result = array(
				'm_id'=>'popup',
				'm_layout'=>'popup',
				'm_contents'=>'[[Widget|?]]'
			);
		}
	}
}



