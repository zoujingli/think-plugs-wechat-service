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

use think\migration\Migrator;

class InstallWechatService extends Migrator
{

    /**
     * 创建数据库
     */
    public function change()
    {
        set_time_limit(0);
        @ini_set('memory_limit', -1);
        $this->_create_wechat_auth();
    }

    /**
     * 创建数据对象
     * @class WechatAuth
     * @table wechat_auth
     * @return void
     */
    private function _create_wechat_auth()
    {

        // 当前数据表
        $table = 'wechat_auth';

        // 存在则跳过
        if ($this->hasTable($table)) return;

        // 创建数据表
        $this->table($table, [
            'engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '微信-授权',
        ])
            ->addColumn('authorizer_appid', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '微信APPID'])
            ->addColumn('authorizer_access_token', 'string', ['limit' => 200, 'default' => '', 'null' => true, 'comment' => '授权Token'])
            ->addColumn('authorizer_refresh_token', 'string', ['limit' => 200, 'default' => '', 'null' => true, 'comment' => '刷新Token'])
            ->addColumn('expires_in', 'integer', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => 'Token时限'])
            ->addColumn('user_alias', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '公众号别名'])
            ->addColumn('user_name', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '众众号原账号'])
            ->addColumn('user_nickname', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '公众号昵称'])
            ->addColumn('user_headimg', 'string', ['limit' => 200, 'default' => '', 'null' => true, 'comment' => '公众号头像'])
            ->addColumn('user_signature', 'string', ['limit' => 200, 'default' => '', 'null' => true, 'comment' => '公众号描述'])
            ->addColumn('user_company', 'string', ['limit' => 200, 'default' => '', 'null' => true, 'comment' => '公众号公司'])
            ->addColumn('func_info', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '公众号集权'])
            ->addColumn('service_type', 'string', ['limit' => 10, 'default' => '', 'null' => true, 'comment' => '公众号类型'])
            ->addColumn('service_verify', 'string', ['limit' => 10, 'default' => '', 'null' => true, 'comment' => '公众号认证'])
            ->addColumn('qrcode_url', 'string', ['limit' => 200, 'default' => '', 'null' => true, 'comment' => '公众号二维码'])
            ->addColumn('businessinfo', 'string', ['limit' => 500, 'default' => '', 'null' => true, 'comment' => '业务序列内容'])
            ->addColumn('miniprograminfo', 'string', ['limit' => 500, 'default' => '', 'null' => true, 'comment' => '小程序序列内容'])
            ->addColumn('total', 'integer', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '统计调用次数'])
            ->addColumn('appkey', 'string', ['limit' => 32, 'default' => '', 'null' => true, 'comment' => '应用接口KEY'])
            ->addColumn('appuri', 'string', ['limit' => 255, 'default' => '', 'null' => true, 'comment' => '应用接口URI'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1, 'null' => true, 'comment' => '授权状态(0已取消,1已授权)'])
            ->addColumn('deleted', 'integer', ['limit' => 1, 'default' => 0, 'null' => true, 'comment' => '删除状态(0未删除,1已删除)'])
            ->addColumn('auth_time', 'integer', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '授权时间'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true, 'comment' => '创建时间'])
            ->addIndex('authorizer_appid', ['name' => 'idx_wechat_auth_authorizer_appid'])
            ->addIndex('status', ['name' => 'idx_wechat_auth_status'])
            ->addIndex('deleted', ['name' => 'idx_wechat_auth_deleted'])
            ->save();

        // 修改主键长度
        $this->table($table)->changeColumn('id', 'integer', ['limit' => 20, 'identity' => true]);
    }

}
