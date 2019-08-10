<?php
/**
 * RenewDomainPage
 * @author AyagawaSeirin
 * @version 2.0.0
 * @url https://rmb.moe/
 * @github https://github.com/AyagawaSeirin/RenewDomainPage
 */
//载入配置文件
$config = require_once "./config.php";

//先处理图片伪静态问题
if ($config['img_from'] == true && $_GET['url'] == '/'.$config['img']) {
    @ header("Content-Type:image/png");
    echo file_get_contents($config['img']);
    return;
}
//蜘蛛检测
$UA = $_SERVER['HTTP_USER_AGENT'];
$spider = array("baiduspider", "googlebot", "haosouspider", "360spider", "soso", "yahoo", "youdaobot", "yodaobot", "msnbot", "bingbot", "verdantspider");
$url = $config['scheme'] . $config['domain'] . $_GET['url'];
foreach ($spider as $value) {
    if (stripos($UA, $value) !== false) {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url);
        return;
    }
}

if ($_SERVER['HTTP_REFERER'] == true && $config['ILJ'] == true) {
    $domain_from = parse_url($_SERVER['HTTP_REFERER'])['host'];
    if ($domain_from == $config['domain']) {
        header('Location: ' . $url);
        return;
    }
}
?>
<html>
<head>
    <title><?= $config['title'] ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://cdnjs.loli.net/ajax/libs/mdui/0.4.2/css/mdui.min.css">
    <script src="https://cdnjs.loli.net/ajax/libs/mdui/0.4.2/js/mdui.min.js"></script>
    <!--
    Powered by AyagawaSeirin~
    https://rmb.moe/
    https://github.com/AyagawaSeirin/RenewDomainPage
    -->
</head>
<body>
<style>
    .seirin-card {
        width: 200px;
        height: 320px;
        margin: 20px auto;
    }

    .seirin-card-pic {
        width: 200px;
        height: 200px;
        background-image: url("/<?= $config['img'] ?>");
        background-repeat: no-repeat;
        background-size: 100%;
    }
</style>
<div class="mdui-card seirin-card">
    <div class="seirin-card-pic"/>
    <!--Pixiv: 65309723-->
</div>
<div class="mdui-progress">
    <div class="mdui-progress-determinate mdui-color-pink-accent" style="width: 30%;" id="progress"></div>
</div>
<div class="mdui-typo mdui-text-center">
    <div class="mdui-typo-title" style="margin-top:10px;color:#F93995"><?= $config['content'] ?></div>
    <a href="<?= $url ?>" style="font-size: 30px;"><?= $config['domain'] ?></a>
</div>
<script>
    var progress = document.getElementById("progress");
    var countDown = 100;

    function updateElement() {
        countDown--;
        progress.style.width = ((100 - countDown)).toString() + "%";
        if (countDown == 0) {
            clearInterval(interval);
            window.location.replace("<?=$url?>");
        }
    }

    updateElement();
    var interval = setInterval(function () {
        updateElement()
    }, 50);
</script>
</body>