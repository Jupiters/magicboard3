<?php if(!defined("__MAGIC__")) exit; 

/*
 * 위젯삽입
 */
// 스킨 변경 시 업데이트
$_POST['wg_skin'] = GV::String('wgSkin');

// 게시글 입력
$tbn = Write::Inst()->TBN();
$clear = array();
$clear['mb_no'] = Member::Inst()->mb_no;
$clear['bo_no'] = 0;
$clear['wr_datetime'] = 'NOW()';
$clear['wr_update'] = 'NOW()';
$clear['wr_ip'] = "INET_ATON('".Util::GetRealIPAddr()."')";
$clear['wr_content'] = '';
$clear['wr_subject'] = '페이지(일반형)';

$key = DB::Get()->InsertEx($tbn, $clear, array('wr_ip','wr_datetime','wr_update'));

// 게시글번호 저장
$_POST['wr_no'] = $key;

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



