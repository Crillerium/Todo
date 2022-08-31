<?php
if(isset($_POST['submit'])&&$_POST['submit']=='确认'){
    if(isset($_POST['enable'])&&$_POST['enable']=="on"){
        file_put_contents('.cache','checked');
        header('location: push.php');
    }
    else{
        file_put_contents('.cache','');
        header('location: push.php');
    }
}
$type = file_get_contents('.cache');
include('header.php');
echo '<div class="mdui-card">
<form name="create" action="" method="post">
  <div class="mdui-card-primary">
    <div class="mdui-card-primary-title">推送设置</div>
  </div>
  <div class="mdui-card-content">
  <ul class="mdui-list">

  <li class="mdui-list-item mdui-ripple">
    <i class="mdui-list-item-icon mdui-icon material-icons">network_wifi</i>
    <div class="mdui-list-item-content">启用微信推送</div>
    <label class="mdui-switch">
      <input name="enable" type="checkbox" '.$type.'/>
      <i class="mdui-switch-icon"></i>
    </label>
  </li>

</ul>
  </div>
  <div class="mdui-card-actions">
    <input name="submit" type="submit" class="mdui-btn mdui-ripple" value="确认">
  </div>
</form>
</div>';
include('footer.php');
?>