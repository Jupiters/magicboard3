<?php if(!defined("__MAGIC__")) exit; 

/*
 * 위젯삽입
 */
// 스킨 변경 시 업데이트
$_POST['wg_skin'] = GV::String('wgSkin');

$r = GV::String('r');
$id1 = GV::String('id1');
$id2 = GV::String('id2');
$clear['bo_subject'] = '페이지';
$clear['bo_kind'] = 'page';
$clear['bo_admin_path'] = Url::Get(array('r'=>$r,'id1'=>$id1,'id2'=>$id2,'bo_no'=>$clear['bo_no'], $this->Mode('name')=>'write'));

// 게시판 추가하여 저장
$key = Board::Inst()->Action('insert_record', $clear);

// 게시판 번호
$_POST['bo_no'] = $key;

// POST 데이터 변환
$data = Widget::Inst()->Action('data_implode', $_POST);

// insert
$key = DB::Get()->InsertEx($this->TBN(), $data);
if(!$key) Dialog::Alert('정확한 정보를 입력하세요.');

/*
 * 삽입된 위젯정보를 원본 게시글에 업데이트 함
 */
Widget::Inst()->Action('add_widget', $key);
?>
<script>
window.opener.location.reload();
window.close();
</script>
<?php exit;



