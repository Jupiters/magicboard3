<?php if(!defined('__MAGIC__')) exit;
$key = GV::Number($this->KN());

$btns = array();

if($this->CurrentState()=='view') {
	if($this->Can('modify')) {
		$btns[] = array(
			'href'=>$this->Link('modify', $key),
      'img'=>$this->path_img('btn_modify.gif'),
			'alt'=>'수정'
		);
	}
	if($this->Can('delete')) {
		$btns[] = array(
			'href'=>$this->Link('delete', $key),
			'onclick'=>"return confirm('게시글을 삭제 하시겠습니까?\\n삭제된 개시글은 복구 할 수 없습니다.')",
      'img'=>$this->path_img('btn_delete.gif'),
			'alt'=>'삭제'
		);
	}
}

if($this->Config('mb','admin') && $this->CurrentState()=='list') {
  $btns[] = array(
    'href'=>urldecode($this->Link('delete_selected')),
    'class'=>'delete_selected',
    'img'=>$this->path_img('btn_select_delete.gif'),
    'alt'=>'선택삭제'
  );
}

if($this->CurrentState()!='write') {
	if($this->Can('write')) {
		$btns[] = array(
			'href'=>$this->Link('write'),
      'img'=>$this->path_img('btn_write.gif'),
			'alt'=>'글쓰기'
		);
	}
}
?>

<?php foreach($btns as $vvv) {?>
<a href="<?php echo $vvv['href']?>" onclick="<?php echo $vvv['onclick']?>" class="<?php echo $vvv['class']?>"><img src="<?php echo $vvv['img']?>" alt="<?php echo $vvv['alt']?>"/></a>
<?php }?>
