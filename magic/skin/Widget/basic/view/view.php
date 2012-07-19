<?php if(!defined('__MAGIC__')) exit;
?>
<div class="widget" style="width:<?php echo $this->widget_width?>">
  <?php echo $this->widget?>
  <?php if(sizeof($this->wg_buttons)!=0) {?>
  <div class="widget_btn">
    <?php foreach ($this->wg_buttons as $v) {?><a
      class="button <?php echo $v['class']?> wg_config"
      <?php echo $v['title']?'title="'.$v['title'].'"':''?>
      <?php echo $v['width']?'width="'.$v['width'].'"':''?>
      <?php echo $v['height']?'height="'.$v['height'].'"':''?>
      href="<?php echo $v['href']?>"><?php echo $v['name']?></a><?php }?>
  </div>
  <?php }?>
</div><!-- .widget -->
