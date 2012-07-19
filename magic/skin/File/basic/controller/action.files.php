<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 */

if($this->list) {
	$result = $this->list;
} else {
	if($this->wr_no && !$this->mb_no) {
		$this->list = $this->Sql('list_by_write', $this->wr_no);

		// 파일 내용중에 이미지를 검사하여 출력해준다.
		$data = Write::Inst()->Sql('fetch',$this->wr_no);
		preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $data['wr_content'], $imgtags);
		if($imgtags[1][0]) {
      $subfolder = explode('/',$_SERVER['PHP_SELF']);
			$host = 'http://'.$_SERVER['HTTP_HOST'].'/'.$subfolder[1];
			$file_path = str_replace(array_shift(explode('?',$host)), '', $imgtags[1][0]);
			if(strpos('http', $file_path)===false) {
				$this->list_content_img = array('file_path'=>$file_path);
			}
		}

	} else {
		$this->list = $this->Sql('list_by_member', $this->mb_no);
	}
	$result = $this->list;
}


