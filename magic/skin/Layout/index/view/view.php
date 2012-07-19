<?php if(!defined('__MAGIC__')) exit;
$gnb = PageElement::Inst('gnb')->html();
$menu = PageElement::Inst('menu')->html();
$footer = PageElement::Inst('footer')->html();
$head = PageElement::Inst('head')->html();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><?php echo $head?></head>
<body>
  <div id="header_index">
    <div id="gnb">
      <?php echo $gnb?>
    </div>
    <div id="menu">
      <?php echo $menu?>
    </div>
  </div>
  <div id="container">
    <div class="index_left_section">
      <div class="latest">[[contents]]</div>
      <div class="banner">
        <a href="http://www.webmona.com" class="popup"><img src="<?php echo $this->path_img('banner_builder_homepage.jpg')?>"/></a>
        <a href="http://www.webmona.com" class="popup"><img src="<?php echo $this->path_img('banner_builder_potal.jpg')?>"/></a>
      </div>
    </div>
    <div class="index_right_section">
      <div class="latest"><a href="http://www.webmona.com" class="popup tp" title="준비중입니다"><img src="<?php echo $this->path_img('temp.gif')?>"/></a></div>
      <div class="banner">
        <a href="http://www.webmona.com" class="popup"><img src="<?php echo $this->path_img('banner_release.jpg')?>"/></a>
        <a href="http://www.webmona.com" class="popup"><img src="<?php echo $this->path_img('banner_download.jpg')?>"/></a>
      </div>
    </div>
  </div><!-- #container -->
  <div id="footer"><?php echo $footer?></div>
</body>
</html>
