<?php if(!defined("__MAGIC__")) exit; 

// 걸러진 결과값
$clear = $this->Clear();
if(!$clear['m_id']) Dialog::alert("메뉴명을 입력하세요.");

// 부모 아이디를 찾는다
// POST로 root, main 이렇게 넘어옴
if($_POST['main']) {
	$clear['m_parent'] = $_POST['main'];
} else if($_POST['root']) {
	$clear['m_parent'] = $_POST['root'];
} else {
	$clear['m_parent'] = 0;
}

$data = $this->Sql('fetch', GV::Number($this->KN()));
$existing = explode(',', $data['m_contents']);
$layout_contents = Layout::Inst($clear['m_layout'])->FindContents();

$contents=array();
foreach ($layout_contents as $k=>$v) {
	if($existing[$k]) {
		$contents[] = $existing[$k];
	} else {
		$contents[] = '[[Widget]]';
	}
}

$clear['m_contents'] = implode(',', $contents);
if(!$clear['m_hidden']) $clear['m_hidden']=0;


// 아이디가 변경 되었을 경우
// 페이지 게시판의 게시물 last_id를 모두 변경해주어야 한다
// 관리자페이지 아이디가 변경되었을 경우에는 홈으로 이동해 주어야함
if($clear['m_id']!=$data['m_id']) {
  $root = $main = '';
  if($_POST['root']) {
    $_root = $this->Sql('fetch', $_POST['root']);
  }
  if($_POST['main']) {
    $_main = $this->Sql('fetch', $_POST['main']);
  }
  if($_root) $root = $_root['m_id'];
  if($_main) $main = $_main['m_id'];


  $redirection_stx='';
  if($main) {
    $redirection_stx='./?r='.$root.'&amp;id1='.$main.'&amp;id2='.$data['m_id'];
  } else if($root) {
    $redirection_stx='./?r='.$root.'&amp;id1='.$data['m_id'].'&amp;';
  } else {
    $redirection_stx='./?r='.$data['m_id'].'&amp;';
  }

  $redirection='';
  if($main) {
    $redirection='./?r='.$root.'&amp;id1='.$main.'&amp;id2='.$clear['m_id'];
  } else if($root) {
    $redirection='./?r='.$root.'&amp;id1='.$clear['m_id'].'&amp;';
  } else {
    $redirection='./?r='.$clear['m_id'].'&amp;';
  }

  $tbn = $this->TBN();
  $sql = " SELECT m_no, m_redirection FROM {$tbn} WHERE m_redirection LIKE '{$redirection_stx}%' ";
  $magic_list = DB::Get()->sql_query_list($sql);
  foreach($magic_list as $v) {
    DB::Get()->update($tbn, array('m_redirection'=>str_replace($redirection_stx,$redirection,$v['m_redirection'])), " WHERE m_no='{$v['m_no']}' ");
  }

  $stx='';
  if($main) {
    $stx='r='.$root.',id1='.$main.',id2='.$data['m_id'];
  } else if($root) {
    $stx='r='.$root.',id1='.$data['m_id'];
  } else {
    $stx='r='.$data['m_id'];
  }

  $last_id='';
  if($main) {
    $last_id='r='.$root.',id1='.$main.',id2='.$clear['m_id'];
  } else if($root) {
    $last_id='r='.$root.',id1='.$clear['m_id'];
  } else {
    $last_id='r='.$clear['m_id'];
  }

  $tbn_write = Write::Inst()->TBN();
  $sql = " SELECT wr_no, last_id FROM $tbn_write WHERE bo_no=0 AND last_id LIKE '{$stx}%' ";
  $write_list = DB::Get()->sql_query_list($sql);
  foreach($write_list as $v) {
    DB::Get()->update($tbn_write, array('last_id'=>str_replace($stx,$last_id,$v['last_id'])), " WHERE wr_no='{$v['wr_no']}' ");
  }


//*
  // 관리자페이지 아이디 변경 체크
  if(Config::Inst()->path_admin==$data['m_id']) {
    $change_admin_page = true;
    DB::Get()->update(Config::Inst()->TBN(), array('cf_value'=>$clear['m_id']), " WHERE cf_id='path_admin' ");
  }
//*/

}

// 회원정보 업데이트
$this->Sql('update', GV::Number($this->KN()), $clear);

if($change_admin_page) {
  Dialog::AlertNReplace("관리자 페이지 주소가 변경되었습니다.\n메인화면으로 이동합니다.",Path::Root());
} else {
  Url::GoReplace($this->Link('list'));
}

exit;
		
