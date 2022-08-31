<?php
if($_GET['em']=="pty"){
file_put_contents("todo.txt","");
header('location: index.php');
}
if(isset($_GET['do'])&&$_GET['do']!=""){
$text = file_get_contents('todo.txt');
$strarr = explode(';',$text);
unset($strarr[$_GET['do']]);
$text = implode(';',$strarr);
file_put_contents("todo.txt",$text);
header('location: index.php');
}
include('header.php');
$text = file_get_contents("todo.txt");
$strarr = explode(';',$text);
echo '<div class="mdui-card">
  <div class="mdui-card-primary">
    <div class="mdui-card-primary-title">所有任务</div>
  </div>
  <div class="mdui-card-content">
  <div class="mdui-panel mdui-panel-gapless" mdui-panel>';
for($i=0;$i<count($strarr);$i++){
if(false !== strstr($strarr[$i],":::")){
$arr = explode(':::',$strarr[$i]);
echo '<div class="mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">'.nl2br(base64_decode($arr[0],true)).'</div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
    <div class="mdui-panel-item-body">
      <p>'.base64_decode($arr[1],true).'</p>
      <div class="mdui-panel-item-actions">
        <button class="mdui-btn mdui-ripple" mdui-panel-item-close>收起</button>
        <a href="?do='.$i.'" class="mdui-btn mdui-ripple">完成</a>
      </div>
    </div>
  </div>';
}
}
echo '</div>
  </div>
  <div class="mdui-card-actions">
    <a href="create.php" class="mdui-btn mdui-ripple">新建</a>
  </div>
</div>';
include('footer.php');
?>