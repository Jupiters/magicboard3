<?php if(!defined("__MAGIC__")) exit; 

$kn = $this->Config('key');
// 현재 페이지 
$key = GV::Number($kn);
if(!$key) $key = 1;
// 한페이지에 표시되는 개시물 수
$rows = $this->Config('rows');
// 전체 게시물 수
$tot = $this->Config('tot');
// 한번에 표시되는 숫자들의 개수
$nWidth = $this->Config('nWidth');
// 전체 페이지 개수
$pages = ceil(intval($tot)/$rows);

$list=array();
// 모든 변수가 재대로 되어 있어야 링크들을 생성함
if($rows>=1 && $tot>=1 && $pages>=1 && $nWidth>=1) {
	/*
	 * 처음 링크 생성
	 */
	//if($key>2) { }
	$list[] = array(
		'name'=>'처음',
		'class'=>'',
    'img'=>$this->path_img('paging_first.gif'),
		'link'=>Url::Get('',$this->Config('key'))
	);
	
	/*
	 * 이전링크 생성
	 */
	$link='';
	if($key<=2) $link = Url::Get('',$kn);
	else if($key>2) $link = Url::Get(array($kn=>$key-1));
	$list[] = array(
		'name'=>'이전',
		'class'=>'',
    'img'=>$this->path_img('paging_prev.gif'),
		'link'=>$link
	);
	
	/*
	 * 페이지 번호들 생성
	 */
	$end = ceil($key/$nWidth)*$nWidth;
	$start = $end-$nWidth+1;
	$end = $pages<$end?$pages:$end;
	for($i=$start; $i<=$end; $i++) {
		$class='number';
		if($i==$key) $class.=' hover';
		if($i==1) $link = Url::Get('',$kn);
		else $link = Url::Get(array($kn=>$i));
		$list[] = array(
			'name'=>$i,
			'class'=>$class,
			'link'=>$link
		);
	}
	
	/*
	 * 다음링크 생성
	 */
	$link='';
	if($pages>$key) $link=Url::Get(array($kn=>$key+1));
	else $link = Url::Get('',$kn);
	$list[] = array(
		'name'=>'다음',
		'class'=>'',
    'img'=>$this->path_img('paging_next.gif'),
		'link'=>$link
	);
	/*
	 * 마지막링크 생성
	 */
	//if($pages>($key+1)) { }
	$list[] = array(
		'name'=>'마지막',
		'class'=>'',
    'img'=>$this->path_img('paging_last.gif'),
		'link'=>Url::Get(array($kn=>$pages))
	);
}

$this->list = $list;
