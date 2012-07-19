<?php if(!defined('__MAGIC__')) exit; 

$list = $this->Sql('list', $this->wr_no);
$cnt = $this->Sql('list_cnt', $this->wr_no);

foreach($list as $k=>$v) {

  if($this->Can('delete', $v['cmt_no'])) {
    $v['link_delete'] = $this->Link('delete', $v['cmt_no']);
    $v['icon_delete'] = $this->path_img('btn_cmt_delete.gif');
  }
  $v['link_reply'] = $this->Link('reply', $this->wr_no, $v['cmt_no']);
  $v['icon_reply'] = $this->path_img('btn_cmt_reply.gif');
  $v['picture'] = Member::Inst()->mb_no($v['mb_no'])->Action('picture');

  if($v['children']) {
    foreach($v['children'] as $kk=>$vv) {
      if($this->Can('delete', $vv['cmt_no'])) {
        $vv['link_delete'] = $this->Link('delete', $vv['cmt_no']);
        $vv['icon_delete'] = $this->path_img('btn_cmt_delete.gif');
      }
      $vv['link_reply'] = $this->Link('reply', $this->wr_no, $vv['cmt_no']);
      $vv['icon_reply'] = $this->path_img('btn_cmt_reply.gif');
      $vv['picture'] = Member::Inst()->mb_no($vv['mb_no'])->Action('picture');
      $v['children'][$kk] = $vv;
    }
  } else {
    $v['children'] = array();
  }

  $list[$k] = $v;
}
?>

<div id="comment_title">댓글 <span><?php echo number_format($cnt)?></span></div>
<ul id="comments">
  <?php foreach ($list as $v) { ?>
    <li>

      <div class="top">
        <span class="nick"><?php echo $v['cmt_writer']?></span>
        <span class="datetime"><?php echo $v['cmt_datetime_text']?></span>
        <span class="ip"><?php echo $v['ip']?></span>
        <div class="buttons">
          <?php if($v['link_delete']){?>
          <a href="<?php echo $v['link_delete']?>" title="댓글을 삭제합니다" class="delete tp">댓글삭제 <img src="<?php echo $v['icon_delete']?>" alt="댓글삭제"/></a> | 
          <?php }?>
          <a class="reply" href="<?php echo $v['link_reply']?>">답글달기 <img src="<?php echo $v['icon_reply']?>" alt="답글달기"/></a>
        </div>
      </div>

      <div class="cmt_content"><?php echo $v['cmt_content']?></div>

      <img class="pic" src="<?php echo $v['picture']['link']?>"/>


      <!-- children -->
      <ul class="children">
        <?php foreach ($v['children'] as $vv) {?>
        <li>

          <div class="top">
            <span class="nick"><?php echo $vv['cmt_writer']?></span>
            <span class="datetime"><?php echo $vv['cmt_datetime_text']?></span>
            <span class="ip"><?php echo $vv['ip']?></span>
            <div class="buttons">
              <?php if($vv['link_delete']){?>
              <a href="<?php echo $vv['link_delete']?>" title="댓글을 삭제합니다" class="delete tp">댓글삭제 <img src="<?php echo $vv['icon_delete']?>" alt="댓글삭제"/></a> | 
              <?php }?>
              <a class="reply" href="<?php echo $vv['link_reply']?>">답글달기 <img src="<?php echo $vv['icon_reply']?>" alt="답글달기"/></a>
            </div>
          </div>

          <div class="cmt_content"><?php echo $vv['cmt_content']?></div>
          <img class="pic" src="<?php echo $vv['picture']['link']?>"/>
        </li>
        <?php }?>
        <li class="input hide"></li>
      </ul>

    </li>
  <?php }?>

  <li class="input"><?php include $this->path_view('form.php')?></li>
</ul>



