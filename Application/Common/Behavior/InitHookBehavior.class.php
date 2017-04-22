<?php
namespace Common\Behavior;
use Think\Behavior;

class InitHookBehavior extends Behavior{
    public function run(&$content){
        // 安装模式下直接返回
        if (defined('BIND_MODULE') && BIND_MODULE === 'Install') {
            return;
        }

        //添加插件配置
        $addonConfig['ADDON_PATH']                   = './Addons/';
        $addonConfig['AUTOLOAD_NAMESPACE']           = C('AUTOLOAD_NAMESPACE');
        $addonConfig['AUTOLOAD_NAMESPACE']['Addons'] = $addonConfig['ADDON_PATH'];
        C($addonConfig);
    }
}