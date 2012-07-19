<?php if(!defined('__MAGIC__')) exit;
$key = GV::Number($this->KN());

$btns = array();

if($this->CurrentState()=='view') {
	if($this->Can('list')) {
		$btns[] = array(
			'href'=>$this->Link('list'),
			'alt'=>'목록'
		);
	}
	if($this->Can('delete')) {
		$btns[] = array(
			'href'=>$this->Link('delete', $key),
			'onclick'=>"return confirm('게시글을 삭제 하시겠습니까?\\n삭제된 개시글은 복구 할 수 없습니다.')",
			'alt'=>'삭제'
		);
	}
}
if($this->CurrentState()!='write') {
	if($this->Can('write')) {
		$btns[] = array(
			'href'=>$this->Link('write'),
			'icon'=>'ui-icon-pencil',
			'alt'=>'글쓰기'
		);
	}
}
?>

<?php foreach($btns as $vvv) {?>
<li><a data-theme="" data-icon="" href="<?php echo $vvv['href']?>"><?php echo $vvv['alt']?></a></li>
<?php }?>
