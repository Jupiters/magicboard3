<?php
class AdminMenu
{
	protected $menu;
	protected $position;
	protected $path;

	protected static $inst;
	public static function Inst() {
		if(!isset(self::$inst)) {
			$class_name = __CLASS__;
			self::$inst = new $class_name();
		}
		return self::$inst;
	}
	
	protected function __construct() {
		if(Path::IsAdminPage()) $this->path = Path::admin();
		else $this->path = Path::manager();
		
		$menu=array();

		$dir = dir($this->path);
		while($file = $dir->read())
		{
			if(strrpos($file, 'menu_')!==false) {
				
				$name = substr($file, 0, strrpos($file, '.'));
				$div = explode('_', $name);
				
				if(sizeof($div)==2) {
					$contents = implode('', file($this->path($file)));
					preg_match("/title=[\S ]+/", $contents, $matches);
					$title = explode('"', $matches[0]);
					$menu[$div[1]]['title'] = $title[1];
				} else if(sizeof($div)==3) {
					$contents = implode('', file($this->path($file)));
					preg_match("/title=[\S ]+/", $contents, $matches);
					$title = explode('"', $matches[0]);

					if(!isset($menu[$div[1]])) $menu[$div[1]] = array();
					if(!isset($menu[$div[1]['child']])) $menu[$div[1]]['child'] = array();
					$menu[$div[1]]['child'][$div[2]] = $title[1];
					ksort($menu[$div[1]]['child']);
				}
				
			}
		}
		ksort($menu);
		$this->menu = $menu;

		// 현재 관리자페이지 위치 분석
		$urls = explode('?', Url::This());
		$url = substr($urls[0], 0, strrpos($urls[0], '.'));
		$url = substr($url, strrpos($url, '/'));
		$position = explode('_', $url);
		$this->position[0] = $position[1];
		if(isset($position[2])) $this->position[1] = $position[2];
	}
	
	public function path($file='') {
		return $this->path.$file;
	}

	protected function GetName($parent_no, $child_no='') {
		if($child_no==='' || $child_no==-1) return $this->menu[$parent_no]['title'];
		else return $this->menu[$parent_no]['title'].' &gt; '.$this->menu[$parent_no]['child'][$child_no];
	}

	public function CurrentPosition() { return $this->position; }

	public function Menu() { return $this->menu; }

	public function ParentList() {
		$list=array();
		foreach($this->menu as $k=>$v) {
			$list[$k] = $v['title'];
		}
		return $list;
	}

	public function ChildList($parent_no) { return $this->menu[$parent_no]['child']; }

}