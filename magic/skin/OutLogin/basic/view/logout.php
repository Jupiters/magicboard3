<?php if(!defined("__MAGIC__")) exit;
$m = Member::Inst();
$picture = $m->Action('picture');
?>

<div id="logout">
  <img class="pic" src="<?php echo $picture['link']?>" alt="회원사진"/>
  <p><b><?php echo $m->mb_nick?></b>님 반갑습니다.</p>
  <div class="bottom">
    <a href="<?php echo $m->Link('logout')?>"><img src="<?php echo $this->path_img('btn_logout.gif')?>" alt="로그아웃"/></a>
    <a href="<?php echo $m->Link('view')?>"><img src="<?php echo $this->path_img('btn_modify.gif')?>" alt="정보수정"/></a>
    <a href="<?php echo Path::Admin()?>"><img src="<?php echo $this->path_img('btn_admin.gif')?>" alt="관리자모드접속"/></a>
  </div>
</div>
