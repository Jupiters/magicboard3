<?php if(!defined("__MAGIC__")) exit;
?>
<?php if(sizeof($this->list)!=0){?>
<ul>
<?php foreach($this->list as $v) {?>
  <li <?php echo $v['active']?'class="active"':''?>><a href="<?php echo $v['link']?>" <?php echo $v['popup']?'class="popup"':''?>><?php echo $v['m_id']?></a></li>
<?php } ?>
</ul>
<?php }?>
