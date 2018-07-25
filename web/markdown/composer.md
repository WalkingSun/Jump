[TOC]

composer 遵循PSR准则，解决安装依赖。

# 安装（linux）
```
#下载安装脚本 － composer-setup.php － 到当前目录。
php -r "copy('https://install.phpcomposer.com/installer', 'composer-setup.php');"

#执行安装过程
php composer-setup.php

#删除安装脚本。
php -r "unlink('composer-setup.php');"
#全局安装
sudo mv composer.phar /usr/local/bin/composer

#改为中国全量镜像（项目composer.josn 尾部添加）
"repositories": {
        "packagist": {
            "type": "composer",
            "url": "https://packagist.phpcomposer.com"
        }
    }

```

项目目录下执行安装依赖：
```
composer install
```


安装单个组件：
```
composer require guzzlehttp/guzzle;     #http处理
composer require league/csv;            #csv文件处理
#组件安装到 verdor/ 目录中，添加记录到composer.josn和composer.lock文件中。
```

# composer.lock 文件
列出项目中所有的PHP组件，以及组建的具体版本号。其实就锁定了项目，让项目只能使用具体版本的PHP组件。
- 优点
    - 版本统一，代码一致，易于管理
    - 降低组件版本差异导致缺陷的风险

- 缺点
    - 不会安装最新的版本
    - 若要更新执行 composer update

# composer.josn 文件
信息查找、安装和自动加载PHP组件。


# 自动加载PHP组件
composer下载PHP组件会为项目的所有依赖创建一个符合PSR标准的自动加载器：
```
<?php
require 'vendor/autoload.php';
```
其实就是创建 autoload.php的PHP文件，保存在verdor/下。
![image](http://images.cnblogs.com/cnblogs_com/followyou/1251481/o_TIM%e5%9b%be%e7%89%8720180723202014.jpg)

# 组件包库地址
https://packagist.org/

# 实例
 扫描一个csv文件中的URL，找出死链。

实现：
[扫描CSV文件,查找死链](https://github.com/WalkingSun/Jump/blob/master/commands/ScanController.php)

[csv文件](https://github.com/WalkingSun/Jump/blob/master/commands/url.csv)

执行
```
php ./yii scan/index --argv=url.csv
```
依次打印出 死链url。

![image](http://images.cnblogs.com/cnblogs_com/followyou/1251481/o_TIM%e5%9b%be%e7%89%8720180724165203.png)

# composer私有仓库

![image](http://images.cnblogs.com/cnblogs_com/followyou/1251481/o_TIM%e6%88%aa%e5%9b%be20180724172937.png)

![image](http://images.cnblogs.com/cnblogs_com/followyou/1251481/o_TIM%e6%88%aa%e5%9b%be20180724173753.png)

创建组件，基于版本控制，托管github；注册Packagist，Submit Packagist->Repository URL->Check，提交到Packagist 即建立组件。