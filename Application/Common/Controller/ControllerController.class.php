<?php
namespace Common\Controller;
use \Think\Controller;
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
    protected function display($templateFile='', $charset='', $contentType='', $content='', $prefix=''){
        if(!is_file($templateFile)){
            $depr = C('TMPL_FILE_DEPR');
            if($templateFile == ''){
                //如果模板文件为空 按照默认规则定位
                $templateFile = CONTROLLER_NAME . $depr . ACTION_NAME;
            }elseif(false === strpos($templateFile, $depr)){
                //模板文件路径不完整
                $templateFile = CONTROLLER_NAME . $depr . $templateFile;
            }
        }else{

        }
        $this->assign('meta_description', C('WEB_SITE_DESCRIPTION'));
        $this->assign('meta_keywords', C('WEB_SITE_DESCRIPTION'));
        $this->assign('_user_auth', session('user_auth')); // 用户登录信息
        $this->assign('_admin_public_layout', C('ADMIN_PUBLIC_LAYOUT')); // 页面公共继承模版
        $this->assign('_formbuilder_layout', C('FORMBUILDER_LAYOUT')); // FormBuilder继承模版

        $this->assign('_page_name', strtolower(MODULE_NAME . '_' . CONTROLLER_NAME . '_' . ACTION_NAME));
        $this->view->display($templateFile);
    }
}