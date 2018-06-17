### docker容器修改hosts文件
搜了一大批资料，有说需要在docker run --hosts...改；dockerfile改；有点麻烦，下面方案比较好：

参照docker吧（https://tieba.baidu.com/p/4295556808?red_tag=0157001827）的解决方案。运用如下命令可写入 hosts：
```
docker exec <容器Id> /bin/sh -c "echo 101.37.113.127 www.cnblogs.com >> /etc/hosts"
```

为避免重启失效，放入开启启动项（已php容器为例）：
```
$ cd /etc/profile.d/
$ vi hosts.sh
//输入命令,保存
docker exec php7-dev /bin/sh -c "echo 101.37.113.127 www.cnblogs.com >> /etc/hosts"
```

重启服务器，可以看到容器 php7-dev,hosts文件已有添加内容。

注意docker必须在root用户才会执行，所以要做下切换,或者以 root 权限运行服务器。

