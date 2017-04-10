<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/7
 * Time: 14:18
 */
if(!function_exists('user_md5')){
    /**
     * 自定义Md5加密方法
     * @param $str
     * @param null $authKey
     * @return string
     */
    function user_md5($str, $authKey = null){

        if(! $authKey){
            $authKey = C('AUTH_KEY') ? : 'defaultKey';
        }

        return '' === $str ? '' : md5(sha1($str).$authKey);
    }
}

if(!function_exists('is_login')) {
    /**
     * 检测用户是否登录
     * @return integer 0-未登录，大于0-当前登录用户ID
     */
    function is_login(){
        return D('Admin/User')->isLogin();
    }
}

if(!function_exists('hook')) {
    /**
     * 处理插件钩子
     * @param $hook
     * @param array $params
     */
    function hook($hook, $params = array())
    {
        $result = \Think\Hook::listen($hook, $params);
    }

}

if(!function_exists('is_ssl')) {
    /**
     * 判断是否SSL协议
     */
    function is_ssl()
    {
        if (isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))) {
            return true;
        } elseif (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
            return true;
        }
        return false;
    }

}