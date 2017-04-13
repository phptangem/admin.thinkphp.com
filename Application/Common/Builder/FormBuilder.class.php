<?php
namespace Common\Builder;

use Common\Controller\ControllerController;

/**
 * 表单页面自动生成器
 * Class FormBuilder
 * @package Common\Builder
 */
class FormBuilder extends ControllerController{

    private $_template;                 // 模板
    private $_metaData;                 // 页面标题
    private $_postUrl;                  // 表单提交地址
    private $_submitTitle ;             //确定按钮文本自定义
    private $_extraHtml;                //额外功能代码
    private $_ajaxSubmit    = true;     // 是否ajax提交
    private $_tabNav        = array();  //  页面Tab导航
    private $_extraItems    = array();  // 额外已经构造好的表单项目
    private $_formItems     = array();  // 表单项目
    private $_formData      = array();  // 表单数据
    /**
     * 初始化方法
     */
    protected function _initialize(){
        $this->_template = APP_PATH . 'Common/Builder/Layout/' . MODULE_MARK . '/form.html';
    }

    /**
     * @param $submitTitle
     * @return $this
     */
    public function setSubmitTitle($submitTitle){
        $this->_submitTitle = $submitTitle;
        return $this;
    }

    /**
     * @param $extraHtml
     * @return $this
     */
    public function setExtraHtml($extraHtml){
        $this->_extraHtml = $extraHtml;
        return $this;
    }

    /**
     * @param $ajaxSubmit
     * @return $this
     */
    public function setAjaxSubmit($ajaxSubmit = true){
        $this->_ajaxSubmit = $ajaxSubmit;
        return $this;
    }
    /**
     * @param $metaData
     * @return $this
     */
    public function setMetaTitle($metaData){
        $this->_metaData = $metaData;
        return $this;
    }

    /**
     * @param $tabNav
     * @param $currentTab
     * @return $this
     */
    public function setTabNav($tabNav, $currentTab){
        $this->_tabNav = array('tab_list' => $tabNav, 'current_tab' => $currentTab);
        return $this;
    }

    /**
     * @param $postUrl
     * @return $this
     */
    public function setPostUrl($postUrl){
        $this->_postUrl = $postUrl;
        return $this;
    }

    /**
     * @param $extraItems
     * @return $this
     */
    public function setExtraItems($extraItems){
        $this->_extraItems = $extraItems;
        return $this;
    }

    /**
     * @param string $template
     * @param string $charset
     * @param string $contentType
     * @param string $content
     * @param string $prefix
     * @return bool null
     */
    public function display($template = '', $charset = '', $contentType = '', $content = '', $prefix = ''){
        // 额外已经构造好的表单项目与单个组装的的表单项目进行合并
        $this->_formItems = array_merge($this->_formItems, $this->_extraItems);

        // 编译表单值
        if($this->_formData){
            foreach($this->_formItems as &$item){
                if(isset($item['name']) && isset($this->_formData[$item['name']])){
                    $item['value'] = $this->_formData[$item['name']];
                }
            }
        }

        $this->assign('meta_title', $this->_metaData);      //页面标题
        $this->assign('tab_nav', $this->_tabNav);           //页面导航
        $this->assign('post_url', $this->_postUrl);         //标题提交地址
        $this->assign('form_items', $this->_formItems);     //表单项目
        $this->assign('form_data', $this->_formData);       //表单项目默认值
        $this->assign('ajax_submit', $this->_ajaxSubmit);   //是否ajax提交
        $this->assign('submit_title', $this->_submitTitle); //确定按钮文本自定义
        $this->assign('extra_html', $this->_extraHtml);     //额外HTML代码

        //显示页面
        $template = CONTROLLER_NAME . '/' . ACTION_NAME;
        if(is_file($this->view->parseTemplate($template))){
            parent::display($template);
        } else {
            $this->assign('is_builder', 'form'); // Builder标记
            parent::display($this->_template);
        }
    }
}
