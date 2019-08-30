<?php
return [
    // +-----------------------------------------------------------------------
    // | 项目设置，各选项具体释义请访问：
    // | https://github.com/AyagawaSeirin/RenewDomainPage/tree/v2.1.0#配置项目/
    // +-----------------------------------------------------------------------

    //跳转目标域名
    "domain" => "rmb.moe",
    //跳转目标的协议头，https://或http://
    "scheme" => "https://",
    //站内链接是否直接跳转
    "ILJ" => true,
    //网站标题
    "title" => "qwq换域名啦",
    //显示文本
    "content" => "更换域名了噢~",
    //图片来源，true为网站内，false为网站外
    "img_from" => true,
    //图片地址，具体规则根据上一个参数所定
    "img" => "img.png",
    //蜘蛛标识
    "spider" => array("baiduspider", "googlebot", "haosouspider", "360spider", "soso", "yahoo", "youdaobot", "yodaobot", "msnbot", "bingbot", "verdantspider", "curl"),
];