# ThinkPlugsWechatService for ThinkAdmin [`VIP`](https://thinkadmin.top/vip-introduce)

[![Latest Stable Version](https://poser.pugx.org/zoujingli/think-plugs-wechat-service/v/stable)](https://packagist.org/packages/zoujingli/think-plugs-wechat-service)
[![Latest Unstable Version](https://poser.pugx.org/zoujingli/think-plugs-wechat-service/v/unstable)](https://packagist.org/packages/zoujingli/think-plugs-wechat-service)
[![Total Downloads](https://poser.pugx.org/zoujingli/think-plugs-wechat-service/downloads)](https://packagist.org/packages/zoujingli/think-plugs-wechat-service)
[![Monthly Downloads](https://poser.pugx.org/zoujingli/think-plugs-wechat-service/d/monthly)](https://packagist.org/packages/zoujingli/think-plugs-wechat-service)
[![Daily Downloads](https://poser.pugx.org/zoujingli/think-plugs-wechat-service/d/daily)](https://packagist.org/packages/zoujingli/think-plugs-wechat-service)
[![PHP Version Require](http://poser.pugx.org/zoujingli/think-plugs-wechat-service/require/php)](https://packagist.org/packages/zoujingli/think-plugs-wechat-service)
[![ThinkAdmin VIP 授权](https://img.shields.io/badge/license-VIP%20授权-blueviolet.svg)](https://thinkadmin.top/vip-introduce)

微信开放平台基础插件，此插件为[会员尊享插件](https://thinkadmin.top/vip-introduce)，未授权不可商用。

基于此插件可以进行[微信开放平台](https://open.weixin.qq.com)的功能开发，服务对接及接口调度都已经包含在内！

以后 **ThinkAdmin** 关于微信开放平台的基础功能都会集中在此插件中实现，目前已集成 **公众号** 和 **小程序** 管理等相关接口；

**安全提示：** 安装此插件需要是 **ThinkAdmin v6.1** 版本的系统，其他版本会自动升级到 **v6.1** 版本，安装过程会强制替换 `app/admin` 目录和 `public/static` 部分目录。

如果不希望 `app/admin` 目录被更新替换，可以在 `app/admin` 目录下创建 `ignore` 文件（ 如 `app/admin/ignore`，文件名没有后缀哦！），即使执行了应用插件更新也会忽略更新目录。

### 开放接口

此插件支持 [**ThinkPlugsWechat**](https://thinkadmin.top/think-plugs-wechat) 应用插件远程调用，需要增加配置`sysconf('wechat.service_jsonrpc')`远程调用的 **JSON-RPC** 接口地址；

接口地址可以在此插件的节点 `plugin-wechat-service/config/index` 页面查看，注意此插件接口地址需要带有 `TOKEN` 占位字符；

**JSON-RPC** 接口地址格式如：`http://admin.local.cuci.cc/plugin-wechat-service/api.client/jsonrpc?token=TOKEN`

### 安装插件

```shell
### 注意，仅支持在 ThinkAdmin v6.1 中使用
composer require zoujingli/think-plugs-wechat-service
```

### 卸载插件

```shell
### 注意，插件卸载不会删除数据表，需要手动删除
composer remove zoujingli/think-plugs-wechat-service
```

### 调用案例

```php
// 开放平台SDK调用入口
use plugin\wechat\service\AuthService;

// 1. 实例公众号 APPID 的 User 接口
$user = AuthService::WeChatUser(APPID);

// 2. 获取公众号 APPID 的粉丝列表（ 第一页 100 条 ）
$userList = $user->getUserList();
var_dump($userList);

// 3. 获取公众号 APPID 的 OPENID 资料
// 现在调用此接口获取不到粉丝详情资料
$userInfo = $user->getUserInfo(OPENID);
var_dump($userInfo);

// 其他 WeChatDeveloper 的接口实例以此类推
// 具体接口实例对象可以阅读SDK的源码或对应文档

```

### 功能节点

可根据下面的功能节点配置菜单及访问权限，按钮操作级别的节点未展示！

* 开放平台配置：`plugin-wechat-service/config/index`
* 授权微信管理：`plugin-wechat-service/wechat/index`

### 插件数据

本插件涉及数据表有：

* 微信-授权 `wechat_auth`

### 版权说明

**ThinkPlugsWechatService** 为 **ThinkAdmin** 会员插件，未授权不可商用，了解商用授权请阅读 [《会员尊享介绍》](https://thinkadmin.top/vip-introduce)。

### 插件展示

<img alt="WechatServiceDemo" src="https://thinkadmin.top/static/img/wechat-service-01.jpg" style="max-width:100%">
