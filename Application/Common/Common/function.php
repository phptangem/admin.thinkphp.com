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

if(!function_exists('is_weixin')) {
    /**
     * 是否微信访问
     * @return bool
     */
    function is_weixin(){
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        } else {
            return false;
        }
    }
}

if(!function_exists('is_wap')) {
    /**
     * 是否手机访问
     */
    function is_wap(){
        if (isset($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'], "wap")) {
            return true;
        } elseif (isset($_SERVER['HTTP_ACCEPT']) && strpos(strtoupper($_SERVER['HTTP_ACCEPT']), "VND.WAP.WML")) {
            return true;
        } elseif (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
            return true;
        } elseif (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])) {
            return true;
        } else {
            return false;
        }
    }
}

if(!function_exists('get_cover')){
    /**
     * 获取上传文件路径
     * @param null $id
     * @param null $type
     */
    function get_cover($id = null, $type = null){
        return D('Admin/Upload')->getCover($id, $type);
    }
}

if(! function_exists('time_format')){
    /**
     * @param null $time
     * @param string $format
     * @return bool|string
     */
    function time_format($time = null, $format = 'Y-m-d H:i'){
        $time = $time === null ? time() : intval($time);
        return date($format, $time);
    }
}
if(! function_exists('cut_str')){
    /**
     * @param $str
     * @param $start
     * @param $length
     * @param string $charset
     * @param bool|true $suffix
     * @return mixed
     */
    function cut_str($str, $start, $length, $charset = 'utf-8', $suffix = true)
    {
        return \Util\Str::cutStr(
            $str, $start, $length, $charset, $suffix
        );
    }
}

if(! function_exists('get_addon_class')){
    function get_addon_class($name){
        $class = "Addons\\{$name}Addon";
        return $class;
    }
}

if(! function_exists('select_list_as_tree')){
    //获取所有数据并转换成以为数组
    function select_list_as_tree($model, $map = null, $extra = null, $key = 'id'){
        //获取列表
        $con['status'] = array('eq', 1);
        if ($map) {
            $con = array_merge($con, $map);
        }
        $modelObj = D($model);
        if (in_array('sort', $modelObj->getDbFields())) {
            $list = $modelObj->where($con)->order('sort asc, id asc')->select();
        } else {
            $list = $modelObj->where($con)->order('id asc')->select();
        }

        //转换成树状列表(非严格模式)
        $tree = new \Util\Tree();
        $list = $tree->array2tree($list, 'title', 'id', 'pid', 0, false);
        if ($extra) {
            $result[0] = $extra;
        }

        //转换成一维数组
        foreach ($list as $val) {
            $result[$val[$key]] = $val['title_show'];
        }
        return $result;
    }
}