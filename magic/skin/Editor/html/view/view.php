<?php if(!defined('__MAGIC__')) exit;
$name = $this->name;
$width = $this->Config('width');
$height = $this->Config('height');
$rows = $this->Config('rows');
$cols = $this->Config('cols');
$class = $this->Config('class');
$contents = $this->contents;
?>
<link rel="stylesheet" href="<?php echo $this->path_view('lib/codemirror.css')?>">
<script src="<?php echo $this->path_view('lib/codemirror.js')?>"></script>
<script src="<?php echo $this->path_view('lib/util/closetag.js')?>"></script>
<script src="<?php echo $this->path_view('lib/util/formatting.js')?>"></script>
<script src="<?php echo $this->path_view('lib/util/dialog.js')?>"></script>
<script src="<?php echo $this->path_view('lib/util/searchcursor.js')?>"></script>
<script src="<?php echo $this->path_view('lib/util/search.js')?>"></script>
<script src="<?php echo $this->path_view('keymap/vim.js')?>"></script>
<script src="<?php echo $this->path_view('keymap/emacs.js')?>"></script>
<script src="<?php echo $this->path_view('mode/xml/xml.js')?>"></script>
<script src="<?php echo $this->path_view('mode/javascript/javascript.js')?>"></script>
<script src="<?php echo $this->path_view('mode/htmlmixed/htmlmixed.js')?>"></script>
<link rel="stylesheet" href="<?php echo $this->path_view('theme/ambiance.css')?>">
<!--<link rel="stylesheet" href="<?php echo $this->path_view('doc/docs.css')?>">-->
<link rel="stylesheet" href="<?php echo $this->path_view('lib/util/dialog.css')?>">
<style>
.CodeMirror {
  border:1px solid #d1d1d1;
  font-family:Gulim;
}
.CodeMirror-fullscreen {
  display: block;
  position: fixed;
  top: 0; left: 0;
  width: 100%;
  z-index: 9999;
  background-color:#fff;
}
.activeline {background: #e8f2ff !important;}
.CodeMirror * {
  vertical-align:baseline;
}
.CodeMirror pre {
  line-height:1.2;
}
.CodeMirror-scroll {
  min-height:200px;
  height:auto;
  overflow-y:hidden;
  overflow-x:auto;
}
table#config_editor { width:100%; border-collapse:collapse; table-layout:fixed; margin-bottom:5px; }
table#config_editor tbody td { border:none !important; padding:2px 7px; }
table#config_editor tbody td .label { font-weight:bold; }
</style>

<textarea name="<?php echo $name?>" rows="<?php echo $rows?>" cols="<?php echo $cols?>" class="<?php echo $class?>" style="width:<?php echo $width?>;height:<?php echo $height?>"><?php echo $contents?></textarea>

<table id="config_editor">
  <tbody>
    <tr>
      <td>
        <span class="label">키 입력모드 변경 : </span>
        <input type="radio" name="keyMap" id="default" value="default" checked/>&nbsp;<label for="default">일반</label>
        <input type="radio" name="keyMap" id="vim" value="vim"/>&nbsp;<label for="vim">vim</label>
        <input type="radio" name="keyMap" id="emacs" value="emacs"/>&nbsp;<label for="vim">emacs</label>
      </td>
    </tr>
    <tr>
      <td>
        <span class="label">전체화면 토글 : F11</span>&nbsp;전체화면에서 F11누르면 빠져나올수 있다.
      </td>
    </tr>
    <tr>
      <td>
        <span class="label">코드 자동 포매팅 : </span>
        <input type="button" id="formatting" value="자동포맷"/>&nbsp;들여쓰기가 엉망인 코드를 자동으로 들여쓰기 해줌(드래그 선택-&gt;버튼클릭)
      </td>
    </tr>
    <tr>
      <td>
        <p><span class="label">검색 : </span>Ctrl-F / Cmd-F</p>
        <p><span class="label">다음단어 : </span>Ctrl-G / Cmd-G</p>
        <p><span class="label">이전단어 : </span>Shift-Ctrl-G / Shift-Cmd-G</p>
        <p><span class="label">바꾸기 : </span>Shift-Ctrl-F / Cmd-Option-F</p>
        <p><span class="label">모두바꾸기 : </span>Shift-Ctrl-R / Shift-Cmd-Option-F</p>
      </td>
    </tr>
  </tbody>
</table>

<script>
  $(function(){
    function isFullScreen(cm) {
      return /\bCodeMirror-fullscreen\b/.test(cm.getWrapperElement().className);
    }
    function winHeight() {
      return window.innerHeight || (document.documentElement || document.body).clientHeight;
    }
    function setFullScreen(cm, full) {
      var wrap = cm.getWrapperElement(), scroll = cm.getScrollerElement();
      if (full) {
        wrap.className += " CodeMirror-fullscreen";
        scroll.style.height = winHeight() + "px";
        document.documentElement.style.overflow = "hidden";
      } else {
        wrap.className = wrap.className.replace(" CodeMirror-fullscreen", "");
        scroll.style.height = "";
        document.documentElement.style.overflow = "";
      }
      cm.refresh();
    }
    CodeMirror.connect(window, "resize", function() {
      var showing = document.body.getElementsByClassName("CodeMirror-fullscreen")[0];
      if (!showing) return;
      showing.CodeMirror.getScrollerElement().style.height = winHeight() + "px";
    });
    var editor = CodeMirror.fromTextArea($("textarea[name='<?php echo $name?>']")[0], {
      mode: "text/html",
      tabMode: "indent",
      extraKeys: {
        "'>'": function(cm) { cm.closeTag(cm, '>'); },
        "'/'": function(cm) { cm.closeTag(cm, '/'); },
        "F11": function(cm) {
          if (isFullScreen(cm)) {
            setFullScreen(cm, false);
          } else {
            setFullScreen(cm, !isFullScreen(cm));
          }
        }/*,
        "Esc": function(cm) {
          if (isFullScreen(cm)) setFullScreen(cm, false);
        }
        //*/
      },
      onCursorActivity: function() {
        editor.setLineClass(hlLine, null, null);
        hlLine = editor.setLineClass(editor.getCursor().line, null, "activeline");
      },
      lineWrapping: true,
      wordWrap: true,
      lineNumbers: true
    });
    var hlLine = editor.setLineClass(0, "activeline");
    $("input[type='radio'][name='keyMap']").click(function(){
      editor.setOption("keyMap", $(this).val());
    });
    $("#formatting").click(function(){
      editor.autoFormatRange(editor.getCursor(true), editor.getCursor(false));
    });
    /*
    $("#fullscreen").click(function(){
      editor.setFullScreen(editor.getCursor(true), editor.getCursor(false));
    });
    //*/
  });
</script>
