# ThinkPlugsWechatService

[微信开放平台](https://open.weixin.qq.com)基础插件，此为`ThinkAdmin`会员插件。

安装后可以基于此插件进行扩展开发微信开放平台相关的功能，基础服务对接及`SDK`都已经包含！

### 安装插件

```shell
composer require zoujingli/think-plugs-wechat-service dev-master
```

### 卸载插件

```shell
# 注意，插件卸载不需要删除数据表，需要手动删除
composer remove zoujingli/think-plugs-wechat-service
```

### 功能节点

可根据下面节点配置菜单或访问权限

* 开放平台配置：`plugin-wechat-service/config/index`
* 授权微信管理：`plugin-wechat-service/wechat/index`

### 插件数据库

本插件涉及数据表有：
`wechat_auth`