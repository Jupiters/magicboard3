<?php if(!defined("__MAGIC__")) exit; 

/*
 * 목록보기 데이터 정의
 * ---------------------
 * 목록에서 추가/수정/삭제 모두 다 한다.
 *
 *
 *
 *
 */

$key = GV::Number($this->KN()); // 키 값
$mode = GV::GetParam($this->Mode('name'), 'GET'); // 모드 값
$this->href_list = $this->Link('list');

/*
 * 단락추가 모드
 * 에디터와 업데이트 주소를 설정함
 */
if($mode=='write') {
  $this->mode_write = true;
  $this->editor = Editor::Inst('wr_content',$this->Config('editor', 'name')
    )->db_edit(''
    )->width($this->Config('editor', 'width')
    )->height($this->Config('editor', 'height')
    )->html(
  );
  $this->action = $this->Link('insert');
}

/*
 * key가 있으면 수정모드
 */
if($key) {
  $this->editor = Editor::Inst('wr_content',$this->Config('editor', 'name')
    )->db_edit(''
    )->width($this->Config('editor', 'width')
    )->height($this->Config('editor', 'height')
    )->html(
  );
  $this->action = $this->Link('update');
}

// 관리자 로그인시 단락추가 버튼 링크 생성
if(!$key && $mode!='write' && $this->Config('mb','admin') && Widget::Inst()->Config('is_page')) {
  $this->href_write = $this->Link('write');
}

/*
 * 게시글 목록 생성
 *
 */
$this->list = $this->Sql('list');

foreach ($this->list as $k => $v) {
  if($key==$v['wr_no']) {
    $height = $this->Config('editor', 'height');
    if($_GET['height']) $height = $_GET['height'].'px';
    $this->editor = Editor::Inst('wr_content',$this->Config('editor', 'name')
      )->db_edit($v['wr_content']
      )->width($this->Config('editor', 'width')
      )->height($height
      )->html(
    );
    $data = $v;
    ob_start();
    include($this->path_view('write.php'));
    $v['content'] = ob_get_contents();
    ob_end_clean();
  } else {
    $v['content'] = Widget::Inst()->Parse(
      $this->TBN(),
      'wr_no',
      $v['wr_no'],
      'wr_content',
      Editor::Inst('', $this->Config('editor', 'name'))->db_out($v['wr_content'])
    );
    if($v['wr_subject']) {
      $v['content'] = "<{$v['wr_category']}>{$v['wr_subject']}</{$v['wr_category']}>".$v['content'];
    }

    if(!$key && $mode!='write' && $this->Config('mb','admin') && Widget::Inst()->Config('is_page')) {
      $v['content'].= '<input class="order" type="hidden" name="order[]" value="'.$v['wr_no'].'"/>';
      $v['href_modify'] = $this->Link('modify', $v['wr_no']);
      $v['href_delete'] = $this->Link('delete', $v['wr_no']);
    }
  }
  $this->list[$k] = $v;
}

