<?php if(!defined('__MAGIC__')) exit;

/* 카테고리별 댓글 개수및 저장소의 댓글 개수 카운팅 */
$_category = json_decode(Board::Inst()->bo_no($this->bo_no)->bo_category,true);
$category_cnt = $this->Sql('category_cnt');

$ca1 = $_GET['ca1'];
$ca2 = $_GET['ca2'];

$category = array();
foreach($_category as $k=>$v) {
  $v['link'] = Url::Get(array('ca1'=>$v['data']),array('ca2', 'wr_no'));
  $v['cnt'] = 0;

  if($v['data']==$ca1) $v['active'] = true;
  if($v['children']) {
    for($i=0; $i<sizeof($v['children']); $i++) {
      $vv = $v['children'][$i];
      $vv['cnt'] = 0;
      $vv['link'] = Url::Get(array('ca1'=>$v['data'], 'ca2'=>$vv['data']),array('wr_no'));
      if($vv['data']==$ca2) $vv['active'] = true;
      $v['children'][$vv['data']] = $vv;
      unset($v['children'][$i]);
    }
  }
  $category[$v['data']] = $v;
}

$cnt_all=0;
foreach ($category_cnt as $v) {
  $cnt = $v['cnt'];
  $_ex = explode('|',$v['wr_category']);
  $parent = $_ex[0];
  $child = $_ex[1];

  if($child) {
    $category[$parent]['children'][$child]['cnt'] += $cnt;
    $category[$parent]['cnt'] += $cnt;
  } else {
    $category[$parent]['cnt'] += $cnt;
  }
  $cnt_all+=$cnt;
}

$archive=array();
foreach($this->Sql('list_all') as $v) {
  if(!isset($archive[$v['wr_datetime_text']])) $archive[$v['wr_datetime_text']]=0;
  $archive[$v['wr_datetime_text']]++;
}
krsort($archive);

// 공시사항
$notice = $this->Sql('list_notice');
// 최신댓글
$comment = Comment::Inst()->Sql('latest', $this->bo_no, 10);
// 최신글
$latest = Latest::Inst('blog_side', $this->bo_no)->html();
// 태그
$tags = Tag::Inst('basic', $this->bo_no)->SetConfig('hide_count','',1)->html();

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

?>

<div id="blog_right_panel">

  <h2>공지사항</h2>
  <div class="blog_right_links">
    <ul>
<?php foreach($notice as $v) {?>
      <li><a href="<?php echo Url::Get(array('wr_no'=>$v['wr_no']))?>"><?php echo $v['wr_subject']?></a>
<?php }?>
    </ul>
  </div><!-- .blog_right_links -->

  <h2>분류</h2>
  <div class="blog_right_links">
    <ul>
      <li><a href="<?php echo Url::Get('', array('ca1','ca2','wr_no'))?>" <?php echo ($ca1||$ca2)?'':'class="category_active"'?>>전체보기 (View All Post) <span class="cnt">(<?php echo $cnt_all?>)</span></a>
<?php foreach($category as $v) {?>
      <li><a href="<?php echo $v['link']?>" <?php echo $v['active']?'class="category_active"':''?>><?php echo $v['data']?> <span class="cnt">(<?php echo $v['cnt']?>)</span></a>
<?php if($v['children']) {?>
        <ul>
<?php foreach($v['children'] as $vv) {?>
          <li><a href="<?php echo $vv['link']?>" <?php echo $vv['active']?'class="subcategory_active"':''?>><?php echo $vv['data']?> <span class="cnt">(<?php echo $vv['cnt']?>)</span></a></li>
<?php }?>
        </ul>
<?php }?>
      </li>
<?php }?>
    </ul>
  </div><!-- .blog_right_links -->

  <h2>최근 댓글</h2>
  <div class="blog_right_links">
    <ul>
<?php foreach($comment as $v) {?>
      <li><a href="<?php echo Url::Get(array('wr_no'=>$v['wr_no']))?>"><?php echo strcut_utf8(strip_tags($v['cmt_content']), 50)?></a>
<?php }?>
    </ul>
  </div><!-- .blog_right_links -->

  <h2>최신글</h2>
  <div class="blog_right_links">
<?php echo $latest?>
  </div><!-- .blog_right_links -->

  <h2>태그구름</h2>
  <div class="blog_right_links"><?php echo $tags?></div><!-- .blog_right_links -->

  <h2>게시글 저장소</h2>
  <div class="blog_right_links">
    <ul>
<?php foreach($archive as $k=>$v) {?>
      <li><a href="<?php echo Url::Get(array('archive'=>$k))?>"><?php echo $k?> <span class="cnt">(<?php echo $v?>)</span></a></li>
<?php }?>
    </ul>
  </div><!-- .blog_right_links -->

</div><!-- #blog_right_panel -->
<br clear="all" />
