<?php

namespace Common\Behavior;
use Think\Behavior;

/**
 * 根据不同情况读取数据库的配置信息并与本地配置合并
 * Class InitConfigBehavior
 * @package Common\Behavior
 */
class InitConfigBehavior extends Behavior{
    public function run(&$content){
        //读取数据库中的配置
        $systemConfig = S('DB_CONFIG_DATA');
        if(!$systemConfig || APP_DEBUG === true){
            $systemConfig = D('Admin/Config')->lists();
        }
    }
}