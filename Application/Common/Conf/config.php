<?php
/**
 * 全局配置文件
 */
$_config = array(
    //错误页面模板
    'TMPL_ACTION_ERROR'     =>  APP_PATH.'Home/View/Public/think/error.html', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  APP_PATH.'Home/View/Public/think/success.html', // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE'   =>  APP_PATH.'Home/View/Public/think/exception.html',// 异常页面的模板文件

    // 模板相关配置
    'TMPL_PARSE_STRING'     => array(
        '__PUBLIC__'         =>  (is_ssl() ? "https://" : 'http://') . $_SERVER['HTTP_HOST'] . __ROOT__ . '/Public',
        '__LYUI__'           =>  (is_ssl() ? "https://" : 'http://') . $_SERVER['HTTP_HOST'] . __ROOT__ . '/Public/libs/lyui/dist',
        '__ADMIN_CSS__'      =>  (is_ssl() ? "https://" : 'http://') . $_SERVER['HTTP_HOST'] . __ROOT__ . ltrim(APP_PATH, '.') . 'Admin/View/Public/css',
        '__ADMIN_JS__'       =>  (is_ssl() ? "https://" : 'http://') . $_SERVER['HTTP_HOST'] . __ROOT__ . ltrim(APP_PATH, '.') . 'Admin/View/Public/js',

    ),

    // 系统功能模板
    'LISTBUILDER_LAYOUT'   => APP_PATH . 'Common/Builder/listbuilder.html',
    'FORMBUILDER_LAYOUT'   => APP_PATH . 'Common/Builder/formbuilder.html',

    // 全局命名空间
    'AUTOLOAD_NAMESPACE'   => array(
        'Util' => APP_PATH . 'Common/Util/',
    ),
    // 系统功能模板
    'ADMIN_PUBLIC_LAYOUT'  =>  APP_PATH . 'Admin/View/Public/layout.html',

    // 文件上传默认驱动
    'UPLOAD_DRIVER'        => 'Local',

    // 应用配置
    'DEFAULT_MODULE'       => 'Home',
    'MODULE_DENY_LIST'     => array('Common'),
    'MODULE_ALLOW_LIST'    => array('Home', 'Install'),

    // 文件上传相关配置
    'UPLOAD_CONFIG'        => array(
        'mimes'     => '',                          // 允许上传的文件MiMe类型
        'maxSize'   => 2 * 1024 * 1024,             // 上传文件的大小限制 (0-不做限制, 默认为2M, 后台配置会覆盖此值)
        'autoSub'   => true,                        // 自动子目录保存文件
        'subName'   => array('date', 'Y-m-d'),      // 子目录创建方式, [0]-函数名，[1]-参数，多个参数使用数组
        'rootPath'  => './Uploads/',                //保存根路径
        'savePath'  => '',                          //保存路径
        'saveName'  => array('uniqid', ''),         // 上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'   => '',                          // 文件保存后缀， 空则使用原后缀
        'replace'   => false,                       // 存在同名是否覆盖
        'hash'      => true,                        // 是否生成hash编码
        'callback'  => false,                       //检测文件是否存在回调函数，如果存在则返回文件信息数组
    ),

);
// 获取数据库配置信息，手动修改数据库配置请修改./Data/db.php，这里无需改动
if(is_file('./Data/db.php')){
    $db_config = @include './Data/db.php'; // 包含数据库连接配置
}else{
    // 开启开发部署模式
    if(@$_SERVER[ENV_PRE.'DEV_MODE'] === 'true'){
        return array(
            'DB_TYPE'   => $_SERVER[ENV_PRE.'DB_TYPE'] ? : 'mysql', //数据库类型
            'DB_HOST'   => $_SERVER[ENV_PRE.'DB_HOST'] ? : '127.0.0.1', //服务器地址
            'DB_NAME'   => $_SERVER[ENV_PRE.'DB_NAME'] ? : 'lyadmin', //数据库名
            'DB_USER'   => $_SERVER[ENV_PRE.'DB_USER'] ? : 'root', //用户名
            'DB_PWD'    => $_SERVER[ENV_PRE.'DB_PWD'] ? : 'root',  //密码
            'DB_PORT'   => $_SERVER[ENV_PRE.'DB_PORT'] ? : '3306', //端口
            'DB_PREFIX' => $_SERVER[ENV_PRE.'DB_PREFIX'] ? : 'ly_',   //数据库表前缀
            'AUTH_KEY'  => 'T;cMg<H+Bk-uUX.DVWY}#>n+NIbQIxT.?Pspu*[oT][:f%i~|}_d,z=ugtsLHBq)',   // 系统加密KEY，轻易不要修改此项，否则容易造成用户无法登录，如要修改，务必备份原key

        );
    }else{
        return array(
            'DB_TYPE'   => 'mysql', //数据库类型
            'DB_HOST'   => '127.0.0.1', //服务器地址
            'DB_NAME'   => 'lyadmin', //数据库名
            'DB_USER'   => 'root', //用户名
            'DB_PWD'    => 'root',  //密码
            'DB_PORT'   => '3306', //端口
            'DB_PREFIX' => 'ly_',   //数据库表前缀
            'AUTH_KEY'  => 'T;cMg<H+Bk-uUX.DVWY}#>n+NIbQIxT.?Pspu*[oT][:f%i~|}_d,z=ugtsLHBq)',   // 系统加密KEY，轻易不要修改此项，否则容易造成用户无法登录，如要修改，务必备份原key
        );
    }
}

// 返回合并的配置

return array_merge(
    $_config,
    $db_config
);