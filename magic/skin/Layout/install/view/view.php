<?php if(!defined('__MAGIC__')) exit;
$head = PageElement::Inst('head')->SetConfig('title','0','매직보드 설치')->html();
include $this->path_controller('install_script/config.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><?php echo $head?></head>
<body>

<div id="top">
<h1><img src="<?php echo $this->path_img('logo.png')?>"></h1>
</div><!-- #top -->

<form method="post" action="<?php echo $this->Link('install')?>">
<div id="tabs" class="ui-form">
	<ul>
		<li><a href="#tab-1">라이센스 동의</a></li>
		<li><a href="#tab-2">데이터베이스 정보</a></li>
		<li><a href="#tab-3">관리자 정보</a></li>
		<li><a href="#tab-4">홈페이지 기본정보</a></li>
		<li><a href="#tab-5">설치</a></li>
	</ul>
	<div id="tab-1">
		<p class="warn">라이센스(License) 내용을 반드시 확인하십시오.</p>
		<div id="license">
		<textarea rows="14" readonly><?php echo implode('', file(Path::license()))?></textarea> 
		</div>
		<div class="tip"><p>설치를 원하시면 위 내용에 동의하셔야 합니다.</p></div>
		<p><input type="checkbox" name="agree" id="agree" value="1"/>&nbsp;<label for="agree">위 내용을 숙지 하였으며 내용에 동의합니다.</label></p>
		<div class="buttonset right">
		<input type="button" class="button hover next" value="다음" onclick="$('#tabs').tabs('select', 1)"/>
		</div>
	</div>
	<div id="tab-2">
		<p class="warn">데이터베이스 접속 정보를 정확히 입력 하세요.</p>
		<table width="100%" class="basic_table">
		<colgroup>
			<col width="100px"/>
			<col/>
		</colgroup>
		<tbody>
			<tr> 
				<th>Host</th>
				<td class="left">
				<input type="text" name="mysql_host" value="<?php echo $cfg['dbinfo']['host']?>"/>
				<label>※ 대부분의 홈페이지는 localhost를 사용합니다.</label>
				</td>
			</tr>
			<tr> 
				<th>User</th>
				<td class="left">
				<input type="text" name="mysql_user" value="<?php echo $cfg['dbinfo']['user']?>"/>
				<label>※ 일반 호스팅에서는 FTP접속 [아이디]와 동일합니다.</label>
				</td>
			</tr>
			<tr> 
				<th>Password</th>
				<td class="left">
				<input type="password" name="mysql_pass" value="<?php echo $cfg['dbinfo']['password']?>"/>
				<label>※ 일반 호스팅에서는 FTP접속 [비밀번호]와 동일합니다.</label>
				</td>
			</tr>
			<tr> 
				<th>DB</th>
				<td class="left">
				<input type="text" name="mysql_db" value="<?php echo $cfg['dbinfo']['db']?>"/>
				<label>※ 일반 호스팅에서는 FTP접속 [아이디]와 동일합니다.</label>
				</td>
			</tr>
			<tr> 
				<th>DB Prefix</th>
				<td class="left">
				<input type="text" name="db_prefix" value="<?php echo $cfg['dbinfo']['prefix']?>"/>
				<label>※ 데이터테이블의 접두어 입니다. 보통은 그대로 사용하시면 됩니다.</label>
				</td>
			</tr>
		</tbody>
		</table>
		<div class="tip">
			<p>
			<strong>&lt;주의 !!&gt;</strong> 실제 운영할 사이트에 설치할 때는 모든 아이디/비번에 기본으로 제시된 아이디/비번을 절대 사용하지 마시고 <br />
			직접 별도의 아이디/비번을 사용하시기를 [강력히!!] 권장합니다. <br />
			</p>
		</div>
		<div class="buttonset right">
		<input type="button" class="button" value="이전" onclick="$('#tabs').tabs('select',0)"/><input type="button" class="button hover" value="다음" onclick="$('#tabs').tabs('select',2)"/>
		</div>
	</div>
	<div id="tab-3">
		<p class="warn">사이트 최고관리자의 정보입니다.</p>
		<table width="100%" class="basic_table">
		<colgroup>
			<col width="100px"/>
			<col/>
		</colgroup>
		<tbody>
			<tr> 
				<th>아이디</th>
				<td class="left">
				<input type="text" name="admin_id" value="<?php echo $cfg['admin_info']['id']?>"/>
				<label>※ 보통 admin을 사용하지만 보안을위해 다른 아이디를 사용하실것을 추천합니다.</label>
				</td>
			</tr>
			<tr> 
				<th>비밀번호</th>
				<td class="left">
				<input type="password" name="admin_pass" value="<?php echo $cfg['admin_info']['password']?>"/>
				<label>※ 로그인시 패스워드를 입력하세요.</label>
				</td>
			</tr>
			<tr> 
				<th>비밀번호확인</th>
				<td class="left">
				<input type="password" name="admin_pass_confirm" value="<?php echo $cfg['admin_info']['password_confirm']?>"/>
				<label>※ 패스워드를 한번더 입력하세요.</label>
				</td>
			</tr>
			<tr> 
				<th>이름</th>
				<td class="left">
				<input type="text" name="admin_name" value="<?php echo $cfg['admin_info']['name']?>"/>
				<label>※ 관리자명을 설정합니다.</label>
				</td>
			</tr>
		</tbody>
		</table>
		<div class="tip">
			<p><strong>&lt;주의 !!&gt;</strong> 최고관리자 정보는 절대 분실하지 마시기 바랍니다. 분실하면 찾는 절차가 복잡합니다.</p>
		</div>
		<div class="buttonset right">
		<input type="button" class="button" value="이전" onclick="$('#tabs').tabs('select',1)"/><input type="button" class="button hover" value="다음" onclick="$('#tabs').tabs('select',3)"/>
		</div>
	</div>
	<div id="tab-4">
		<p class="warn">홈페이지의 기본 정보입니다.</p>
		<table width="100%" class="basic_table">
		<colgroup>
			<col width="100px"/>
			<col/>
		</colgroup>
		<tbody>
			<tr> 
				<th>홈페이지명</th>
				<td class="left">
				<input type="text" name="hp_title" value="<?php echo $cfg['hp_info']['title']?>"/>
				<label>※ 홈페이지 이름입니다 추후에 수정가능합니다.</label>
				</td>
			</tr>
			<tr> 
				<th>초기메뉴생성</th>
				<td class="left">
					<p>초기 메뉴를 생성합니다.</p>
					<p>초기메뉴는 설치스크립트에 정의되어 있는 메뉴설정 입니다.</p>
					<p>메뉴는 설치후 수정가능합니다.(현재 폼에서는 수정 불가합니다)</p>
				</td>
			</tr>
		</tbody>
		</table>
		<div class="buttonset right">
		<input type="button" class="button" value="이전" onclick="$('#tabs').tabs('select',2)"/><input type="button" class="button hover" value="다음" onclick="$('#tabs').tabs('select',4)"/>
		</div>
	</div>
	<div id="tab-5">
		<p class="warn">설치를 시작합니다.</p>
		<div class="ui-corner-all" style="border:1px solid #ccc;padding:5px">
		<h3>설치될 데이터베이스 테이블 목록</h3>
		<ul>
		<?php foreach($cfg['tables'] as $k=>$v) {?>
			<li><?php echo $k?></li>
		<?php }?>
		</ul>
		</div>
		<div class="tip">
		<p>입력하신 정보가 정확하십니까?</p>
		<p>준비가 완료되었으면 아래 설치 버튼을 클릭하세요.</p>
		</div>
		<div class="buttonset right">
		<input type="button" class="button" value="이전" onclick="$('#tabs').tabs('select',3)"/><input type="submit" class="button hover" value="설치"/>
		</div>
	</div>
</div><!-- #tabs -->
</form>
<div id="footer">
<address>Copyright (c) Since 2009-2012. All rights reserved by <a class="popup" href="http://www.webmona.com/">Webmona.</a></address>
</div>
</body>
</html>
