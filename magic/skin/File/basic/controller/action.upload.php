<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 파일을 업로드 하는 스크립트이다.
 * $att[1] 첫번째 파라메터는 업로드할 게시글 번호다.
 */

if(!$att[1]) $att[1]=0;

/*
if (empty($_POST)){
	$upload_max_filesize = ini_get('upload_max_filesize');
	Dialog::Alert("
		파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\n\n
		post_max_size=".ini_get('post_max_size')." , 
		upload_max_filesize=$upload_max_filesize\n\n
		게시판관리자 또는 서버관리자에게 문의 바랍니다.");
}
//*/

$fName_file = $this->Config('form_name','file');

$uploaded_files=array();
$number_of_files = sizeof($_FILES[$fName_file]['tmp_name']);
for ($i=0; $i<$number_of_files; $i++) {
	if(!$_FILES[$fName_file]['name'][$i]) continue;
	
	$file_name = $_FILES[$fName_file]['name'][$i];
	$type = $_FILES[$fName_file]['type'][$i];
	$tmp_name = $_FILES[$fName_file]['tmp_name'][$i];
	$size = $_FILES[$fName_file]['size'][$i];
	$wr_no = $att[1];
	
	if (is_uploaded_file($tmp_name)) {
		$real_file_name = $this->Action('realfilename', $file_name);//$this->GenRealFileName($file_name);
		$upload_path = $this->Config('upload_path');
		$dest_file = Path::Group($upload_path.$real_file_name);

		if(move_uploaded_file($tmp_name, $dest_file)) {
			chmod($dest_file, 0606);
			// insert record
			$insertData['mb_no'] = Member::Inst()->mb_no;
			$insertData['wr_no'] = $wr_no;
			$insertData['file_name'] = $file_name;
			$insertData['file_path'] = $upload_path.$real_file_name;
			$insertData['file_size'] = $size;
			$insertData['file_type'] = $type;
			$insertData['file_datetime'] = Util::GetDatetime();
			$uploaded_files[] = DB::Get()->InsertEx($this->TBN(), $insertData);
		}
	}
}

$result = $uploaded_files;
