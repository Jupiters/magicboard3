<?php if(!defined('__MAGIC__')) exit;

$breadcrumb = PageElement::Inst('breadcrumb')->html();

$key = GV::Number($this->KN());
$board = Board::Inst($this->bo_id);
$v = $this->Sql('fetch', $key);
$comments = Comment::Inst('dppia_blog'
  )->wr_no($key
  )->bo_no($board->bo_no
  )->html(
);

$category = explode('|',$v['wr_category']);
$link_category = Url::Get(array('ca1'=>$category[0], 'ca2'=>$category[1]));

// 파일 정보를 가져옴
$file = File::Inst()->wr_no($key)->Protection();
$list = $this->Sql('list',1);

if(!function_exists('strcut_utf8')) {
  function strcut_utf8($str, $len, $checkmb=false, $tail='') {
    /**
    * UTF-8 Format
    * 0xxxxxxx = ASCII, 110xxxxx 10xxxxxx or 1110xxxx 10xxxxxx 10xxxxxx
    * latin, greek, cyrillic, coptic, armenian, hebrew, arab characters consist of 2bytes
    * BMP(Basic Mulitilingual Plane) including Hangul, Japanese consist of 3bytes
    **/
    preg_match_all('/[\xE0-\xFF][\x80-\xFF]{2}|./', $str, $match); // target for BMP

    $m = $match[0];
    $slen = strlen($str); // length of source string
    $tlen = strlen($tail); // length of tail string
    $mlen = count($m); // length of matched characters

    if ($slen <= $len) return $str;
    if (!$checkmb && $mlen <= $len) return $str;

    $ret = array();
    $count = 0;
    for ($i=0; $i < $len; $i++) {
      $count += ($checkmb && strlen($m[$i]) > 1)?2:1;
      if ($count + $tlen > $len) break;
      $ret[] = $m[$i];
    }
    return join('', $ret).$tail;
  }
}

// 이전글 다음글
$view_prev='';
$view_next='';
$prev='';
foreach($list as $w) {
  if($key==$w['wr_no']) {
    if($prev) $view_prev=$prev;
    else $view_prev=false;
  } else if($view_prev!=='') {
    $view_next=$w;
    break;
  }
  $prev=$w;
}
if(!$view_prev) $view_prev['wr_content'] = '게시글이 없습니다.';
if(!$view_next) $view_next['wr_content'] = '게시글이 없습니다.';

?>

<!--Start Container 5-->
<div id="container_5">
<!--Start Blog Container-->
<div id="blogs_container">
<!--Start Blog Container Top-->
<div id="blogs_container_top">
<!--Start Blog Container Bottom-->
<div id="blogs_container_bottom">

<div style="float:right;margin-right:20px"><?php include $this->path_view('buttons.php');?></div>

<!--Start Breadcrumb-->
<?php echo $breadcrumb?>
<!--End Breadcrumb-->

<!--Start Blog Content-->
<div id="blog_content">
<span class="blog_date"><?php echo date("n", strtotime($v['wr_datetime']))?>월<br /><?php echo date("j", strtotime($v['wr_update']))?>일</span>

<script>
$(function(){
  $(".list_top h3 a").click(function(){
    $(this).parents("div.list_top").children("ul.list_style_2").toggle('slow');
    return false;
  });
});
</script>

<style>
div.list_top ul li a span.cnt {font-family:Tahoma;font-weight:normal;font-size:.8em;color:#EE5A00}
div.list_top ul li.active {font-weight:bold}
</style>


<!--Start Blog Div-->
<div class="blog_div">

<div class="list_top" style="margin-bottom:10px">
  <h3><a href="#list_style_2">목록 보기&raquo;</a></h3>
  <ul class="list_style_2" style="display:none">
<?php foreach ($list as $vv) {// 심플리스트
	$category2 = explode('|',$vv['wr_category']);
?>
    <li><a href="<?php echo $vv['wr_subject']['href']?>"><?php echo implode('&gt;',$category2)?> : <?php echo $vv['wr_subject']['text']?>&nbsp;<span class="cnt">(<?php echo $vv['cmt_count']?>)</span></a></li>
<?php }?>
  </ul>
</div>

<div class="blog_heading">
  <h2><?php echo $v['wr_subject']?></h2>
  <!-- 링크 -->
  <?php if($v['wr_link']) {?><p>
  <img src="<?php echo $this->path_img('write_icon_link.gif')?>" width="13" height="7" alt="링크"/>&nbsp;
  <a href="<?php echo $v['wr_link']?>" class="popup" title="새창으로 열림"><?php echo $v['wr_link']?></a>
  </p><?php }?>
  <!-- 업로드된 파일목록 -->
  <?php if($file->Action('count')!=0) {?>
  <p><?php foreach ($file->Action('files') as $vv) {?>
    <span style="white-space:nowrap;line-height:1.6">
    <img src="<?php echo $this->path_img('write_icon_file.gif')?>" alt="download"/>
    <a href="<?php echo $file->Link('download',$vv['file_no'])?>" class="popup" title="<?php echo number_format($vv['file_size'])?> bytes (<?php echo $vv['file_download']?>)"><?php echo $vv['file_name']?></a>
    </span>
  <?php }?></p>
  <?php }?>
  <p class="right">Read <?php echo number_format($v['wr_hit'])?>, Posted in <a href="<?php echo $link_category?>" class="category_name"><?php echo implode('-',$category)?></a> by <b><?php echo $v['wr_writer']?></b></p>
</div><!--End Blog Heading-->
<br clear="all" />

<div class="blog_title_border" style="margin-bottom:20px">
  <?php if(sizeof($file->Action('images', $this->Config('img_width'), false))!=0) { // 첨부이미지 출력 ?>
  <div class="txt_c" style="margin-bottom:20px"><?php foreach ($file->Action('images', $this->Config('img_width'), false) as $vv) {?>
  <div style="margin-bottom:5px"><img src="<?php echo $vv['link']?>" width="<?php echo $vv['width']?>" height="<?php echo $vv['height']?>"/></div>
  <?php }?></div>
  <?php }?>
  <div style="text-align:right; font-size:11px;margin-bottom:10px"><?php echo 'http://'.$_SERVER['HTTP_HOST'].urldecode(Url::Get());?> <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].Url::Get()?>" class="copy">주소복사</a></div>
  <div style="min-height:300px;padding-bottom:20px"><?php echo $v['wr_content']?></div>
<?php if($this->tags){?>
  <div class="tags"><strong>태그(Tags)</strong> :
<?php foreach($this->tags as $vv) { ?>
    <a href="<?php echo Url::Get(array('tag'=>$vv),array('ca1','ca2','wr_no','pg'))?>"><?php echo $vv?></a>&nbsp;
<?php }?>
  </div>
<?php }?>
  <div><?php echo $comments?></div>
  <div style="text-align:right"><?php include $this->path_view('buttons.php')?></div>
</div><!--End Blog Title Border-->          

<div class="list_top" style="margin-bottom:10px">
  <h3>카테고리 다른글&raquo;</h3>
  <ul class="list_style_2">
<?php foreach ($this->sql('view_list_category', $category[0], $category[1]) as $vv) {// 심플리스트
	$category2 = explode('|',$vv['wr_category']);
?>
    <li class="<?php echo $vv['active']?'active':''?>"><a href="<?php echo $vv['wr_subject']['href']?>"><?php echo implode('&gt;',$category2)?> : <?php echo $vv['wr_subject']['text']?>&nbsp;<span class="cnt">(<?php echo $vv['cmt_count']?>)</span></a></li>
<?php }?>
  </ul>
</div>

<style>
table#inner_table td { padding:5px 8px; overflow:hidden; word-break:break-all; }
table.view_list th { color:#fff; background-color:#798d07 }
table#inner_table th a { color:#fff }
table#inner_table td a { color:#333 }
</style>

<div class="list_top" style="margin-bottom:10px">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_border"><tr><td>
<table width="100%" border="0" cellspacing="1" cellpadding="0" id="inner_table">
  <colgroup>
    <col width="50%" />
    <col width="50%" />
  </colgroup>
  <thead>
    <tr>
      <th><a href="<?php echo $view_prev['wr_subject']['href']?>">&laquo;이전글</a></th>
      <th><a href="<?php echo $view_next['wr_subject']['href']?>">다음글&raquo;</a></th>
    </tr>
  </thead>
  <tbody>
    <tr class="std_1">
      <td class="center"><a href="<?php echo $view_prev['wr_subject']['href']?>"><strong><?php echo $view_prev['wr_subject']['text']?></strong>&nbsp;<?php echo strcut_utf8(strip_tags($view_prev['wr_content']),120)?></a></td>
      <td class="center"><a href="<?php echo $view_next['wr_subject']['href']?>"><strong><?php echo $view_next['wr_subject']['text']?></strong>&nbsp;<?php echo strcut_utf8(strip_tags($view_next['wr_content']),120)?></a></td>
    </tr>
  </tbody>
</table>
</td></tr></table>
</div>

</div><!--End Blog Div-->
</div><!--End Blog Content-->

<?php include $this->path_view('side.php')?>

</div><!--End Blogs Container Bottom-->
</div><!--End Blogs Container Top-->
</div><!--End Blogs Container-->
</div><!--End Blogs Container 5-->

