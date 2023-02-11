# ThinkPlugsWechatService [`VIP`](https://thinkadmin.top/vip-introduce)

[![Latest Stable Version](https://poser.pugx.org/zoujingli/think-plugs-wechat-service/v/stable)](https://packagist.org/packages/zoujingli/think-plugs-wechat-service)
[![Latest Unstable Version](https://poser.pugx.org/zoujingli/think-plugs-wechat-service/v/unstable)](https://packagist.org/packages/zoujingli/think-plugs-wechat-service)
[![Total Downloads](https://poser.pugx.org/zoujingli/think-plugs-wechat-service/downloads)](https://packagist.org/packages/zoujingli/think-plugs-wechat-service)
[![Monthly Downloads](http://img.shields.io/packagist/dm/zoujingli/think-plugs-wechat-service.svg)](https://packagist.org/packages/zoujingli/think-plugs-wechat-service)

微信开放平台基础插件，此插件为[会员尊享插件](https://thinkadmin.top/vip-introduce)，未授权不得商用。

基于此插件可以进行[微信开放平台](https://open.weixin.qq.com)的功能开发，基础服务对接及`SDK`都已经包含在内！

以后`ThinkAdmin`关于微信开放平台的基础功能都会集中在此插件中实现，目前已集成 **`公众号`** 有 **`小程序`** 管理等相关接口；

**安全提示：** 安装此插件需要是`ThinkAdmin v6.1`或直接自动升级到此版本，会强制替换`app/admin`目录和`public/static`部分目录。

如果不希望自有的`app/admin`目录被更新替换，可以在`app/admin`目录下创建`ignore`文件（ 即`app/admin/ignore`，注意文件名没有后缀哦！），即使执行了插件安装或更新都会忽略更新替换。

### 开放接口

此插件支持`think-plugs-wechat`远程调用，需要在安装有`think-plugs-wechat`的系统增加配置`sysconf('wechat.service_jsonrpc')`接口地址；

开放的`JSON-RPC`接口地址可以在此插件的节点`plugin-wechat-service/config/index`页面查看，注意此插件接口地址需要带有`TOKEN`占位字符；

接口地址格式如：`http://admin.local.cuci.cc/plugin-wechat-service/api.client/jsonrpc?token=TOKEN`

### 安装插件

```shell
# 注意，插件仅支持在 ThinkAdmin v6 系统中使用
composer require zoujingli/think-plugs-wechat-service dev-master
```

### 卸载插件

```shell
# 注意，插件卸载不会删除数据表，需要手动删除
composer remove zoujingli/think-plugs-wechat-service
```

### 调用案例

```php
// 开放平台SDK调用入口
use plugin\wechat\service\AuthService;

// 指定已授权公众号APPID，获取其粉丝列表
$userList = AuthService::WeChatUser(APPID)->getUserList();
var_dump($userList);
```

### 功能节点

可根据下面的功能节点配置菜单和访问权限，按钮操作级别的节点未展示！

* 开放平台配置：`plugin-wechat-service/config/index`
* 授权微信管理：`plugin-wechat-service/wechat/index`

### 插件数据

本插件涉及数据表有：

* 微信-授权 `wechat_auth`

### 版权说明

**ThinkPlugsWechatService** 为 [`ThinkAdmin`](https://thinkadmin.top) 会员插件。

未经授权不得商用，了解商用授权请阅读[《会员尊享介绍》](https://thinkadmin.top/vip-introduce)。

### 插件展示

<img alt="WechatServiceDemo" src="https://thinkadmin.top/static/img/wechat-service-01.jpg" style="max-width:100%">
