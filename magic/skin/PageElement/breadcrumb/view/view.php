<?php if(!defined('__MAGIC__')) exit;

$hierarachy = Magic::Inst()->Action('hierarachy');
$current = array_shift($hierarachy);
$hierarachy = array_reverse($hierarachy);
?>
<div id="breadcrumb">
  <h1><?php echo $current['m_id']?></h1>							 
  <ul>
    <?php foreach($hierarachy as $v) {?>
    <li><a href="<?php echo $v['link']?>"><?php echo $v['m_id']?></a>&nbsp;&gt;&nbsp;</li>
    <?php }?>
    <li class="bold"><?php echo $current['m_id']?></li>							 
  </ul>
</div>
