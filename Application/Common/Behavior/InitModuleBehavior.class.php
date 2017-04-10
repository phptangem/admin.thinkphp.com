<?php
namespace Common\Behavior;
use Think\Behavior;
class InitModuleBehavior extends Behavior{
    public function run(&$content){
        // 如果是后台访问自动设置默认模块为Admin
        if(MODULE_MARK === 'Admin'){
            C('DEFAULT_MODULE', 'Admin');
        }

        //获取数据库存储配置
//        $database_config = D('Admin/Config')->lists();

    }
}