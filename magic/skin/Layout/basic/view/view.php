<?php if(!defined('__MAGIC__')) exit;
$gnb = PageElement::Inst('gnb')->html();
$side = PageElement::Inst('side')->html();
$menu = PageElement::Inst('menu')->html();
$footer = PageElement::Inst('footer')->html();
$head = PageElement::Inst('head')->html();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><?php echo $head?></head>
<body>
  <div id="header">
    <div id="gnb">
      <?php echo $gnb?>
    </div>
    <div id="menu">
      <?php echo $menu?>
    </div>
  </div>
  <div id="container">
    <div id="content">
      [[contents]]
    </div><!-- #content -->
    <div id="side">
      <?php echo $side?>
    </div>
    <br clear="both"/>
  </div><!-- #container -->
  <div id="footer">
    <?php echo $footer?>
  </div>
</body>
</html>
