[TOC]
PHP5.4.0起，PHP内置了Web服务器。对本地开发是个极好的工具，便捷，无需安装WAMP、XAMP或大新那个web服务器，就能在本地调试了。

# 启动服务器

进入项目的根目录下，执行命令
```
php -S localhost:4000   #地址:监听端口
```

或者 直接指定网站根目录
```
php -S localhost:4000 -t D:\website   
```

浏览器打开 localhost:4000,就可以进入到网站浏览应用。

如想停止PHP Web服务器，可关闭终端应用或按Ctrl+C。

# 配置服务器

指定初始化文件。使用专属的php初始配置文件，对内存用量、文件上传、分析或字节码缓存有特殊要求。
```
php -S localhost:4000 -c app/config/php/ini
```

# 路由器脚本

内置服务器无法进行路由解析、转发、重定向等，不支持.htaccess文件。因此很难使用多数流行的PHP框架中的常见的前端控制器。

使用路由器脚本弥补这个遗漏的功能。处理每个HTTP请求前，先执行这个路由器脚本。其作用跟.htaccess文件一样。
```
php -S localhost:4000 router.php
```

路由器脚本 如对图片的请求会返回相应的图片，但对HTML文件的请求会显示“Welcome to PHP”：
```
<?php
// router.php
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
return false;  // serve the requested resource as-is.
} else {
echo "<p>Welcome to PHP</p>";
}
?>
```

# 判断是否为内置的服务器

```php
<?php
    if(php_sapi_name() === 'cli_server'){
        //PHP内置服务器
    }else{
        //其他Web服务器
    }

```

缺点：不能在生产环境使用，只能本地开发使用。
- 性能差。一次只能处理一个请求；
- 支持少量的媒体类型；
- 支持少量的URL重写规则。
