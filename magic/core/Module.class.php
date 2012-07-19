<?php
/*!
 *  \class    Module
 *  \author   Kevin Park (kevinpark1981<>gmail.com)
 *  \version  1.0 
 *  \brief    모듈  
 *  \date   2011.10.26 - 생성
 */
class Module
{
  protected $module;  ///< 모듈명
  protected $skin;  ///< 스킨명
  protected $path;  ///< 모듈의 위치
  protected $html;  ///< HTML source
  protected $called_init=false; ///< Init함수가 호출되었는지 확인
  protected static $inst=array(); ///< 모듈 풀링 인스턴스 
  
  protected $state=false; ///< controller/state.php 의 state값
  protected $cfg=false; ///< controller/config.php 값
  protected $sql=array(); ///< model/sql 값
  protected $table;   ///< model/table.php 값
  protected $tbns;    ///< model/table.php 의 테이블 이름값
  protected $can=array(); ///< controller/can.* 의 결과값
  protected $action=array();///< controller/action.* 의 결과값
  
  /*! 
   *  \fn   Inst($module, $skin='basic')
   *  \brief  모듈의 인스턴스를 반환함
   *      모듈은 모듈명과 스킨명의 조합으로 구분함
   *      모듈은 풀링으로 관리되며 $inst에 모두 저장되고 
   *      동일한 모듈이 호출되면 기존에 있던 인스턴스를 반환한다.
   *      싱글톤 + 인스턴스 풀링이 개념이다. 
   *  \param  $module 모듈이름
   *  \param  $skin 스킨명
   *  \return 해당 인스턴스
   */
  public static function Inst($module, $skin='basic') {
    if(!isset(self::$inst[$module])) {
      $class_name = __CLASS__;
      self::$inst[$module] = new $class_name($module, $skin);
    }
    return self::$inst[$module];
  }

  /*! 
   *  \fn   __construct($module, $skin='basic')
   *  \brief  모듈의 생성자
   *      모듈의 경로를 초기화 한다.
   *  \param  $module 모듈이름
   *  \param  $skin 스킨명
   */
  protected function __construct($module, $skin='basic') {
    $this->module = $module;
    $this->skin = $skin;
    $this->Skin($this->skin);
  }
  
  
  /*! 
   *  \fn   Init()
   *  \brief  초기화 함수
   *      기본적으로 style.css, script.js 파일을 인크루트한다.
   *      초기화파일 init종류의 파일을 읽어들인다.
   *      기본적으로 init.php 파일을 읽어들이고
   *      - 현재 상태에 따른 init.현재상태.php 파일을 읽어들인다.
   *      - 현재상태가 view이면 init.view.php 파일을 읽어들임
   *      - 만약 파일이 없다면 호출하지 않는다.
   *      - 초기화 하고 싶은 상태가 있으면 파일을 만들고 해당 코드를 집어 넣으면된다.
   *      auth.php 도 호출한다. 로직은 init과 동일하다.
   *      기본적으로 한번만 호출되어야 하기 때문에 멤버 변수를 사용해서 한번만 호출되도록 컨트롤 하고 있다.
   */
  protected function Init() {
    if($this->called_init) return;
    
    if(is_file($this->path_view('style.css'))) Styles::Add($this->path_view('style.css'));
    if(is_file($this->path_view('script.js'))) Scripts::Add($this->path_view('script.js'));
    
    if(is_file($this->path_controller('auth.php'))) {
      include $this->path_controller('auth.php');
    }
    if(is_file($this->path_controller('auth.'.$this->CurrentState().'.php'))) {
      include $this->path_controller('auth.'.$this->CurrentState().'.php');
    }
    
    // 2012.03.19 - 초기화 함수를 뒤로 옮김 삭제나 추가 같은 액션은 초기화에서 삭제나 추가를 하기때문에....
    // 예전에 init을 위로 올린 이유가 있었는데... 지금은 해결되었길 바란다.
    if(is_file($this->path_controller('init.php')))
      include $this->path_controller('init.php');
    if(is_file($this->path_controller('init.'.$this->CurrentState().'.php')))
      include $this->path_controller('init.'.$this->CurrentState().'.php');
      
    $this->called_init=true;
  }
  
  /*! 
   *  \fn   Can($mode)
   *  \brief  권한의 검사
   *      Auth는 검사 결과에 대한 액션
   *  \param  $mode 검사모드
   *  \return 검사결과
   */
  public function Can($mode) {
    $att = func_get_args();
    $mode_name=$mode;
    foreach ($att as $k=>$v) {
      if($k==0) continue;
      $mode_name.=$v;
    }
    if(!isset($this->can[$mode_name])) {
      include $this->path_controller('can.'.$mode.'.php');
      $this->can[$mode_name] = $pass;
    }
    return $this->can[$mode_name];
  }
  
  /*! 
   *  \fn   Action($mode)
   *  \brief  특정한 행동 실행
   *  \param  $mode 실행모드모드
   *  \return 실행결과
   */
  public function Action($mode) {
    $att = func_get_args();
    $mode_name=$mode;
    foreach ($att as $k=>$v) {
      if($k==0) continue;
      $mode_name.=$v;
    }
    if(!isset($this->action[$mode_name])) {
      include $this->path_controller('action.'.$mode.'.php');
      $this->action[$mode_name] = $result;
    }
    return $this->action[$mode_name];
  }
  
  /*! 
   *  \fn   path_controller($file='')
   *  \brief  모듈의 컨트롤러 경로
   *      final 함수로 더이상 수정불가능하다
   *      모듈의 폴더구조를 견고히 고정하기 위해 더이상 수정 못하도록 하였음
   *  \param  $file 반환할 파일명
   *  \return 파일이나 폴더경로
   */
  protected final function path_controller($file='') { return $this->path.'/controller/'.$file; }
  /*! 
   *  \fn   path_model($file='')
   *  \brief  모듈의 모델 경로
   *      final 함수로 더이상 수정불가능하다
   *      모듈의 폴더구조를 견고히 고정하기 위해 더이상 수정 못하도록 하였음
   *  \param  $file 반환할 파일명
   *  \return 파일이나 폴더경로
   */
  protected final function path_model($file='') { return $this->path.'/model/'.$file; }
  /*! 
   *  \fn   path_view($file='')
   *  \brief  모듈의 뷰 경로
   *      final 함수로 더이상 수정불가능하다
   *      모듈의 폴더구조를 견고히 고정하기 위해 더이상 수정 못하도록 하였음
   *  \param  $file 반환할 파일명
   *  \return 파일이나 폴더경로
   */
  protected final function path_view($file='') { return $this->path.'/view/'.$file; }
  /*! 
   *  \fn   path_img($file='')
   *  \brief  모듈의 이미지 경로
   *      final 함수로 더이상 수정불가능하다
   *      모듈의 폴더구조를 견고히 고정하기 위해 더이상 수정 못하도록 하였음
   *  \param  $file 반환할 파일명
   *  \return 파일이나 폴더경로
   */
  protected final function path_img($file='') { return $this->path_view().'img/'.$file; }
  
  /*! 
   *  \fn   Skin($skin_name='')
   *  \brief  현재상태에 따라서 스킨경로를 찾아서 반환해줌
   *      CreateHtml()에서 한번만 호출하지만 자식클래스에서
   *      오버라이딩해서 사용할수도 있기 때문에 함수로 제작하였음
   *  \return 스킨경로
   */
  public function Skin($skin_name='') {
    if($skin_name) {
      $this->skin = $skin_name;
      $this->path = Path::skin($this->module.'/'.$skin_name);
    }
    return self::$inst[$this->module];
  }
  
  /*! 
   *  \fn   SkinList($kind='basic')
   *  \brief  스킨 폴더에서 스킨 목록을 찾아서 반환해줌
   *      스킨에 따른 종류도 선택할 수 있겠끔 파라미터로 이름을 받음
   *  \return 스킨목록
   */
  public function SkinList($kind='basic') {
    $path = Path::skin($this->module);
    $dir = dir($path);
    
    $result = array();
    while($name = $dir->read()) {
      $path_dir = $path.'/'.$name;
      if(is_dir($path_dir)) {
        $path_config = $path_dir.'/config.php';
        // config.php 파일이 있다면
        if(is_file($path_config)) {
          include $path_config;
          // 종류를 비교하여 목록에 포함시킴
          if($skin['kind']==$kind) {
            $result[] = array(
              'skin'=>$name,
              'name'=>$skin['name']
            );
          }
          unset($skin);
        }
      }
    }
    if(!function_exists('cmp')) {
      function cmp($a,$b) { return strcmp($a['name'], $b['name']); }
    }
    usort($result, 'cmp');
    return $result;
  }
  
  /*! 
   *  \fn   CreateHtml()
   *  \brief  html 코드를 생성함
   *      Init 함수를 호출하지 않았다면 호출
   *      항상 생성자에서 호출하지 않고, 나중에 호출해야 할때도 있기 때문에
   */
  protected function CreateHtml() {
    $this->Init();
    ob_start();
    include($this->path_view($this->CurrentState().'.php'));
    $this->html = ob_get_contents();
    ob_end_clean();
  }
  /*! 
   *  \fn   __toString()
   *  \brief  php 내장함수를 오버라이딩 함
   *      echo $class_instance; 가 동작하도록 하기위함
   *  \return html code
   */
  public final function __toString() { $this->CreateHtml(); return $this->html; }
  /*! 
   *  \fn   html()
   *  \brief  __toString()이 먹히지 않는 서버가 있기 때문에
   *      이 함수를 통해서 호출하도록 함
   *  \return html code
   */
  public final function html() {return $this->__toString();}
  
  /*! 
   *  \fn   CurrentState()
   *  \brief  모듈의 현재 상태를 반환
   *      controller의 state.php파일을 인크루드하여 현재상태를 파악한다.
   *      모듈마다 로직이 달라질수 있음으로 로직은 state.php파일에 정의함
   *      호출할때마다 파일을 읽어들이면 퍼포먼스가 떨어짐으로
   *      $state변수에 저장하여 한번만 호출한다.
   *  \return 현재상태
   */
  public function CurrentState() {
    if(!$this->state) {
      include $this->path_controller('state.php');
      $this->state=$state;
    }
    return $this->state;
  }
  
  /*! 
   *  \fn   Sql($mode)
   *  \brief  sql 쿼리를 질의하는 php파일을 인크루드함
   *      해당모드의 쿼리를 질의하여 결과값을 $sql_result에 받아온다.
   *      해당 파일들은 결과 값을 $sql_result에 입력해야 한다.
   *      예를 들어 list.sql.php 파일은 목록을 불러올때 사용하게되며
   *      목록의 리스트는 $sql_result라는 변수에 저장을 하면된다.
   *  \param  $mode 파일명 앞의 prefix
   *  \return 질의 결과
   */
  public function Sql($mode) {
    $att = func_get_args();
    $mode_name=$mode;
    foreach ($att as $k=>$v) {
      if($k==0) continue;
      $mode_name.=$v;
    }
    if(!isset($this->sql[$mode_name])) {
      include $this->path_model('sql.'.$mode.'.php');
      $this->sql[$mode] = $sql_result;
    }
    return $this->sql[$mode];
  }
  
  /*! 
   *  \fn   Config($name, $sub='')
   *  \brief  모듈의 환경설정을 불러옴
   *      다양한 환경설정들을 config.php파일에 배열로 정의할 수 있으며,
   *      Config함수를 통해 값을 읽어 들일 수 있다.
   *      한번 읽어들인 config.php 파일은 다시는 읽어들이지 않는다.
   *  \param  $name 환경설정 이름 배열의 첫번째 파라메터
   *  \param  $sub 환경설정 배열의 두번째 파라메터
   *  \return 현재상태
   */
  public function Config($name, $sub='') {
    $att = func_get_args();
    $mode_name = $name.$sub;
    if(!isset($this->cfg[$mode_name])) {
      include $this->path_controller('config.php');
      if($sub) $this->cfg[$mode_name] = $cfg[$name][$sub];
      else $this->cfg[$mode_name] = $cfg[$name];
    }
    return $this->cfg[$mode_name];
  }
  
  /*! 
   *  \fn   SetConfig($name, $sub='')
   *  \brief  모듈의 환경설정을 변경함
   *  \param  $name 환경설정 이름 배열의 첫번째 파라메터
   *  \param  $sub 환경설정 배열의 두번째 파라메터
   *  \param  $value 설정값 배열의 두번째 파라메터
   */
  protected function SetConfig($name, $sub='', $value) {
    $mode_name = $name.$sub;
    if(!isset($this->cfg[$mode_name])) {
      include $this->path_controller('config.php');
      if($sub) $this->cfg[$mode_name] = $cfg[$name][$sub];
      else $this->cfg[$mode_name] = $this->cfg[$name];
    }
    $this->cfg[$mode_name] = $value;
    return $this;
  }
  
  /*! 
   *  \fn   Path()
   *  \brief  모듈이 호출되는 위치를 설정함
   *      외부에서 모듈의 위치를 찾아서 호출할 때에 사용된다.
   *  \return 모듈이 호출될 곳의 위치
   */
  protected function Path() {
    return $this->Config('path');
  }
  
  /*! 
   *  \fn   Mode()
   *  \brief  모듈의 해당 모드명을 반환
   *  \param  모드의 이름
   *  \return 모듈의 모드 명
   */
  public function Mode($name) {
    return $this->Config('mode', $name);
  }
  
  /*! 
   *  \fn   Table($index=0)
   *  \brief  테이블설정을 읽어들임
   *      테이블명이 파라미터로 넘어오지 않으면 첫번째 테이블 설정을 반환함
   *      테이블이 두개 있을 수도 있음
   *      두개의 테이블명은 $tbns에 저장됨
   *  \param  $index 테이블 인덱스 두개이상의 테이블이 설치 될때에는 이 인덱스를 이용함 기본은 첫번째
   *  \return 테이블설정 배열
   */
  public function Table($index=0) {
    if(!$this->table) {
      include $this->path_model('table.php');
      $this->table=$table;
      $this->tbns=array_keys($table);
    }
    return $this->table[$this->tbns[$index]];
  }
  
  /*! 
   *  \fn   KN($index=0)
   *  \brief  테이블의 키 이름을 읽어들임
   *  \param  $index 테이블 인덱스 두개이상의 테이블이 설치 될때에는 이 인덱스를 이용함 기본은 첫번째
   *  \return 테이블 키 이름
   */
  public function KN($index=0) {
    $t = $this->Table($index);
    return $t['pri_key'];
  }
  
  /*! 
   *  \fn   Key($index=0)
   *  \brief  키의 값을 GET 데이터로부터 읽어 들임
   *  \param  $index 테이블 인덱스 두개이상의 테이블이 설치 될때에는 이 인덱스를 이용함 기본은 첫번째
   *  \return 키값
   */
  public function Key($index=0) {
    $key_name = $this->KN($index);
    $key = '';
    if(isset($_GET[$key_name]))
      $key = $_GET[$key_name];
    return $key;
  }
  
  /*! 
   *  \fn   TBN($index=0)
   *  \brief  테이블 이름
   *      prefix를 붙여서 실제 테이블 이름을 반환해 준다.
   *  \param  $index 테이블 인덱스 두개이상의 테이블이 설치 될때에는 이 인덱스를 이용함 기본은 첫번째
   *  \return 테이블이름
   */
  public function TBN($index=0) {
    $this->Table($index);
    $db = DB::Get();
    if(is_object($db)) {
      return $db->prefix().$this->tbns[$index];
    } else {
      return '';
    }
  }
  
  /*! 
   *  \fn   Link($name)
   *  \brief  링크정보 반환
   *      controller/link.php 파일을 읽어들여서 링크정보를 반환함
   *      링크에 대한 추가 파라메터는 $name의 다음 파라메터로 가변인자로 받아들임
   *      링크를 호출할때마다 파일을 열어야 하기때문에 퍼포먼스가 떨어지지만
   *      추후에 개선하기로함
   *      Url클래스를 이용하여 현재URL에서 포함,제거,기본경로등을 이용하여 URL을 생성한다.
   *  \param  $name 링크명
   *  \return 링크주소
   */
  public function Link($name) {
    $att = func_get_args();
    include $this->path_controller('link.php');
    
    if(!$link[$name]) return false;
    return Url::Get($link[$name]['include'], $link[$name]['exclude'], $link[$name]['path']);
  }
  
  /*! 
   *  \fn   CheckInstall()
   *  \brief  테이블 설정값과 비교하여 결과를 배열로 반환해줌
   *  \param  tbn 비교할 테이블명
   *  \param  table_info 테이블비교 설정값 /model/table.php 파일의 내용
   *  \return array 데이터베이스 비교 결과
   */
  public function CheckInstall($tbn, $table_info) {

    // 테이블 존재여부 체크
    if(!DB::Get()->existTB($tbn)) return 'create';
    
    $check = array();
    $check['add'] = array();
    $check['change'] = array();
    $check['drop'] = array();

    $def_cols = $table_info['cols'];
    $desc = DB::Get()->sql_query_list('desc '.$tbn);
    
    foreach($desc as $v) {
      $field = $def_cols[$v['Field']];
      // 설정에는 없는데 설치된 테이블에는 존제하는 필드
      if($field===null) $check['drop'][] = $v['Field'];
      // 양쪽 모두 존제하는 필드
      else {
        // CHANGE
        if($field['type']!=$v['Type']) {
          $check['change'][$v['Field']] = $field;
        }
        unset($def_cols[$v['Field']]);
      }
    }

    // 추가해야할 필드
    foreach($def_cols as $k=>$v) {
      $check['add'][$k]=$v;
    }
    
    // 모든정보가 일치할때 $check에 true를 넣어줌
    if(count($check['add'])==0 && count($check['change'])==0 && count($check['drop'])==0)
      $check = true;

    return $check;
  }
  
  /*! 
   *  \fn   Install()
   *  \brief  데이터베이스 테이블과 비교하여 설치함
   *  \param  tbn 설치할 테이블명
   *  \param  table 테이블 설정값
   *  \param  check CheckInstall() 결과값
   */
  public function Install($tbn, $table, $check) {
    $db = DB::Get($tbn);
    // 테이블이 없을때
    if($check=='create') {
      $db->CreateTable($table);
      return;
    }
    // 테이블에 컬럼제거
    foreach($check['drop'] as $v) {
      $db->AlterTableDrop($v);
    }
    // 테이블에 컬럼변경
    foreach($check['change'] as $k=>$v) {
      $db->AlterTableChange($k, $v['type'], $v['null'], $v['default'], $v['extra'], $v['comment']);
    }
    // 테이블에 컬럼추가
    foreach($check['add'] as $k=>$v) {
      $db->AlterTableAdd($k, $v['type'], $v['null'], $v['default'], $v['extra'], $v['comment']);
    }
  }
  
  /*! 
   *  \fn   Clear($except=array())
   *  \brief  데이터베이스에 입력할 결과값들을 필터링함
   *  \param  $except 제외시킬 키값
   *  \return 필터링된 결과값
   */
  protected function Clear($except=array()) {
    $tbn = $this->TBN();
    $fields = $this->Table();
    $fields = $fields['cols'];
    
    $valid=array();
    foreach($fields as $k => $v) {
      $type = $v['filter'];
      // 제외할 것 제거
      if(in_array($k, $except)) continue;
      if(!isset($_POST[$k]) && !isset($_GET[$k]) && $type!='bool') continue;
      // POST/GET으로 데이터 받아오기
      $value = $_GET[$k];
      if(!$value) $value = $_POST[$k];
      // 필터링된 값
      $cleared = Filter::Inst()->Get($type, $value);
      if(isset($cleared)) $valid[$k]=$cleared;
    }
    return $valid;
  }

}
