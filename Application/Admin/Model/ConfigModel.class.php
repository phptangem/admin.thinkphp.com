<?php
namespace Admin\Model;
use Think\Model;
class ConfigModel extends Model {
    /**
     * 数据库表明
     * @var string
     */
    protected $tableName = 'admin_config';

    /**
     * 获取配置列表
     */
    public function lists(){
        $where['status'] = array('eq', 1);
        $list            = $this->where($where)->field('name,type,type')->select();
        foreach($list as $key => $val){
            switch($val['type']){
                case 'array':
                    $config[$val['name']] = \Util\Str::parseAttr($val['value']);
                    break;
                case 'checkbox':
                    $config[$val['name']] = explode(',', $val['value']);
                    break;
                default:
                    $config[$val['name']] = $val['value'];
                    break;
            }
        }
        return $config;
    }
}