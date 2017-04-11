<?php

namespace Common\Behavior;
use Think\Behavior;

/**
 * 根据不同情况读取数据库的配置信息并与本地配置合并
 * Class InitConfigBehavior
 * @package Common\Behavior
 */
class InitConfigBehavior extends Behavior{
    public function run(&$content){
        //读取数据库中的配置
        $systemConfig = S('DB_CONFIG_DATA');
        if(! $systemConfig || APP_DEBUG === true){
            $systemConfig = D('Admin/Config')->lists();

            // SESSION 和 COOKIE 前缀设置避免冲突
            $systemConfig['SESSION_PREFIXX'] = strtolower(ENV_PRE.MODIULE_MARK.'_');	//SESSION前缀
            $systemConfig['COOKIE_PREFIXX']  = strtolower(ENV_PRE.MODIULE_MARK.'_');	//COOKIE前缀

            //SESSION数据表
            $systemConfig['SESSION_TABLE'] = C('DB_PREFIXX').'admin_session';

            // 获取所有安装的模块配置
            $moduleList = D('Admin/Module')->where(array('status' => '1'))->field('name,config')->select();
			$moduleConfig = array();
            foreach ($moduleList as $key => $val) {
				$moduleConfig[strtolower($val['name']) . '_config']				   = json_decode($val['config'], true);
				$moduleConfig[strtolower($val['name']) . '_config']['module_name'] = $val['name'];
            }
            if($moduleConfig){
            	// 合并模块配置
            	$systemConfig = array_merge($systemConfig, $moduleConfig);

            	// 加载模块标签库及行为扩展
            	$systemConfig['TAGLIB_PRE_LOAD'] = explode(',', C('TAGLIB_PRE_LOAD'));
            	foreach ($moduleConfig as $key => $val) {

            		// 加载模块标签库
            		if(isset($val['tabib'])){
            			foreach ($val['tabib'] as $tag) {
            				$tab_path = APP_PATH . $val['module_name'] . '/TagLib/'. $tag . '.class.php';
            				if(is_file($tab_path)){
            					$systemConfig['TAGLIB_PRE_LOAD'] = $val['module_name'] . '\\TagLib\\' . $tag;
            				}
            			}	
            				
            		}

            		// 加载模块行为扩展
            		if(isset($val['behavior'])){
            			foreach ($val['behavior'] as $bhv) {
            				$bhvPath = APP_PATH . $val['module_name'] . '/Behavior/' . $bhv . 'Behavior.class.php';
            				if(is_file($bhvPath)){
            					\Think\Hook::add('lingyun_behavior', $val['module_name'] . '\\Behavior\\' . $bhv . 'Behavior');
            				}
            			}
            		}
            	}

            	$systemConfig['TAGLIB_PRE_LOAD'] = implode(',', $systemConfig['TAGLIB_PRE_LOAD']);
            }
        }

		C($systemConfig);
    }
}