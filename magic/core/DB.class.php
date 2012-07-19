<?php
/*
--------------------------------------------------------------------------------------
	작성자 : 박경종(똥싼너구리)
	이메일 : kevinpark1981[]지멜
--------------------------------------------------------------------------------------
	데이터베이스에 직접 질의하고 결과를 얻어오는 클래스.
	데이터베이스 정보를 담고 있다.
	데이터 베이스 연결을 최소화 하기위해 연결횟수 정보를 저장한다.
    ==========
     제공함수
    ==========
    기본적인 데이터베이스 질의 함수를 제공한다.

    sql_query - 질의하고 결과를 sql 객체로 반환
    sql_query_list - 질의하고 결과를 배열로 반환함
    sql_fetch - 질의하고 결과 1줄을 반환함
    sql_insert - insert 질의하고 삽입된 id번호를 반환
    TODO DB호출 구조도 좀 변경해야 함
-------------------------------------------------------------------------------------- 
*/
class DB 
{
	private $prefix;
	private $tbn;
	private $dbn;
	private $db;
	private $connect=0;
	const file_name='dbconfig.php';

	// select
	public function existTB($tbn) {
		$sql = "show tables where Tables_in_{$this->dbn} = '{$tbn}' ";
		$ret = $this->sql_fetch($sql);
		return $ret;
	}

	public function prefix() {
		return $this->prefix;
	}
	
	// 쿼리 결과를 한줄 받환 받음
	public function sql_fetch($sql) {
		$result = $this->sql_query($sql);
		/*
		//$num_results = $result->num_rows;
		//$row = '';
		if($num_results!=0) {
			$row = $result->fetch_assoc();
			$result->free();
		}
		//*/
		$row = mysql_fetch_array($result);
		mysql_free_result($result);
		return $row;
	}
	// 단순 쿼리 결과를 연관배열로 반환해줌
	public function sql_query_list($sql) {
		$result = $this->sql_query($sql);
		//$num_results = $result->num_rows;

		/*
		$row='';
		for($i=0; $i<$num_results; $i++) 
		{
			$row = $result->fetch_assoc();
			$list[$i] = $row;
		}
		//*/
		
		$list=array();
		while ($row = mysql_fetch_array($result)) {
			$list[] = $row;
		}
		
		mysql_free_result($result);
		
		//if($num_results!=0) $result->free();
		return $list;
	}
	// 쿼리 결과를 단순배열로 반환해줌
	public function sql_query_list_row($sql) {
		$result = $this->sql_query($sql);
		//$num_results = $result->num_rows;

		/*
		$row='';
		for($i=0; $i<$num_results; $i++) 
		{
			$list[$i] = $result->fetch_row();
		}
		//*/
		
		$list=array();
		while ($row = mysql_fetch_array($result)) {
			$list[] = $row;
		}
		
		mysql_free_result($result);
		
		//if($num_results!=0) $result->free();
		return $list;
	}
	// Simple Select 확장
	public function sql_selectEx($table, $field, $where='') {
		$sql = $this->createSelect($table, $field, $where);
		return $this->sql_query_list($sql);
	}
	// Simple Select Row 확장
	public function sql_selectRowEx($table, $field, $where='') {
		$sql = $this->createSelect($table, $field, $where);
		return $this->sql_query_list_row($sql);
	}
	// 테이블, 필드명을 선택하면 자동으로 쿼리문장을 생성함
	protected function createSelect($table, $field, $where='') {
		// 데이터 검증
		if(!isset($table) && $table!='') return false;
		if($field!='*' && !is_array($field)) return false;

		$length = sizeof($field);

		// select ,,, from table where ...
		$sql='SELECT ';
		if(!is_array($field) && $field=='*') $sql.=' * ';
		else
		{
			$count=0;
			foreach($field as $k => $v)
			{
				$sql.=$v;
				if(++$count!=$length) $sql.=',';
			}
		}
		$sql.=' FROM `'.$table.'` ';

		if($where!='') $sql.= ' WHERE '.$where;
		return $sql;
	}

	// insert
	// 일반적인 입력
	public function Insert($sql) {
		if ($this->sql_query($sql)) {
			return mysql_insert_id();
		} else {
			return false;
		}
	}

	// 확장 입력
	// 테이블 명과 필드명, 데이터들을 입력하면
	// 자동으로 쿼리문장을 생성해서 입력함
	public function InsertEx($table, $data, $functions=array()) {
		// 데이터 검증
		if(!isset($table) && $table!='') return false;
		if(!is_array($data)) return false;
		$length = sizeof($data);

		$sql='INSERT INTO '.$table.' (';

		$count=0;
		foreach($data as $k => $v)
		{
			$sql.=$k;
			if(++$count!=$length) $sql.=',';
		}
		$sql.=') VALUES (';
		$count=0;
		foreach($data as $k => $v) {
			if(!in_array($k, $functions) && ($k=='wr_content' || strpos($v, 'PASSWORD')===false) )
				$sql.="'".$v."'";
			else
				$sql.=$v;
			if(++$count!=$length) $sql.=',';
		}
		$sql.=')';
		
		return $this->insert($sql);
	}

	// update
	public function update($table, $data, $where, $functions=array()) {
		// 데이터 검증
		if(!isset($table) && $table!='') return false;
		if(!is_array($data)) return false;
		$length = sizeof($data);

		$sql='UPDATE '.$table.' SET ';

		$count=0;
		foreach($data as $k => $v)
		{
			$sql.= " $k=";
			if(!in_array($k, $functions) && ($k=='wr_content' || strpos($v, 'PASSWORD')===false) )
				$sql.="'".$v."'";
			else
				$sql.=$v;

			if(++$count!=$length) $sql.=',';
		}
		$sql.=' '.$where.' LIMIT 1';
		return $this->insert($sql);
	}

	// 단순쿼리	
	// debug 모드일때 접속수를 카운트함
	public function sql_query($sql) {
		if(defined('__DEBUG__')) $this->connect++;
		return $this->check_error(mysql_query($sql), $sql);
	}

	protected function check_error($result, $sql) {
		if(defined('__DEBUG__')) {
			//if(!$result) {Util::Dbg($sql."\nerrno:<b>".$this->db->errno."</b>\n".$this->db->error); exit;}
			if(!$result) {
				$msg = Debug::Short(4);
				foreach ($msg as $v) {
					echo $v."<br/>\n";
				}
				var_dump($sql."\nerrno:<b>".mysql_errno()."</b>\n".mysql_error());
				exit;
			}
		}
		return $result;
	}

	static function DescTable($tbn) {
		$desc = self::Get()->sql_query_list('desc '.$tbn);

		$result=array();
		foreach($desc as $k=>$v)
		{
			$result[$v['Field']] = GV::GenType($v);
		}
		return $result;
	}

	/*! 
	 *	\fn		AlterTableAdd($name, $type, $null, $default_value=null, $extra=null, $comment=null)
	 *	\brief	필드추가
	 *	\param	name 필드명
	 *	\param	type 필드의 타입
	 *	\param	null null여부
	 *	\param	default_value 기본값
	 *	\param	comment 필드설명
	 */
	public function AlterTableAdd($name, $type, $null, $default_value=null, $extra=null, $comment=null) {
		$sql = " ALTER TABLE `{$this->tbn}` ADD `{$name}` {$type} {$null}  ";
		if($default_value!==null) $sql.= " DEFAULT '{$default_value}' ";
		if($extra!==null) $sql.= " {$extra} ";
		if($comment!==null) $sql.= " COMMENT '{$comment}' ";
		$this->sql_query($sql);
	}

	/*! 
	 *	\fn		AlterTableChange($name, $type, $null, $default_value=null, $extra=null, $comment=null)
	 *	\brief	필드수정
	 *	\param	name 필드명
	 *	\param	type 필드의 타입
	 *	\param	null null여부
	 *	\param	default_value 기본값
	 *	\param	comment 필드설명
	 */
	public function AlterTableChange($name, $type, $null, $default_value=null, $extra=null, $comment=null) {
		$sql = " ALTER TABLE `{$this->tbn}` CHANGE `{$name}` `{$name}` {$type} {$null}  ";
		if($default_value!==null) $sql.= " DEFAULT '{$default_value}' ";
		if($extra!==null) $sql.= " {$extra} ";
		if($comment!==null) $sql.= " COMMENT '{$comment}' ";
		$this->sql_query($sql);
	}

	/*! 
	 *	\fn		AlterTableDrop($field, $variables=null)
	 *	\brief	필드제거	
	 *	\param	field 인덱스 이름
	 *	\param	variables 가변인자
	 */
	public function AlterTableDrop($field, $variables=null) {
		$sql = " ALTER TABLE `{$this->tbn}` DROP `{$field}` ";
		// 가변인자
		for($i=1; $i<func_num_args(); $i++)
		{
			$sql.=",`".func_get_arg($i)."`";
		}
		$this->sql_query($sql);
	}

	/*! 
	 *	\fn		AlterTableAddPrimaryKey($field, $variables=null)
	 *	\brief	기본키 추가
	 *	\param	field 인덱스 필드값
	 *	\param	variables 가변인자
	 */
	public function AlterTableAddPrimaryKey($field, $variables=null) {
		$sql = " ALTER TABLE `{$this->tbn}` ADD PRIMARY KEY (`{$field}` ";
		// 가변인자
		for($i=1; $i<func_num_args(); $i++)
		{
			$sql.=",`".func_get_arg($i)."`";
		}
		$sql.= " ) ";
		$this->sql_query($sql);
	}

	/*! 
	 *	\fn		AlterTableDropPrimaryKey()
	 *	\brief	기본키 제거
	 */
	public function AlterTableDropPrimaryKey() {
		$sql = " ALTER TABLE `{$this->tbn}` DROP PRIMARY KEY ";
		$tbn->sql_query($sql);
	}

	/*! 
	 *	\fn		AlterTableDropIndex($key_name)
	 *	\brief	인덱스제거
	 *	\param	key_name 삭제할 인덱스 이름
	 */
	public function AlterTableDropIndex($key_name) {
		$sql = "ALTER TABLE `{$this->tbn}` DROP INDEX `{$key_name}` ";
		$this->sql_query($sql);
	}

	/*! 
	 *	\fn		AlterTableAddIndex($kind, $field, $variables=null)
	 *	\brief	인덱스추가 가변인자 받을수 있음
	 *	\param	kind 인덱스 종류 INDEX, UNIQUE, FULLTEXT
	 *	\param	field 인덱스 필드값
	 *	\param	variables 가변인자
	 */
	public function AlterTableAddIndex($kind, $field, $variables=null) {
		$sql = "ALTER TABLE `{$this->tbn}` ADD {$kind} ( `{$field}` ";

		// 가변인자
		for($i=1; $i<func_num_args(); $i++)
		{
			$sql.=",`".func_get_arg($i)."`";
		}

		$sql.= " ) ";
		$this->sql_query($sql);
	}


	/*! 
	 *	\brief	테이블 생성 TableSetting에서 설정된 값에 따라 생성
	 *	\fn		CreateTable
	 */
	public function CreateTable($table_desc) {
		$sql="CREATE TABLE IF NOT EXISTS `{$this->tbn}` ( \n";

		foreach($table_desc['cols'] as $k => $v) {
			$sql.="`{$k}` {$v['type']} {$v['null']} ";
			if($v['default']!==NULL) $sql.=" DEFAULT '".$v['default']."' ";
			if($v['extra']!==NULL) $sql.=$v['extra'];
			if($v['comment']!==NULL) $sql.=" COMMENT '".$v['comment']."' ";
			$sql.=", \n";
		}

		if($table_desc['index'])
		foreach($table_desc['index'] as $k => $v) {
			$sql.=" {$k} `{$v['name']}` ({$v['field']}), \n";
		}

		if($table_desc['pri_key']) $sql.=" PRIMARY KEY ({$table_desc['pri_key']})\n";

		$sql.=") ENGINE={$table_desc['ENGINE']} DEFAULT CHARSET={$table_desc['DEFAULT CHARSET']} ";
		if($table_desc['COMMENT']) $sql.=" COMMENT '{$table_desc['COMMENT']}' ";
		
		$this->sql_query($sql);
	}

	/*! 
	 *	\fn		DropTable()
	 *	\brief	테이블 제거
	 */
	public function DropTable($tbn='') {
		if($tbn=='') $tbn = $this->tbn;
		$sql="DROP TABLE `{$tbn}`";
		$this->sql_query($sql);
	}


	//	초기화&싱글턴
	protected function __construct() {
		$this->connect = 0;
		include_once(Path::dbconfig());

		$this->prefix = $prefix;
		
		if(!($this->connection = mysql_connect($mysql_host, $mysql_user, $mysql_password))) {
			echo '데이터베이스 접속정보가 잘못되었습니다.';
			exit;
		}
		
		if(!mysql_select_db($mysql_db)) {
			echo '데이터베이스 이름이 잘못되었습니다.';
			exit;
		}
		
		
		//$this->db = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_db);
		/*
		if(mysqli_connect_errno()) 
		{
			echo '데이터베이스에 접속 할수 없습니다.';
			exit;
		}
		//*/
		$this->dbn = $mysql_db;
		// 글자 깨짐 방지
		mysql_query("set character_set_client = utf8;");
		mysql_query("set character_set_connection = utf8;");
		mysql_query("set character_set_results = utf8;");
		
		//$this->db->query("set character_set_client = utf8;");
		//$this->db->query("set character_set_connection = utf8;");
		//$this->db->query("set character_set_results = utf8;");
	}

	public function __destruct() {
		if(false)
		//if(defined('__DEBUG__'))
		{
			echo '<!-- 데이터베이스 접속 횟수: ';
			echo $this->connect;
			echo ' -->';
		}
	}

	// DB는 어디서든 잘 사용되고, 데이터베이스에 두번 연결 하면 안되기 때문에 싱글턴으로 개발 하자.
	private static $inst;
	public static function Get($tbn=null)
	{
		if(!is_file(Path::dbconfig())) return NULL;
		if(!isset(self::$inst)){$class = __CLASS__; self::$inst = new $class();}
		if($tbn!==null) self::$inst->tbn = $tbn;
		return self::$inst;
	}
}
