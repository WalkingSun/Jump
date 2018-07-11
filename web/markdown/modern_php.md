[TOC]
PHP发展这么多年，技术、架构都已经革新，了解现代PHP很重要，最近在看Model PHP这本书，系统的了解下PHP相关的概念。

#  性状 Trait
是类的部分实现（即常量、属性和方法），可以混入一个或多个现有的php类中。
性状有两个作用：表明类可以做什么（接口）；提供模块化实现（像是类）。

比如说两个无关的类需要拥有一个共同的方法，继承、接口都不太合理（一是属性不同；二是代码重复），使用性状可以共同使用某个方法。

举例 汽车和快递员都可能都需要查询地理位置
```
trait Geocodable{
    protected $address;

    protected $geocoder

    //获取经纬度
    public function getLatitude(){

    }

}
```

使用性状：
```
<?php
Class Car{
    use Geocodable;

    //类的实现
    ...
}

```


# 生成器
生成器提供了一种更容易的方法来实现简单的对象迭代，相比较定义类实现 Iterator 接口(正常迭代)的方式，性能开销和复杂性大大降低。

生成器允许你在 foreach 代码块中写代码来迭代一组数据而不需要在内存中创建一个数组, 那会使你的内存达到上限，或者会占据可观的处理时间。相反，你可以写一个生成器函数，就像一个普通的自定义函数一样, 和普通函数只返回一次不同的是, 生成器可以根据需要 yield 多次，以便生成需要迭代的值。

生成器根据需求计算出要迭代的值；及时计算并产出后续值，不占用宝贵的内存资源。

一个简单的例子就是使用生成器来重新实现 range() 函数。 标准的 range() 函数需要在内存中生成一个数组包含每一个在它范围内的值，然后返回该数组, 结果就是会产生多个很大的数组。 比如，调用 range(0, 1000000) 将导致内存占用超过 100 MB。

做为一种替代方法, 我们可以实现一个 xrange() 生成器, 只需要足够的内存来创建 Iterator 对象并在内部跟踪生成器的当前状态，这样只需要不到1K字节的内存。

Example #1 将 range() 实现为生成器
```php
<?php
function xrange($start, $limit, $step = 1) {
    if ($start < $limit) {
        if ($step <= 0) {
            throw new LogicException('Step must be +ve');
        }

        for ($i = $start; $i <= $limit; $i += $step) {
            yield $i;
        }
    } else {
        if ($step >= 0) {
            throw new LogicException('Step must be -ve');
        }

        for ($i = $start; $i >= $limit; $i += $step) {
            yield $i;
        }
    }
}

/*
 * 注意下面range()和xrange()输出的结果是一样的。
 */

echo 'Single digit odd numbers from range():  ';
foreach (range(1, 9, 2) as $number) {
    echo "$number ";
}
echo "\n";

echo 'Single digit odd numbers from xrange(): ';
foreach (xrange(1, 9, 2) as $number) {
    echo "$number ";
}
?>
```
以上例程会输出：
```
Single digit odd numbers from range():  1 3 5 7 9
Single digit odd numbers from xrange(): 1 3 5 7 9
```

想象下处理斐波那契数列或者迭代流资源，假设处理一个4GB的csv文件，而虚拟服务器只允许使用1GB内存，如果整个加载到内存中，服务器就崩了，而用生成器一次只会为csv一行分配内存。
```
<?php
    function getRows( $file ){
        $handle = fopen($file,'rb');
        if( $handle === false ){
            throw new Exception();
        }

        while(feof($handle) === false){
            yield fgetcsv($handle);
        }
        fclose($handle);
    }

    foreach($getRows('data.csv') as $row){
        print_r($row);
    }

```

生成器是功能多样性和简洁性之间的这种方案。生成器是只能前进的迭代器，无法执行快进，后退，查找操作。

参考鸟哥的文章：http://www.laruence.com/2015/05/28/3038.html

# 闭包
是指在创建时封装周围状态的函数。
匿名函数其实就是没有名称的函数，特别适合作为函数或方法的调用。

- _invoke 尝试以函数方式调用一个对象时，该方法自动被调用。

创建简单的闭包
```php
$closure = function($name){
    return sprintf ('hello %s',$name);
}

echo $closure("Josh");
//输出 --> hello Josh
```

作为回调
```php
//匿名回调
$numbersPlusOne = array_map(function( $number ){
    return $number+1;
},[1,2,3]);
print_r($numbersPlusOne);
//输出  --> [2,3,4]
```
```php
//具名回调
function incrementNumber($number){
    return $number+1;
}

$numbersPlusone = array_map('incrementNumber',[1,2,3]);
print_r($numbersPlusOne);
//输出  --> [2,3,4]
```

- 附加状态

PHP闭包附加并封装状态，手动调用闭包对象的bindTo()方法或者使用use关键字，把状态附加到PHP闭包上。

实例：
```php
<?php
function enclosePersion( $name ){
    return function($doCommand use $name){
        return sprintf('%s,%s',$name,$doCommand);
    }
}

//将字符串“sun”封装到闭包中
$sun = enclosePersion( 'sun' );

//传入参数，调用闭包
echo $sun('get me sweet tea!');
//输出  --> "sun,get me sweet tea!"
```
PHP闭包是对象，与任何其他PHP对象类似，每个闭包实例都可以使用$this关键字获取闭包的内部状态。闭包有__invoke()、bindTo()方法；

- [ ] 参考下手册，手册有详细说明bindTo、bind；
```

<?php

 class  A  {
    function  __construct ( $val ) {
         $this -> val  =  $val ;
    }
    function  getClosure () {
         //returns closure bound to this object and scope
         return function() { return  $this -> val ; };
    }
}

 $ob1  = new  A ( 1 );
 $ob2  = new  A ( 2 );

 $cl  =  $ob1 -> getClosure ();
echo  $cl (),  "\n" ;
 $cl  =  $cl -> bindTo ( $ob2 );
echo  $cl (),  "\n" ;
 ?>


以上例程的输出类似于：


1
2

```
# Zend OPcache
从php 5.5.0开始，内置了字节码缓存功能。
PHP执行过程：
```
graph LR
解析脚本代码-->编译成一系列Zend操作码
编译成一系列Zend操作码-->执行字节码
```
字节码缓存 存储好预先编译好的PHP字节码，PHP解释器跳过读取、解析、编译PHP代码，直接从内存中读取预先编译好的字节码，然后执行。优点节省了时间，极大地提升了应用的性能。

脚本执行图解：

![image](https://ww2.sinaimg.cn/large/006tNbRwly1ff9a5w5n01j31kw0z3agf.jpg)

- 启用Zend OPcache

编译PHP时，明确指定启用Zend OPcache。
执行./configure 命令时必须包含以下选项：
```
--enable-opcache
```
编译成功会显示Zend OPcache扩展的文件路径。也可通过下述命令查找扩展的安装路径
```
php-config --extension-dir
```

php.ini文件中指定Zend OPcache扩展路径，如：
```
zend_extension=/path/to/opcache.so
```
更新php.ini文件，重启php进程。

```
<?php
    phpinfo()
```
查看Zend OPcache扩展开启情况

![image](http://images.cnblogs.com/cnblogs_com/followyou/1251481/o_TIM%E5%9B%BE%E7%89%8720180710192635.png)

- 配置Zend OPcache
```
[opcache]
zend_extension=/usr/local/php5/lib/php/extensions/no-debug-non-zts-20131226/opcache.so

; Zend Optimizer + 的开关, 关闭时代码不再优化.
opcache.enable=1

; Determines if Zend OPCache is enabled for the CLI version of PHP
opcache.enable_cli=1

; Zend Optimizer + 共享内存的大小, 总共能够存储多少预编译的 PHP 代码(单位:MB)
;根据内存来定
opcache.memory_consumption=256

; Zend Optimizer + 暂存池中字符串的占内存总量.(单位:MB)
; 推荐 8
opcache.interned_strings_buffer=4

; 最大缓存的文件数目 200  到 100000 之间
; 推荐 4000~8000
opcache.max_accelerated_files=8000

; 内存“浪费”达到此值对应的百分比,就会发起一个重启调度.
opcache.max_wasted_percentage=5

; 开启这条指令, Zend Optimizer + 会自动将当前工作目录的名字追加到脚本键上,
; 以此消除同名文件间的键值命名冲突.关闭这条指令会提升性能,
; 但是会对已存在的应用造成破坏.
opcache.use_cwd=0

; 开启文件时间戳验证
opcache.validate_timestamps=1

; 2s检查一次文件更新 注意:0是一直检查不是关闭
; 推荐 60
opcache.revalidate_freq=0

; 允许或禁止在 include_path 中进行文件搜索的优化
;opcache.revalidate_path=0


; 是否保存文件/函数的注释   如果apigen、Doctrine、 ZF2、 PHPUnit需要文件注释
; 推荐 0
opcache.save_comments=1

; 是否加载文件/函数的注释
;opcache.load_comments=1


; 打开快速关闭, 打开这个在PHP Request Shutdown的时候会收内存的速度会提高
; 推荐 1
opcache.fast_shutdown=1

;允许覆盖文件存在（file_exists等）的优化特性。
;opcache.enable_file_override=0


; 定义启动多少个优化过程
;opcache.optimization_level=0xffffffff


; 启用此Hack可以暂时性的解决”can’t redeclare class”错误.
;opcache.inherited_hack=1

; 启用此Hack可以暂时性的解决”can’t redeclare class”错误.
;opcache.dups_fix=0

; 设置不缓存的黑名单
; 不缓存指定目录下cache_开头的PHP文件. /png/www/example.com/public_html/cache/cache_
;opcache.blacklist_filename=


; 通过文件大小屏除大文件的缓存.默认情况下所有的文件都会被缓存.
;opcache.max_file_size=0

; 每 N 次请求检查一次缓存校验.默认值0表示检查被禁用了.
; 由于计算校验值有损性能,这个指令应当紧紧在开发调试的时候开启.
;opcache.consistency_checks=0

; 从缓存不被访问后,等待多久后(单位为秒)调度重启
;opcache.force_restart_timeout=180

; 错误日志文件名.留空表示使用标准错误输出(stderr).
;opcache.error_log=/tmp/ckl.log

; 将错误信息写入到服务器(Apache等)日志
;opcache.log_verbosity_level=1

; 内存共享的首选后台.留空则是让系统选择.
;opcache.preferred_memory_model=

; 防止共享内存在脚本执行期间被意外写入, 仅用于内部调试.
;opcache.protect_memory=0
```
参考下大神的配置
```
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=4
opcache.max_accelerated_files=8000
opcache.max_wasted_percentage=5
opcache.use_cwd=1
opcache.validate_timestamps=1
opcache.revalidate_freq=0
opcache.revalidate_path=0
opcache.save_comments=0
opcache.load_comments=0
opcache.force_restart_timeout=3600
```