<?php
if ($_GET['mode']=="light" or $_GET['mode']=="dark") {
    $mode = $_GET['mode'];
}
else if (isset($_COOKIE['mode']) && $_COOKIE['mode']!="") {
    $mode = $_COOKIE['mode'];
}
else {
    $mode = "light";
}
if ($mode == "light") {
    $layout = "light";
    $id = "7";
    $link = "dark";
    setcookie("mode","light",time()+31536000);
}
else {
    $layout = "dark";
    $id = "4";
    $link = "light";
    setcookie("mode","dark",time()+31536000);
}
?>
<!doctype html>
<html lang="zh-cmn-Hans">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <meta name="renderer" content="webkit" />
    <meta name="force-rendering" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css" />
    <title>Crillerium Todo</title>
</head>

<body
    class="mdui-drawer-body-left mdui-appbar-with-toolbar mdui-theme-primary-indigo mdui-theme-accent-pink mdui-bottom-nav-fixed mdui-theme-layout-<?php echo $layout; ?>">
    <header class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-theme">
            <a href="javascript:;" class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#left-drawer', swipe: true}">
                <i class="mdui-icon material-icons">menu</i>
            </a>

            <span class="mdui-typo-title">Todo</span>
            <div class="mdui-toolbar-spacer"></div>
            <a href="?mode=<?php echo $link; ?>" class="mdui-btn mdui-btn-icon">
                <i class="mdui-icon material-icons">brightness_<?php echo $id; ?></i>
            </a>
            <a href="javascript:;" class="mdui-btn mdui-btn-icon" mdui-menu="{target: '#example-attr'}">
                <i class="mdui-icon material-icons">more_vert</i>
            </a>
            <ul class="mdui-menu" id="example-attr">
                <li class="mdui-menu-item">
                    <a href="index.php" class="mdui-ripple">首页</a>
                </li>
                <li class="mdui-menu-item">
                    <a href="index.php?em=pty" class="mdui-ripple">清空任务</a>
                </li>
                <li class="mdui-menu-item">
                    <a href="push.php" class="mdui-ripple">推送设置</a>
                </li>
            </ul>
        </div>
    </header>
    <div class="mdui-container">
        <div class="mdui-drawer" id="left-drawer">
            <ul class="mdui-list">
                <a href="index.php" class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">home</i>
                    <div class="mdui-list-item-content">首页</div>
                </a>
                <a href="index.php?em=pty" class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">library_add</i>
                    <div class="mdui-list-item-content">清空任务</div>
                </a>
                <a href="push.php" class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">settings</i>
                    <div class="mdui-list-item-content">推送设置</div>
                </a>
            </ul>
        </div>
        </br>