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
 * $this->title      // 타이틀
 */

// 경로줄이기
$v = $this->data; // 게시글 데이터
$cfg = $this->config;
$f = $this->file;
?>

<form id="write_form" method="post" action="<?php echo $this->action?>" enctype="multipart/form-data">
<input id="wr_no" type="hidden" name="wr_no" value="<?php echo $v['wr_no']?>"/>
<input type="hidden" name="mb_no" value="<?php echo $v['mb_no']?>"/>


<div class="title">
  <div class="title_bg_left">
  <div class="title_bg_right">
    <h2>
      <?php echo $this->title?>
      <span class="separator">|</span>
    </h2>
  </div>
  </div>
</div>

<table class="table_form">
<colgroup>
	<col width="120px">
	<col>
</colgroup>

<tbody>
  <tr>
    <th>제목</th>
    <td><input type="text" class="require" name="wr_subject" size="60" value="<?php echo $v['wr_subject']?>" alt="제목"/></td>
  </tr>

<?php if(!$this->Config('mb','login')){?>
  <!-- 비회원 : 작성자, 비밀번호 -->
  <tr>
    <th>작성자</th>
    <td>
    <input type="text" class="require" name="wr_writer" size="10" value="<?php echo $v['wr_writer']?>" alt="작성자"/>
    &nbsp;&nbsp;<span>패스워드</span>&nbsp;<input type="password" class="require" name="wr_password" size="8" value="<?php echo $_POST['password']?>" alt="비밀번호"/>
    &nbsp;&nbsp;<span>패스워드확인</span>&nbsp;<input type="password" class="require" name="wr_password_check" size="8" value="<?php echo $_POST['password']?>" alt="비밀번호확인"/>
    </td>
  </tr>

  <!-- 보안코드 -->
  <tr>
    <th>보안코드</th>
    <td><?php echo Captcha::Inst()->html()?></td>
  </tr>
<?php }?>

<?php if(($this->Config('mb','admin') && $this->Config('show_notice')) || $cfg->bo_use_secret){?>
  <!-- 옵션 : 공지사항, 비밀글 -->
  <tr>
    <th>옵션</th>
    <td>
<?php if($this->Config('mb','admin') && $this->Config('show_notice')){?>
    <input id="notice" type="checkbox" name="opt_notice" value="1" <?php echo $v['wr_is_notice']?'checked="checked"':''?>/>
    <label for="notice">공지사항</label>
<?php }?>
<?php if($cfg->bo_use_secret){?>
    <input id="secret" type="checkbox" name="opt_secret" value="1" <?php echo $v['wr_is_secret']?'checked="checked"':''?>/>
    <label for="secret">비밀글</label>
<?php }?>
    </td>
  </tr>
<?php }?>

<?php if($cfg->bo_use_category){?>
  <tr>
    <th>분류</th>
    <td id="category"></td>
  </tr>
<?php }?>

<?php if($cfg->bo_use_link){?>
  <tr>
    <th>링크</th>
    <td><input type="text" name="wr_link" size="60" value="<?php echo $v['wr_link']?>"/></td>
  </tr>
<?php }?>

  <!-- 에디터 -->
  <tr><td colspan="2" class="editor"><?php echo $this->editor?></td></tr>

  <tr>
    <th>태그</th>
    <td><input type="text" name="tags" size="80" value="<?php echo $this->tags?>" title="태그명은 ,(콤마)로 분류"/></td>
  </tr>
<?php if($cfg->bo_use_file) {?>
<?php if($key) {?>
  <tr>
    <th>업로드된 파일</th>
    <td style="line-height:1.6">
      <p>체크를 하고 수정하면 파일이 삭제됩니다.</p>
<?php foreach ($f->Action('files') as $f) {?>
      <div>
        <img src="<?php echo $this->path_img('write_icon_file.gif')?>" alt="download"/>
        <input type="checkbox" name="<?php echo $f->Config('form_name', 'del')?>[]" value="<?php echo $f['file_no']?>" title="삭제 시 체크"/>
        <a href="<?php echo $f->Link('download', $f['file_no'])?>"><?php echo $f['file_name']?></a>
      </div>
<?php }?>
    </td>
  </tr>
<?php }?>
  <tr>
    <th>파일 업로드</th>
    <td><?php echo $f->UploadForm()?></td>
  </tr>
<?php }?>
</tbody>
</table>

<!-- 하단 버튼 -->
<div class="center" style="margin-top:20px">
  <input type="image" class="adjust_button_line" src="<?php echo $this->path_img('btn_ok.gif')?>" value="확인"/>
  <a href="<?php echo $this->Link('list')?>"><img src="<?php echo $this->path_img('btn_list.gif')?>" alt="목록"/></a>
</div>

</form><!-- 게시글/작성 수정 -->

<script type="text/javascript">

var ca = eval('(<?php echo json_encode(explode('|','|'.$v['wr_category']))?>)'); // 기존 데이터

$(function(){

  // 분류 셀렉트 박스 자동 생성
  // 재귀함수를 통해서 트리형 분류를 선택할 수 있도록 함
  function create_select(list, parent, show, depth) {
    var require = '';
    if(depth==0) require='require';
    // 셀렉트박스
    var select = $("<select name='ca"+depth+"' class='"+require+" ca"+depth+"' alt=\"분류\"></select>").change(function(){
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
  $("td#category").each(function(){
    create_select(eval('(<?php echo $cfg->bo_category?>)'), null, true, 1);
  });

});

</script>

