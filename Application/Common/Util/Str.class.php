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

    /**
     * @param $str
     * @param $start
     * @param $length
     * @param string $charset
     * @param bool|true $suffix
     * @return string
     */
    public static function cutStr($str, $start, $length, $charset = 'utf-8', $suffix = true)
    {
        $str    = trim($str);
        $length = $length * 2;
        if ($length) {
            //截断字符
            $wordscut = '';
            if (strtolower($charset) == 'utf-8') {
                //utf8编码
                $n   = 0;
                $tn  = 0;
                $noc = 0;
                while ($n < strlen($str)) {
                    $t = ord($str[$n]);
                    if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                        $tn = 1;
                        $n++;
                        $noc++;
                    } elseif (194 <= $t && $t <= 223) {
                        $tn = 2;
                        $n += 2;
                        $noc += 2;
                    } elseif (224 <= $t && $t < 239) {
                        $tn = 3;
                        $n += 3;
                        $noc += 2;
                    } elseif (240 <= $t && $t <= 247) {
                        $tn = 4;
                        $n += 4;
                        $noc += 2;
                    } elseif (248 <= $t && $t <= 251) {
                        $tn = 5;
                        $n += 5;
                        $noc += 2;
                    } elseif ($t == 252 || $t == 253) {
                        $tn = 6;
                        $n += 6;
                        $noc += 2;
                    } else {
                        $n++;
                    }
                    if ($noc >= $length) {
                        break;
                    }
                }
                if ($noc > $length) {
                    $n -= $tn;
                }
                $wordscut = substr($str, 0, $n);
            } else {
                for ($i = 0; $i < $length - 1; $i++) {
                    if (ord($str[$i]) > 127) {
                        $wordscut .= $str[$i] . $str[$i + 1];
                        $i++;
                    } else {
                        $wordscut .= $str[$i];
                    }
                }
            }
            if ($wordscut == $str) {
                return $str;
            }
            return $suffix ? trim($wordscut) . '...' : trim($wordscut);
        } else {
            return $str;
        }
    }
}