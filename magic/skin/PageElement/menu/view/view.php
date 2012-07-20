<?php if(!defined('__MAGIC__')) exit; 
$menu_main = Magic::Inst()->Action('menu_main');
foreach($menu_main as $k=>$v) {
  $menu_main[$k]['first'] = true;
  break;
}
$menu_all = Magic::Inst()->Sql('list');

$i=0;
foreach($menu_main as $k=>$v) {
  if($v['m_hidden']==0) {
    $v['children'] = array();
    foreach($menu_all as $vv) {
      if($v['m_no']==$vv['m_parent']) {
        $v['children'][] = array(
          'm_id'=>$vv['m_id'],
          'link'=>Path::Root('?id1='.$v['m_id'].'&id2='.$vv['m_id'])
        );
      }
    }
    $menu_main[$k] = $v;
  } else {
    unset($menu_main[$k]);
  }
}

$root = Magic::Inst()->Action('root');
$path = Layout::Inst('index');
?>

<ul class="list">
<?php foreach($menu_main as $v) {?>
  <li class="<?php echo $v['first']?'first':''?> <?php echo $v['active']?' active':''?>">
    <a href="<?php echo $v['link']?>" <?php echo $v['popup']?'class="popup"':''?>><?php echo $v['m_id']?></a>
    <div class="submenu <?php echo $v['active']?'activelink':''?>">
      <ul>
      <?php foreach($v['children'] as $vv) {?>
        <li><a href="<?php echo $vv['link']?>" <?php echo $vv['active']?'class="active"':''?>><?php echo $vv['m_id']?></a></li>
      <?php }?>
      </ul>
    </div>
  </li>
<?php } ?>
</ul>

<div id="logo"><a href="<?php echo $root['link']?>"><img src="<?php echo $path->path_img('logo.png')?>" title="<?php echo Config::Inst()->hp_title?>"></a></div>

<div class="search" style="display:none;">
  <input type="text" name="stx" size="10"/>
  <input type="image" class="adjust_button_line" src="<?php echo $path->path_img('btn_search_all.gif')?>" value="검색"/>
</div><!-- .search -->

