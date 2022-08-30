<?php
if(isset($_POST['title'])&&$_POST['title']!=""&$_POST['body']!=""){
$text = file_get_contents('todo.txt');
$strarr = explode(';',$text);
$title = base64_encode($_POST['title']);
$body = base64_encode($_POST['body']);
$push = $title.':::'.$body;
array_push($strarr,$push);
$text = implode(';',$strarr);
file_put_contents("todo.txt",$text);
header('location: index.php');
}
else{
include('header.php');
echo '<div class="mdui-card">
<form name="create" action="" method="post">
  <div class="mdui-card-primary">
    <div class="mdui-card-primary-title">所有任务</div>
  </div>
  <div class="mdui-card-content">
  <div class="mdui-textfield">
  <i class="mdui-icon material-icons">bookmark</i>
  <label class="mdui-textfield-label">任务标题</label>
  <input name="title" class="mdui-textfield-input" type="text"/>
</div>
  <div class="mdui-textfield mdui-textfield-floating-label">
  <i class="mdui-icon material-icons">edit</i>
  <label class="mdui-textfield-label">任务内容</label>
  <textarea name="body" class="mdui-textfield-input"></textarea>
</div>
  </div>
  <div class="mdui-card-actions">
    <button class="mdui-btn mdui-ripple">确认</button>
  </div>
</form>
</div>';
include('footer.php');
}
?>