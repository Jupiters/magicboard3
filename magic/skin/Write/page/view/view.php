<?php if(!defined('__MAGIC__')) exit;

$v = $this->Sql('fetch', $this->wr_no);
echo Widget::Inst()->Parse(
	$this->TBN(),
	'wr_no',
	$v['wr_no'],
	'wr_content',
	Editor::Inst('', $this->Config('editor', 'name'))->db_out($v['wr_content'])
);
?>

<?php if(Widget::Inst()->Config('is_page')) {?>
<div class="center"><a href="<?php echo $this->Link('modify', $v['wr_no'])?>"><img src="<?php echo $this->path_img('btn_modify_page.gif')?>" alt="수정"/></a></div>
<?php }?>
