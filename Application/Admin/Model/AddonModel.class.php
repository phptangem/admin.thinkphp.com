<?php
namespace Admin\Model;
use Think\Model;
class AddonModel extends Model {

    protected $tableName = 'admin_addon';

    public function getAllAddon(){
        $addDir = C('ADDON_PATH');
        $dirs   = array_map('basename', glob($addDir . "*", GLOB_ONLYDIR));

        if($dirs == false || !file_exists($addDir)){
            $this->error = '插件目录不存在或者不可读';
            return false;
        }

        $addons         = array();
        $where['name']  = array('in', $dirs);
        $list           = $this->where($where)
              ->field(true)
              ->order('sort asc,id desc')
              ->select();
        foreach($list as $addon){
            $addons[$addon['name']] = $addon;
        }
        foreach($dirs as $dir){
            if(!isset($addons[$dir])){
                $class = get_addon_class($dir);
                if(! class_exists($class)){ //实例化插件忽略执行
                    \Think\Log::recode('插件', $dir .'的入口文件不存在');
                    continue;
                }
                $obj = new $class;
                $addons[$dir] = $obj->info;
                if($addons[$dir]){
                    $addons[$dir]['status'] = -1; // 未安装
                }
            }
        }
        foreach($addons as &$addon){
            switch ($addon['status']) {
                case '-1': // 未安装
                    $addon['status'] = '<i class="fa fa-trash" style="color:red"></i>';
                    $addon['right_button']['install']['title'] = '安装';
                    $addon['right_button']['install']['attribute'] = 'class="label label-success ajax-get" href="' . U('install', array('addon_name' => $addon['name'])) . '"';
                    break;
                case '0': // 禁用
                    $addon['status'] = '<i class="fa fa-ban" style="color:red"></i>';
                    $addon['right_button']['config']['title'] = '设置';
                    $addon['right_button']['config']['attribute'] = 'class="label label-info" href="' . U('config', array('id' => $addon['id'])) . '"';
                    $addon['right_button']['forbid']['title'] = '启用';
                    $addon['right_button']['forbid']['attribute'] = 'class="label label-success ajax-get" href="' . U('setStatus', array('status' => 'resume', 'ids' => $addon['id'])) . '"';
                    $addon['right_button']['uninstall']['title'] = '卸载';
                    $addon['right_button']['uninstall']['attribute'] = 'class="label label-danger ajax-get" href="' . U('uninstall', array('id' => $addon['id'])) . '"';
                    if ($addon['adminlist']) {
                        $addon['right_button']['adminlist']['title'] = '数据管理';
                        $addon['right_button']['adminlist']['attribute'] = 'class="label label-success" href="' . U('adminlist', array('name' => $addon['name'])) . '"';
                    }
                    break;
                case '1': // 正常
                    $addon['status'] = '<i class="fa fa-check" style="color:green"></i>';
                    $addon['right_button']['config']['title'] = '设置';
                    $addon['right_button']['config']['attribute'] = 'class="label label-info" href="' . U('config', array('id' => $addon['id'])) . '"';
                    $addon['right_button']['forbid']['title'] = '禁用';
                    $addon['right_button']['forbid']['attribute'] = 'class="label label-warning ajax-get" href="' . U('setStatus', array('status' => 'forbid', 'ids' => $addon['id'])) . '"';
                    $addon['right_button']['uninstall']['title'] = '卸载';
                    $addon['right_button']['uninstall']['attribute'] = 'class="label label-danger ajax-get" href="' . U('uninstall', array('id' => $addon['id'])) . '"';
                    if ($addon['adminlist']) {
                        $addon['right_button']['adminlist']['title'] = '数据管理';
                        $addon['right_button']['adminlist']['attribute'] = 'class="label label-success" href="' . U('adminlist', array('name' => $addon['name'])) . '"';
                    }
                    break;
            }
        }
        return $addons;
    }
}