<?php
namespace Common\Controller;
use Think\Controller;
class ControllerController extends Controller {
    /**
     * 加载模板和页面输出 可以返回输出内容
     * @access public
     * @param string $templateFile 模板文件名
     * @param string $charset 模板输出字符集
     * @param string $contentType 输出类型
     * @param string $content 模板输出内容
     * @param string $prefix 模板缓存前缀
     * @return mixed
     */
    protected function display($templateFile='',$charset='',$contentType='',$content='',$prefix=''){
        if(!is_file($templateFile)){
            $depr = C('TMPL_FILE_DEPR');
        }
        $this->view->display();
    }
}