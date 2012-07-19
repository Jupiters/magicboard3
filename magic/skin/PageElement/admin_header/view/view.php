<?php if(!defined('__MAGIC__')) exit;
?>
<a id="logo" href="<?php echo $this->logo_link?>"><img src="<?php echo $this->logo?>" width="140" height="54" alt="매직보드 관리자"></a>
<div id="link">
  <a href="<?php echo $this->link_page?>" class="tp" title="페이지수정"><img src="<?php echo $this->icon_page?>" alt="페이지수정"/></a>
  <a href="<?php echo $this->link_design?>" class="tp" title="디자인수정"><img src="<?php echo $this->icon_design?>" alt="디자인모드"/></a>
  <a href="<?php echo $this->link_logout?>"><img src="<?php echo $this->btn_logout?>" alt="로그아웃"/></a>
  <a href="<?php echo $this->link_home?>"><img src="<?php echo $this->btn_home?>" alt="홈"></a>
</div>
