<?php
namespace Common\Behavior;
use Think\Behavior;
class InitModuleBehavior extends Behavior{
    public function run(&$content){
        // 如果是后台访问自动设置默认模块为Admin
        if(MODULE_MARK === 'Admin'){
            C('DEFAULT_MODULE', 'Admin');
        }

        //数据缓存前缀
        $config['DATA_CACHE_PREFIX'] = strtolower(ENV_PRE . MODULE_MARK . '_');
        //获取数据库存储配置
        $databaseConfig = D('Admin/Config')->lists();

        // URL_MODEL必须在app_init阶段就从数据库读取出来应用
        // 不然系统就会读取config.php中的配置导致后台的配置失效
        $config['URL_MODEL'] = $databaseConfig['URL_MODEL'];

        // 允许访问模块列表加上安装的功能模块
        $moduleNameList = D('Admin/Module')
            ->where(array('status' => 1, 'is_system' => 0))
            ->getField('name', true);
        $moduleAllowList = array_merge(
            C('MODULE_ALLOW_LIST'),
            $moduleNameList
        );

        if(MODULE_MARK === 'Admin'){
            $moduleAllowList[]   = 'Admin';
            $config['URL_MODEL'] = 3;
        }

        C('MODULE_ALLOW_LIST', $moduleAllowList);

        // 如果是后台访问自动设置默认模块为Admin
        if(MODULE_MARK === 'Admin'){
            C('DEFAULT_MODULE', 'Admin');
        }

        // 设置默认模块
        if($databaseConfig['DEFAULT_MODULE']){
            $config['DEFAULT_MODULE'] = $databaseConfig['DEFAULT_MODULE'];
        }

        // 设置WAP和微信标记
        define('IS_WAP', is_wap() ? true : false);
        define('IS_WEIXIN', is_weixin() ? true : false);

        //获取不带端口的域名
        $host = explode(':', $_SERVER['HTTP_HOST']);
        define('HTTP_HOST', $host[0]);

        // 获取scheme
        define('HTTP_SCHEME', (is_ssl() ? 'https' : 'http'));

        // 获取域名
        define('HTTP_DOMAIN', HTTP_SCHEME . '://' . $_SERVER['HTTP_HOST']);

        C($config);
    }
}