<?php
class Config extends Module
{
	protected $config;
	protected $update=array();	// 업데이트할 레코드 키값들
	
	protected static $inst=array();
	public static function Inst($skin='basic') {
		if(!isset(self::$inst[$skin])) {
			$class_name = __CLASS__;
			self::$inst[$skin] = new $class_name($skin);
		}
		return self::$inst[$skin];
	}

	protected function __construct($skin) {
		parent::__construct(__CLASS__, $skin);
	}

	public function update($v) {
		$this->update = $v;
		return $this;
	}

	public function show_title($v) {
		$this->SetConfig('show_title','',$v);
		return $this;
	}

	public function __get($name) {
		if(!$this->config) {
			$this->config = $this->Sql('list');
		}
		return $this->config[$name]['cf_value'];
	}

/*
	public function Create() {
		if($file = fopen(Path::MB($this->file_name), 'w')) {

			fwrite($file, "<?php\n");
			foreach($_POST['key'] as $k=>$v) {
				if($v) {
					$line = sprintf("\$magic['%s']='%s';//%s\n", $v, $_POST['value'][$k], $_POST['desc'][$k]);
					fwrite($file, $line);
				}
			}
			fwrite($file, "?>\n");
			fclose($file);
		}
	}
	
	protected function path($file_name='') {
		return Path::MB($file_name);
	}

	public function GetList() {
		if($this->list) return $this->list;
		
		if(!is_file($this->path($this->file_name))) {
			$this->list = array();
			return $this->list;
		}
		
		$file_path = Path::MB($this->file_name);
		
		$list=array();
		include($file_path); 
		foreach($magic as $k=>$v) {
			$list[$k] = array();
			$list[$k]['key'] = $k;
			$list[$k]['value'] = $v;
		}

		$data = file($file_path);
		foreach($data as $kk=>$vv) {
			foreach($list as $k=>$v) {
				$tmp = explode('[', $data[$kk]);
				$tmp = explode(']', $tmp[1]);
				$key = substr($tmp[0], 1, -1);

				if($key == $k) {
					$line = explode('//', $data[$kk]);
					$list[$k]['desc'] = $line[1];
					//$desc[$k] = $line[1];
					break;
				}
			}
		}
		$this->list = $list;
		return $list;
	}
	//*/
	

}
