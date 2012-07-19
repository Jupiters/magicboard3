<?php if(!defined("__MAGIC__")) exit; 
$is_login = $this->Config('mb','login');
$parent_no = GV::Number('parent_no');
$can_secret = Board::Inst()->bo_no($this->bo_no)->bo_comment_use_secret;
$m = Member::Inst();
$pic = $m->Action('picture');
?>

<?php if($this->Can('write')) {?>
<div class="cmt_form">
  <form method="post" action="<?php echo $this->Link('insert')?>">
  <input type="hidden" name="edit" value="0"/>
  <input type="hidden" name="wr_no" value="<?php echo $this->wr_no?>"/>
  <input type="hidden" name="cmt_parent_no" value="<?php echo $parent_no?>"/>

  <img class="pic_insert" src="<?php echo $pic['link']?>"/>
  <span class="name"><?php echo $m->mb_nick?></span>
  <textarea name="cmt_content" class="require" alt="댓글내용" rows="2" cols="20000">댓글입력...</textarea>

  <div class="button-line">
    <?php if($can_secret) {?>
    <input id="secret" class="secret" name="cmt_is_secret" type="checkbox" value="1"/>
    <label for="secret">비밀글&nbsp;</label>
    <?php }?>
    <?php if(!$is_login) {?>
    <input type="text" name="cmt_writer" class="require" alt="이름" size="3" title="이름"/>
    <input type="password" name="cmt_password" class="require" alt="비밀번호" size="3" title="비밀번호"/>
    &nbsp;|&nbsp;
    <?php echo Captcha::Inst()->html()?>
    <?php }?>
    <input class="btn_cmt_write" type="image" src="<?php echo $this->path_img('btn_cmt_write.gif')?>" alt="댓글입력"/>
  </div>

  </form>
</div><!-- .cmt_form -->
<div class="cmt_form_bg"></div>
<?php } else {?>
<div class="auth">댓글쓰기 권한이 없습니다.</div>
<?php }?>
