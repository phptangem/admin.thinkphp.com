<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件
header('content-type:text/html;charset=utf-8');
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
//报错设置
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);


//缓存目录设置
define('RUNTIME_PATH', './Runtime/');

//定义后台标记
define('MODULE_MARK', 'Admin');

//开发模式环境变量前缀
define('ENV_PRE', 'TEM_');

// 定义应用目录
define('APP_PATH', './Application/');

//系统调试设置, 项目正式部署后请设置为false
define('APP_DEBUG', @$_SERVER[ENV_PRE . 'APP_DEBUG'] ?: true);

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单