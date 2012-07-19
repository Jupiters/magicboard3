<?php if(!defined('__MAGIC__')) exit;
/*
 * 사용가능한 변수
 * 사용법 : <?php echo 변수?>
 * -----------------------------------
 * $this->config    // 게시판설정 (class)
 * $this->file      // 파일관련 모듈 (class)
      - $this->file->Action('files')            // 업로드된 파일들 (배열)
          ['file_no']         - 파일번호
          ['file_name']       - 파일명
          ['file_download']   - 파일 다운로드 횠수
          ['file_size']       - 파일 사이즈
          ['file_type']       - 파일 타입
      - $this->file->Config('form_name', 'del') // 삭제 폼 이름
      - $this->file->Link('download', 파일번호) // 파일명
      - $this->file->UploadForm() // 파일 업로드폼 (html 문자열)
 * $this->action    // 업데이트 주소 (문자열)
 * $this->link_list // 목록으로 가기 주소 (문자열)
 * $this->editor    // 에디터 모듈 (html 문자열)
 * $this->breadcrumb// 현재위치 출력 모듈 (html 문자열)
 * $this->key       // 키값 (숫자) : 수정시에만
 * $this->data      // 게시글 데이터 (배열): 수정시에만
      - $this->data['필드명'] // 배열값은 데이터베이스 필드명
 * $this->tags      // 현재 태그명 (문자열) : 수정시에만
 */

// 경로줄이기
$v = $this->data; // 게시글 데이터
$cfg = $this->config;
$f = $this->file;
?>

<div id="container_3">
<div id="container_3_top">
<div id="container_3_bottom">
<?php echo $this->breadcrumb?>

<div id="full_width_content">
<h1>새글 작성</h1>

<form class="ui-form write_form" method="post" action="<?php echo $this->action?>" enctype="multipart/form-data">
<input id="wr_no" type="hidden" name="wr_no" value="<?php echo $v['wr_no']?>"/>
<input type="hidden" name="mb_no" value="<?php echo $v['mb_no']?>"/>
<input type="hidden" name="bo_category" value=''/>

<table class="basic_table">
  <colgroup>
    <col width="100px">
    <col>
  </colgroup>

  <tbody>
  <tr>
    <th>제목</th>
    <td><input type="text" class="require" name="wr_subject" size="60" value="<?php echo $v['wr_subject']?>" title="제목은 필수 입력입니다."/></td>
  </tr>

  <tr>
    <th>공지사항</th>
    <td><input name="opt_notice" id="notice" type="checkbox" value="1" <?php echo $v['wr_is_notice']?'checked="checked"':''?>/>&nbsp;<label for="notice">공지사항으로 등록하려면 체크하세요</label></td>
  </tr>

  <tr>
    <th>분류</th>
    <td id="category"></td>
  </tr>

<?php if($cfg->bo_use_link){?>
  <tr>
    <th>링크</th>
    <td><input type="text" name="wr_link" size="110" value="<?php echo $v['wr_link']?>" title="http:// 를 포함한 주소를 적어주세요"/></td>
  </tr>
<?php }?>

  <tr><td colspan="2" class="no_padding"><?php echo $this->editor?></td></tr><!-- 에디터 -->

  <tr>
    <th>태그</th>
    <td><input type="text" name="tags" size="110" value="<?php echo $this->tags?>" title="태그명은 ,(콤마)로 분류"/></td>
  </tr>

<?php if($cfg->bo_use_file) { // 게시판 설정에서 파일사용이면?>
<?php if($this->key) { // 게시글 수정시?>
  <tr>
    <th>업로드된 파일</th>
    <td class="left" style="line-height:1.6">
<?php foreach ($f->Action('files') as $v) { // 업로드된 파일목록 출력?>
    <div>
    <img src="<?php echo $this->path_img('write_icon_file.gif')?>" alt="download"/>
    <input type="checkbox" name="<?php echo $f->Config('form_name', 'del')?>[]" value="<?php echo $v['file_no']?>" title="삭제 시 체크"/>
    <a href="<?php echo $f->Link('download', $v['file_no'])?>"><?php echo $v['file_name']?></a>
    </div>
<?php }?>
    </td>
  </tr>
<?php }?>
  <tr>
    <th>파일 업로드</th>
    <td class="left"><?php echo $f->UploadForm()?></td>
  </tr>
<?php }?>
  </tbody>
</table>

<!-- 하단 버튼 -->
<div class="center" style="margin-top:20px">
  <input class="button" type="submit" value="확인"/>
  <input class="button" type="button" onclick="Go('<?php echo $this->link_list?>'); return false;" value="목록"/>
</div><!-- 하단 버튼 -->

</form><!-- 게시글/작성 수정 -->

</div><!-- #full_width_content -->
<br clear="all" />

</div><!--End Blogs Container Top-->
</div><!--End Blogs Container-->
</div><!--End Container 5-->




<script type="text/javascript">

var ca = eval('(<?php echo json_encode(explode('|','|'.$v['wr_category']))?>)'); // 기존 데이터

$(function(){

  // 분류 셀렉트 박스 자동 생성
  // 재귀함수를 통해서 트리형 분류를 선택할 수 있도록 함
  function create_select(list, parent, show, depth) {
    // 셀렉트박스
    var select = $("<select name='ca"+depth+"' class='ca"+depth+"'></select>").change(function(){
      var _parent = $(this).val();
      $("select.ca"+(depth+1)).each(function(){
        if(_parent == $(this).attr("id")) {
          $(this).css("display","");
          $(this).removeAttr("disabled");
        } else {
          $(this).css("display","none");
          $(this).attr("disabled","disabled");
        }
      });
    })
    .append($("<option value=''>선택하세요</option>"));
    // 셀렉트 박스 초기 상태설정
    if(parent) { select.attr("id", parent.data); }
    if(show) {
      select.css("display", "");
    } else {
      select.css("display", "none");
      select.attr("disabled", "disabled");
    }
    // <option 목록 체워넣음 create li
    for(var i=0; i<list.length; i++) {
      if(list[i].children) {
        if(list[i].data == ca[depth]) {
          create_select(list[i].children, list[i], true, depth+1);
        } else {
          create_select(list[i].children, list[i], null, depth+1);
        }
      }
      var option = $("<option value='"+list[i].data+"'>"+list[i].data+"</option>");
      if(list[i].data == ca[depth]) {
        option.attr("selected", "selected");
      }
      select.append(option);
    }

    $("td#category").prepend(select);
  }

  // bo_category 값을 이용해서 분류를 선택 박스를 생성한다.
  // bo_category에는 json 값이 들어있음
  $("input[name='bo_category']").each(function(){
    $("td#category").each(function(){
      create_select(eval('(<?php echo $cfg->bo_category?>)'), null, true, 1);
    });
  });

});

</script>
