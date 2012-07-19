<?php if(!defined('__MAGIC__')) exit; ?>

<!-- 비밀번호확인 -->
<form method="post" action="<?php echo Url::Get('', GV::check)?>">

<div id="check_password">
  <div class="icon"><img src="<?php echo $this->path_img('icon_secret.gif')?>" alt="lock"/></div>
  <p>게시물을 수정하려면 비밀번호를 입력하세요.</p>

  <table class="">
    <tbody>
    <tr>
      <th>비밀번호</th>
      <td class="center"><input type="password" name="password" size="8" title="글작성시 입력한<br/>비밀번호를 입력하세요"/></td>
    </tr>
    </tbody>
  </table>

  <input type="image" class="btn_ok" src="<?php echo $this->path_img('btn_ok2.gif')?>" alt="확인"/>
</div>

</form>
