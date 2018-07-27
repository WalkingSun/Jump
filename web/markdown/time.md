[TOC]



# 问题
处理日期和时间要考虑很多因素，比如 日期格式、时区、夏令时、闰年、闰秒和天数各异的月份，自己处理易出错。

PHP5.2.0引入 DateTime、DateInterval和DateTimeZone类，提供简单的面向对象接口，准确创建、处理日期、时间。

# 设置默认时区
php.ini 设置
```
    date.timezone = 'America/New-York';
```
或
```php
<?php
date_default_timezone_set('America/New_York');
```

# 处理时间
- DateTime类   用于管理时间和日期
- DateInterval类 设定日期时间间隔规约
- DateTimeZone 处理时区
- DatePeriod 迭代处理时间

## 时间正向推移
```php
        //创建DateTIME实例
        $datetime = new \DateTime('2018-07-01');

        //创建间隔两天的间隔
        $interval = new \DateInterval('P2W');   //P2W 间隔两天；P2D 间隔2天；P2M3W4D5H6M7S 间隔2月3周4天5小时6分7秒

        //修改DateTime实例
        $datetime->add($interval);
        echo $datetime->format('Y-m-d');      //返回 2018-07-15
```
date("Y-m-d",strtotime('+2 day');

## 时间反向推移
```php
<?
        $dateStart = new \DateTime();
        $dateInterval = \DateInterval::createFromDateString('-1 day');
        $datePeriod = new \DatePeriod($dateStart,$dateInterval,3);
        foreach ( $datePeriod as $date){
            echo $date->format('Y-m-d'),PHP_EOL;
        }
        //返回 2018-07-25 2018-07-24 2018-07-23
```
date("Y-m-d",strtotime('-2 day');

## 时区
显示某时区的时间
```php
<?
        $timezone = new DateTimeZone('America/New_York');
        $datetime = new \DateTime('2018-07-26 09:00:00',$timezone);  //设置时区
        print_r( $datetime );
        $datetime->setTimezone(new \DateTimeZone('Asia/Hong_Kong'));    //修改DateTime实例的时区
        print_r( $datetime );

```
返回：
```
DateTime Object
(
    [date] => 2018-07-26 09:00:00.000000
    [timezone_type] => 3
    [timezone] => America/New_York
)
DateTime Object
(
    [date] => 2018-07-26 21:00:00.000000
    [timezone_type] => 3
    [timezone] => Asia/Hong_Kong
)
```