<?php if(!defined("__MAGIC__")) exit;
// 스킨폴더/guidline_for_design.php 파일을 참고하세요
?>
<ul>
  <li class="first"><img src="<?php echo $this->path_img('menu_icon_00.png')?>"/><a href="<?php echo Path::Group('?r=admin')?>">관리자메인</a></li>
<?php foreach($this->menu_main as $v) {?>
  <li class="<?php echo $v['active']?' active':''; echo $v['last']?' last':''?>">
    <img src="<?php echo $v['icon']?>"/>
    <a href="<?php echo $v['link']?>" <?php echo $v['popup']?'class="popup"':''?>><?php echo $v['m_id']?></a>
  </li>
<?php } ?>
</ul>
