<?php if(!defined("__MAGIC__")) exit; 


/*
 * 이곳에서 GET으로 넘어온 값을 분석하여
 * root/main/sub를 분류해줌
 */
$list = $this->Sql('list');
$root = $_GET[$this->Config('root')];	// 최상위루트 키값
$main = $_GET[$this->Config('main')];	// 메인메뉴 키값
$sub = $_GET[$this->Config('sub')];		// 서브메뉴 키값
if(!$root) {
	$root = $this->Config('root_default');
}


// 각각의 키값에 대한 레코드값 변수를 입력
/*
foreach($list as $v) {
	if($root == $v['m_id']) {
		$root = $v;
	} else if($main == $v['m_id']) {
		$main = $v;
	} else if($sub == $v['m_id']) {
		$sub = $v;
	}
}
//*/

// 최상위 리스트 구하기
$list_root = array();
foreach($list as $v) {
	if($v['m_parnet']==0) {
		$list_root[] = $v;
	}
}
// 현재 root구하기
foreach($list_root as $v) {
	if($root == $v['m_id']) {
		$root = $v;
	}
}
if(!is_array($root)) {
	$root = '';
}

// 현재 메인메뉴 구하기
$list_main = array();
foreach($list as $v) {
	if($root['m_no'] == $v['m_parent']) {
		if($v['m_id']==$main) { // active체크
			$v['active'] = true;
		}
		$list_main[] = $v;
	}
}
// 현재 메인메뉴 구하기
foreach($list_main as $v) {
	if($main == $v['m_id']) {
		$main = $v;
	}
}

/*
var_dump($main);
if(!is_array($main)) {
	$main = '';
}
//*/

// 현재 서브메뉴 구하기
$list_sub = array();
foreach($list as $v) {
	if($v['m_hidden']==0 && $main['m_no'] == $v['m_parent']) {
		if($v['m_id'] == $sub) { // active체크
			$v['active'] = true;
		}
		$list_sub[] = $v;
	}
}
// 현재 서브메뉴 구하기
foreach($list_sub as $v) {
	if($sub == $v['m_id']) {
		$sub = $v;
	}
}
if(!is_array($sub)) {
	$sub = '';
}

if($main=='' && $sub=='') {
	$root['active'] = true;
}


$this->root = $root;
$this->main = $main;
$this->sub = $sub;
$this->list_root = $list_root;
$this->list_main = $list_main;
$this->list_sub = $list_sub;

if($this->root['m_id']==$this->Config('root_default')) {
	$this->root['link'] = Path::Root();
} else {
	$this->root['link'] = Path::Root('/?'.$this->Config('root').'='.$this->root['m_id']);
}
if($this->root['m_redirection']) {
	$this->root['link'] = $this->root['m_redirection'];
} else {
	$this->root['link'] = Path::Root('/?'.$this->Config('root').'='.$this->root['m_id']);
}
$this->main['link'] = Path::Root('/?'.$this->Config('root').'='.$this->root['m_id'].'&'.$this->Config('main').'='.$this->main['m_id']);
$this->sub['link'] = Path::Root('/?'.$this->Config('root').'='.$this->root['m_id'].'&'.$this->Config('main').'='.$this->main['m_id'].'&'.$this->Config('sub').'='.$this->sub['m_id']);


/*
if($this->root['m_id']!='mobile' && $this->root['m_id']!='mobile_member' && Util::checkMobile() && is_dir(Path::Root('magic/skin/Layout/mobile'))) {
	Url::GoReplace(Path::Root('?r=mobile'));
}
*/

// 현재메뉴 정보를 불러옴
// redirection 정보가 있으면 바로 이동해줌
// redirection 보다는 메뉴주소자체를 바로 바꾸어줌
$menu='';
if($sub['m_no']) {
	$menu = $sub;
} else if($main['m_no']) {
	$menu = $main;
} else {
	$menu = $root;
}

if(isset($menu['m_redirection']) && $menu['m_redirection']) {
	Url::GoReplace($menu['m_redirection']);
}

/*
 * 테마에 따른 css 입력
 * 테마는 관리자에서 설정하도록 추가할 예정
 */
Styles::Add(Path::Group('/magic/css/'.$this->Config('theme').'/jquery-ui-all.css'));



