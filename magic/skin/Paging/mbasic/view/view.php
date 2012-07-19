<?php if(!defined('__MAGIC__')) exit; 
$list = $this->list;
?>
<?php foreach ($list as $v) {?>
<li><a data-theme="" data-icon="" href="<?php echo $v['link']?>"><?php echo $v['name']?></a></li>
<?php }?>
