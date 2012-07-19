<?php if(!defined("__MAGIC__")) exit; 

$m = Member::Inst();
$top_btns=array();
if($m->Action('is_login')) {
  
  $top_btns[10] = array();
  $top_btns[10]['title'] = '회원페이지';
  $top_btns[10]['link'] = $m->Link('view');
  
  if($m->Action('is_admin')) {
    $top_btns[20]['title'] = '관리자';
    $top_btns[20]['link'] = Path::admin();

    $top_btns[21]['link'] = Widget::Inst()->Config('link_page');
    if(Widget::Inst()->Config('is_page')) {
      $top_btns[21]['title'] = '페이지수정[On]';
    } else {
      $top_btns[21]['title'] = '페이지수정[Off]';
    }

    $top_btns[22]['link'] = Widget::Inst()->Config('link_design');
    if(Widget::Inst()->Config('is_design')) {
      $top_btns[22]['title'] = '위젯수정[On]';
    } else {
      $top_btns[22]['title'] = '위젯수정[Off]';
    }
  }
  
  $top_btns[30] = array();
  $top_btns[30]['title'] = '로그아웃';
  $top_btns[30]['link'] = $m->Link('logout');
  
} else {
  $top_btns[10] = array();
  $top_btns[10]['title'] = '로그인';
  $top_btns[10]['link'] = $m->Link('login');
  
  $top_btns[20] = array();
  $top_btns[20]['title'] = '비밀번호 찾기';
  $top_btns[20]['link'] = $m->Link('find_pw');
  
  $top_btns[30] = array();
  $top_btns[30]['title'] = '회원가입';
  $top_btns[30]['link'] = $m->Link('regist');
}
ksort($top_btns);


$this->top_btns = $top_btns;




