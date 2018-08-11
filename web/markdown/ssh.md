[TOC]

# ssh密钥对认证

以非根用户deploy 身份登录服务器
```
$ ssh deploy@192.168.33.30
```

这个命令会要求你输入deploy用户的密码,然后登录服务器。我们可以禁用密码认证,加强安全。密码认证有漏洞,会受到暴力攻击,不怀好意的人会不断尝试猜测你的密码。使用s登录服务器时应该使用SSH密钥对认证。

密钥对认证是个复杂的话题。简单来说,我们在本地设备中创建一对“密钥”,其中个是私钥(保存在本地设备中),另一个是公钥(传到远程服务器中)。之所以叫密钥对,是因为使用公钥加密的消息只能使用对应的私钥解密使用SSH密钥对认证方式登录远程设备时,远程设备会随机创建一个消息,使用公钥加密,然后把密文发给本地设备。本地设备收到密文后使用私钥解密,然后把解密后的消息发给远程服务器。远程服务器验证解密后的消息之后,再赋予你访问服务器的权限我极大地简化了这个过程,不过相信你已经掌握要点了。如果要在多台电脑中登录远程服务器,或许不应该使用SSH密钥对认证。如果想这么做,要在每台本地电脑中生成SSH密钥对,然后再把每个密钥对中的公钥复制到远程服务器中。遇到这种情况,或许最好使用安全的密码进行密码认证。然而,如果只通过台本地电脑访问远程服务器(很多开发者都是这样),SSH密钥对认证是最好的方式。

## 创建秘钥对
本地设备
```
$ ssh-keygen
```
按照屏幕上显示的内容，根据提示输入所需的信息。

会在本地设备中创建两个文件：~/.ssh/id_rsa.pub(公钥) 和 ~/.ssh/id_rsa (私钥)。私钥应保存于本地电脑中，且需保密。公钥必须复制到服务器中，可使用scp（安全复制）命令复制公钥：
```
$ scp ~/.ssh/id_rsa.pub deploy@192.168.33.30:
```
切记末尾加上:！ 此命令会把公钥复制到远程服务器中deploy用户的家目录中。

## 远程服务器设置,通过信任公钥
下面以deploy用户的身份登录远程服务器。登录后，确认~/.ssh目录是否存在，不存在创建:
```
$ mkdir ~/.ssh
```
 
创建~/.ssh/authorized_keys
```
$ touch ~/.ssh/authorized_keys
```

把上传的公钥添加到~/.ssh/authorized_keys文件中：
```
$ cat ~/id_rsa.pub >> ~/.ssh/authorized_keys
```

最后，修改目录及文件的访问权限，只让deploy用户访问~/.ssh目录和~/.ssh/authorized_keys。
```
$ chown -R deploy:deploy ~/.ssh;
$ chmod 700 ~/.ssh;
$ chmod 600 ~/.ssh/authorized_keys;
```

配置完成，现在可通过ssh登录远程服务器。

# 禁用密码，禁止根用户登录

让远程服务器再安全一些。我们要禁止所有用户通过密码认证登录,还要禁止根用户登录。==记住,根用户能做任何事,所以我们要尽量不让根用户访问服务器==。以deploy用户的身份登录远程服务器,然后在你喜欢的文本编辑器中打开/etc/ssh/sshd_config文件。这是SSH服务器软件的配置文件。找到PasswordAuthentication设置,将其值改为no;如果需要,去掉这个设置的注释。然后,找到PermitRootlogin设置,将其值改为no;如果需要,去掉这个设置的注释。保存改动,然后执行下述命令重启SSH服务器,让改动生效:
```
sudo service ssh restart
sudo systemctl restart sshd. service
```
现在必须通过ssh密钥对连接服务器，并且用户非root。

