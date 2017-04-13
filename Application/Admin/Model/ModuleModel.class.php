<?php
namespace Admin\Model;
use Think\Model;
use Util\Tree;
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
}