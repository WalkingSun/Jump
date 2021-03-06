[TOC]

# php.ini
PHP解释器在 php.ini 文件中配置和调优。web和cli使用的路径不同，如果必要我觉得可以调成一样或者共用。路径一般都在/etc下。

# 内存
考虑每个PHP进程要使用多少内存？确定分配给PHP多少内存？

- 共能分配给PHP多少内存?
首先,确定能分配给PHP多少系统内存。例如,我可能会使用一个 Linode虚拟设备,这个设备一共有2GB内存。可是,这台设备中可能还有其他进程(例如,nginx、 MySQL或 memcache),而这些进程也要消耗内存。我觉得留512MB给PHP就足够了。

- 单个PHP进程平均消耗多少内存?
然后,确定单个PHP进程平均消耗多少内存。为此,我要监控进程的内存使用
量。如果使用命令行,可以执行top命令,查看运行中的进程的实时统计数据。除
此之外,还可以在PHP脚本的最后调用 memory_get_peak usage()函数,输出当前
脚本消耗的最大内存量。不管使用哪种方式,都要多次运行同一个PHP脚本,然后
取内存消耗量的平均值。我发现PHP进程一般会消耗5-20MB内存(具体消耗可能
有差异)。如果要上传文件、处理图像,或者运行的是内存集中型应用,得到的平
均值显然会高些。

- 能负担得起多少个 PHP-FPM进程?
假设我给PHP分配了512MB内存,每个PHP进程平均消耗15MB内存,我拿内存总
量除以每个PHP进程消耗的内存量,从而确定我能负担得起34个 PHP-FPM进程。这
是个估值,应该再做实验,得到精确值。

- 有足够的系统资源吗?
最后我会问自己,确信有足够的系统资源运行PHP应用并处理预期的流量吗?如果
答案是肯定的,那太好了。如果答案是否定的,就需要升级服务器,添加更多的内
存,然后再回到第一个问题。

查了测试环境
```
#查询内存
[root@localhost data]# grep MemTotal /proc/meminfo
MemTotal:        1884808 kB
```
总内存：1884808/1024*1024 = 1.8

配置内存：
```
memory_limit = 128M
```
负担PHP-FPM进程：128M/10M（平均耗用内存） = 13，大约13个PHP-FPM进程。

# Zend OPcache
确定分配内存后，配置PHP的Zend OPcache扩展，来缓存字节码。

如：
```
opcache. memory consumption=64
opcache interned strings buffer 16
opcache. max accelerated files=4000
opcache. validate timestamps =1
opcache revalidate fred=0
opcache. fast shutdown=1
```

- opcache. memory consumption =64
为操作码缓存分配的内存量(单位是MB)。分配的内存量应该够保存应用中所有PHP脚本编译得到的操作码。如果是小型PHP应用,脚本数较少,可以设为较低的值,例如16MB;如果是大型PHP应用,有很多脚本,那就使用较大的值,例如64MB。

- opcache interned strings buffer =16
用来存储驻留字符串( interned string)的内存量(单位是MB)。那么驻留字符串是什么呢?我首先也会想到这个问题。PHP解释器在背后会找到相同字符串的多个实例,把这个字符串保存在内存中,如果再次使用相同的字符串,PHP解释器会使用指针。这么做能节省内存。默认情况下,PHP驻留的字符串会隔离在各个PHP进程中。这个设置能让PHP-FPM进程池中的所有进程把驻留字符串存储到共享的缓冲区中,以便在 PHP-FPM进程池中的多个进程之间引用驻留字符串。这样能节省
更多内存。这个设置的默认值是4MB,不过我喜欢设为16MB。

- opcache interned strings buffer =16
用来存储驻留字符串( interned string)的内存量(单位是MB)。那么驻留字符串
是什么呢?我首先也会想到这个问题。PHP解释器在背后会找到相同字符串的多个
实例,把这个字符串保存在内存中,如果再次使用相同的字符串,PHP解释器会使
用指针。这么做能节省内存。默认情况下,PHP驻留的字符串会隔离在各个PHP进
程中。这个设置能让 PHP-FPM进程池中的所有进程把驻留字符串存储到共享的缓
冲区中,以便在 PHP-FPM进程池中的多个进程之间引用驻留字符串。这样能节省
更多内存。这个设置的默认值是4MB,不过我喜欢设为16MB。

- opcache. max accelerated files=4000
操作码缓存中最多能存储多少个PHP脚本。这个设置的值可以是200到100000之间
的任何数。我使用的是4000。这个值一定要比PHP应用中的文件数量大

- opcache.validate timestamps=1
这个设置的值为1时,经过一段时间后PHP会检查PHP脚本的内容是否有变化。检
查的时间间隔由 apache, revalidate freq设置指定。如果这个设置的值为0,PHP
不会检査PHP脚本的内容是否有变化,我们必须自己动手清除缓存的操作码。我建
议在开发环境中设为1,在生产环境中设为0。

- opcache. revalidate freq 0
==设置PHP多久(单位是秒)检查一次PHP脚本的内容是否有变化==。缓存的好处是,
不用每次请求都重新编译PHP脚本。这个设置用于确定在多长时间内认为操作码
缓存是新的。在这段时间之后,PHP会检查PHP脚本的内容是否有变化。如果有变
化,PHP会重新编译脚本,再次缓存。我使用的值是0秒。仅当 apache. validate
timestamps设置的值为1时,这么设置会在每次请求时都重新验证PHP文件。因
此,在开发环境中,每次请求都会重新验证PHP文件(这是好事)。这个设置在生
产环境中没有任何意义,因为生产环境中 opcache. validate timestamps的值始终
为0。

- opcache. fast shutdown =1
这么设置能让操作码使用更快的停机步骤,把对象析构和内存释放交给Zend
Engine的内存管理器完成。这个设置缺少文档,你只需知道要把它设为1。

# 文件上传
```
file_uploads = 1
upload_macx_filesize = 10M  #文件最大空间限制，调整幅度不能过高，上传文件过大，Web服务器会抱怨HTTP请求主体太大。
max_file_uploads = 3        #允许单次上传文件数
```

# 最长执行时间
```
max_execution_time = 5
```

PHP脚本可调用函数 set_time_limit() 设置。

web脚本时间不宜过长，web服务器会超时。如时间过长，可交由任务单独运行。

建议:PHP中的exec()函数调用bash的at命令。这个命令的作用是派生单独的==非阻塞进
程==,不耽误当前的PHP进程。使用PHP中的exec()函数时,要使用 escapeshellarg()函数
(hp/ php. net/manuallfunction escapeshellarg php)转义shell参数。

假设我们要生成报告,并把结果制作成PDF文件。这个任务可能要花10分钟才能完成,
而我们肯定不想让PHP请求等待10分钟。我们应该单独编写一个PHP文件,假如将其命
名为 create-report,php,让这个文件运行10分钟,最后生成报告。其实,web应用只需几
毫秒就能派生一个单独的后台进程,然后返回HTTP响应,如下所示:
```
<?php
exec(echo "create-report php"I at now);
echo" Report pending…’;
```
creare- report.php脚本在单独的后台进程中运行,运行完毕后可以更新数据库,或者通
过电子邮件把报告发给收件人。可以看出,我们完全没有理由让长时间运行的任务拖延
PHP主脚本,影响用户体验。

太多脚本服务，使用专门的作业队列或许更好。

# 处理会话
大型应用或者多机器，不宜存贮，一种是占用文件I/O，降低读写速度，一种是无法多机器公用。存贮与内存中，解决此类问题。可使用memcache、redis，即使空间不够，也可扩展。

```
session.save_handler = 'redis';
session.save_path = '127.0.0.1:11211'
```

或者使用PHP的函数
```
session_set_save_handler ( callable $open , callable $close , callable $read , callable $write , callable $destroy , callable $gc [, callable $create_sid [, callable $validate_sid [, callable $update_timestamp ]]] )
```

# 缓冲输出
缓冲区的作用就是,把输入或者输出的内容先放进内存,而不显示或者读取.

缓冲区最本质的作用就是,==协调高速CPU和相对缓慢的IO设备(磁盘等)的运作==.

当执行PHP的时候,如果碰到了echo print_r之类的会输出数据的代码,PHP就会将要输出的数据放到PHP自身的缓冲区,等待输出.

echo、print => php output_buffering => webServer buffer => browser buff => browser display

　　即：脚本输出 => php的缓冲区设置 => 系统的缓冲区设置(apache、nginx) => 浏览器的缓冲区设置 => 显示给用户
　　
推荐配置：
```
output_buffering = 4096         #缓冲区字节大小
implicit_flush = false
```

使用场景：
- PHP断点续传
- 静态文件缓存

缓冲区相关函数：ob_*

# 真实路径缓存
对文件的真实路径缓存，并且include_once、require_once可用到。

这样每次包含或导入文件时就无需不断搜索包含路
径了。这个缓存叫真实路径缓存( realpath cache)。如果运行的是大型PHP文件(例如
Drupal和 Composer组件等),使用了大量文件,增加PHP真实路径缓存的大小能得到更
好的性能
真实路径缓存的默认大小为16k。这个缓存所需的准确大小不容易确定,不过可以使用
个小技巧。首先,增加真实路径缓存的大小,设为特别大的值,例如256k。然后,在
个PHP脚本的末尾加上 print_ r( realpath cache size()};,输出真实路径缓存的真
正大小。最后,把真实路径缓存的大小改为这个真正的值。我们可以在 phpin件中设
置真实路径缓存的大小:
```
realpath cache size= 64k
```

服务器马力十足。