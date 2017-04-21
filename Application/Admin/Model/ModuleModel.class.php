<?php
namespace Admin\Model;
use Think\Model;
use Util\Tree;
use Think\Storage;
class ModuleModel extends Model {
    /**
     * 数据库表名
     * @var string
     */
    protected $tableName = 'admin_module';

    /**
     * 获取所有模块菜单
     * @return array|mixed
     */
    public function getAllMenu(){
        $uid = is_login();
        $userGroup = D('Admin/Access')->getFieldByUid($uid, 'group'); //获得当前登录用户信息
        $groupInfo = D('Admin/Group')->find($userGroup);
        $groupAuth = json_decode($groupInfo['menu_auth'], true); // 获得当前登录用户所属部门的权限列表

        //获取所有菜单
        $menuList = S('MENU_LIST_' . $uid);
        if(! $menuList || APP_DEBUG === true){
            $where['status']    = 1;
            $systemModuleList   = $this->where($where)->order('sort asc, id asc')->select();
            $tree               = new tree();
            $menuList           = array();
            foreach($systemModuleList as $key => $module){
                $menu                               = json_decode($module['admin_menu'], true);
                $temp                               = $tree->list2tree($menu);
                $menuList[$module['name']]          = $temp[0];
                $menuList[$module['name']]['id']    = $module['id'];
                $menuList[$module['name']]['name']  = $module['name'];
            }

            S('MENU_LIST_' . $uid, $menuList, 3600); // 缓存配置
        }

        return $menuList;
    }

    /**
     * 根据菜单ID的获取其所有父级菜单
     * @param string $currentMenu
     * @param string $moduleName
     * @return array|bool
     */
    public function getParentMenu($currentMenu = '', $moduleName = MODULE_MARK){
        if(! $currentMenu){
            $currentMenu = $this->getCurrentMenu();
        }

        if(! $currentMenu){
            return false;
        }

        $adminMenu = $this->getFieldByName($moduleName, 'admin_menu');
        $adminMenu = json_decode($adminMenu, true);
        $pid       = $currentMenu['pid'];
        $temp      = array();
        $result[]  = $currentMenu;
        while(true){
            foreach($adminMenu as $key => $val){
                if($val['id'] == $pid){
                    $pid = $val['pid'];
                    array_unshift($result, $val); // 将父菜单插入到第一个元素前
                }
            }

            if ($pid == '0') {
                break;
            }
        }

        return $result;
    }

    /**
     * 获取模块当前菜单
     * @param string $moduleName
     * @return mixed
     */
    public function getCurrentMenu($moduleName = MODULE_MARK){
        $adminMenu = $this->getFieldByName($moduleName, 'admin_menu');
        $adminMenu = json_decode($adminMenu, true);
        foreach($adminMenu as $key => $val){
            if(isset($val['url'])){
                $configUrl = U($val['url']);
                $currentUrl = U(MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME);
                if($currentUrl === $configUrl){
                    $result = $val;
                }
            }
        }

        return $result;
    }

    /**
     * 获取模块名称列表
     * @return mixed
     */
    public function getNameList(){
        $list = $this->getField('name', true);
        foreach($list as $val){
            $return[$val] = $val;
        }
        return $return;
    }

    /**
     * 安装描述文件名
     * @author jry <598821125@qq.com>
     */
    public function install_file()
    {
        return 'opencmf.php';
    }

    public function getAll(){
        // 获取除了Common等系统模块外的用户模块
        // 文件夹下必须有$install_file定义的安装描述文件
        $dirs = array_map('basename', glob(APP_PATH . '*', GLOB_ONLYDIR));
        foreach($dirs as $dir){
            $configFile = realpath(APP_PATH . $dir) . '/ ' . $this->install_file();
            if (Storage::has($configFile)) {
                $moduleDirList[]                       = $dir;
                $tempArr                               = include $configFile;
                $tempArr['info']['status']             = -1; //未安装
                $moduleList[$tempArr['info']['name']]  = $tempArr['info'];
            }
        }
        $installedModuleList = $this->field(true)
            ->order('sort asc, id asc')
            ->select();
        if($installedModuleList){
            foreach($installedModuleList as &$module){
                $newModuleList[$module['name']]                 = $module;
                $newModuleList[$module['name']]['admin_menu']   = json_decode($module['admin_menu'], true);
            }

            // 系统已经安装的模块信息与文件夹下模块信息合并
            $moduleList = array_merge($moduleList, $newModuleList);
        }

        foreach($moduleList as &$module){
            switch ($module['status']) {
                case '-2': // 损坏
                    $module['status_icon']                          = '<span class="text-danger">删除记录</span>';
                    $module['right_button']['damaged']['title']     = '删除记录';
                    $module['right_button']['damaged']['attribute'] = 'class="label label-danger ajax-get" href="' . U('setStatus', array('status' => 'delete', 'ids' => $val['id'])) . '"';
                    break;
                case '-1': // 未安装
                    $module['status_icon']                                 = '<i class="fa fa-download text-success"></i>';
                    $module['right_button']['install_before']['title']     = '安装';
                    $module['right_button']['install_before']['attribute'] = 'class="label label-success" href="' . U('install_before', array('name' => $val['name'])) . '"';
                    break;
                case '0': // 禁用
                    $module['status_icon']                                   = '<i class="fa fa-ban text-danger"></i>';
                    $module['right_button']['update_info']['title']          = '更新菜单';
                    $module['right_button']['update_info']['attribute']      = 'class="label label-info ajax-get no-refresh" href="' . U('updateInfo', array('id' => $val['id'])) . '"';
                    $module['right_button']['forbid']['title']               = '启用';
                    $module['right_button']['forbid']['attribute']           = 'class="label label-success ajax-get" href="' . U('setStatus', array('status' => 'resume', 'ids' => $val['id'])) . '"';
                    $module['right_button']['uninstall_before']['title']     = '卸载';
                    $module['right_button']['uninstall_before']['attribute'] = 'class="label label-danger " href="' . U('uninstall_before', array('id' => $val['id'])) . '"';
                    break;
                case '1': // 正常
                    $module['status_icon']                              = '<i class="fa fa-check text-success"></i>';
                    $module['right_button']['update_info']['title']     = '更新菜单';
                    $module['right_button']['update_info']['attribute'] = 'class="label label-info ajax-get no-refresh" href="' . U('updateInfo', array('id' => $val['id'])) . '"';
                    if (!$module['is_system']) {
                        $module['right_button']['forbid']['title']               = '禁用';
                        $module['right_button']['forbid']['attribute']           = 'class="label label-warning ajax-get" href="' . U('setStatus', array('status' => 'forbid', 'ids' => $val['id'])) . '"';
                        $module['right_button']['uninstall_before']['title']     = '卸载';
                        $module['right_button']['uninstall_before']['attribute'] = 'class="label label-danger " href="' . U('uninstall_before', array('id' => $val['id'])) . '"';
                    }
                    break;
            }
        }
        return $moduleList;
    }
}