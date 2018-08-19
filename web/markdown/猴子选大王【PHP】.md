[TOC]
# 猴子选大王

一群猴子排成一圈，按1，2，...，n依次编号。然后从第1只开始数，数到第m只,把它踢出圈，从它后面再开始数，再数到第m只，在把它踢出去...，如此不停的进行下去，直到最后只剩下一只猴子为止，那只猴子就叫做大王。要求编程模拟此过程，输入m、n,输出最后那个大王的编号。

## 指针解决
思考了下，发现数组指针最适合解决这个问题，解决方法：
```php
function monkeyKing($m,$n){
    $arr = range(1,$n);
    $i = 1;
    while( count($arr)>1 ){

        //移动指针，如果是底部移向顶部
        if( $i>1 && empty($SF) ){
            $sta = next($arr);
            if( !$sta ){
                reset($arr);
            }
            $sta = current($arr);
        }

        $SF = 0;

        //去除m倍数的值，如果是底部移向顶部，并做标记
        if( $i%$m==0 ){
            if(!next($arr)){
                reset($arr);
                current($arr);
            }

            $key = array_search($sta, $arr);    //获取key
            unset($arr[$key]);
            $SF = 1;
        }
        $i++;
    }

    return array_pop($arr);
}
```

测试数据：
```
print_r( monkeyKing(1,3));      //返回 3
print_r( monkeyKing(4,4));      //返回 2
print_r( monkeyKing(3,10));      //返回 4
```
 
挺有意思。


## 数组压栈
```php
function monkeyKing( $m , $n ){
        $arr = range(1,$n);

        $i = 1;
        //for循环 数组压栈数据不计入，遍历结束重新遍历
        while(  count($arr)!=1 ){
            foreach ($arr as $k => $v){
                unset($arr[$k]);
                if( $i%$m!=0 ){
                    array_push($arr,$v);
                }
                $i++;
            }
        }
        return $arr;
    }
```