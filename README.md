# RenewDomainPage
项目介绍与使用教程：[https://rmb.moe/dev/90.html](https://zwz.moe/dev/90.html "使用教程")

域名更换后，站长们有两个选择。<br>
域名跳转方案，便是站长最头疼的问题。<br>
**全站301重定向**，直接重定向跳转到新域名。这是比较好的解决方案，也对SEO友好。但对于访客而言很难观察到域名的变化，仍然记得是旧域名。<br>
**提示页面跳转**，也就是出现一个提示页面域名已更改，再配上跳转。这样对访客很友好，但对于SEO而言以前的收录链接相当于全部作废了。<br>

而咱的这个跳转页面则是整合了这两种的优点，即有跳转提示页面，又照顾到了SEO问题。<br>

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

### 域名设置
编辑index.php文件，在第15行左右找到$domain变量，将变量值改为您的新域名。默认是zwz.moe，修改掉即可。
```php
$domain = 'example.com';
```
跳转目标默认是HTTPS，如果您的新域名网站暂不支持HTTPS，请修改第18行左右的`$url`变量，将`https://`修改为`http://`:
```php
$url = 'http://' . $domain . $_GET['url'];
```

到此为止就配置完毕了<br>
## 技术问题
### 前端设计
由于咱的前端水平较低，这个跳转页面的设计是模仿的另一个跳转页面：[点击这里](https://redirect.yuzu.im/yuzu.php?domain=rmb.moe "点击这里")<br>
另外，图片的P站ID：65309723<br>
同时还使用了MDUI作为前端框架<br>
## 伪静态规则缺陷
这个伪静态规则十分直接，把所有目录或文件都直接伪静态到了index.php。<br>
这也导致了有个问题，访问其他资源比如根目录的img.png，也会被伪静态到index.php造成图片资源无法正常读取。<br>
所以为了解决这个问题，在index.php的开头检测文件名是否为img.png，若是则读取图片资源并返回。虽然到底是解决了问题，但仍是美中不足的地方。<br>
另外由于各种原因，URL的锚链接和URL参数会丢失，这也是需要解决的问题。<br>
<br>
以上便是目前存在的问题，欢迎各位大佬提供解决方案~<br>
其实无伤大雅啦这些小问题。<br>