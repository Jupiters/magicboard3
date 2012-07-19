<?php if(!defined("__MAGIC__")) exit; 

$wg_no = $this->wg_no; // 위젯번호
/*
 * 위젯번호가 있을 때
 * 위젯 정보 얻어오기
 */
if($wg_no) {

  // 위젯정보
	$view = $this->Sql('fetch', $wg_no);
	if($view['wg_skin']) {
		$this->widget = Widget::Inst($view['wg_skin'], $wg_no)->html();
		$this->widget_width = $view['wg_width'].$view['wg_width_unit'];
	}

	// 디자인 모드일때 상단의 버튼 출력
  $this->wg_buttons = array();
	if($this->Config('mb', 'admin') && $this->Config('is_design')) {
    // 해당위젯에서 정의한 버튼
    $this->wg_buttons = Widget::Inst($view['wg_skin'], $view['wg_no'])->Config('button');
    if(!is_array($this->wg_buttons)) {
      $this->wg_buttons = array();
    }
    $config_path = Path::MB('skin/Widget/'.$view['wg_skin'].'/config.php');
    if(is_file($config_path)) {
      include $config_path;
    }

    // 기본버튼1
    $this->wg_buttons[] = array(
      'class'=>'ui-icon-wrench popup tp',
      'href'=>$this->Link('edit', $wg_no),
      'width'=>'100',
      'height'=>'100',
      'title'=>$skin['name'],
      'name'=>'위젯수정'
    );
    // 기본버튼2
    $this->wg_buttons[] = array(
      'class'=>'ui-icon-trash wg_delete no-text',
      'href'=>$this->Link('delete', $wg_no, Url::This()),
      'name'=>'위젯삭제'
    );
	}
}


