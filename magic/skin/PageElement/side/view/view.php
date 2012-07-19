<?php if(!defined('__MAGIC__')) exit;

$menu_sub = Magic::Inst()->Action('menu_sub'); 
$main_menu = Magic::Inst()->main;
?>
<div class="title"><h3><?php echo $main_menu['m_id']?></h3></div>
<?php if(sizeof($menu_sub)!=0){?>
<ul><?php foreach($menu_sub as $v) {?>
<li <?php echo $v['active']?'class="active"':''?>><a href="<?php echo $v['link']?>" <?php echo $v['popup']?'class="popup"':''?>><?php echo $v['m_id']?></a></li>
	<?php } ?></ul>
<?php }?>

<div class="banner"><img src="<?php echo Layout::Inst('index')->path_img('customer_center.gif')?>" alt="customer_center"/></div>
<div class="banner"><a href="http://www.webmona.com/" class="popup"><img src="<?php echo Layout::Inst('index')->path_img('banner_side_release.jpg')?>" alt="매직보드 3.x 출시"/></a></div>
<div class="banner"><a href="http://www.webmona.com/" class="popup"><img src="<?php echo Layout::Inst('index')->path_img('banner_side_download.jpg')?>" alt="매직보드 다운로드"/></a></div>
