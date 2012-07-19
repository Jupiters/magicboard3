<?php if(!defined('__MAGIC__')) exit; 

/* 공지목록 생성 */
// 공지
if($this->Config('show_notice')) {
  $list_notice = array();
  foreach($this->Sql('list_notice') as $v) {
    $list_notice[] = array(
        'href'=>$this->Link('subject', $v['wr_no']),
        'subject'=>$v['wr_subject']
    );
  }
}


/* 게시글목록 */
$list = array();
foreach ($this->Sql('list') as $v) {

  $_list = array();

  if($this->Config('mb','admin')) {
    $_list['check'] = '<input type="checkbox" name="chk[]" value="'.$v['wr_no'].'"/>';
  }

  $_list['datetime'] = Util::GetDate($v['wr_datetime']);
  if($v['wr_category']) $_list['category'] = '['.array_pop(explode('|',$v['wr_category'])).']';
  $_list['subject'] = $v['wr_subject'];
  $f = File::Inst()->wr_no($v['wr_no'])->Action('images', 156, 94);
  $_list['thumb'] = $f[0]['link'];//$this->path_img('no_image.gif');

  $list[] = $_list;
}

$cols = $this->Config('cols');
$rows = $this->Config('rows');

// 남은 목록에 빈 데이터를 체움
for($i=sizeof($list)+1; $i<=$rows*$cols; $i++) {
  $_list = array(
    'thumb'=>$this->path_img('no_image.gif'),
    'subject'=>array(
      'text'=>'이미지를 등록해 주세요.'
    )
  );
  if($i%$cols==0) {
    $_list['class'] = 'last';
  }
  $list[] = $_list;
}




$config = Board::Inst()->bo_no($this->bo_no);
?>

<?php if($config->bo_use_category) { ?>
<input type="hidden" name="ca1" value='<?php echo $_GET['ca1']?>'/>
<input type="hidden" name="ca2" value='<?php echo $_GET['ca2']?>'/>
<input type="hidden" name="ca3" value='<?php echo $_GET['ca3']?>'/>
<input type="hidden" name="base_url" value='<?php echo Url::Get('',array('ca1','ca2','ca3'))?>'/>
<input type="hidden" name="bo_category" value='<?php echo $config->bo_category?>'/>
<?php }?>

<!-- total,category -->
<div id="ca_line">
  <div id="category"></div>
  <?php if($this->Config('mb','admin')) {?>
  <a class="btn_admin" href="<?php echo $config->bo_admin_path?>"><img src="<?php echo $this->path_img('btn_admin.gif')?>" alt="admin"/></a>
  <?php }?>
  <div id="total"><img src="<?php echo $this->path_img('total.gif')?>" alt="total"/> Total <?php echo number_format($this->Sql('list_cnt'))?></div>
</div>

<div id="gallery_list">
  <!-- 목록시작:공지 -->
  <?php if(is_array($list_notice) && sizeof($list_notice)!=0) {?>
  <ul class="notice">
    <?php foreach($list_notice as $v) {?>
    <li><a href="<?php echo $v['href']?>"><?php echo $v['subject']?></a></li>
    <?php }?>
  </ul>
  <?php }?>
  <!-- 목록시작:게시물 -->
  <ul class="list">
    <?php foreach($list as $v) { ?>
      <li class="<?php echo $v['class']?>">
        <div class="thumb">
          <?php if($v['subject']['href']){?><a href="<?php echo $v['subject']['href']?>"><?php }?>
          <img src="<?php echo $v['thumb']?>"/>
          <?php if($v['subject']['href']){?></a><?php }?>
        </div>
        <div class="subject">
          <?php echo $v['check']?$v['check']:''?>
          <?php echo $v['category']?'<span class="category">'.$v['category'].'</span>':''; //분류출력?>
          <?php if($v['subject']['href']){?><a href="<?php echo $v['subject']['href']?>"><?php }?>
          <?php echo $v['subject']['text']?>
          <?php if($v['subject']['href']){?></a><?php }?>
        </div>
        <div class="datetime">
          <?php echo $v['datetime']?>
        </div>
      </li>
    <?php }?>
    <li class="last_line"></li>
  </ul>
</div>

<!-- 페이징 -->
<?php echo Paging::Inst(
	)->rows($rows*$cols
	)->tot($this->Sql('list_cnt')
	)->html(
)?>

<!-- 검색 및 버튼 -->
<div id="search_line">
  <div class="buttons"><?php include $this->path_view('buttons.php')?></div>
  <?php echo Search::Inst()->Html()?>
</div>


