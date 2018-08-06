[TOC]

# 环境
Linux、Nginx。

# 生成私钥和证书
为站点配置HTTPS，生成私钥和证书。证书需要CA签名，生产环境需向云服务商购买证书，本次使用自签证书。

安装前确保机器已安装OPENSSL。
```
#移动至nginx目录
cd /etx/nginx

#配置openssl
openssl req \
  -x509 \
  -nodes \
  -days 365 \
  -newkey rsa:2048 \
  -keyout example.key \
  -out example.crt
```

上面命令的各个参数含义如下。
```
req：处理证书签署请求。
-x509：生成自签名证书。
-nodes：跳过为证书设置密码的阶段，这样 Nginx 才可以直接打开证书。
-days 365：证书有效期为一年。
-newkey rsa:2048：生成一个新的私钥，采用的算法是2048位的 RSA。
-keyout：新生成的私钥文件为当前目录下的example.key。
-out：新生成的证书文件为当前目录下的example.crt。
```

执行之后需要回答一堆问题：国家（比如US）、城市、email等等。Common Name 正常情况填写一个域名，如：192.168.33.30。

安装完成，当前目录会生成：example.key、example.crt。

移动至nginx 目录下：
```
#创建certs目录
mkdir certs
#移动
mv example.key example.crt /etc/nginx/certs
```

# 站点配置
```
server {
    listen       82;

    #监听 ssl  443端口
    listen 443 ssl http2;

    server_name jump.com;
    root /app/space/jump/web;

    #开启  如果把ssl on；这行去掉，这样http和https的链接都可以用
    ssl                      on;

    #证书(公钥.发送到客户端的)
    ssl_certificate          /etc/nginx/certs/example.crt;

    #私钥
    ssl_certificate_key      /etc/nginx/certs/example.key;

    #缓存超时是5分钟
    ssl_session_timeout  5m;

    #ssl_protocols和ssl_ciphers指令可以用来强制用户连接只能引入SSL/TLS那些强壮的协议版本和强大的加密算法
    ssl_ciphers HIGH:!aNULL:!MD5;
    ssl_protocols SSLv3 TLSv1 TLSv1.1 TLSv1.2;
    ssl_prefer_server_ciphers   on;
```

配置完成，重启nginx。

打开浏览器输入站点地址，如：https://192.168.33.30:83

![TIM截图20180727223637](https://note.youdao.com/yws/res/38003/4D6FBC2050AF4896AE7861620CB7E18D)

注意：因为自签，浏览器会提示不安全，点击继续访问。

# 相关阅读：

DigitalOcean https://www.digitalocean.com/community/tutorials/how-to-create-a-self-signed-ssl-certificate-for-nginx-in-ubuntu-16-04

https相关知识  http://note.youdao.com/noteshare?id=a56969a717ba6f6ebb8074cdf9c5e7c2&sub=4EC9E0DC5BBD4859B2AC1D029A8B0387


