<?php if(!defined('__MAGIC__')) exit; 
$cols = $this->Config('columns');

/* thead 라인 생성 */
$list_thead = array();
if($this->Config('mb','admin')) {
  $list_thead['check'] = array(
    'class'=>'check',
    'content'=>'<input type="checkbox" name="check_toggle"/>'
  );
}
foreach($cols as $k=>$v) {
  $list_thead[$k] = array(
    'class'=>$k,
    'content'=>$this->Config('columns_name', $k)
  );
}
/* 첫번째 컬럼과 마지막 컬럼 찾기*/
$list_thead[$k]['class'] = $k.' last';
foreach($list_thead as $k=>$v) { $list_thead[$k]['class'] = $k.' first'; break; }


/* 목록 데이터 생성 */
$list = array();

// 공지
if($this->Config('show_notice')) {
  foreach($this->Sql('list_notice') as $v) {
    $list[] = array(
      'notice'=>array(
        'colspan'=>sizeof($list_thead),
        'class'=>'notice',
        'href'=>$this->Link('subject', $v['wr_no']),
        'content'=>$v['wr_subject']
      )
    );
  }
}

// 게시글목록
foreach ($this->Sql('list') as $v) {

  $_list = array();

  if($this->Config('mb','admin')) {
    $_list[] = array(
      'colspan'=>0,
      'class'=>'check',
      'content'=>'<input type="checkbox" name="chk[]" value="'.$v['wr_no'].'"/>'
    );
  }
  foreach($cols as $kk=>$vv) {
    if($kk=='wr_datetime') {
      $_list[] = array(
        'colspan'=>0,
        'class'=>$kk,
        'content'=>Util::GetDate($v[$kk])
      );
    } else if($kk=='wr_subject') {
      $_list[] = array(
        'colspan'=>0,
        'class'=>$kk,
        'category'=>$v['wr_category']?'['.array_pop(explode('|',$v['wr_category'])).']':'',
        'href'=>$v['wr_subject']['href'],
        'cmt'=>$v['wr_subject']['cmt'],
        'icons'=>$v['wr_subject']['imgs'],
        'content'=>$v['wr_subject']['text']
      );
    } else {
      $_list[] = array(
        'colspan'=>0,
        'class'=>$kk,
        'content'=>$v[$kk]
      );
    }
  }
  $list[] = $_list;
}


if(sizeof($list)==0) {
    $list[] = array(
      'no_content'=>array(
        'colspan'=>sizeof($list_thead),
        'class'=>'no_contents',
        'content'=>'게시글이 없습니다.'
      )
    );
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

<!-- 목록시작 -->
<div id="write_list_bg">
<table id="write_list">

  <thead>
    <tr>
    <?php foreach($list_thead as $k=>$v) {?>
      <th class="<?php echo $v['class']?>"><?php echo $v['content']?></th>
    <?php }?>
    </tr>
  </thead>

  <tbody>
  <?php foreach($list as $v) { ?>
    <tr>
    <?php foreach($v as $vv){?>
      <td <?php echo $vv['class']?'class="'.$vv['class'].'"':''?> <?php echo $vv['colspan']?'colspan="'.$vv['colspan'].'"':''?>>
        <?php echo $vv['category']?'<span class="category">'.$vv['category'].'</span>':''; //분류출력?>
        <?php if($vv['href']) {?>
        <a href="<?php echo $vv['href']?>"><?php echo $vv['content']?></a>
        <?php } else {?>
        <?php echo $vv['content']?>
        <?php }?>
        <?php echo $vv['cmt']?>
        <?php if(is_array($vv['icons'])) foreach($vv['icons'] as $img) {?>
        <img src="<?php echo $img['src']?>" alt="<?php echo $img['alt']?>"/>
        <?php }?>
      </td>
    <?php }?>
    </tr>
  <?php }?>
  </tbody>
</table><!-- #write_list -->
</div><!-- #write_list_bg -->

<!-- 페이징 -->
<?php echo Paging::Inst(
	)->rows($this->Config('rows')
	)->tot($this->Sql('list_cnt')
	)->html(
)?>

<!-- 검색 및 버튼 -->
<div id="search_line">
  <div class="buttons"><?php include $this->path_view('buttons.php')?></div>
  <?php echo Search::Inst()->Html()?>
</div>

<script>
// 긴문자열 자르기
// 짧은 문자열은 자르지 않는다
$(function(){
  var subject_length = 350;
  $("table#write_list tbody tr td.wr_subject a").each(function(){
    if($(this).width()>subject_length) {
      $(this).css("width", subject_length+"px");
      $(this).css("overflow", "hidden");
      $(this).css("text-overflow", "ellipsis");
    }
  });
});
</script>

