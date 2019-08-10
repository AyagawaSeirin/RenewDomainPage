# RenewDomainPage
项目介绍与使用教程：[https://rmb.moe/dev/90.html](https://zwz.moe/dev/90.html "使用教程")

域名更换后，站长们有两个选择。<br>
域名跳转方案，便是站长最头疼的问题。<br>
**全站301重定向**，直接重定向跳转到新域名。这是比较好的解决方案，也对SEO友好。但对于访客而言很难观察到域名的变化，仍然记得是旧域名。<br>
**提示页面跳转**，也就是出现一个提示页面域名已更改，再配上跳转。这样对访客很友好，但对于SEO而言以前的收录链接相当于全部作废了。<br>

而咱的这个跳转页面则是整合了这两种的优点，即有跳转提示页面，又照顾到了SEO问题。<br>
## 版本记录
master分支为最新稳定版本，dev分支为开发进度，其他分支为各个版本。<br>
[V1.0.0](https://github.com/AyagawaSeirin/RenewDomainPage/tree/v1.0.0 "V1.0.0") - 2019.7.19<br>
[V2.0.0](https://github.com/AyagawaSeirin/RenewDomainPage/tree/v2.0.0 "V2.0.0") - 2019.8.11<br>
## 介绍
为了兼顾访客体验和SEO问题，我做了这个东西。<br>
[点击这里效果预览](https://www.pplin.cn/ "点击这里效果预览")<br>
检测UA是否为搜索引擎蜘蛛爬虫，若是则直接301重定向，达到优化SEO的目的。<br>
其他则为普通访客，显示倒计时跳转提示页面。<br>
这便是核心功能，再搭配上伪静态处理，网站下所有链接都能跳转到新域名的对应链接。<br>
## 使用
### 安装
项目地址：[https://github.com/AyagawaSeirin/RenewDomainPage](https://github.com/AyagawaSeirin/RenewDomainPage "https://github.com/AyagawaSeirin/RenewDomainPage")<br>
将所有文件下载放入到网站根目录即可。<br>
### 伪静态配置
具体如何设置伪静态不再赘述，这里仅贴出伪静态规则。<br>
Apache:
```APACHE
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule ^(.*?)$ /index.php?url=$1
</IfModule>
```
Nginx:
```NGINX
rewrite ^(.*?)$ /index.php?url=$1;
```
>项目已经配置好了Apache伪静态规则在.htaccess文件内，如果您的Apache支持使用.htaccess文件配置伪静态，则不需要再手动配置了。

### 配置项目
编辑config.php文件，即可快捷配置项目。<br>
**只有domain和scheme参数需要您自己配置，其他参数保持默认即可，若您需要深度自定义可配置其他参数。**<br>
**domain：跳转目标域名。<br>
scheme：跳转目标的协议头，https://或http://<br>**
ILJ：站内链接是否直接跳转，假如访问来源是站内（目标域名），则直接跳转不显示倒计时页面。因为更换域名后网站可能有些链接没来得及更改域名，每次访问都提示会影响访客体验。<br>
title：网站标题。<br>
content：网站内容文本。<br>
img_from：图片来源，true为图片在该网站（跳转提示站）内，false为图片为网站外的链接。<br>
img：图片路径，若参数img_from为true则输入相对于网站根目录路径，第一个斜杠不需要输入。若参数img_from为false则输入图片绝对路径，不能为本跳转站图片。

到此为止就配置完毕了<br>
## 技术问题
### 前端设计
由于咱的前端水平较低，这个跳转页面的设计是模仿的另一个跳转页面：[点击这里](https://redirect.yuzu.im/yuzu.php?domain=rmb.moe "点击这里")<br>
另外，默认图片的P站ID：65309723<br>
同时还使用了MDUI作为前端框架<br>
## 伪静态规则缺陷
这个伪静态规则十分直接，把所有目录或文件都直接伪静态到了index.php。<br>
这也导致了有个问题，访问其他资源比如根目录的img.png，也会被伪静态到index.php造成图片资源无法正常读取。<br>
所以为了解决这个问题，在index.php的开头检测文件名是否为img.png，若是则读取图片资源并返回。虽然到底是解决了问题，但仍是美中不足的地方。<br>
另外由于各种原因，URL的锚链接和URL参数会丢失，这也是需要解决的问题。<br>
<br>
以上便是目前存在的问题，欢迎各位大佬提供解决方案~<br>
其实无伤大雅啦这些小问题。<br>