<?php if(!defined('__MAGIC__')) exit;
$root = Magic::Inst()->Action('root');
?>

<div id="magic_btn">
  <?php if($this->btn_page) {?>
  <a class="tp" href="<?php echo $this->btn_page['link']?>"><?php echo $this->btn_page['title']?></a>
  <?php }?>
  <?php if($this->btn_magic) {?>
  <a class="tp" href="<?php echo $this->btn_magic['link']?>"><?php echo $this->btn_magic['title']?></a>
  <?php }?>
</div>

<ul class="links">
  <li><a href="<?php echo $root['link']?>">HOME</a></li>
<?php foreach ($this->top_btns as $v) {?>
  <li><a href="<?php echo $v['link']?>" <?php echo $v['popup']?'onclick="'.$v['popup'].'"':''?> ><?php echo $v['title']?></a></li>
<?php }?>
</ul>
