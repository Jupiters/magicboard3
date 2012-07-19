<?php
/*!
 *	\class		File
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\author		Computer Science in Inje Univ.
 *	\version	1.0	
 *	\brief		파일 컨트롤 클래스.
 *	\date		2010.01.19 - 생성
 *	\date		2011.04.03 - MVC 패턴으로 설계 완료
 *	\date		2011.11.18 - 모듈 구조로 변경, Board/Write클래스와 무관 하도록 분리시킴
 */
class File extends Module
{	
	protected static $inst;			///< 모듈 인스턴스 
	protected $file_no;				///< 파일번호
	protected $files;				///< 파일 정보등 파일번호로 구분되어져 있다.
	protected $list=array();		///< 파일 리스트
	protected $wr_no;				///< 게시글번호
	const hotlink = 'pht';
	
	public static function Inst($skin='basic', $wr_no=0, $mb_no=0) {
		$skin_name = $skin.$wr_no.$mb_no;
		if(!isset(self::$inst[$skin_name])) {
			$class_name = __CLASS__;
			self::$inst[$skin_name] = new $class_name($skin, $wr_no, $mb_no);
		}
		return self::$inst[$skin_name];
	}
	
	protected function __construct($skin, $wr_no, $mb_no=0) {
		$this->wr_no = $wr_no;
		$this->mb_no = $mb_no;
		parent::__construct(__CLASS__, $skin);
		$this->Init();
	}
	
	public function SetSkin($skin_name='') {
		return self::Inst($skin_name, $this->wr_no, $this->mb_no);
	}
	
	/*
	public function file_no($file_no) {
		$this->file_no = $file_no;
		$this->Sql('fetch', $file_no);
		return $this;
	}
	//*/
	
	public function wr_no($v='') {
		return self::Inst($this->skin, $v, 0);
	}
	
	public function mb_no($v='') {
		return self::Inst($this->skin, 0, $v);
	}
	
	public function MaxUpload($v) {
		$this->SetConfig('max_upload', '', $v);
		return $this;
	}
	
	/*
	 * 무단 링크를 방지하기 위해 페이지에서 한번 호출해줘야 한다. 
	 * 다이렉트 링크는 이 함수를 호출하지 못하기 때문에 검사하여서
	 * hotlink 이미지를 뿌려준다.
	 * config.php 파일의 변수를 이용하여 한페이지당 한번만 호출한다.
	 */
	public function Protection() {
		if(!$this->Config(self::hotlink)) {
			$this->SetConfig(self::hotlink, '', uniqid());
			$_SESSION[self::hotlink] = $this->Config(self::hotlink);
		}
		return $this;
	}
	
	public function UploadForm() {
		$old_state = $this->state;;
		$this->state = 'upload_form';
		$html = $this->html();
		$this->state = $old_state;
		return $html;
	}

	
}
