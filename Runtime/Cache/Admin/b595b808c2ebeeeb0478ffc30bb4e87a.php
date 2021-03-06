<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title><?php echo ($meta_title); ?>｜<?php echo C('WEB_SITE_TITLE');?>后台管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="author" content="<?php echo C('WEB_SITE_TITLE');?>">
    <meta name="keywords" content="<?php echo ($meta_keywords); ?>">
    <meta name="description" content="<?php echo ($meta_description); ?>">
    <meta name="generator" content="CoreThink">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php echo C('WEB_SITE_TITLE');?>">
    <meta name="format-detection" content="telephone=no,email=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="apple-touch-icon" type="image/x-icon" href="/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="/logo.png">
    <link rel="stylesheet" type="text/css" href="http://admin.thinkphp.com/Public/libs/lyui/dist/css/lyui.min.css">
    <link rel="stylesheet" type="text/css" href="http://admin.thinkphp.com/Application/Admin/View/Public/css/<?php echo C('ADMIN_THEME');?>.css">
    
    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://admin.thinkphp.com/Public/libs/jquery/1.x/jquery.min.js"></script>
</head>
<body class="<?php echo ($_page_name); ?>">
    <div class="clearfix full-header">
        
    <!-- 顶部导航 -->
    <div class="navbar navbar-default navbar-fixed-top main-nav" role="navigation">
        <div class="container-fluid">
            <div>
                <div class="navbar-header navbar-header-default">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-top">
                        <span class="sr-only">切换导航</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php if(C('WEB_SITE_LOGO')): ?>
                    <a class="navbar-brand" target="_blank" href="/">
                        <img class="logo img-responsive" src="<?php echo (get_cover(C("WEB_SITE_LOGO"))); ?>">
                    </a>
                    <?php else: ?>
                    <a class="navbar-brand" target="_blank" href="/">
                        <span><?php echo C('LOGO_DEFAULT');?></span>
                    </a>
                    <?php endif; ?>
                </div>
                <div class="navbar-header navbar-header-inverse">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-top">
                        <span class="sr-only">切换导航</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php if(C('WEB_SITE_LOGO_INVERSE')): ?>
                    <a class="navbar-brand" target="_blank" href="/">
                        <img class="logo img-responsive" src="<?php echo (get_cover(C("WEB_SITE_LOGO_INVERSE"))); ?>">
                    </a>
                    <?php else: ?>
                    <a class="navbar-brand" target="_blank" href="/">
                        <span><?php echo C('LOGO_DEFAULT');?></span>
                    </a>
                    <?php endif; ?>
                </div>
                <div class="collapse navbar-collapse navbar-collapse-top">
                    <ul class="nav navbar-nav">
                        <!-- 主导航 -->
                        <?php if (!C('ADMIN_TABS')): ?>
                        <li><a href="<?php echo U('Admin/Index/index');?>"><i class="fa fa-home"></i> 首页</a></li>
                        <?php if (count($_menu_list) > 6): ?>
                        <?php if(is_array($_menu_list)): $i = 0; $__LIST__ = array_slice($_menu_list,0,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($_parent_menu_list[0]['title'] == $vo['title']) echo 'class="active"'; ?>>
                            <a href="<?php echo U($vo['_child'][0]['_child'][0]['url']);?>" target="<?php echo C(strtolower($vo['name']).'_config.target'); ?>">
                                <i class="fa <?php echo ($vo["icon"]); ?>"></i>
                                <span><?php echo ($vo["title"]); ?></span>
                            </a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-th-large"></i> 更多 <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <?php if(is_array($_menu_list)): $i = 0; $__LIST__ = array_slice($_menu_list,6,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($_parent_menu_list[0]['title'] == $vo['title']) echo 'class="active"'; ?>>
                                    <a href="<?php echo U($vo['_child'][0]['_child'][0]['url']);?>" target="<?php echo C(strtolower($vo['name']).'_config.target'); ?>">
                                        <i class="fa <?php echo ($vo["icon"]); ?>"></i>
                                        <span><?php echo ($vo["title"]); ?></span>
                                    </a>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </li>
                        <?php else: ?>
                        <?php if(is_array($_menu_list)): $i = 0; $__LIST__ = $_menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($_parent_menu_list[0]['title'] == $vo['title']) echo 'class="active"'; ?>>
                            <a href="<?php echo U($vo['_child'][0]['_child'][0]['url']);?>" target="<?php echo C(strtolower($vo['name']).'_config.target'); ?>">
                                <i class="fa <?php echo ($vo["icon"]); ?>"></i>
                                <span><?php echo ($vo["title"]); ?></span>
                            </a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php endif; ?>
                        <?php else: ?>
                        <?php if (count($_menu_list) > 7): ?>
                        <?php if(is_array($_menu_list)): $i = 0; $__LIST__ = array_slice($_menu_list,0,7,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                <a href="#module<?php echo ($vo["id"]); ?>" role="tab" data-toggle="tab">
                                    <i class="fa <?php echo ($vo["icon"]); ?>"></i>
                                    <span><?php echo ($vo["title"]); ?></span>
                                </a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-th-large"></i> 更多 <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <?php if(is_array($_menu_list)): $i = 0; $__LIST__ = array_slice($_menu_list,7,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                        <a href="#module<?php echo ($vo["id"]); ?>" role="tab" data-toggle="tab">
                                            <i class="fa <?php echo ($vo["icon"]); ?>"></i>
                                            <span><?php echo ($vo["title"]); ?></span>
                                        </a>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </li>
                        <?php else: ?>
                        <?php if(is_array($_menu_list)): $i = 0; $__LIST__ = $_menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                <a href="#module<?php echo ($vo["id"]); ?>" role="tab" data-toggle="tab">
                                    <i class="fa <?php echo ($vo["icon"]); ?>"></i>
                                    <span><?php echo ($vo["title"]); ?></span>
                                </a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo U('Admin/Index/removeRuntime');?>" style="border: 0;text-align: left" class="btn ajax-get no-refresh"><i class="fa fa-trash"></i> 清空缓存</a></li>
                        <li><a target="_blank" href="/"><i class="fa fa-external-link"></i> 打开前台</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i> <?php echo ($_user_auth["username"]); ?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a target="_blank" href="/"><i class="fa fa-external-link"></i> 打开前台</a></li>
                                <li><a href="<?php echo U('Admin/Index/removeRuntime');?>" style="border: 0;text-align: left" class="btn ajax-get no-refresh"><i class="fa fa-trash"></i> 清空缓存</a></li>
                                <li><a href="<?php echo U('Admin/Public/logout');?>" class="ajax-get"><i class="fa fa-sign-out"></i> 退出</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    </div>

    <div class="clearfix full-container" id="full-container">
        
    <input type="hidden" name="check_version_url" value="<?php echo U('Admin/Update/checkVersion');?>">
    <div class="container-fluid with-top-navbar" style="height: 100%;overflow: hidden;">
        <div class="row" style="height: 100%;">
            <!-- 后台左侧导航 -->
            <div id="sidebar" class="col-xs-12 col-sm-3 sidebar tab-content">
                <?php if (!C('ADMIN_TABS')): ?>
                <!-- 模块菜单 -->
                <nav class="navside navside-default" role="navigation">
                    <?php if($_current_menu_list['_child']): ?>
                    <ul class="nav navside-nav navside-first">
                        <?php if(is_array($_current_menu_list["_child"])): $fkey = 0; $__LIST__ = $_current_menu_list["_child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_first): $mod = ($fkey % 2 );++$fkey;?><li>
                                <a data-toggle="collapse" href="#navside-collapse-<?php echo ($_ns["id"]); ?>-<?php echo ($fkey); ?>">
                                    <i class="<?php echo ($_ns_first["icon"]); ?>"></i>
                                    <span class="nav-label"><?php echo ($_ns_first["title"]); ?></span>
                                    <span class="angle fa fa-angle-down"></span>
                                    <span class="angle-collapse fa fa-angle-left"></span>
                                </a>
                                <?php if(!empty($_ns_first["_child"])): ?><ul class="nav navside-nav navside-second collapse in" id="navside-collapse-<?php echo ($_ns["id"]); ?>-<?php echo ($fkey); ?>">
                                        <?php if(is_array($_ns_first["_child"])): $skey = 0; $__LIST__ = $_ns_first["_child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_second): $mod = ($skey % 2 );++$skey;?><li <?php if($_parent_menu_list[2]['id'] == $_ns_second['id']) echo 'class="active"'; ?>>
                                            <a href="<?php echo U($_ns_second['url']);?>" >
                                                <i class="<?php echo ($_ns_second["icon"]); ?>"></i>
                                                <span class="nav-label"><?php echo ($_ns_second["title"]); ?></span>
                                            </a>
                                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul><?php endif; ?>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <?php endif; ?>
                </nav>
                <?php else: ?>
                <!-- 模块菜单 -->
                <?php if(is_array($_menu_list)): $i = 0; $__LIST__ = $_menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns): $mod = ($i % 2 );++$i; if($_ns['_child']): ?>
                    <div role="tabpanel" class="tab-pane fade <?php if($i === 1) echo 'active in';?>" id="module<?php echo ($_ns["id"]); ?>">
                        <nav class="navside navside-default" role="navigation">
                            <ul class="nav navside-nav navside-first">
                                <?php if(!empty($_ns["_child"])): if(is_array($_ns["_child"])): $fkey = 0; $__LIST__ = $_ns["_child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_first): $mod = ($fkey % 2 );++$fkey;?><li>
                                            <a data-toggle="collapse" href="#navside-collapse-<?php echo ($_ns["id"]); ?>-<?php echo ($fkey); ?>">
                                                <i class="<?php echo ($_ns_first["icon"]); ?>"></i>
                                                <span class="nav-label"><?php echo ($_ns_first["title"]); ?></span>
                                                <span class="fa arrow"></span>
                                            </a>
                                            <?php if(!empty($_ns_first["_child"])): ?><ul class="nav navside-nav navside-second collapse in" id="navside-collapse-<?php echo ($_ns["id"]); ?>-<?php echo ($fkey); ?>">
                                                    <?php if(is_array($_ns_first["_child"])): $skey = 0; $__LIST__ = $_ns_first["_child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_second): $mod = ($skey % 2 );++$skey;?><li>
                                                            <a href="<?php echo U($_ns_second['url']);?>" class="open-tab" tab-name="navside-collapse-<?php echo ($_ns["id"]); ?>-<?php echo ($fkey); ?>-<?php echo ($skey); ?>">
                                                                <i class="<?php echo ($_ns_second["icon"]); ?>"></i>
                                                                <span class="nav-label"><?php echo ($_ns_second["title"]); ?></span>
                                                            </a>
                                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                                </ul><?php endif; ?>
                                        </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </ul>
                        </nav>
                    </div>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                <?php endif; ?>
            </div>

            <!-- 右侧内容 -->
            <div id="main" class="col-xs-12 col-sm-9 main" style="padding-right: 0;">
                <?php if (C('ADMIN_TABS')): ?>
                <!-- 多标签后台 -->
                <nav class="navbar navbar-default ct-tab-nav" role="navigation">
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li><a href="#" id="tab-left"><i class="fa fa-caret-left"></i></a></li>
                        </ul>
                        <div class="ct-tab-wrap clearfix">
                            <ul class="nav navbar-nav nav-close ct-tab">
                                <li href="#home" role="tab" data-toggle="tab">
                                    <a href="#"><i class="fa fa-dashboard"></i> <span>首页</span></a>
                                </li>
                            </ul>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" id="tab-right"><i class="fa fa-caret-right"></i></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">关闭操作 <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="close-all">关闭所有</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <?php else: ?>
                <!-- 面包屑导航 -->
                <ul class="breadcrumb">
                    <li><i class="fa fa-map-marker"></i></li>
                    <li class="text-muted">首页</li>
                </ul>
                <?php endif; ?>

                <!-- 多标签后台内容部分 -->
                <div class="tab-content ct-tab-content" style="height: 100%;">
                    <!-- 首页 -->
                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                        <div class="dashboard clearfix">
                            <div class="col-xs-12 col-sm-6 col-lg-6 ct-update">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="update pull-right"></div>
                                        <i class="fa fa-cog"></i> 系统信息
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-condensed">
                                            <tbody>
                                            <tr>
                                                <td><?php echo C('PRODUCT_NAME');?>版本</td>
                                                <td>
                                                        <span class="version">
                                                            v<?php echo C('CURRENT_VERSION');?>
                                                            <?php echo C('DEVELOP_VERSION'); ?>
                                                        </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>产品型号</td>
                                                <td><?php echo C('PRODUCT_TITLE');?>（ <?php echo C('PRODUCT_MODEL');?> ）</td>
                                            </tr>
                                            <tr>
                                                <td>ThinkPHP版本</td>
                                                <td><?php echo (THINK_VERSION); ?></td>
                                            </tr>
                                            <tr>
                                                <td>服务器操作系统</td>
                                                <td><?php echo (PHP_OS); ?></td>
                                            </tr>
                                            <tr>
                                                <td>运行环境</td>
                                                <td>
                                                    <?php
 $server_software = explode(' ', $_SERVER['SERVER_SOFTWARE']); echo $server_software[0]; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PHP版本</td>
                                                <td><?php echo PHP_VERSION; ?></td>
                                            </tr>
                                            <tr>
                                                <td>MYSQL版本</td>
                                                <td><?php $system_info_mysql = M()->query("select version() as v;"); echo ($system_info_mysql["0"]["v"]); ?></td>
                                            </tr>
                                            <tr>
                                                <td>上传限制</td>
                                                <td><?php echo ini_get('upload_max_filesize');?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="panel-actions"></div>
                                        <i class="fa fa-users"></i> 产品团队
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-condensed">
                                            <tbody>
                                            <tr>
                                                <td>网站标题</td>
                                                <td><?php echo C('WEB_SITE_TITLE');?></td>
                                            </tr>
                                            <tr>
                                                <td>友情赞助</td>
                                                <td><a target="_blank" href="http://weex-china.org">weex中文网</a></td>
                                            </tr>
                                            <tr>
                                                <td>核心框架</td>
                                                <td><a target="_blank" href="http://www.lingyun.net">零云</a></td>
                                            </tr>
                                            <tr>
                                                <td>官方网址</td>
                                                <td><a target="_blank" href="https://www.lingyun.net">https://www.lingyun.net</a></td>
                                            </tr>
                                            <tr>
                                                <td>核心团队</td>
                                                <td><?php echo C('TEAM_MEMBER');?>...</td>
                                            </tr>
                                            <tr>
                                                <td>客服QQ</td>
                                                <td><?php echo C('TEAM_QQ');?></td>
                                            </tr>
                                            <tr>
                                                <td>官方QQ群</td>
                                                <td>
                                                    <a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=f48f78657bc1f0865ebf44059ca3054b1e73e57c6afee2a91ca3e8d49ee07029">
                                                        <img border="0" src="data:image/png;base64,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" alt="零云交流群" title="零云交流群">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>联系我们</td>
                                                <td>
                                                    <?php echo C('TEAM_EMAIL');?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- 后台首页小工具 -->
                            <?php echo hook('AdminIndex');?>
                        </div>
                    </div>
                </div>

                <div class="clearfix footer">
                    <div class="navbar navbar-default" role="navigation">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" target="_blank" href="http://www.lingyun.net">
                                    <span>零云</span>
                                </a>
                            </div>
                            <div class="collapse navbar-collapse navbar-collapse-bottom">
                                <ul class="nav navbar-nav">
                                    <li>
                                        <a href="<?php echo C('WEBSITE_DOMAIN');?>" class="text-muted" target="_blank">
                                            <span>版权所有 © 2014-<?php echo date("Y",time()); ?></span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a target="_blank" href="https://www.lingyun.net" class="text-muted pull-right">Powered By 零云</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <div class="clearfix full-footer">
        
    </div>

    <div class="clearfix full-script">
        <div class="container-fluid">
            <input type="hidden" id="corethink_home_img" value="__HOME_IMG__">
            <script type="text/javascript" src="http://admin.thinkphp.com/Public/libs/lyui/dist/js/lyui.min.js"></script>
            <script type="text/javascript" src="http://admin.thinkphp.com/Application/Admin/View/Public/js/admin.js"></script>
            <script type="text/javascript">
                // 如果是多标签方式自动跳转后台首页
                var admin_tabs = '<?php echo ($_admin_tabs); ?>';
                if(admin_tabs == '1' && !(self.frameElement != null && (self.frameElement.tagName == "IFRAME" || self.frameElement.tagName == "iframe"))){
                    parent.parent.location = "<?php echo U('Admin/Index/index');?>";
                }
                if(admin_tabs == '0' && (self.frameElement != null && (self.frameElement.tagName == "IFRAME" || self.frameElement.tagName == "iframe"))){
                    parent.parent.location = "<?php echo U('Admin/Index/index');?>";
                }
            </script>
            
        </div>
    </div>
</body>
</html>