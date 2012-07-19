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


// 레이아웃에 contents개수 찾기
// contents 개수만큼 [[Widget]] 텍스트를 넣어줌
$contents=array();
foreach (Layout::Inst($clear['m_layout'])->FindContents() as $v) {
	$contents[] = '[[Widget]]';
}
$clear['m_contents'] = implode(',', $contents);

$this->Sql('insert', $clear);
Url::Go($this->Link('list'));

exit;
