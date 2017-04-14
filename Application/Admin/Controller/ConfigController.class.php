<?php
namespace Admin\Controller;
use Common\Builder\FormBuilder;
class ConfigController extends AdminController {
    public function index(){

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