<?php
class Path
{
  /**********************************************************/
  /* define path                                            */
  /**********************************************************/
  const mb          ='magic/';
  const core        ='core/';
  const data        ='data/';
  const data_file   ='file/';
  const data_member ='member/';
  const img         ='img/';
  const css         ='css/';
  const js          ='js/';
  const skin        ='skin/';
  const classExt    ='classExt/';

  static $root;
  static $browser;

  // 현재 경로 출력 + 파일까지
  // index파일을 공백으로 처리함
  // file로 파일명을 넣으면 해당위치의 파일을 찾아 경로를 반환함
  static function This($file='')
  {
    $path_this = str_replace('index.php','', $_SERVER['PHP_SELF']);

    if($file!='')
    {
      $file = str_replace('index.php','',$file);
      $path = substr($path_this, 0, strrpos($path_this, '/')).'/';
      return self::JoinEx($path, $file);
    }
    return $path_this;
  }

  // level 0 : 폴더명 까지만 동일하면 OK
  // level 1 : 파일명 까지만 동일하면 OK
  // level 2 : query string이 $path가 가지고 있는것을 포함하고 있으면 OK
  // level 3 : query string이 $path와 모두 동일해야 OK
  // return values
  //    - 'ext' : external link
  //    - true : correct link
  //    - false : incorrect link
  // 항상비교시 === 연산자를 사용하자
  static function check($path, $level=0) {
    
    // 외부링크는 현재주소와 맞을수가 없으니 처음부터 걸러냄
    if(self::checkExternalLink($path)===true) return 'ext';
    $active=false;
    
    // &amp; 같은 문자가 들어왔을 경우 대처
    $path = htmlspecialchars_decode($path);
    
    // index.php는 비교하지 않음
    // 현재 주소와 체크주소의 URL파라메터 값들을 분리하여 저장함
    $_this = Url::extractFactor(str_replace('index.php','',$_SERVER['REQUEST_URI']));
    $_check = Url::extractFactor(str_replace('index.php','',$path));
    
    // 주소값을 / 단위로 끊어서 비교함
    // 공백값은 제거함
    $arr_path_current = explode('/', $_this['path']);
    $arr_path_check = explode('/', $_check['path']);
    
    $file_current = array_pop($arr_path_current);
    $file_check = array_pop($arr_path_check);
    
    foreach($arr_path_check as $k => $v) {
      if($v=='.') unset($arr_path_check[$k]);
    }
    
    $arr_path_current = array_filter($arr_path_current);
    $arr_path_check = array_filter($arr_path_check);
    
    // REQUEST_URI는 서버 루트부터의 URL을 반환한다.
    // 그러므로 체크할 주소를 비교하여 .. 의 개수를 샐 필요가 있다.
    $count_sub_folders = count($arr_path_current);
    $count_sub_folders_check = array_count_values($arr_path_check);
    
    // 개수를 세고나서 폴더를 제거한다.
    foreach($arr_path_check as $k => $v) {
      if($v=='..') unset($arr_path_check[$k]);
    }

    // 상위폴더로의 경로가 있을 시 대칭이 맞지 않으면 이미 경로는 현재경로가 아님
    if($count_sub_folders_check['..']) {
      if($count_sub_folders_check['..'] != sizeof($arr_path_check)) {
        return false;
      }
    }
    
    // level:0 폴더비교
    if(sizeof(array_diff($arr_path_check, $arr_path_current))==0 && sizeof(array_diff($arr_path_current, $arr_path_check))==0) {
      $active=true;
    }
    
    // level:1 파일까지 비교
    if($active==true && $level>=1) {
      $active = false;
      if($file_check == $file_current) $active=true;
    }

    // level1을 통과했을시 level2 이면 쿼리스트링까지 비교함
    if($active==true && $level>=2) {
      $active=false;
      
      // 쿼리스트링 비교후 체크하고자 하는 url의 쿼리스트링과
      // 다른것만 남김
      $diff = array_diff_assoc($_check['qstr'], $_this['qstr']);
      
      if(count($diff)==0) {
        $active=true;
        // 3레벨 이상일 때에는 url의 양쪽이 모두 똑같아야 함
        if($level>=3) {
          $active=false;
          $diff = array_diff_assoc($_this['qstr'], $_check['qstr']);
          if(count($diff)==0) $active=true;
        }
      }
    }
      
    return $active;
  }
  
  protected function checkExternalLink($link) { return (strpos($link,"http://") !== false || strpos($link,"https://") !== false)?true:false; }

  static function Root($file='') { return self::JoinEx(self::$root, $file); }
  static function Group($file='') { return self::Root($file); }

  static function MB($file='') { return self::JoinEx(self::Root(self::mb), $file); }
  static function MB_js($file='') { return self::JoinEx(self::MB(self::js), $file); }
  static function MB_css($file='') { return self::JoinEx(self::MB(self::css), $file); }
  static function MB_img($file='') { return self::JoinEx(self::MB(self::img), $file); }

  static function data($file='') { return self::JoinEx(self::MB(self::data), $file); }
  static function data_file($file=''){ return self::JoinEx(self::data(self::data_file), $file); }
  static function data_member($file=''){ return self::JoinEx(self::data(self::data_member), $file); }

  static function config() { return self::MB('config.php'); }
  static function dbconfig() { return self::MB(DB::file_name); }
  static function license() { return self::MB('LICENSE'); }
  static function history() { return self::MB('HISTORY'); }

  static function core($file='') { return self::JoinEx(self::MB(self::core), $file); }
  static function classExt($file='') { return self::JoinEx(self::MB(self::classExt), $file); }
  static function skin($file='') { return self::JoinEX(self::MB(self::skin), $file); }

  // 어드민 경로
  static function admin($id1='', $id2='') {
    $qstr = '?r='.Config::Inst()->path_admin;
    if($id1) {
      $qstr.= '&id1='.$id1;
      if($id2) $qstr.= '&id2='.$id2;
    }
    return self::Root($qstr);
  }

  /// 회원사진 경로 반환
  static function mb_picture($picture, $id, $print_noimage=true) {
    if($picture) return Path::data_member($id.'_mb');
    else if($print_noimage) return Path::img('noimage.gif');
    return '';
  }

  /// 회원아이콘 경로 반환
  static function mb_icon($icon, $id) {
    if($icon) return Path::data_member($id.'_icon_'.$icon);
    else return '';
  }

  // 상위 폴더로 진행하면서 파일을 찾음
  // 파일이 없으면 path_error로 알려줌
  static function FindFile($folder, $file) {
    $depth = array_count_values(explode('/', self::Root()));
    $path = self::JoinEx($folder, $file);

    $i=0;
    $find=false;
    do {
      if(is_file($path)) {
        $find=true;
        break;
      }
      if($depth['..']>0) $path = self::Join('..', $path);
    }
    while($i++<$depth['..']);

    if(!defined('__DEBUG__') && !$find) {
      $path='';
    } else if(!$find) {
      $path.='/!!!!/path_error';
    }
    return $path;
  }
  
  // 상위 폴더로 진행하면서 파일을 찾음
  // 파일이 없으면 path_error로 알려줌
  static function FindDir($path, $debug=false) {
    $depth = array_count_values(explode('/', self::Root()));
    
    $i=0;
    $find=false;
    do {
      if(is_dir($path)) {
        $find=true;
        break;
      }
      if($depth['..']>0) $path = self::Join('..', $path);
      
    } while($i++<$depth['..']);

    if(!$debug && !$find) {
      $path='';
    } else if(!$find) {
      $path.='/!!!!/path_error';
    }
    return $path;
  }


  // 슬레쉬가 두개가 되거나 없이 합치는 것을 방지
  static function Join($path1, $path2) {
    if($path1 != '' && substr($path1, -1)!='/') $path1.='/';
    if(substr($path2, 0, 1)=='/') $path2=substr($path2, 1);
    return $path1.$path2;
  }

  static function JoinEx($path, $file) {
    if($file=='') {
      if(!is_file($path)) {
        if(substr($path, -1)!='/') $path.='/';
      }
      return $path; 
    }
    else return self::Join($path, $file); 
  }

  static function SetRoot($root) {
    self::$root = $root;
  }

  const ff='ff';
  const ie5='ie5';
  const ie6='ie6';
  const ie7='ie7';
  const ie8='ie8';
  const chrome='chrome';
  const safari='safari';
  const opera='opera';
  static function SetBrowser() {
    $agent=$_SERVER['HTTP_USER_AGENT'];
    if(strpos($agent, 'Firefox'))     self::$browser = '';//self::ff;
    else if(strpos($agent, 'MSIE 5.5'))   self::$browser = self::ie5;
    else if(strpos($agent, 'MSIE 6.0'))   self::$browser = self::ie6;
    else if(strpos($agent, 'MSIE 7.0'))   self::$browser = self::ie7;
    else if(strpos($agent, 'MSIE 8.0'))   self::$browser = self::ie8;
    else if(strpos($agent, 'Chrome'))   self::$browser = self::chrome;
    else if(strpos($agent, 'Safari'))   self::$browser = self::safari;
    else if(strpos($agent, 'Opera'))    self::$browser = self::opera;
  }


  static function mobile_device_detect($iphone=true,$android=true,$opera=true,$blackberry=true,$palm=true,$windows=true,$mobileredirect=false,$desktopredirect=false) {

    $mobile_browser   = false; // set mobile browser as false till we can prove otherwise
    $user_agent       = $_SERVER['HTTP_USER_AGENT']; // get the user agent value - this should be cleaned to ensure no nefarious input gets executed
    $accept           = $_SERVER['HTTP_ACCEPT']; // get the content accept value - this should be cleaned to ensure no nefarious input gets executed
  
    switch(true){ // using a switch against the following statements which could return true is more efficient than the previous method of using if statements
  
      case (stripos($user_agent,'ipod')!==false || stripos($user_agent,'iphone')!==false); // we find the words iphone or ipod in the user agent
        $mobile_browser = $iphone; // mobile browser is either true or false depending on the setting of iphone when calling the function
        $status = 'Apple';
        if(substr($iphone,0,4)=='http'){ // does the value of iphone resemble a url
        $mobileredirect = $iphone; // set the mobile redirect url to the url value stored in the iphone value
        } // ends the if for iphone being a url
        break; // break out and skip the rest if we've had a match on the iphone or ipod
    
      case (stripos($user_agent,'android')!==false);  // we find android in the user agent
        $mobile_browser = $android; // mobile browser is either true or false depending on the setting of android when calling the function
        $status = 'Android';
        if(substr($android,0,4)=='http'){ // does the value of android resemble a url
        $mobileredirect = $android; // set the mobile redirect url to the url value stored in the android value
        } // ends the if for android being a url
        break; // break out and skip the rest if we've had a match on android
    
      case (stripos($user_agent,'opera mini')!==false); // we find opera mini in the user agent
        $mobile_browser = $opera; // mobile browser is either true or false depending on the setting of opera when calling the function
        $status = 'Opera';
        if(substr($opera,0,4)=='http'){ // does the value of opera resemble a rul
        $mobileredirect = $opera; // set the mobile redirect url to the url value stored in the opera value
        } // ends the if for opera being a url 
        break; // break out and skip the rest if we've had a match on opera
    
      case (stripos($user_agent,'blackberry')!==false); // we find blackberry in the user agent
        $mobile_browser = $blackberry; // mobile browser is either true or false depending on the setting of blackberry when calling the function
        $status = 'Blackberry';
        if(substr($blackberry,0,4)=='http'){ // does the value of blackberry resemble a rul
        $mobileredirect = $blackberry; // set the mobile redirect url to the url value stored in the blackberry value
        } // ends the if for blackberry being a url 
        break; // break out and skip the rest if we've had a match on blackberry
    
      case (preg_match('/(pre\/|palm os|palm|hiptop|avantgo|fennec|plucker|xiino|blazer|elaine)/i',$user_agent)); // we find palm os in the user agent - the i at the end makes it case insensitive
        $mobile_browser = $palm; // mobile browser is either true or false depending on the setting of palm when calling the function
        $status = 'Palm';
        if(substr($palm,0,4)=='http'){ // does the value of palm resemble a rul
        $mobileredirect = $palm; // set the mobile redirect url to the url value stored in the palm value
        } // ends the if for palm being a url 
        break; // break out and skip the rest if we've had a match on palm os
    
      case (preg_match('/(iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile)/i',$user_agent)); // we find windows mobile in the user agent - the i at the end makes it case insensitive
        $mobile_browser = $windows; // mobile browser is either true or false depending on the setting of windows when calling the function
        $status = 'Windows Smartphone';
        if(substr($windows,0,4)=='http'){ // does the value of windows resemble a rul
        $mobileredirect = $windows; // set the mobile redirect url to the url value stored in the windows value
        } // ends the if for windows being a url 
        break; // break out and skip the rest if we've had a match on windows
    
      case (preg_match('/(mini 9.5|vx1000|lge |m800|e860|u940|ux840|compal|wireless| mobi|ahong|lg380|lgku|lgu900|lg210|lg47|lg920|lg840|lg370|sam-r|mg50|s55|g83|t66|vx400|mk99|d615|d763|el370|sl900|mp500|samu3|samu4|vx10|xda_|samu5|samu6|samu7|samu9|a615|b832|m881|s920|n210|s700|c-810|_h797|mob-x|sk16d|848b|mowser|s580|r800|471x|v120|rim8|c500foma:|160x|x160|480x|x640|t503|w839|i250|sprint|w398samr810|m5252|c7100|mt126|x225|s5330|s820|htil-g1|fly v71|s302|-x113|novarra|k610i|-three|8325rc|8352rc|sanyo|vx54|c888|nx250|n120|mtk |c5588|s710|t880|c5005|i;458x|p404i|s210|c5100|teleca|s940|c500|s590|foma|samsu|vx8|vx9|a1000|_mms|myx|a700|gu1100|bc831|e300|ems100|me701|me702m-three|sd588|s800|8325rc|ac831|mw200|brew |d88|htc\/|htc_touch|355x|m50|km100|d736|p-9521|telco|sl74|ktouch|m4u\/|me702|8325rc|kddi|phone|lg |sonyericsson|samsung|240x|x320vx10|nokia|sony cmd|motorola|up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|kindle|mobile|psp|treo)/i',$user_agent)); // check if any of the values listed create a match on the user agent - these are some of the most common terms used in agents to identify them as being mobile devices - the i at the end makes it case insensitive
        $mobile_browser = true; // set mobile browser to true
        $status = 'Mobile matched on piped preg_match';
        break; // break out and skip the rest if we've preg_match on the user agent returned true 
    
      case ((strpos($accept,'text/vnd.wap.wml')>0)||(strpos($accept,'application/vnd.wap.xhtml+xml')>0)); // is the device showing signs of support for text/vnd.wap.wml or application/vnd.wap.xhtml+xml
        $mobile_browser = true; // set mobile browser to true
        $status = 'Mobile matched on content accept header';
        break; // break out and skip the rest if we've had a match on the content accept headers
    
      case (isset($_SERVER['HTTP_X_WAP_PROFILE'])||isset($_SERVER['HTTP_PROFILE'])); // is the device giving us a HTTP_X_WAP_PROFILE or HTTP_PROFILE header - only mobile devices would do this
        $mobile_browser = true; // set mobile browser to true
        $status = 'Mobile matched on profile headers being set';
        break; // break out and skip the final step if we've had a return true on the mobile specfic headers
    
      case (in_array(strtolower(substr($user_agent,0,4)),array('1207'=>'1207','3gso'=>'3gso','4thp'=>'4thp','501i'=>'501i','502i'=>'502i','503i'=>'503i','504i'=>'504i','505i'=>'505i','506i'=>'506i','6310'=>'6310','6590'=>'6590','770s'=>'770s','802s'=>'802s','a wa'=>'a wa','acer'=>'acer','acs-'=>'acs-','airn'=>'airn','alav'=>'alav','asus'=>'asus','attw'=>'attw','au-m'=>'au-m','aur '=>'aur ','aus '=>'aus ','abac'=>'abac','acoo'=>'acoo','aiko'=>'aiko','alco'=>'alco','alca'=>'alca','amoi'=>'amoi','anex'=>'anex','anny'=>'anny','anyw'=>'anyw','aptu'=>'aptu','arch'=>'arch','argo'=>'argo','bell'=>'bell','bird'=>'bird','bw-n'=>'bw-n','bw-u'=>'bw-u','beck'=>'beck','benq'=>'benq','bilb'=>'bilb','blac'=>'blac','c55/'=>'c55/','cdm-'=>'cdm-','chtm'=>'chtm','capi'=>'capi','cond'=>'cond','craw'=>'craw','dall'=>'dall','dbte'=>'dbte','dc-s'=>'dc-s','dica'=>'dica','ds-d'=>'ds-d','ds12'=>'ds12','dait'=>'dait','devi'=>'devi','dmob'=>'dmob','doco'=>'doco','dopo'=>'dopo','el49'=>'el49','erk0'=>'erk0','esl8'=>'esl8','ez40'=>'ez40','ez60'=>'ez60','ez70'=>'ez70','ezos'=>'ezos','ezze'=>'ezze','elai'=>'elai','emul'=>'emul','eric'=>'eric','ezwa'=>'ezwa','fake'=>'fake','fly-'=>'fly-','fly_'=>'fly_','g-mo'=>'g-mo','g1 u'=>'g1 u','g560'=>'g560','gf-5'=>'gf-5','grun'=>'grun','gene'=>'gene','go.w'=>'go.w','good'=>'good','grad'=>'grad','hcit'=>'hcit','hd-m'=>'hd-m','hd-p'=>'hd-p','hd-t'=>'hd-t','hei-'=>'hei-','hp i'=>'hp i','hpip'=>'hpip','hs-c'=>'hs-c','htc '=>'htc ','htc-'=>'htc-','htca'=>'htca','htcg'=>'htcg','htcp'=>'htcp','htcs'=>'htcs','htct'=>'htct','htc_'=>'htc_','haie'=>'haie','hita'=>'hita','huaw'=>'huaw','hutc'=>'hutc','i-20'=>'i-20','i-go'=>'i-go','i-ma'=>'i-ma','i230'=>'i230','iac'=>'iac','iac-'=>'iac-','iac/'=>'iac/','ig01'=>'ig01','im1k'=>'im1k','inno'=>'inno','iris'=>'iris','jata'=>'jata','java'=>'java','kddi'=>'kddi','kgt'=>'kgt','kgt/'=>'kgt/','kpt '=>'kpt ','kwc-'=>'kwc-','klon'=>'klon','lexi'=>'lexi','lg g'=>'lg g','lg-a'=>'lg-a','lg-b'=>'lg-b','lg-c'=>'lg-c','lg-d'=>'lg-d','lg-f'=>'lg-f','lg-g'=>'lg-g','lg-k'=>'lg-k','lg-l'=>'lg-l','lg-m'=>'lg-m','lg-o'=>'lg-o','lg-p'=>'lg-p','lg-s'=>'lg-s','lg-t'=>'lg-t','lg-u'=>'lg-u','lg-w'=>'lg-w','lg/k'=>'lg/k','lg/l'=>'lg/l','lg/u'=>'lg/u','lg50'=>'lg50','lg54'=>'lg54','lge-'=>'lge-','lge/'=>'lge/','lynx'=>'lynx','leno'=>'leno','m1-w'=>'m1-w','m3ga'=>'m3ga','m50/'=>'m50/','maui'=>'maui','mc01'=>'mc01','mc21'=>'mc21','mcca'=>'mcca','medi'=>'medi','meri'=>'meri','mio8'=>'mio8','mioa'=>'mioa','mo01'=>'mo01','mo02'=>'mo02','mode'=>'mode','modo'=>'modo','mot '=>'mot ','mot-'=>'mot-','mt50'=>'mt50','mtp1'=>'mtp1','mtv '=>'mtv ','mate'=>'mate','maxo'=>'maxo','merc'=>'merc','mits'=>'mits','mobi'=>'mobi','motv'=>'motv','mozz'=>'mozz','n100'=>'n100','n101'=>'n101','n102'=>'n102','n202'=>'n202','n203'=>'n203','n300'=>'n300','n302'=>'n302','n500'=>'n500','n502'=>'n502','n505'=>'n505','n700'=>'n700','n701'=>'n701','n710'=>'n710','nec-'=>'nec-','nem-'=>'nem-','newg'=>'newg','neon'=>'neon','netf'=>'netf','noki'=>'noki','nzph'=>'nzph','o2 x'=>'o2 x','o2-x'=>'o2-x','opwv'=>'opwv','owg1'=>'owg1','opti'=>'opti','oran'=>'oran','p800'=>'p800','pand'=>'pand','pg-1'=>'pg-1','pg-2'=>'pg-2','pg-3'=>'pg-3','pg-6'=>'pg-6','pg-8'=>'pg-8','pg-c'=>'pg-c','pg13'=>'pg13','phil'=>'phil','pn-2'=>'pn-2','pt-g'=>'pt-g','palm'=>'palm','pana'=>'pana','pire'=>'pire','pock'=>'pock','pose'=>'pose','psio'=>'psio','qa-a'=>'qa-a','qc-2'=>'qc-2','qc-3'=>'qc-3','qc-5'=>'qc-5','qc-7'=>'qc-7','qc07'=>'qc07','qc12'=>'qc12','qc21'=>'qc21','qc32'=>'qc32','qc60'=>'qc60','qci-'=>'qci-','qwap'=>'qwap','qtek'=>'qtek','r380'=>'r380','r600'=>'r600','raks'=>'raks','rim9'=>'rim9','rove'=>'rove','s55/'=>'s55/','sage'=>'sage','sams'=>'sams','sc01'=>'sc01','sch-'=>'sch-','scp-'=>'scp-','sdk/'=>'sdk/','se47'=>'se47','sec-'=>'sec-','sec0'=>'sec0','sec1'=>'sec1','semc'=>'semc','sgh-'=>'sgh-','shar'=>'shar','sie-'=>'sie-','sk-0'=>'sk-0','sl45'=>'sl45','slid'=>'slid','smb3'=>'smb3','smt5'=>'smt5','sp01'=>'sp01','sph-'=>'sph-','spv '=>'spv ','spv-'=>'spv-','sy01'=>'sy01','samm'=>'samm','sany'=>'sany','sava'=>'sava','scoo'=>'scoo','send'=>'send','siem'=>'siem','smar'=>'smar','smit'=>'smit','soft'=>'soft','sony'=>'sony','t-mo'=>'t-mo','t218'=>'t218','t250'=>'t250','t600'=>'t600','t610'=>'t610','t618'=>'t618','tcl-'=>'tcl-','tdg-'=>'tdg-','telm'=>'telm','tim-'=>'tim-','ts70'=>'ts70','tsm-'=>'tsm-','tsm3'=>'tsm3','tsm5'=>'tsm5','tx-9'=>'tx-9','tagt'=>'tagt','talk'=>'talk','teli'=>'teli','topl'=>'topl','hiba'=>'hiba','up.b'=>'up.b','upg1'=>'upg1','utst'=>'utst','v400'=>'v400','v750'=>'v750','veri'=>'veri','vk-v'=>'vk-v','vk40'=>'vk40','vk50'=>'vk50','vk52'=>'vk52','vk53'=>'vk53','vm40'=>'vm40','vx98'=>'vx98','virg'=>'virg','vite'=>'vite','voda'=>'voda','vulc'=>'vulc','w3c '=>'w3c ','w3c-'=>'w3c-','wapj'=>'wapj','wapp'=>'wapp','wapu'=>'wapu','wapm'=>'wapm','wig '=>'wig ','wapi'=>'wapi','wapr'=>'wapr','wapv'=>'wapv','wapy'=>'wapy','wapa'=>'wapa','waps'=>'waps','wapt'=>'wapt','winc'=>'winc','winw'=>'winw','wonu'=>'wonu','x700'=>'x700','xda2'=>'xda2','xdag'=>'xdag','yas-'=>'yas-','your'=>'your','zte-'=>'zte-','zeto'=>'zeto','acs-'=>'acs-','alav'=>'alav','alca'=>'alca','amoi'=>'amoi','aste'=>'aste','audi'=>'audi','avan'=>'avan','benq'=>'benq','bird'=>'bird','blac'=>'blac','blaz'=>'blaz','brew'=>'brew','brvw'=>'brvw','bumb'=>'bumb','ccwa'=>'ccwa','cell'=>'cell','cldc'=>'cldc','cmd-'=>'cmd-','dang'=>'dang','doco'=>'doco','eml2'=>'eml2','eric'=>'eric','fetc'=>'fetc','hipt'=>'hipt','http'=>'http','ibro'=>'ibro','idea'=>'idea','ikom'=>'ikom','inno'=>'inno','ipaq'=>'ipaq','jbro'=>'jbro','jemu'=>'jemu','java'=>'java','jigs'=>'jigs','kddi'=>'kddi','keji'=>'keji','kyoc'=>'kyoc','kyok'=>'kyok','leno'=>'leno','lg-c'=>'lg-c','lg-d'=>'lg-d','lg-g'=>'lg-g','lge-'=>'lge-','libw'=>'libw','m-cr'=>'m-cr','maui'=>'maui','maxo'=>'maxo','midp'=>'midp','mits'=>'mits','mmef'=>'mmef','mobi'=>'mobi','mot-'=>'mot-','moto'=>'moto','mwbp'=>'mwbp','mywa'=>'mywa','nec-'=>'nec-','newt'=>'newt','nok6'=>'nok6','noki'=>'noki','o2im'=>'o2im','opwv'=>'opwv','palm'=>'palm','pana'=>'pana','pant'=>'pant','pdxg'=>'pdxg','phil'=>'phil','play'=>'play','pluc'=>'pluc','port'=>'port','prox'=>'prox','qtek'=>'qtek','qwap'=>'qwap','rozo'=>'rozo','sage'=>'sage','sama'=>'sama','sams'=>'sams','sany'=>'sany','sch-'=>'sch-','sec-'=>'sec-','send'=>'send','seri'=>'seri','sgh-'=>'sgh-','shar'=>'shar','sie-'=>'sie-','siem'=>'siem','smal'=>'smal','smar'=>'smar','sony'=>'sony','sph-'=>'sph-','symb'=>'symb','t-mo'=>'t-mo','teli'=>'teli','tim-'=>'tim-','tosh'=>'tosh','treo'=>'treo','tsm-'=>'tsm-','upg1'=>'upg1','upsi'=>'upsi','vk-v'=>'vk-v','voda'=>'voda','vx52'=>'vx52','vx53'=>'vx53','vx60'=>'vx60','vx61'=>'vx61','vx70'=>'vx70','vx80'=>'vx80','vx81'=>'vx81','vx83'=>'vx83','vx85'=>'vx85','wap-'=>'wap-','wapa'=>'wapa','wapi'=>'wapi','wapp'=>'wapp','wapr'=>'wapr','webc'=>'webc','whit'=>'whit','winw'=>'winw','wmlb'=>'wmlb','xda-'=>'xda-',))); // check against a list of trimmed user agents to see if we find a match
        $mobile_browser = true; // set mobile browser to true
        $status = 'Mobile matched on in_array';
        break; // break even though it's the last statement in the switch so there's nothing to break away from but it seems better to include it than exclude it
    
      default;
        $mobile_browser = false; // set mobile browser to false
        $status = 'Desktop / full capability browser';
        break; // break even though it's the last statement in the switch so there's nothing to break away from but it seems better to include it than exclude it
  
    } // ends the switch 
  
    // tell adaptation services (transcoders and proxies) to not alter the content based on user agent as it's already being managed by this script
    //  header('Cache-Control: no-transform'); // http://mobiforge.com/developing/story/setting-http-headers-advise-transcoding-proxies
    //  header('Vary: User-Agent, Accept'); // http://mobiforge.com/developing/story/setting-http-headers-advise-transcoding-proxies
  
    // if redirect (either the value of the mobile or desktop redirect depending on the value of $mobile_browser) is true redirect else we return the status of $mobile_browser
    if($redirect = ($mobile_browser==true) ? $mobileredirect : $desktopredirect){
      header('Location: '.$redirect); // redirect to the right url for this device
      exit;
    }else{ 
      return $mobile_browser; // will return either true or false 
    }
  
  } // ends function mobile_device_detect
}
