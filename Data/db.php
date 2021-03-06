<?php
/**
 * 数据库连接配置文件
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/7
 * Time: 14:35
 */
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
        'DB_PREFIX' => 'ly',   //数据库表前缀
        'AUTH_KEY'  => 'T;cMg<H+Bk-uUX.DVWY}#>n+NIbQIxT.?Pspu*[oT][:f%i~|}_d,z=ugtsLHBq)',   // 系统加密KEY，轻易不要修改此项，否则容易造成用户无法登录，如要修改，务必备份原key
    );
}