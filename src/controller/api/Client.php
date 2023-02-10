<?php

// +----------------------------------------------------------------------
// | Wechat Service Plugin for ThinkAdmin
// +----------------------------------------------------------------------
// | 版权所有 2022~2023 Anyon <zoujingli@qq.com>
// +----------------------------------------------------------------------
// | 官方网站: https://thinkadmin.top
// +----------------------------------------------------------------------
// | 免责声明 ( https://thinkadmin.top/disclaimer )
// | 会员免费 ( https://thinkadmin.top/vip-introduce )
// +----------------------------------------------------------------------
// | gitee 代码仓库：https://gitee.com/zoujingli/think-plugs-wechat-service
// | github 代码仓库：https://github.com/zoujingli/think-plugs-wechat-service
// +----------------------------------------------------------------------

namespace plugin\wechat\service\controller\api;

use plugin\wechat\service\AuthService;
use plugin\wechat\service\model\WechatAuth;
use think\admin\Controller;
use think\admin\extend\JsonRpcServer;
use think\Exception;
use think\exception\HttpResponseException;

/**
 * 接口获取实例化
 * Class Client
 * @package plugin\wechat\service\controller\api
 */
class Client extends Controller
{
    /**
     * YAR 标准接口
     */
    public function yar()
    {
        try {
            $service = new \Yar_Server($this->instance());
            $service->handle();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response($exception->getMessage()));
        }
    }

    /**
     * SOAP 标准接口
     */
    public function soap()
    {
        try {
            $server = new \SoapServer(null, ['uri' => 'thinkadmin']);
            $server->setObject($this->instance());
            $server->handle();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response($exception->getMessage()));
        }
    }

    /**
     * JsonRpc 标准接口
     */
    public function jsonrpc()
    {
        try {
            JsonRpcServer::instance()->handle($this->instance());
        } catch (HttpResponseException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw new HttpResponseException(response($exception->getMessage()));
        }
    }

    /**
     * 远程获取实例对象
     * @return mixed
     */
    private function instance()
    {
        try {
            $data = json_decode(debase64url(input('token', '')), true);
            [$class, $appid, $time, $nostr, $sign] = [$data['class'], $data['appid'], $data['time'], $data['nostr'], $data['sign']];
            if (empty($class) || empty($appid) || empty($time) || empty($nostr) || empty($sign)) throw new Exception('请求 TOKEN 格式异常！');
            // 接口请求参数检查验证
            $config = WechatAuth::mk()->where(['authorizer_appid' => $appid])->find();
            if (empty($config)) throw new Exception("该公众号还未授权，请重新授权！");
            if (empty($config['status'])) throw new Exception('该公众号已被禁用，请联系管理员！');
            if (!empty($config['deleted'])) throw new Exception('该公众号已取消授权，请重新授权！');
            if (abs(time() - $data['time']) > 3600) throw new Exception('请求时间与服务器时差过大，请同步时间！');
            if (md5("{$class}#{$appid}#{$config['appkey']}#{$time}#{$nostr}") !== $sign) throw new Exception("该公众号{$appid}请求签名异常！");
            $config->inc('total')->update([]);
            return AuthService::__callStatic($class, [$appid]);
        } catch (\Exception $exception) {
            return new \Exception($exception->getMessage(), 404);
        }
    }
}