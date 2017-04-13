<?php
namespace Util;

class Str{
    /**
     * 根据配置类型解析配置
     * @param $value
     * @param null $type
     * @return array|void
     */
    public static function parseAttr($value, $type = null){
        switch($type){
            default:
                //callback:callable:param
                if(strpos($value, 'callback') === 0){
                    list($flag, $funcName, $funcParam) = explode(':',$value);
                    //防止参数被引号包裹出错
                    $funcParam = trim($funcParam, "'\"");
                    //callable形式如为D('Admin/User')->select
                    if(strpos($funcName, '->')){
                        $funcArr   = explode('->', $funcName);
                        $modelName = trim($funcArr[0], "D('\")");
                        $callArr[] = D($modelName);
                        $callArr[] = $funcArr[1];
                        return call_user_func($callArr, $funcParam);
                    }else{
                        //callable形式如time
                        return call_user_func($funcName, $funcParam);
                    }
                }

                //function(){}匿名函数,暂不支持
                if (strpos($value, 'function') === 0) {
                    return;
                }
                //解析"1:1\r\n2:3"格式字符串为数组
                $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
                if(strpos($value, ':') !== false){
                    $value = array();
                    foreach($array as $val){
                        list($k, $v)    = explode(':', $val);
                        $value[$k]      = $v;
                    }
                }else{
                    $value = $array;
                }
            break;
        }

        return $value;
    }
}