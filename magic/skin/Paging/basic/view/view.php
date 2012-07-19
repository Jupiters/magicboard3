<?php if(!defined('__MAGIC__')) exit; 
$list = $this->list;
?>
<div class="paging">
<?php foreach ($list as $v) {?>
  <a class="<?php echo $v['class']?>" href="<?php echo $v['link']?>">
  <?php if($v['img']) {?>
  <img src="<?php echo $v['img']?>" alt="name"/>
  <?php } else { echo $v['name']; }?>
  </a>
<?php }?>
</div>
