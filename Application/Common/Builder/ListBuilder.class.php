<?php
namespace Common\Builder;

use Common\Controller\ControllerController;

/**
 * 数据列表自动生成器
 * Class ListBuilder
 * @package Common\Builder
 */
class ListBuilder extends ControllerController{

    private $_metaTitle;                    // 页面标题
    private $_extraHtml;                    // 额外功能代码
    private $_template;                     // 模版
    private $_tableDataPage;                // 表格数据分页
    private $_tableDataListKey  = 'id';     // 表格数据列表主键字段名
    private $_topButtonList     = array();  // 表格右侧操作按钮组
    private $_search            = array();  // 搜索参数配置
    private $_tabNav            = array();  // 页面Tab导航
    private $_tableColumnList   = array();  // 表格标题字段
    private $_tableDataList     = array();  // 表格数据列表
    private $_rightButtonList   = array();  // 顶部工具栏按钮组
    private $_alterDataList     = array();  // 表格数据列表重新修改的项目

    /**
     * 初始化方法
     */
    protected function _initialize(){
        $this->_template    = APP_PATH . 'Common/Builder/Layout/' . MODULE_MARK  . '/list.html';
    }

    /**
     * 设置页面标题
     * @param $metaTitle
     * @return $this
     */
    public function setMetaTitle($metaTitle){
        $this->_metaTitle = $metaTitle;
        return $this;
    }

    /**
     * @param $type
     * @param null $attribute
     * @return $this
     */
    public function addTopButton($type, $attribute = null){
        switch($type){
            case 'add': //添加新增按钮
                //预定义按钮属性以简化使用
                $myAttr['title'] = '新增';
                $myAttr['class'] = 'btn btn-primary-outline btn-pill';
                $myAttr['href']  = U(MODULE_NAME . '/' . CONTROLLER_NAME . '/add');

                if($attribute && is_array($attribute)){
                    $myAttr = array_merge($myAttr, $attribute);
                }

                $this->_topButtonList[] = $myAttr;
                break;
            case 'resume': //添加启用按钮
                //预定义按钮属性以简化使用
                $myAttr['title']        = '启用';
                $myAttr['target-form']  = 'ids';
                $myAttr['class']        = 'btn btn-success-outline btn-pill ajax-post confirm';
                $myAttr['model']        = $attribute['model'] ?: CONTROLLER_NAME; // 要操作的数据模型
                $myAttr['href']        = U(
                    MODULE_NAME . '/' . CONTROLLER_NAME . '/setStatus',
                    array(
                        'status' => 'resume',
                        'model'  => $myAttr['model'],
                    )
                );

                if($attribute && is_array($attribute)){
                    $myAttr = array_merge($myAttr, $attribute);
                }

                $this->_topButtonList[] = $myAttr;
                break;
            case 'forbid': // 添加禁用按钮(启用的反操作)
                // 预定义按钮属性以简化使用
                $myAttr['title']       = '禁用';
                $myAttr['target-form'] = 'ids';
                $myAttr['class']       = 'btn btn-warning-outline btn-pill ajax-post confirm';
                $myAttr['model']       = $attribute['model'] ?: CONTROLLER_NAME;
                $myAttr['href']        = U(
                    MODULE_NAME . '/' . CONTROLLER_NAME . '/setStatus',
                    array(
                        'status' => 'forbid',
                        'model'  => $myAttr['model'],
                    )
                );

                if($attribute && is_array($attribute)){
                    $myAttr = array_merge($myAttr, $attribute);
                }

                $this->_topButtonList[] = $myAttr;
                break;
            case 'recycle': // 添加回收按钮(还原的反操作)
                // 预定义按钮属性以简化使用
                $myAttr['title']       = '回收';
                $myAttr['target-form'] = 'ids';
                $myAttr['class']       = 'btn btn-danger-outline btn-pill ajax-post confirm';
                $myAttr['model']       = $myAttr['model'] ?: CONTROLLER_NAME;
                $myAttr['href']        = U(
                    MODULE_NAME . '/' . CONTROLLER_NAME . '/setStatus',
                    array(
                        'status' => 'recycle',
                        'model'  => $myAttr['model'],
                    )
                );

                if($attribute && is_array($attribute)){
                    $myAttr = array_merge($myAttr, $attribute);
                }

                $this->_topButtonList[] = $myAttr;
                break;
            case 'restore': // 添加还原按钮(回收的反操作)
                // 预定义按钮属性以简化使用
                $myAttr['title']       = '还原';
                $myAttr['target-form'] = 'ids';
                $myAttr['class']       = 'btn btn-success-outline btn-pill ajax-post confirm';
                $myAttr['model']       = $myAttr['model'] ?: CONTROLLER_NAME;
                $myAttr['href']        = U(
                    MODULE_NAME . '/' . CONTROLLER_NAME . '/setStatus',
                    array(
                        'status' => 'restore',
                        'model'  => $myAttr['model'],
                    )
                );

                if($attribute && is_array($attribute)){
                    $myAttr = array_merge($myAttr, $attribute);
                }

                $this->_topButtonList[] = $myAttr;
                break;
            case 'delete': // 添加删除按钮
                // 预定义按钮属性以简化使用
                $myAttr['title']       = '删除';
                $myAttr['target-form'] = 'ids';
                $myAttr['class']       = 'btn btn-danger-outline btn-pill ajax-post confirm';
                $myAttr['model']       = $myAttr['model'] ?: CONTROLLER_NAME;
                $myAttr['href']        = U(
                    MODULE_NAME . '/' . CONTROLLER_NAME . '/setStatus',
                    array(
                        'status' => 'delete',
                        'model'  => $myAttr['model'],
                    )
                );

                if($attribute && is_array($attribute)){
                    $myAttr = array_merge($myAttr, $attribute);
                }

                $this->_topButtonList[] = $myAttr;
                break;
            case 'self': //添加自定义按钮
                // 预定义按钮属性以简化使用
                $myAttr['target-form'] = 'ids';
                $myAttr['class']       = 'btn btn-danger-outline btn-pill';

                if($attribute && is_array($attribute)){
                    $myAttr = array_merge($myAttr, $attribute);
                }

                $this->_topButtonList[] = $myAttr;
                break;
        }
        return $this;
    }

    /**
     * 设置搜索参数
     * @param $title
     * @param $url
     * @return $this
     */
    public function setSearch($title, $url){
        $this->_search = array('title' => $title, 'url' => $url);
        return $this;
    }

    /**
     * 设置按钮列表
     * @param $tabList
     * @param $currentTab
     * @return $this
     */
    public function setTabNav($tabList, $currentTab){
        $this->_tabNav = array(
            'tab_list'      => $tabList,
            'current_tab'   => $currentTab,
        );
        return $this;
    }

    /**
     * 设置表格标题字段
     * @param $name
     * @param $title
     * @param null $type
     * @param null $param
     * @return $this
     */
    public function addTableColumn($name, $title, $type = null, $param = null){
        $column = array(
            'name' => $name,
            'title' => $title,
            'type' => $type,
            'param' => $param,
        );
        $this->_tableColumnList[] = $column;
        return $this;
    }

    /**
     * 表格数据列表
     * @param $tableDataList
     * @return $this
     */
    public function setTableDataList($tableDataList){
        $this->_tableDataList = $tableDataList;
        return $this;
    }

    /**
     * 表格数据列表的主键名称
     * @param $tableDataListKey
     * @return $this
     */
    public function setTableDataListKey($tableDataListKey){
        $this->_tableDataListKey = $tableDataListKey;
        return $this;
    }

    public function addRightButton($type, $attribute = null){
        switch($type){
            case 'edit': // 编辑按钮
                // 预定义按钮属性以简化使用
                $myAttr['name']  = 'edit';
                $myAttr['title'] = '编辑';
                $myAttr['class'] = 'label label-primary-outline label-pill';
                $myAttr['href']  = U(
                    MODULE_NAME . '/' . CONTROLLER_NAME . '/edit',
                    array($this->_tableDataListKey => '__data_id__')
                );

                if ($attribute && is_array($attribute)) {
                    $myAttr = array_merge($myAttr, $attribute);
                }
                $this->_rightButtonList[] = $myAttr;
                break;
            case 'forbid': // 改变记录状态按钮，会更具数据当前的状态自动选择应该显示启用/禁用
                //预定义按钮属
                $myAttr['type']             = 'forbid';
                $myAttr['model']            = $attribute['model'] ?: CONTROLLER_NAME;
                $myAttr['forbid0']['name']  = 'forbid';
                $myAttr['forbid0']['title'] = '启用';
                $myAttr['forbid0']['class'] = 'label label-success-outline label-pill ajax-get confirm';
                $myAttr['forbid0']['href']  = U(
                    MODULE_NAME . '/' . CONTROLLER_NAME . '/setStatus',
                    array(
                        'status' => 'resume',
                        'ids'    => '__data_id__',
                        'model'  => $myAttr['model'],
                    )
                );
                $myAttr['forbid1']['name']  = 'forbid';
                $myAttr['forbid1']['title'] = '禁用';
                $myAttr['forbid1']['class'] = 'label label-warning-outline label-pill ajax-get confirm';
                $myAttr['forbid1']['href']  = U(
                    MODULE_NAME . '/' . CONTROLLER_NAME . '/setStatus',
                    array(
                        'status' => 'forbid',
                        'ids'    => '__data_id__',
                        'model'  => $myAttr['model'],
                    )
                );

                if ($attribute['forbid0'] && is_array($attribute['forbid0'])) {
                    $myAttr['forbid0'] = array_merge($myAttr['forbid0'], $attribute['forbid0']);
                }
                if ($attribute['forbid1'] && is_array($attribute['forbid1'])) {
                    $myAttr['forbid1'] = array_merge($myAttr['forbid1'], $attribute['forbid1']);
                }

                $this->_rightButtonList[] = $myAttr;
                break;

            case 'recycle':
                //预定义按钮属
                $myAttr['type']              = 'recycle';
                $myAttr['model']             = $attribute['model'] ?: CONTROLLER_NAME;
                $myAttr['recycle1']['name']  = 'recycle';
                $myAttr['recycle1']['title'] = '回收';
                $myAttr['recycle1']['class'] = 'label label-danger-outline label-pill ajax-get confirm';
                $myAttr['recycle1']['href']  = U(
                    MODULE_NAME . '/' . CONTROLLER_NAME . '/setStatus',
                    array(
                        'status' => 'recycle',
                        'ids'    => '__data_id__',
                        'model'  => $myAttr['model'],
                    )
                );
                $myAttr['recycle-1']['name']  = 'restore';
                $myAttr['recycle-1']['title'] = '还原';
                $myAttr['recycle-1']['class'] = 'label label-success-outline label-pill ajax-get confirm ';
                $myAttr['recycle-1']['href']  = U(
                    MODULE_NAME . '/' . CONTROLLER_NAME . '/setStatus',
                    array(
                        'status' => 'restore',
                        'ids'    => '__data_id__',
                        'model'  => $myAttr['model'],
                    )
                );

                if ($attribute['recycle-1'] && is_array($attribute['recycle-1'])) {
                    $myAttr['recycle-1'] = array_merge($myAttr['recycle-1'], $attribute['recycle-1']);
                }
                if ($attribute['recycle1'] && is_array($attribute['recycle1'])) {
                    $myAttr['recycle1'] = array_merge($myAttr['recycle1'], $attribute['recycle1']);
                }

                // 这个按钮定义好了把它丢进按钮池里
                $this->_rightButtonList[] = $myAttr;
                break;
            case 'restore':
                // 预定义按钮属性以简化使用
                $myAttr['name']  = 'restore';
                $myAttr['title'] = '还原';
                $myAttr['class'] = 'label label-success-outline label-pill ajax-get confirm';
                $myAttr['model'] = $attribute['model'] ?: CONTROLLER_NAME;
                $myAttr['href']  = U(
                    MODULE_NAME . '/' . CONTROLLER_NAME . '/setStatus',
                    array(
                        'status' => 'restore',
                        'ids'    => '__data_id__',
                        'model'  => $myAttr['model'],
                    )
                );

                if ($attribute && is_array($attribute)) {
                    $myAttr = array_merge($myAttr, $attribute);
                }

                $this->_rightButtonList[] = $myAttr;
                break;
            case 'delete':
                // 预定义按钮属性以简化使用
                $myAttr['name']  = 'delete';
                $myAttr['title'] = '删除';
                $myAttr['class'] = 'label label-danger-outline label-pill ajax-get confirm';
                $myAttr['model'] = $attribute['model'] ?: CONTROLLER_NAME;
                $myAttr['href']  = U(
                    MODULE_NAME . '/' . CONTROLLER_NAME . '/setStatus',
                    array(
                        'status' => 'delete',
                        'ids'    => '__data_id__',
                        'model'  => $myAttr['model'],
                    )
                );

                if ($attribute && is_array($attribute)) {
                    $myAttr = array_merge($myAttr, $attribute);
                }

                $this->_rightButtonList[] = $myAttr;
                break;
            case 'self':
                // 预定义按钮属性以简化使用
                $myAttr['name']  = 'self';
                $myAttr['class'] = 'label label-default';

                // 如果定义了属性数组则与默认的进行合并
                if ($attribute && is_array($attribute)) {
                    $myAttr = array_merge($myAttr, $attribute);
                } else {
                    $myAttr['title'] = '该自定义按钮未配置属性';
                }

                // 这个按钮定义好了把它丢进按钮池里
                $this->_rightButtonList[] = $myAttr;
                break;
        }

        return $this;
    }

    /**
     * 设置分页
     * @param $tableDataPage
     * @return $this
     */
    public function setTableDataPage($tableDataPage){
        $this->_tableDataPage = $tableDataPage;
        return $this;
    }

    /**
     * 修改列表数据
     * 有时候列表数据需要在最终输出前做一次小的修改
     * 比如管理员列表ID为1的超级管理员右侧编辑按钮不显示删除
     * @param $condition
     * @param $alterData
     * @return $this
     */
    public function alterTableData($condition, $alterData){
        $this->_alterDataList[] = array(
            'condition'     => $condition,
            'alter_data'    => $alterData,
        );
        return $this;
    }

    /**
     * 设置额外功能代码
     * @param $extraHtml
     * @return $this
     */
    public function setExtraHtml($extraHtml){
        $this->_extraHtml = $extraHtml;
        return $this;
    }

    /**
     * 设置页面模版
     * @param $template
     * @return $this
     */
    public function setTemplate($template){
        $this->_template = $template;
        return $this;
    }

    /**
     * 页面展示
     */
    public function display()
    {
        // 编译_tableDataList中的值
        foreach($this->_tableDataList as &$data){
            // 编译表格右侧按钮
            if($this->_rightButtonList){
                foreach($this->_rightButtonList as $rightButton){
                    // 禁用按钮比较特殊，它需要根据数据当前状态判断是显示禁用还是启用
                    if ($rightButton['type'] === 'forbid') {
                        $rightButton = $rightButton['forbid' . $data['status']];
                    }
                    if ($rightButton['type'] === 'recycle') {
                        if ($data['status'] === '0' || $data['status'] === '1') {
                            $rightButton = $rightButton['recycle1'];
                        } else {
                            $rightButton = $rightButton['recycle' . $data['status']];
                        }
                    }

                    // 将约定的标记__data_id__替换成真实的数据ID
                    $right_button['href'] = preg_replace(
                        '/__data_id__/i',
                        $data[$this->_tableDataListKey],
                        $rightButton['href']
                    );

                    // 编译按钮属性
                    $rightButton['attribute']                   = $this->compileHtmlAttr($rightButton);
                    $data['right_button'][$rightButton['name']] = $rightButton;
                }
            }

            /**
             * 修改列表数据
             * 有时候列表数据需要在最终输出前做一次小的修改
             * 比如管理员列表ID为1的超级管理员右侧编辑按钮不显示删除
             */
            if ($this->_alterDataList) {
                foreach ($this->_alterDataList as $alter) {
                    if ($data[$alter['condition']['key']] === $alter['condition']['value']) {
                        if ($alter['alter_data']['right_button']) {
                            foreach ($alter['alter_data']['right_button'] as &$val) {
                                if (!$val['attribute']) {
                                    $val['href'] = preg_replace(
                                        '/__data_id__/i',
                                        $data[$this->_tableDataListKey],
                                        $val['href']
                                    );
                                    $val['attribute'] = $this->compileHtmlAttr($val); // 编译按钮属性
                                }
                            }
                        }
                        $data = array_merge($data, $alter['alter_data']);
                    }
                }
            }

            // 根据表格标题字段指定类型编译列表数据
            foreach ($this->_tableColumnList as &$column) {
                switch ($column['type']) {
                    case 'status':
                        switch ($data[$column['name']]) {
                            case '-1':
                                $data[$column['name']] = '<i class="fa fa-trash text-danger"></i>';
                                break;
                            case '0':
                                $data[$column['name']] = '<i class="fa fa-ban text-danger"></i>';
                                break;
                            case '1':
                                $data[$column['name']] = '<i class="fa fa-check text-success"></i>';
                                break;
                        }
                        break;
                    case 'byte':
                        $data[$column['name']] = $this->formatBytes($data[$column['name']]);
                        break;
                    case 'icon':
                        $data[$column['name']] = '<i class="fa ' . $data[$column['name']] . '"></i>';
                        break;
                    case 'date':
                        $data[$column['name']] = time_format($data[$column['name']], 'Y-m-d');
                        break;
                    case 'datetime':
                        $data[$column['name']] = time_format($data[$column['name']]);
                        break;
                    case 'time':
                        $data[$column['name']] = time_format($data[$column['name']]);
                        break;
                    case 'avatar':
                        $data[$column['name']] = '<img style="width:40px;height:40px;" src="' . get_cover($data[$column['name']]) . '">';
                        break;
                    case 'picture':
                        $data[$column['name']] = '<img class="picture" src="' . get_cover($data[$column['name']]) . '">';
                        break;
                    case 'pictures':
                        if (!is_array($data[$column['name']])) {
                            $temp = explode(',', $data[$column['name']]);
                        }
                        $data[$column['name']] = '<img class="picture" src="' . get_cover($temp[0]) . '">';
                        break;
                    case 'type':
                        $form_item_type        = C('FORM_ITEM_TYPE');
                        $data[$column['name']] = $form_item_type[$data[$column['name']]][0];
                        break;
                    case 'callback': // 调用函数
                        if (is_array($column['param'])) {
                            $data[$column['name']] = call_user_func_array($column['param'], array($data[$column['name']]));
                        } else {
                            $data[$column['name']] = call_user_func($column['param'], $data[$column['name']]);
                        }
                        break;
                }
                if (is_array($data[$column['name']]) && $column['name'] !== 'right_button') {
                    $data[$column['name']] = implode(',', $data[$column['name']]);
                }
            }
        }
        //编译top_button_list中的HTML属性
        if ($this->_topButtonList) {
            foreach ($this->_topButtonList as &$button) {
                $button['attribute'] = $this->compileHtmlAttr($button);
            }
        }

        $this->assign('meta_title', $this->_metaTitle); // 页面标题
        $this->assign('top_button_list', $this->_topButtonList); // 顶部工具栏按钮
        $this->assign('search', $this->_search); // 搜索配置
        $this->assign('tab_nav', $this->_tabNav); // 页面Tab导航
        $this->assign('table_column_list', $this->_tableColumnList); // 表格的列
        $this->assign('table_data_list', $this->_tableDataList); // 表格数据
        $this->assign('table_data_list_key', $this->_tableDataListKey); // 表格数据主键字段名称
        $this->assign('table_data_page', $this->_tableDataPage); // 表示个数据分页
        $this->assign('right_button_list', $this->_rightButtonList); // 表格右侧操作按钮
        $this->assign('alter_data_list', $this->_alterDataList); // 表格数据列表重新修改的项目
        $this->assign('extra_html', $this->_extraHtml); //是否ajax提交

        // 显示页面
        $template = CONTROLLER_NAME . '/' . ACTION_NAME;
        if (is_file($this->view->parseTemplate($template))) {
            parent::display();
        } else {
            $this->assign('is_builder', 'list'); // Builder标记
            parent::display($this->_template);
        }
    }

    //编译HTML属性
    protected function compileHtmlAttr($attr)
    {
        $result = array();
        foreach ($attr as $key => $value) {
            $value    = htmlspecialchars($value);
            $result[] = "$key=\"$value\"";
        }
        $result = implode(' ', $result);
        return $result;
    }
}