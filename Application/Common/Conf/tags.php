<?php
return array(
    'app_init'  => array(
        'Common\Behavior\InitModuleBehavior',   //初始化安装的模块行为扩展
    ),
    'app_begin' => array(
    	'Common\Behavior\InitConfigBehavior',	//初始化系统配置行为扩展
    ),
);