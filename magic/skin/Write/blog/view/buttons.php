<?php if(!defined('__MAGIC__')) exit;
$key = GV::Number($this->KN());

$btns = array();

// 분류나 기타 태그별 보기등이 실행중일 때 전체보기 버튼 생성
if($this->Config('mb', 'admin')) {
  $btns[] = array(
    'href'=>Path::Root('admin/menu_3_0.php?boardMode=write&bo_no='.$this->bo_no),
    'icon'=>'btn_admin.gif',
    'alt'=>'블로그관리'
  );
}

if($_GET['writeMode']!='tagcloud') {
  $btns[] = array(
    'href'=>$this->Link('tagcloud'),
    'icon'=>'btn_tagcloud.gif',
    'alt'=>'태그구름'
  );
}

// 분류나 기타 태그별 보기등이 실행중일 때 전체보기 버튼 생성
if($_GET['writeMode'] || $_GET['wr_no'] || $_GET['ca1'] || $_GET['ca2'] || $_GET['tag']) {
  $btns[] = array(
    'href'=>Url::Get('', array('wr_no','ca1','ca2','tag','writeMode')),
    'icon'=>'btn_list.gif',
    'alt'=>'목록보기'
  );
}

if($this->CurrentState()=='view') {
	if($this->Can('list')) {
		$btns[] = array(
			'href'=>$this->Link('list'),
      'icon'=>'btn_list_search.gif',
			'alt'=>'검색목록'
		);
	}
	if($this->Can('modify')) {
		$btns[] = array(
			'href'=>$this->Link('modify', $key),
      'icon'=>'btn_moidfy.gif',
			'alt'=>'수정'
		);
	}
	if($this->Can('delete')) {
		$btns[] = array(
			'href'=>$this->Link('delete', $key),
      'icon'=>'btn_delete.gif',
			'onclick'=>"return confirm('게시글을 삭제 하시겠습니까?\\n삭제된 개시글은 복구 할 수 없습니다.')",
			'alt'=>'삭제'
		);
	}
}
if($this->CurrentState()!='write') {
	if($this->Can('write')) {
		$btns[] = array(
			'href'=>$this->Link('write'),
      'icon'=>'btn_write.gif',
			'alt'=>'글쓰기'
		);
	}
}
?>

<span>
<?php foreach($btns as $vvv) {?>
  <a href="<?php echo $vvv['href']?>"><img src="<?php echo $this->path_img($vvv['icon'])?>" alt="<?php echo $vvv['alt']?>"></a>
<?php }?>
</span>
