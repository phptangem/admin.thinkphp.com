<?php
namespace Admin\Controller;
use Common\Builder\FormBuilder;
use Common\Builder\ListBuilder;
use Think\Page;

class ConfigController extends AdminController {
    public function index($group = '1'){
        $keyword = I('keyword', '', 'string');
        $where['id|name|title'] = array('like', '%' . $keyword . '%');
        $where['group']         = array('eq', $group);
        $where['status']        = array('egt', '0');
        $p                      = !empty($_GET['p']) ? : 1;
        $configObj = D('Admin/Config');
        $dataList = $configObj
            ->page($p,C('ADMIN_PAGE_ROWS'))
            ->where($where)
            ->order('sort asc,id asc')
            ->select();
        $page = new Page(
            $configObj->where($where)->count(),
            C('ADMIN_PAGE_ROWS')
        );

        // 设置Tab导航数据列表
        $configGroupList = C('CONFIG_GROUP_LIST'); // 获取配置分组
        foreach($configGroupList as $key => $val){
            $tabList[$key]['title'] = $val;
            $tabList[$key]['href']  = U("index", array('group' => $key));
        }

        // 使用Builder快速建立列表页面。
        $builder = new ListBuilder();
        $builder->setMetaTitle('配置列表')  // 设置页面标题
            ->addTopButton('add')           // 添加新增按钮
            ->addTopButton('resume')        // 添加启用按钮
            ->addTopButton('forbid')        // 添加禁用按钮
            ->addTopButton('delete')        // 添加删除按钮
            ->setSearch(
                '请输入ID/配置名称/配置标题',
                U('index', array('group' => $group))
            )
            ->setTabNav($tabList, $group)
            ->addTableColumn('id', 'ID')
            ->addTableColumn('name', '名称')
            ->addTableColumn('title', '标题')
            ->addTableColumn('sort', '排序')
            ->addTableColumn('status', '状态', 'status')
            ->addTableColumn('right_button', '操作', 'btn')
            ->setTableDataList($dataList)      // 数据列表
            ->setTableDataPage($page->show())   // 数据列表
            ->addRightButton('edit') // 添加编辑按钮
            ->addRightButton('forbid') // 添加禁用/启用按钮
            ->addRightButton('delete') // 添加删除按钮
            ->display();
    }

    /**
     * @param int $group
     */
    public function group($group = 1){

        // 根据分组获取配置值
        $where['status'] = array('egt', 0); //禁用或者正常状态
        $where['group']  = array('eq', $group);

        $dataList = D('Config')
            ->where($where)
            ->order('sort asc,id asc')
            ->select();

        // 设置Tab导航数据列表
        $configGroupList = C('CONFIG_GROUP_LIST'); // 获取配置分组
        $tabList         = array();
        foreach($configGroupList as $key => $value){
            $tabList[$key]['title']  = $value;
            $tabList[$key]['href']   = U('group', array('group' => $key));
        }
        //构造表单解析options
        foreach($dataList as &$data){
            $data['name']       = 'config[' . $data['name'] . ']';
            $data['options']    = \Util\Str::parseAttr($data['options']);
        }
        // 使用FormBuilder快速简历表单页面
        $builder = new FormBuilder();
        $builder->setMetaTitle('系统设置')  // 设置页面标题
            ->setTabNav($tabList, $group)   // 设置Tab按钮列表
            ->setPostUrl(U('groupSave'))    // 设置表单提交地址
            ->setExtraItems($dataList)      // 直接设置表单数据
            ->display();
    }

    /**
     * 批量保存配置
     * @param $config
     */
    public function groupSave($config){
        if($config && is_array($config)){
            $configObj = D('Config');
            $sql = 'UPDATE '.C('DB_PREFIX').'admin_config SET value = CASE name';
            $whereIn    = array_map(function($val){
                return "'" . $val . "'";
            }, array_keys($config));
            $whereThen  = '';
            foreach($config as $name => $value){
                // 如果值是数组则转换成字符串，适用于复选框等类型
                if(is_array($value)){
                    $value = implode(',', $value);
                }
                $whereThen .= " WHEN '" .$name . "' THEN '" . $value . "'";
            }
            $sql .= $whereThen;
            $sql .= ' END';
            $sql .= ' WHERE name in(' . implode(',', $whereIn) . ')';
            $ret  = $configObj->execute($sql);
            if($ret){
                S('DB_CONFIG_DATA', null);
                $this->success('保存成功！');
            } else {
                $this->error('保存失败重新尝试');
            }
        }
        $this->error('参数为空,请重新尝试！');
    }
}