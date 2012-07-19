<?php if(!defined('__MAGIC__')) exit;
$v = $this->Sql('fetch_by_id', GV::Id('mb_id'));
?>

<div class="sub_title"><h2>비밀번호 찾기 질문</h2></div>

<div id="member_view">
  <div id="find_pw">
    <img class="icon" src="<?php echo $this->path_img('icon_secret.gif')?>" alt="find_pw"/>
    <p>비밀번호를 찾으시려면 아래 질문에 답하세요.</p>
  <form method="post" action="<?php echo $this->Link('find_pw_question_check')?>"> 
  <input type="hidden" name="mb_no" value="<?php echo $v['mb_no']?>"/>
  <table>
  <tbody>
    <tr>
      <th>질문</th>
      <td><?php echo $v['mb_question']?></td>
    </tr>
    <tr>
      <th>답변</th>
      <td><input type="text" class="require" alt="답변" name="mb_answer"/></td>
    </tr>
  </tbody>
  </table>
  <input type="image" src="<?php echo $this->path_img('btn_ok.gif')?>" alt="확인"/>
  </form>

  </div>
</div>
