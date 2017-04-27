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
    
    <link rel="stylesheet" type="text/css" href="http://admin.thinkphp.com/Public/libs/lyui/dist/css/lyui.extend.min.css">
    <style type="text/css">
    /* Builder样式 */
    .builder .builder-container .builder-data-empty {
        margin-bottom: 20px;
        background-color: #f9f9f9;
    }
    .builder .builder-container .builder-data-empty .empty-info {
        padding: 130px 0;
        color: #555;
    }
    .builder .builder-container .builder-table .table td {
        max-width: 600px;
        vertical-align: middle;
        overflow: hidden;
    }
    .builder .builder-container .builder-table .table td img.picture {
        max-width: 200px;
        max-height: 40px;
    }
    .builder .builder-container .pagination {
        margin-top: 0px;
    }
    .builder.formbuilder-box .form-builder .img-box .remove-picture {
        color: red;
        position: absolute;
        top: 0;
        right: 2px;
        background: #fff;
        border-radius: 20px;
        cursor: pointer;
    }
    .builder.formbuilder-box .form-builder .img-box .remove-picture:hover {
        color: #DD0000;
        box-shadow: inset 0 1px 1px red, 0 0 8px red;
    }
    .builder.formbuilder-box .form-builder .file-box .remove-file {
        color: red;
        position: absolute;
        top: 12px;
        right: 10px;
        border-radius: 20px;
        cursor: pointer;
    }
    .builder.formbuilder-box .form-builder .file-box .remove-file:hover {
        color: #DD0000;
        box-shadow: inset 0 1px 1px red, 0 0 8px red;
    }
    .builder.formbuilder-box .form-builder .board_list .board {
        padding: 0px;
        margin-right: 10px;
    }
    @media (min-width: 768px) {
        .builder.formbuilder-box .form-builder .input,
        .builder.formbuilder-box .form-builder .select,
        .builder.formbuilder-box .form-builder .textarea,
        .builder.formbuilder-box .form-builder .file-box {
            width: 70%;
        }
        .builder.formbuilder-box .form-builder .bottom_button_list .btn {
            min-width: 120px;
        }
        .builder.formbuilder-box .form-builder.form-horizontal {
            padding: 0 15px;
        }
        .builder.formbuilder-box .form-builder.form-horizontal .control-label {
            text-align: left;
        }
        .builder.formbuilder-box .form-builder.form-horizontal .left {
            width: 15%;
            float: left;
        }
        .builder.formbuilder-box .form-builder.form-horizontal .right {
            width: 85%;
            float: left;
        }
    }
    @media (min-width: 992px) {
        .builder.formbuilder-box .form-builder.form-horizontal .left {
            width: 12%;
            float: left;
        }
        .builder.formbuilder-box .form-builder.form-horizontal .right {
            width: 88%;
            float: left;
        }
    }
    @media (max-width: 768px) {
        .builder.formbuilder-box .form-builder .bottom_button_list .btn {
            width: 100%;
        }
    }
</style>


    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://admin.thinkphp.com/Public/libs/jquery/1.x/jquery.min.js"></script>
</head>
<body class="<?php echo ($_page_name); ?>">
    <div class="clearfix full-header">
        
            <?php if (!C('ADMIN_TABS')): ?>
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
                                            <li><a href="<?php echo U('Admin/Index/removeRuntime');?>" style="border: 0;text-align: left;" class="btn text-left ajax-get no-refresh"><i class="fa fa-trash"></i> 清空缓存</a></li>
                                            <li><a href="<?php echo U('Admin/Public/logout');?>" class="ajax-get"><i class="fa fa-sign-out"></i> 退出</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        
    </div>

    <div class="clearfix full-container" id="full-container">
        
            <?php if (!C('ADMIN_TABS')): ?>
                <div class="container-fluid with-top-navbar">
                    <div class="row" style="background: #fff;">
                        <!-- 后台左侧导航 -->
                        <div id="sidebar" class="col-xs-12 col-sm-3 sidebar tab-content">
                            <!-- 模块菜单 -->
                            <nav class="navside navside-default" role="navigation">
                                <?php if($_current_menu_list['_child']): ?>
                                    <ul class="nav navside-nav navside-first">
                                        <?php if(is_array($_current_menu_list["_child"])): $fkey = 0; $__LIST__ = $_current_menu_list["_child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_first): $mod = ($fkey % 2 );++$fkey;?><li>
                                                <a data-toggle="collapse" href="#navside-collapse-<?php echo ($_ns_first["id"]); ?>-<?php echo ($fkey); ?>">
                                                    <i class="<?php echo ($_ns_first["icon"]); ?>"></i>
                                                    <span class="nav-label"><?php echo ($_ns_first["title"]); ?></span>
                                                    <span class="angle fa fa-angle-down"></span>
                                                    <span class="angle-collapse fa fa-angle-left"></span>
                                                </a>
                                                <?php if(!empty($_ns_first["_child"])): ?><ul class="nav navside-nav navside-second collapse in" id="navside-collapse-<?php echo ($_ns_first["id"]); ?>-<?php echo ($fkey); ?>">
                                                        <?php if(is_array($_ns_first["_child"])): $skey = 0; $__LIST__ = $_ns_first["_child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_second): $mod = ($skey % 2 );++$skey;?><li <?php if($_parent_menu_list[2]['url'] == $_ns_second['url']) echo 'class="active"'; ?>>
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
                        </div>

                        <!-- 右侧内容 -->
                        <div id="main" class="col-xs-12 col-sm-9 main"  style="overflow-y: scroll;">
                            <!-- 面包屑导航 -->
                            <ul class="breadcrumb">
                                <li><i class="fa fa-map-marker"></i></li>
                                <?php if(is_array($_parent_menu_list)): $i = 0; $__LIST__ = $_parent_menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="text-muted"><?php echo ($vo["title"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>

                            <!-- 主体内容区域 -->
                            <div class="tab-content ct-tab-content">
                                
    <div class="panel builder formbuilder-box">
        <div class="panel-body">
            <form action="/admin.php?s=/Admin/Group/add.html" method="post" class="form form-builder">
                <ul class="nav-tabs nav">
                    <li class="active"><a href="#tab1" data-toggle="tab">部门信息</a></li>
                    <?php if(($info["id"]) != "1"): ?><li><a href="#tab2" data-toggle="tab">系统权限</a></li><?php endif; ?>
                </ul>
                <div class="tab-content">
                    <div id="tab1" class="tab-pane active">
                        <div class="form-group"></div>
                        <?php if(($info["id"]) != "1"): ?><div class="form-group">
                                <label class="left control-label">上级部门：</label>
                                <div class="right">
                                    <select name="pid" class="form-control select cui-select">
                                        <?php if(is_array($all_group)): $i = 0; $__LIST__ = $all_group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"
                                                <?php if($key == $info['pid']) echo 'selected="selected"'; ?> >
                                                <?php echo ($group); ?>
                                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-success"><?php echo ($info["title"]); ?>拥有后台所有权限</div><?php endif; ?>
                        <div class="form-group">
                            <label class="left control-label">部门名称：</label>
                            <div class="right">
                                <input type="text" class="form-control input" name="title" value="<?php echo ((isset($info["title"]) && ($info["title"] !== ""))?($info["title"]):''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="left control-label">图标：</label>
                            <div class="right">
                                <div class="input-group input" id="icon">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-fw fa-info-circle"></i> 点击选择图标</button>
                                    </span>
                                    <input type="text" class="form-control" name="icon" value="<?php echo ((isset($info["icon"]) && ($info["icon"] !== ""))?($info["icon"]):''); ?>">
                                </div>
                                <script type="text/javascript">
                                    $(function(){
                                        $("#icon").iconpicker({
                                            icons: '[{"filter":"glass","name":"glass","selector":"fa-glass"},{"filter":"music","name":"music","selector":"fa-music"},{"filter":"search","name":"search","selector":"fa-search"},{"filter":"envelope-o","name":"envelope-o","selector":"fa-envelope-o"},{"filter":"heart","name":"heart","selector":"fa-heart"},{"filter":"star","name":"star","selector":"fa-star"},{"filter":"star-o","name":"star-o","selector":"fa-star-o"},{"filter":"user","name":"user","selector":"fa-user"},{"filter":"film","name":"film","selector":"fa-film"},{"filter":"th-large","name":"th-large","selector":"fa-th-large"},{"filter":"th","name":"th","selector":"fa-th"},{"filter":"th-list","name":"th-list","selector":"fa-th-list"},{"filter":"check","name":"check","selector":"fa-check"},{"filter":"times","name":"times","selector":"fa-times"},{"filter":"search-plus","name":"search-plus","selector":"fa-search-plus"},{"filter":"search-minus","name":"search-minus","selector":"fa-search-minus"},{"filter":"power-off","name":"power-off","selector":"fa-power-off"},{"filter":"signal","name":"signal","selector":"fa-signal"},{"filter":"cog","name":"cog","selector":"fa-cog"},{"filter":"trash-o","name":"trash-o","selector":"fa-trash-o"},{"filter":"home","name":"home","selector":"fa-home"},{"filter":"file-o","name":"file-o","selector":"fa-file-o"},{"filter":"clock-o","name":"clock-o","selector":"fa-clock-o"},{"filter":"road","name":"road","selector":"fa-road"},{"filter":"download","name":"download","selector":"fa-download"},{"filter":"arrow-circle-o-down","name":"arrow-circle-o-down","selector":"fa-arrow-circle-o-down"},{"filter":"arrow-circle-o-up","name":"arrow-circle-o-up","selector":"fa-arrow-circle-o-up"},{"filter":"inbox","name":"inbox","selector":"fa-inbox"},{"filter":"play-circle-o","name":"play-circle-o","selector":"fa-play-circle-o"},{"filter":"repeat","name":"repeat","selector":"fa-repeat"},{"filter":"refresh","name":"refresh","selector":"fa-refresh"},{"filter":"list-alt","name":"list-alt","selector":"fa-list-alt"},{"filter":"lock","name":"lock","selector":"fa-lock"},{"filter":"flag","name":"flag","selector":"fa-flag"},{"filter":"headphones","name":"headphones","selector":"fa-headphones"},{"filter":"volume-off","name":"volume-off","selector":"fa-volume-off"},{"filter":"volume-down","name":"volume-down","selector":"fa-volume-down"},{"filter":"volume-up","name":"volume-up","selector":"fa-volume-up"},{"filter":"qrcode","name":"qrcode","selector":"fa-qrcode"},{"filter":"barcode","name":"barcode","selector":"fa-barcode"},{"filter":"tag","name":"tag","selector":"fa-tag"},{"filter":"tags","name":"tags","selector":"fa-tags"},{"filter":"book","name":"book","selector":"fa-book"},{"filter":"bookmark","name":"bookmark","selector":"fa-bookmark"},{"filter":"print","name":"print","selector":"fa-print"},{"filter":"camera","name":"camera","selector":"fa-camera"},{"filter":"font","name":"font","selector":"fa-font"},{"filter":"bold","name":"bold","selector":"fa-bold"},{"filter":"italic","name":"italic","selector":"fa-italic"},{"filter":"text-height","name":"text-height","selector":"fa-text-height"},{"filter":"text-width","name":"text-width","selector":"fa-text-width"},{"filter":"align-left","name":"align-left","selector":"fa-align-left"},{"filter":"align-center","name":"align-center","selector":"fa-align-center"},{"filter":"align-right","name":"align-right","selector":"fa-align-right"},{"filter":"align-justify","name":"align-justify","selector":"fa-align-justify"},{"filter":"list","name":"list","selector":"fa-list"},{"filter":"outdent","name":"outdent","selector":"fa-outdent"},{"filter":"indent","name":"indent","selector":"fa-indent"},{"filter":"video-camera","name":"video-camera","selector":"fa-video-camera"},{"filter":"picture-o","name":"picture-o","selector":"fa-picture-o"},{"filter":"pencil","name":"pencil","selector":"fa-pencil"},{"filter":"map-marker","name":"map-marker","selector":"fa-map-marker"},{"filter":"adjust","name":"adjust","selector":"fa-adjust"},{"filter":"tint","name":"tint","selector":"fa-tint"},{"filter":"pencil-square-o","name":"pencil-square-o","selector":"fa-pencil-square-o"},{"filter":"share-square-o","name":"share-square-o","selector":"fa-share-square-o"},{"filter":"check-square-o","name":"check-square-o","selector":"fa-check-square-o"},{"filter":"arrows","name":"arrows","selector":"fa-arrows"},{"filter":"step-backward","name":"step-backward","selector":"fa-step-backward"},{"filter":"fast-backward","name":"fast-backward","selector":"fa-fast-backward"},{"filter":"backward","name":"backward","selector":"fa-backward"},{"filter":"play","name":"play","selector":"fa-play"},{"filter":"pause","name":"pause","selector":"fa-pause"},{"filter":"stop","name":"stop","selector":"fa-stop"},{"filter":"forward","name":"forward","selector":"fa-forward"},{"filter":"fast-forward","name":"fast-forward","selector":"fa-fast-forward"},{"filter":"step-forward","name":"step-forward","selector":"fa-step-forward"},{"filter":"eject","name":"eject","selector":"fa-eject"},{"filter":"chevron-left","name":"chevron-left","selector":"fa-chevron-left"},{"filter":"chevron-right","name":"chevron-right","selector":"fa-chevron-right"},{"filter":"plus-circle","name":"plus-circle","selector":"fa-plus-circle"},{"filter":"minus-circle","name":"minus-circle","selector":"fa-minus-circle"},{"filter":"times-circle","name":"times-circle","selector":"fa-times-circle"},{"filter":"check-circle","name":"check-circle","selector":"fa-check-circle"},{"filter":"question-circle","name":"question-circle","selector":"fa-question-circle"},{"filter":"info-circle","name":"info-circle","selector":"fa-info-circle"},{"filter":"crosshairs","name":"crosshairs","selector":"fa-crosshairs"},{"filter":"times-circle-o","name":"times-circle-o","selector":"fa-times-circle-o"},{"filter":"check-circle-o","name":"check-circle-o","selector":"fa-check-circle-o"},{"filter":"ban","name":"ban","selector":"fa-ban"},{"filter":"arrow-left","name":"arrow-left","selector":"fa-arrow-left"},{"filter":"arrow-right","name":"arrow-right","selector":"fa-arrow-right"},{"filter":"arrow-up","name":"arrow-up","selector":"fa-arrow-up"},{"filter":"arrow-down","name":"arrow-down","selector":"fa-arrow-down"},{"filter":"share","name":"share","selector":"fa-share"},{"filter":"expand","name":"expand","selector":"fa-expand"},{"filter":"compress","name":"compress","selector":"fa-compress"},{"filter":"plus","name":"plus","selector":"fa-plus"},{"filter":"minus","name":"minus","selector":"fa-minus"},{"filter":"asterisk","name":"asterisk","selector":"fa-asterisk"},{"filter":"exclamation-circle","name":"exclamation-circle","selector":"fa-exclamation-circle"},{"filter":"gift","name":"gift","selector":"fa-gift"},{"filter":"leaf","name":"leaf","selector":"fa-leaf"},{"filter":"fire","name":"fire","selector":"fa-fire"},{"filter":"eye","name":"eye","selector":"fa-eye"},{"filter":"eye-slash","name":"eye-slash","selector":"fa-eye-slash"},{"filter":"exclamation-triangle","name":"exclamation-triangle","selector":"fa-exclamation-triangle"},{"filter":"plane","name":"plane","selector":"fa-plane"},{"filter":"calendar","name":"calendar","selector":"fa-calendar"},{"filter":"random","name":"random","selector":"fa-random"},{"filter":"comment","name":"comment","selector":"fa-comment"},{"filter":"magnet","name":"magnet","selector":"fa-magnet"},{"filter":"chevron-up","name":"chevron-up","selector":"fa-chevron-up"},{"filter":"chevron-down","name":"chevron-down","selector":"fa-chevron-down"},{"filter":"retweet","name":"retweet","selector":"fa-retweet"},{"filter":"shopping-cart","name":"shopping-cart","selector":"fa-shopping-cart"},{"filter":"folder","name":"folder","selector":"fa-folder"},{"filter":"folder-open","name":"folder-open","selector":"fa-folder-open"},{"filter":"arrows-v","name":"arrows-v","selector":"fa-arrows-v"},{"filter":"arrows-h","name":"arrows-h","selector":"fa-arrows-h"},{"filter":"bar-chart-o","name":"bar-chart-o","selector":"fa-bar-chart-o"},{"filter":"twitter-square","name":"twitter-square","selector":"fa-twitter-square"},{"filter":"facebook-square","name":"facebook-square","selector":"fa-facebook-square"},{"filter":"camera-retro","name":"camera-retro","selector":"fa-camera-retro"},{"filter":"key","name":"key","selector":"fa-key"},{"filter":"cogs","name":"cogs","selector":"fa-cogs"},{"filter":"comments","name":"comments","selector":"fa-comments"},{"filter":"thumbs-o-up","name":"thumbs-o-up","selector":"fa-thumbs-o-up"},{"filter":"thumbs-o-down","name":"thumbs-o-down","selector":"fa-thumbs-o-down"},{"filter":"star-half","name":"star-half","selector":"fa-star-half"},{"filter":"heart-o","name":"heart-o","selector":"fa-heart-o"},{"filter":"sign-out","name":"sign-out","selector":"fa-sign-out"},{"filter":"linkedin-square","name":"linkedin-square","selector":"fa-linkedin-square"},{"filter":"thumb-tack","name":"thumb-tack","selector":"fa-thumb-tack"},{"filter":"external-link","name":"external-link","selector":"fa-external-link"},{"filter":"sign-in","name":"sign-in","selector":"fa-sign-in"},{"filter":"trophy","name":"trophy","selector":"fa-trophy"},{"filter":"github-square","name":"github-square","selector":"fa-github-square"},{"filter":"upload","name":"upload","selector":"fa-upload"},{"filter":"lemon-o","name":"lemon-o","selector":"fa-lemon-o"},{"filter":"phone","name":"phone","selector":"fa-phone"},{"filter":"square-o","name":"square-o","selector":"fa-square-o"},{"filter":"bookmark-o","name":"bookmark-o","selector":"fa-bookmark-o"},{"filter":"phone-square","name":"phone-square","selector":"fa-phone-square"},{"filter":"twitter","name":"twitter","selector":"fa-twitter"},{"filter":"facebook","name":"facebook","selector":"fa-facebook"},{"filter":"github","name":"github","selector":"fa-github"},{"filter":"unlock","name":"unlock","selector":"fa-unlock"},{"filter":"credit-card","name":"credit-card","selector":"fa-credit-card"},{"filter":"rss","name":"rss","selector":"fa-rss"},{"filter":"hdd-o","name":"hdd-o","selector":"fa-hdd-o"},{"filter":"bullhorn","name":"bullhorn","selector":"fa-bullhorn"},{"filter":"bell","name":"bell","selector":"fa-bell"},{"filter":"certificate","name":"certificate","selector":"fa-certificate"},{"filter":"hand-o-right","name":"hand-o-right","selector":"fa-hand-o-right"},{"filter":"hand-o-left","name":"hand-o-left","selector":"fa-hand-o-left"},{"filter":"hand-o-up","name":"hand-o-up","selector":"fa-hand-o-up"},{"filter":"hand-o-down","name":"hand-o-down","selector":"fa-hand-o-down"},{"filter":"arrow-circle-left","name":"arrow-circle-left","selector":"fa-arrow-circle-left"},{"filter":"arrow-circle-right","name":"arrow-circle-right","selector":"fa-arrow-circle-right"},{"filter":"arrow-circle-up","name":"arrow-circle-up","selector":"fa-arrow-circle-up"},{"filter":"arrow-circle-down","name":"arrow-circle-down","selector":"fa-arrow-circle-down"},{"filter":"globe","name":"globe","selector":"fa-globe"},{"filter":"wrench","name":"wrench","selector":"fa-wrench"},{"filter":"tasks","name":"tasks","selector":"fa-tasks"},{"filter":"filter","name":"filter","selector":"fa-filter"},{"filter":"briefcase","name":"briefcase","selector":"fa-briefcase"},{"filter":"arrows-alt","name":"arrows-alt","selector":"fa-arrows-alt"},{"filter":"users","name":"users","selector":"fa-users"},{"filter":"link","name":"link","selector":"fa-link"},{"filter":"cloud","name":"cloud","selector":"fa-cloud"},{"filter":"flask","name":"flask","selector":"fa-flask"},{"filter":"scissors","name":"scissors","selector":"fa-scissors"},{"filter":"files-o","name":"files-o","selector":"fa-files-o"},{"filter":"paperclip","name":"paperclip","selector":"fa-paperclip"},{"filter":"floppy-o","name":"floppy-o","selector":"fa-floppy-o"},{"filter":"square","name":"square","selector":"fa-square"},{"filter":"bars","name":"bars","selector":"fa-bars"},{"filter":"list-ul","name":"list-ul","selector":"fa-list-ul"},{"filter":"list-ol","name":"list-ol","selector":"fa-list-ol"},{"filter":"strikethrough","name":"strikethrough","selector":"fa-strikethrough"},{"filter":"underline","name":"underline","selector":"fa-underline"},{"filter":"table","name":"table","selector":"fa-table"},{"filter":"magic","name":"magic","selector":"fa-magic"},{"filter":"truck","name":"truck","selector":"fa-truck"},{"filter":"pinterest","name":"pinterest","selector":"fa-pinterest"},{"filter":"pinterest-square","name":"pinterest-square","selector":"fa-pinterest-square"},{"filter":"google-plus-square","name":"google-plus-square","selector":"fa-google-plus-square"},{"filter":"google-plus","name":"google-plus","selector":"fa-google-plus"},{"filter":"money","name":"money","selector":"fa-money"},{"filter":"caret-down","name":"caret-down","selector":"fa-caret-down"},{"filter":"caret-up","name":"caret-up","selector":"fa-caret-up"},{"filter":"caret-left","name":"caret-left","selector":"fa-caret-left"},{"filter":"caret-right","name":"caret-right","selector":"fa-caret-right"},{"filter":"columns","name":"columns","selector":"fa-columns"},{"filter":"sort","name":"sort","selector":"fa-sort"},{"filter":"sort-asc","name":"sort-asc","selector":"fa-sort-asc"},{"filter":"sort-desc","name":"sort-desc","selector":"fa-sort-desc"},{"filter":"envelope","name":"envelope","selector":"fa-envelope"},{"filter":"linkedin","name":"linkedin","selector":"fa-linkedin"},{"filter":"undo","name":"undo","selector":"fa-undo"},{"filter":"gavel","name":"gavel","selector":"fa-gavel"},{"filter":"tachometer","name":"tachometer","selector":"fa-tachometer"},{"filter":"comment-o","name":"comment-o","selector":"fa-comment-o"},{"filter":"comments-o","name":"comments-o","selector":"fa-comments-o"},{"filter":"bolt","name":"bolt","selector":"fa-bolt"},{"filter":"sitemap","name":"sitemap","selector":"fa-sitemap"},{"filter":"umbrella","name":"umbrella","selector":"fa-umbrella"},{"filter":"clipboard","name":"clipboard","selector":"fa-clipboard"},{"filter":"lightbulb-o","name":"lightbulb-o","selector":"fa-lightbulb-o"},{"filter":"exchange","name":"exchange","selector":"fa-exchange"},{"filter":"cloud-download","name":"cloud-download","selector":"fa-cloud-download"},{"filter":"cloud-upload","name":"cloud-upload","selector":"fa-cloud-upload"},{"filter":"user-md","name":"user-md","selector":"fa-user-md"},{"filter":"stethoscope","name":"stethoscope","selector":"fa-stethoscope"},{"filter":"suitcase","name":"suitcase","selector":"fa-suitcase"},{"filter":"bell-o","name":"bell-o","selector":"fa-bell-o"},{"filter":"coffee","name":"coffee","selector":"fa-coffee"},{"filter":"cutlery","name":"cutlery","selector":"fa-cutlery"},{"filter":"file-text-o","name":"file-text-o","selector":"fa-file-text-o"},{"filter":"building-o","name":"building-o","selector":"fa-building-o"},{"filter":"hospital-o","name":"hospital-o","selector":"fa-hospital-o"},{"filter":"ambulance","name":"ambulance","selector":"fa-ambulance"},{"filter":"medkit","name":"medkit","selector":"fa-medkit"},{"filter":"fighter-jet","name":"fighter-jet","selector":"fa-fighter-jet"},{"filter":"beer","name":"beer","selector":"fa-beer"},{"filter":"h-square","name":"h-square","selector":"fa-h-square"},{"filter":"plus-square","name":"plus-square","selector":"fa-plus-square"},{"filter":"angle-double-left","name":"angle-double-left","selector":"fa-angle-double-left"},{"filter":"angle-double-right","name":"angle-double-right","selector":"fa-angle-double-right"},{"filter":"angle-double-up","name":"angle-double-up","selector":"fa-angle-double-up"},{"filter":"angle-double-down","name":"angle-double-down","selector":"fa-angle-double-down"},{"filter":"angle-left","name":"angle-left","selector":"fa-angle-left"},{"filter":"angle-right","name":"angle-right","selector":"fa-angle-right"},{"filter":"angle-up","name":"angle-up","selector":"fa-angle-up"},{"filter":"angle-down","name":"angle-down","selector":"fa-angle-down"},{"filter":"desktop","name":"desktop","selector":"fa-desktop"},{"filter":"laptop","name":"laptop","selector":"fa-laptop"},{"filter":"tablet","name":"tablet","selector":"fa-tablet"},{"filter":"mobile","name":"mobile","selector":"fa-mobile"},{"filter":"circle-o","name":"circle-o","selector":"fa-circle-o"},{"filter":"quote-left","name":"quote-left","selector":"fa-quote-left"},{"filter":"quote-right","name":"quote-right","selector":"fa-quote-right"},{"filter":"spinner","name":"spinner","selector":"fa-spinner"},{"filter":"circle","name":"circle","selector":"fa-circle"},{"filter":"reply","name":"reply","selector":"fa-reply"},{"filter":"github-alt","name":"github-alt","selector":"fa-github-alt"},{"filter":"folder-o","name":"folder-o","selector":"fa-folder-o"},{"filter":"folder-open-o","name":"folder-open-o","selector":"fa-folder-open-o"},{"filter":"smile-o","name":"smile-o","selector":"fa-smile-o"},{"filter":"frown-o","name":"frown-o","selector":"fa-frown-o"},{"filter":"meh-o","name":"meh-o","selector":"fa-meh-o"},{"filter":"gamepad","name":"gamepad","selector":"fa-gamepad"},{"filter":"keyboard-o","name":"keyboard-o","selector":"fa-keyboard-o"},{"filter":"flag-o","name":"flag-o","selector":"fa-flag-o"},{"filter":"flag-checkered","name":"flag-checkered","selector":"fa-flag-checkered"},{"filter":"terminal","name":"terminal","selector":"fa-terminal"},{"filter":"code","name":"code","selector":"fa-code"},{"filter":"reply-all","name":"reply-all","selector":"fa-reply-all"},{"filter":"mail-reply-all","name":"mail-reply-all","selector":"fa-mail-reply-all"},{"filter":"star-half-o","name":"star-half-o","selector":"fa-star-half-o"},{"filter":"location-arrow","name":"location-arrow","selector":"fa-location-arrow"},{"filter":"crop","name":"crop","selector":"fa-crop"},{"filter":"code-fork","name":"code-fork","selector":"fa-code-fork"},{"filter":"chain-broken","name":"chain-broken","selector":"fa-chain-broken"},{"filter":"question","name":"question","selector":"fa-question"},{"filter":"info","name":"info","selector":"fa-info"},{"filter":"exclamation","name":"exclamation","selector":"fa-exclamation"},{"filter":"superscript","name":"superscript","selector":"fa-superscript"},{"filter":"subscript","name":"subscript","selector":"fa-subscript"},{"filter":"eraser","name":"eraser","selector":"fa-eraser"},{"filter":"puzzle-piece","name":"puzzle-piece","selector":"fa-puzzle-piece"},{"filter":"microphone","name":"microphone","selector":"fa-microphone"},{"filter":"microphone-slash","name":"microphone-slash","selector":"fa-microphone-slash"},{"filter":"shield","name":"shield","selector":"fa-shield"},{"filter":"calendar-o","name":"calendar-o","selector":"fa-calendar-o"},{"filter":"fire-extinguisher","name":"fire-extinguisher","selector":"fa-fire-extinguisher"},{"filter":"rocket","name":"rocket","selector":"fa-rocket"},{"filter":"maxcdn","name":"maxcdn","selector":"fa-maxcdn"},{"filter":"chevron-circle-left","name":"chevron-circle-left","selector":"fa-chevron-circle-left"},{"filter":"chevron-circle-right","name":"chevron-circle-right","selector":"fa-chevron-circle-right"},{"filter":"chevron-circle-up","name":"chevron-circle-up","selector":"fa-chevron-circle-up"},{"filter":"chevron-circle-down","name":"chevron-circle-down","selector":"fa-chevron-circle-down"},{"filter":"html5","name":"html5","selector":"fa-html5"},{"filter":"css3","name":"css3","selector":"fa-css3"},{"filter":"anchor","name":"anchor","selector":"fa-anchor"},{"filter":"unlock-alt","name":"unlock-alt","selector":"fa-unlock-alt"},{"filter":"bullseye","name":"bullseye","selector":"fa-bullseye"},{"filter":"ellipsis-h","name":"ellipsis-h","selector":"fa-ellipsis-h"},{"filter":"ellipsis-v","name":"ellipsis-v","selector":"fa-ellipsis-v"},{"filter":"rss-square","name":"rss-square","selector":"fa-rss-square"},{"filter":"play-circle","name":"play-circle","selector":"fa-play-circle"},{"filter":"ticket","name":"ticket","selector":"fa-ticket"},{"filter":"minus-square","name":"minus-square","selector":"fa-minus-square"},{"filter":"minus-square-o","name":"minus-square-o","selector":"fa-minus-square-o"},{"filter":"level-up","name":"level-up","selector":"fa-level-up"},{"filter":"level-down","name":"level-down","selector":"fa-level-down"},{"filter":"check-square","name":"check-square","selector":"fa-check-square"},{"filter":"pencil-square","name":"pencil-square","selector":"fa-pencil-square"},{"filter":"external-link-square","name":"external-link-square","selector":"fa-external-link-square"},{"filter":"share-square","name":"share-square","selector":"fa-share-square"},{"filter":"compass","name":"compass","selector":"fa-compass"},{"filter":"caret-square-o-down","name":"caret-square-o-down","selector":"fa-caret-square-o-down"},{"filter":"caret-square-o-up","name":"caret-square-o-up","selector":"fa-caret-square-o-up"},{"filter":"caret-square-o-right","name":"caret-square-o-right","selector":"fa-caret-square-o-right"},{"filter":"eur","name":"eur","selector":"fa-eur"},{"filter":"gbp","name":"gbp","selector":"fa-gbp"},{"filter":"usd","name":"usd","selector":"fa-usd"},{"filter":"inr","name":"inr","selector":"fa-inr"},{"filter":"jpy","name":"jpy","selector":"fa-jpy"},{"filter":"rub","name":"rub","selector":"fa-rub"},{"filter":"krw","name":"krw","selector":"fa-krw"},{"filter":"btc","name":"btc","selector":"fa-btc"},{"filter":"file","name":"file","selector":"fa-file"},{"filter":"file-text","name":"file-text","selector":"fa-file-text"},{"filter":"sort-alpha-asc","name":"sort-alpha-asc","selector":"fa-sort-alpha-asc"},{"filter":"sort-alpha-desc","name":"sort-alpha-desc","selector":"fa-sort-alpha-desc"},{"filter":"sort-amount-asc","name":"sort-amount-asc","selector":"fa-sort-amount-asc"},{"filter":"sort-amount-desc","name":"sort-amount-desc","selector":"fa-sort-amount-desc"},{"filter":"sort-numeric-asc","name":"sort-numeric-asc","selector":"fa-sort-numeric-asc"},{"filter":"sort-numeric-desc","name":"sort-numeric-desc","selector":"fa-sort-numeric-desc"},{"filter":"thumbs-up","name":"thumbs-up","selector":"fa-thumbs-up"},{"filter":"thumbs-down","name":"thumbs-down","selector":"fa-thumbs-down"},{"filter":"youtube-square","name":"youtube-square","selector":"fa-youtube-square"},{"filter":"youtube","name":"youtube","selector":"fa-youtube"},{"filter":"xing","name":"xing","selector":"fa-xing"},{"filter":"xing-square","name":"xing-square","selector":"fa-xing-square"},{"filter":"youtube-play","name":"youtube-play","selector":"fa-youtube-play"},{"filter":"dropbox","name":"dropbox","selector":"fa-dropbox"},{"filter":"stack-overflow","name":"stack-overflow","selector":"fa-stack-overflow"},{"filter":"instagram","name":"instagram","selector":"fa-instagram"},{"filter":"flickr","name":"flickr","selector":"fa-flickr"},{"filter":"adn","name":"adn","selector":"fa-adn"},{"filter":"bitbucket","name":"bitbucket","selector":"fa-bitbucket"},{"filter":"bitbucket-square","name":"bitbucket-square","selector":"fa-bitbucket-square"},{"filter":"tumblr","name":"tumblr","selector":"fa-tumblr"},{"filter":"tumblr-square","name":"tumblr-square","selector":"fa-tumblr-square"},{"filter":"long-arrow-down","name":"long-arrow-down","selector":"fa-long-arrow-down"},{"filter":"long-arrow-up","name":"long-arrow-up","selector":"fa-long-arrow-up"},{"filter":"long-arrow-left","name":"long-arrow-left","selector":"fa-long-arrow-left"},{"filter":"long-arrow-right","name":"long-arrow-right","selector":"fa-long-arrow-right"},{"filter":"apple","name":"apple","selector":"fa-apple"},{"filter":"windows","name":"windows","selector":"fa-windows"},{"filter":"android","name":"android","selector":"fa-android"},{"filter":"linux","name":"linux","selector":"fa-linux"},{"filter":"dribbble","name":"dribbble","selector":"fa-dribbble"},{"filter":"skype","name":"skype","selector":"fa-skype"},{"filter":"foursquare","name":"foursquare","selector":"fa-foursquare"},{"filter":"trello","name":"trello","selector":"fa-trello"},{"filter":"female","name":"female","selector":"fa-female"},{"filter":"male","name":"male","selector":"fa-male"},{"filter":"gittip","name":"gittip","selector":"fa-gittip"},{"filter":"sun-o","name":"sun-o","selector":"fa-sun-o"},{"filter":"moon-o","name":"moon-o","selector":"fa-moon-o"},{"filter":"archive","name":"archive","selector":"fa-archive"},{"filter":"bug","name":"bug","selector":"fa-bug"},{"filter":"vk","name":"vk","selector":"fa-vk"},{"filter":"weibo","name":"weibo","selector":"fa-weibo"},{"filter":"renren","name":"renren","selector":"fa-renren"},{"filter":"pagelines","name":"pagelines","selector":"fa-pagelines"},{"filter":"stack-exchange","name":"stack-exchange","selector":"fa-stack-exchange"},{"filter":"arrow-circle-o-right","name":"arrow-circle-o-right","selector":"fa-arrow-circle-o-right"},{"filter":"arrow-circle-o-left","name":"arrow-circle-o-left","selector":"fa-arrow-circle-o-left"},{"filter":"caret-square-o-left","name":"caret-square-o-left","selector":"fa-caret-square-o-left"},{"filter":"dot-circle-o","name":"dot-circle-o","selector":"fa-dot-circle-o"},{"filter":"wheelchair","name":"wheelchair","selector":"fa-wheelchair"},{"filter":"vimeo-square","name":"vimeo-square","selector":"fa-vimeo-square"},{"filter":"try","name":"try","selector":"fa-try"},{"filter":"plus-square-o","name":"plus-square-o","selector":"fa-plus-square-o"}]'
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="left control-label">排序：</label>
                            <div class="right">
                                <input type="text" class="form-control input" name="sort" value="<?php echo ((isset($info["sort"]) && ($info["sort"] !== ""))?($info["sort"]):0); ?>">
                            </div>
                        </div>
                    </div>
                    <?php if(($info["id"]) != "1"): ?><div id="tab2" class="tab-pane">
                            <div class="form-group"></div>
                            <div class="form-group">
                                <div class="auth">
                                    <?php if(is_array($all_module_menu_list)): $i = 0; $__LIST__ = $all_module_menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; $module_name = $key; ?>
                                        <div class="<?php echo ($module_name); ?>">
                                            <div class="cui-control cui-checkbox">
                                                <label class="checkbox-label checkbox-inline">
                                                    <input type="checkbox" name="menu_auth[<?php echo ($module_name); ?>][]" data-module-name="<?php echo ($module_name); ?>" <?php if(in_array($vo1['id'], $info['menu_auth'][$module_name])) echo "checked"; ?> value="<?php echo ($vo1["id"]); ?>">
                                                    <span class="cui-control-indicator"></span>
                                                    <span> <?php echo ($vo1["title"]); ?></span>
                                                </label>
                                                <div class="auth<?php echo ($vo1["id"]); ?>" style="padding-left: 25px;margin-top: 10px;">
                                                    <?php if(is_array($vo1["_child"])): $i = 0; $__LIST__ = $vo1["_child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><label class="checkbox-label checkbox-inline">
                                                            <input type="checkbox" name="menu_auth[<?php echo ($module_name); ?>][]" data-module-name="<?php echo ($module_name); ?>" <?php if(in_array($vo2['id'], $info['menu_auth'][$module_name])) echo "checked"; ?> value="<?php echo ($vo2["id"]); ?>">
                                                            <span class="cui-control-indicator"></span>
                                                            <span> <?php echo ($vo2["title"]); ?></span>
                                                        </label>
                                                        <div class="auth<?php echo ($vo2["id"]); ?>" style="padding-left: 25px;margin-top: 10px;">
                                                            <?php if(is_array($vo2["_child"])): foreach($vo2["_child"] as $key=>$vo3): ?><label class="checkbox-label checkbox-inline">
                                                                    <input type="checkbox" name="menu_auth[<?php echo ($module_name); ?>][]" data-module-name="<?php echo ($module_name); ?>" <?php if(in_array($vo3['id'], $info['menu_auth'][$module_name])) echo "checked"; ?> value="<?php echo ($vo3["id"]); ?>">
                                                                    <span class="cui-control-indicator"></span>
                                                                    <span> <?php echo ($vo3["title"]); ?></span>
                                                                </label>
                                                                <?php if(!empty($vo3["_child"])): ?><div class="auth<?php echo ($vo3["id"]); ?>" style="padding-left: 25px;margin-top: 10px;margin-bottom: 10px;">
                                                                        <?php if(is_array($vo3["_child"])): $i = 0; $__LIST__ = $vo3["_child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo4): $mod = ($i % 2 );++$i; if(!empty($vo4["_child"])): ?><label class="checkbox-inline" style="display: block;margin-top: 10px;margin-left: 0px;">
                                                                                    <input type="checkbox" name="menu_auth[<?php echo ($module_name); ?>][]" data-module-name="<?php echo ($module_name); ?>" <?php if(in_array($vo4['id'], $info['menu_auth'][$module_name])) echo "checked"; ?> value="<?php echo ($vo4["id"]); ?>">
                                                                                    <span class="cui-control-indicator"></span>
                                                                                    <span> <?php echo ($vo4["title"]); ?></span>
                                                                                </label>
                                                                            <?php else: ?>
                                                                                 <label class="checkbox-inline">
                                                                                    <input type="checkbox" name="menu_auth[<?php echo ($module_name); ?>][]" data-module-name="<?php echo ($module_name); ?>" <?php if(in_array($vo4['id'], $info['menu_auth'][$module_name])) echo "checked"; ?> value="<?php echo ($vo4["id"]); ?>">
                                                                                    <span class="cui-control-indicator"></span>
                                                                                    <span> <?php echo ($vo4["title"]); ?></span>
                                                                                </label><?php endif; ?>
                                                                            <?php if(!empty($vo4["_child"])): ?><div class="auth<?php echo ($vo4["id"]); ?>" style="padding-left: 25px;margin-top: 10px;margin-bottom: 10px;">
                                                                                    <?php if(is_array($vo4["_child"])): foreach($vo4["_child"] as $key=>$vo5): ?><label class="checkbox-inline">
                                                                                            <input type="checkbox" name="menu_auth[<?php echo ($module_name); ?>][]" data-module-name="<?php echo ($module_name); ?>" <?php if(in_array($vo5['id'], $info['menu_auth'][$module_name])) echo "checked"; ?> value="<?php echo ($vo5["id"]); ?>">
                                                                                            <span class="cui-control-indicator"></span>
                                                                                            <span> <?php echo ($vo5["title"]); ?></span>
                                                                                        </label><?php endforeach; endif; ?>
                                                                                </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                                                    </div><?php endif; endforeach; endif; ?>
                                                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <hr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                            <div class="form-group"></div>
                        </div><?php endif; ?>
                </div>
                <div class="form-group"></div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>">
                    <button class="btn btn-primary submit ajax-post" type="submit" target-form="form">确定</button>
                    <button class="btn btn-default return" onclick="javascript:history.back(-1);return false;">返回</button>
                </div>
            </form>
        </div>
    </div>

                            </div>

                            <div class="clearfix footer hidden-xs">
                                <div class="navbar navbar-default" role="navigation">
                                    <div class="container－fluid">
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
                                                <li><a target="_blank" href="http://www.lingyun.net" class="text-muted pull-right">Powered By 零云</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                
    <div class="panel builder formbuilder-box">
        <div class="panel-body">
            <form action="/admin.php?s=/Admin/Group/add.html" method="post" class="form form-builder">
                <ul class="nav-tabs nav">
                    <li class="active"><a href="#tab1" data-toggle="tab">部门信息</a></li>
                    <?php if(($info["id"]) != "1"): ?><li><a href="#tab2" data-toggle="tab">系统权限</a></li><?php endif; ?>
                </ul>
                <div class="tab-content">
                    <div id="tab1" class="tab-pane active">
                        <div class="form-group"></div>
                        <?php if(($info["id"]) != "1"): ?><div class="form-group">
                                <label class="left control-label">上级部门：</label>
                                <div class="right">
                                    <select name="pid" class="form-control select cui-select">
                                        <?php if(is_array($all_group)): $i = 0; $__LIST__ = $all_group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"
                                                <?php if($key == $info['pid']) echo 'selected="selected"'; ?> >
                                                <?php echo ($group); ?>
                                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-success"><?php echo ($info["title"]); ?>拥有后台所有权限</div><?php endif; ?>
                        <div class="form-group">
                            <label class="left control-label">部门名称：</label>
                            <div class="right">
                                <input type="text" class="form-control input" name="title" value="<?php echo ((isset($info["title"]) && ($info["title"] !== ""))?($info["title"]):''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="left control-label">图标：</label>
                            <div class="right">
                                <div class="input-group input" id="icon">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-fw fa-info-circle"></i> 点击选择图标</button>
                                    </span>
                                    <input type="text" class="form-control" name="icon" value="<?php echo ((isset($info["icon"]) && ($info["icon"] !== ""))?($info["icon"]):''); ?>">
                                </div>
                                <script type="text/javascript">
                                    $(function(){
                                        $("#icon").iconpicker({
                                            icons: '[{"filter":"glass","name":"glass","selector":"fa-glass"},{"filter":"music","name":"music","selector":"fa-music"},{"filter":"search","name":"search","selector":"fa-search"},{"filter":"envelope-o","name":"envelope-o","selector":"fa-envelope-o"},{"filter":"heart","name":"heart","selector":"fa-heart"},{"filter":"star","name":"star","selector":"fa-star"},{"filter":"star-o","name":"star-o","selector":"fa-star-o"},{"filter":"user","name":"user","selector":"fa-user"},{"filter":"film","name":"film","selector":"fa-film"},{"filter":"th-large","name":"th-large","selector":"fa-th-large"},{"filter":"th","name":"th","selector":"fa-th"},{"filter":"th-list","name":"th-list","selector":"fa-th-list"},{"filter":"check","name":"check","selector":"fa-check"},{"filter":"times","name":"times","selector":"fa-times"},{"filter":"search-plus","name":"search-plus","selector":"fa-search-plus"},{"filter":"search-minus","name":"search-minus","selector":"fa-search-minus"},{"filter":"power-off","name":"power-off","selector":"fa-power-off"},{"filter":"signal","name":"signal","selector":"fa-signal"},{"filter":"cog","name":"cog","selector":"fa-cog"},{"filter":"trash-o","name":"trash-o","selector":"fa-trash-o"},{"filter":"home","name":"home","selector":"fa-home"},{"filter":"file-o","name":"file-o","selector":"fa-file-o"},{"filter":"clock-o","name":"clock-o","selector":"fa-clock-o"},{"filter":"road","name":"road","selector":"fa-road"},{"filter":"download","name":"download","selector":"fa-download"},{"filter":"arrow-circle-o-down","name":"arrow-circle-o-down","selector":"fa-arrow-circle-o-down"},{"filter":"arrow-circle-o-up","name":"arrow-circle-o-up","selector":"fa-arrow-circle-o-up"},{"filter":"inbox","name":"inbox","selector":"fa-inbox"},{"filter":"play-circle-o","name":"play-circle-o","selector":"fa-play-circle-o"},{"filter":"repeat","name":"repeat","selector":"fa-repeat"},{"filter":"refresh","name":"refresh","selector":"fa-refresh"},{"filter":"list-alt","name":"list-alt","selector":"fa-list-alt"},{"filter":"lock","name":"lock","selector":"fa-lock"},{"filter":"flag","name":"flag","selector":"fa-flag"},{"filter":"headphones","name":"headphones","selector":"fa-headphones"},{"filter":"volume-off","name":"volume-off","selector":"fa-volume-off"},{"filter":"volume-down","name":"volume-down","selector":"fa-volume-down"},{"filter":"volume-up","name":"volume-up","selector":"fa-volume-up"},{"filter":"qrcode","name":"qrcode","selector":"fa-qrcode"},{"filter":"barcode","name":"barcode","selector":"fa-barcode"},{"filter":"tag","name":"tag","selector":"fa-tag"},{"filter":"tags","name":"tags","selector":"fa-tags"},{"filter":"book","name":"book","selector":"fa-book"},{"filter":"bookmark","name":"bookmark","selector":"fa-bookmark"},{"filter":"print","name":"print","selector":"fa-print"},{"filter":"camera","name":"camera","selector":"fa-camera"},{"filter":"font","name":"font","selector":"fa-font"},{"filter":"bold","name":"bold","selector":"fa-bold"},{"filter":"italic","name":"italic","selector":"fa-italic"},{"filter":"text-height","name":"text-height","selector":"fa-text-height"},{"filter":"text-width","name":"text-width","selector":"fa-text-width"},{"filter":"align-left","name":"align-left","selector":"fa-align-left"},{"filter":"align-center","name":"align-center","selector":"fa-align-center"},{"filter":"align-right","name":"align-right","selector":"fa-align-right"},{"filter":"align-justify","name":"align-justify","selector":"fa-align-justify"},{"filter":"list","name":"list","selector":"fa-list"},{"filter":"outdent","name":"outdent","selector":"fa-outdent"},{"filter":"indent","name":"indent","selector":"fa-indent"},{"filter":"video-camera","name":"video-camera","selector":"fa-video-camera"},{"filter":"picture-o","name":"picture-o","selector":"fa-picture-o"},{"filter":"pencil","name":"pencil","selector":"fa-pencil"},{"filter":"map-marker","name":"map-marker","selector":"fa-map-marker"},{"filter":"adjust","name":"adjust","selector":"fa-adjust"},{"filter":"tint","name":"tint","selector":"fa-tint"},{"filter":"pencil-square-o","name":"pencil-square-o","selector":"fa-pencil-square-o"},{"filter":"share-square-o","name":"share-square-o","selector":"fa-share-square-o"},{"filter":"check-square-o","name":"check-square-o","selector":"fa-check-square-o"},{"filter":"arrows","name":"arrows","selector":"fa-arrows"},{"filter":"step-backward","name":"step-backward","selector":"fa-step-backward"},{"filter":"fast-backward","name":"fast-backward","selector":"fa-fast-backward"},{"filter":"backward","name":"backward","selector":"fa-backward"},{"filter":"play","name":"play","selector":"fa-play"},{"filter":"pause","name":"pause","selector":"fa-pause"},{"filter":"stop","name":"stop","selector":"fa-stop"},{"filter":"forward","name":"forward","selector":"fa-forward"},{"filter":"fast-forward","name":"fast-forward","selector":"fa-fast-forward"},{"filter":"step-forward","name":"step-forward","selector":"fa-step-forward"},{"filter":"eject","name":"eject","selector":"fa-eject"},{"filter":"chevron-left","name":"chevron-left","selector":"fa-chevron-left"},{"filter":"chevron-right","name":"chevron-right","selector":"fa-chevron-right"},{"filter":"plus-circle","name":"plus-circle","selector":"fa-plus-circle"},{"filter":"minus-circle","name":"minus-circle","selector":"fa-minus-circle"},{"filter":"times-circle","name":"times-circle","selector":"fa-times-circle"},{"filter":"check-circle","name":"check-circle","selector":"fa-check-circle"},{"filter":"question-circle","name":"question-circle","selector":"fa-question-circle"},{"filter":"info-circle","name":"info-circle","selector":"fa-info-circle"},{"filter":"crosshairs","name":"crosshairs","selector":"fa-crosshairs"},{"filter":"times-circle-o","name":"times-circle-o","selector":"fa-times-circle-o"},{"filter":"check-circle-o","name":"check-circle-o","selector":"fa-check-circle-o"},{"filter":"ban","name":"ban","selector":"fa-ban"},{"filter":"arrow-left","name":"arrow-left","selector":"fa-arrow-left"},{"filter":"arrow-right","name":"arrow-right","selector":"fa-arrow-right"},{"filter":"arrow-up","name":"arrow-up","selector":"fa-arrow-up"},{"filter":"arrow-down","name":"arrow-down","selector":"fa-arrow-down"},{"filter":"share","name":"share","selector":"fa-share"},{"filter":"expand","name":"expand","selector":"fa-expand"},{"filter":"compress","name":"compress","selector":"fa-compress"},{"filter":"plus","name":"plus","selector":"fa-plus"},{"filter":"minus","name":"minus","selector":"fa-minus"},{"filter":"asterisk","name":"asterisk","selector":"fa-asterisk"},{"filter":"exclamation-circle","name":"exclamation-circle","selector":"fa-exclamation-circle"},{"filter":"gift","name":"gift","selector":"fa-gift"},{"filter":"leaf","name":"leaf","selector":"fa-leaf"},{"filter":"fire","name":"fire","selector":"fa-fire"},{"filter":"eye","name":"eye","selector":"fa-eye"},{"filter":"eye-slash","name":"eye-slash","selector":"fa-eye-slash"},{"filter":"exclamation-triangle","name":"exclamation-triangle","selector":"fa-exclamation-triangle"},{"filter":"plane","name":"plane","selector":"fa-plane"},{"filter":"calendar","name":"calendar","selector":"fa-calendar"},{"filter":"random","name":"random","selector":"fa-random"},{"filter":"comment","name":"comment","selector":"fa-comment"},{"filter":"magnet","name":"magnet","selector":"fa-magnet"},{"filter":"chevron-up","name":"chevron-up","selector":"fa-chevron-up"},{"filter":"chevron-down","name":"chevron-down","selector":"fa-chevron-down"},{"filter":"retweet","name":"retweet","selector":"fa-retweet"},{"filter":"shopping-cart","name":"shopping-cart","selector":"fa-shopping-cart"},{"filter":"folder","name":"folder","selector":"fa-folder"},{"filter":"folder-open","name":"folder-open","selector":"fa-folder-open"},{"filter":"arrows-v","name":"arrows-v","selector":"fa-arrows-v"},{"filter":"arrows-h","name":"arrows-h","selector":"fa-arrows-h"},{"filter":"bar-chart-o","name":"bar-chart-o","selector":"fa-bar-chart-o"},{"filter":"twitter-square","name":"twitter-square","selector":"fa-twitter-square"},{"filter":"facebook-square","name":"facebook-square","selector":"fa-facebook-square"},{"filter":"camera-retro","name":"camera-retro","selector":"fa-camera-retro"},{"filter":"key","name":"key","selector":"fa-key"},{"filter":"cogs","name":"cogs","selector":"fa-cogs"},{"filter":"comments","name":"comments","selector":"fa-comments"},{"filter":"thumbs-o-up","name":"thumbs-o-up","selector":"fa-thumbs-o-up"},{"filter":"thumbs-o-down","name":"thumbs-o-down","selector":"fa-thumbs-o-down"},{"filter":"star-half","name":"star-half","selector":"fa-star-half"},{"filter":"heart-o","name":"heart-o","selector":"fa-heart-o"},{"filter":"sign-out","name":"sign-out","selector":"fa-sign-out"},{"filter":"linkedin-square","name":"linkedin-square","selector":"fa-linkedin-square"},{"filter":"thumb-tack","name":"thumb-tack","selector":"fa-thumb-tack"},{"filter":"external-link","name":"external-link","selector":"fa-external-link"},{"filter":"sign-in","name":"sign-in","selector":"fa-sign-in"},{"filter":"trophy","name":"trophy","selector":"fa-trophy"},{"filter":"github-square","name":"github-square","selector":"fa-github-square"},{"filter":"upload","name":"upload","selector":"fa-upload"},{"filter":"lemon-o","name":"lemon-o","selector":"fa-lemon-o"},{"filter":"phone","name":"phone","selector":"fa-phone"},{"filter":"square-o","name":"square-o","selector":"fa-square-o"},{"filter":"bookmark-o","name":"bookmark-o","selector":"fa-bookmark-o"},{"filter":"phone-square","name":"phone-square","selector":"fa-phone-square"},{"filter":"twitter","name":"twitter","selector":"fa-twitter"},{"filter":"facebook","name":"facebook","selector":"fa-facebook"},{"filter":"github","name":"github","selector":"fa-github"},{"filter":"unlock","name":"unlock","selector":"fa-unlock"},{"filter":"credit-card","name":"credit-card","selector":"fa-credit-card"},{"filter":"rss","name":"rss","selector":"fa-rss"},{"filter":"hdd-o","name":"hdd-o","selector":"fa-hdd-o"},{"filter":"bullhorn","name":"bullhorn","selector":"fa-bullhorn"},{"filter":"bell","name":"bell","selector":"fa-bell"},{"filter":"certificate","name":"certificate","selector":"fa-certificate"},{"filter":"hand-o-right","name":"hand-o-right","selector":"fa-hand-o-right"},{"filter":"hand-o-left","name":"hand-o-left","selector":"fa-hand-o-left"},{"filter":"hand-o-up","name":"hand-o-up","selector":"fa-hand-o-up"},{"filter":"hand-o-down","name":"hand-o-down","selector":"fa-hand-o-down"},{"filter":"arrow-circle-left","name":"arrow-circle-left","selector":"fa-arrow-circle-left"},{"filter":"arrow-circle-right","name":"arrow-circle-right","selector":"fa-arrow-circle-right"},{"filter":"arrow-circle-up","name":"arrow-circle-up","selector":"fa-arrow-circle-up"},{"filter":"arrow-circle-down","name":"arrow-circle-down","selector":"fa-arrow-circle-down"},{"filter":"globe","name":"globe","selector":"fa-globe"},{"filter":"wrench","name":"wrench","selector":"fa-wrench"},{"filter":"tasks","name":"tasks","selector":"fa-tasks"},{"filter":"filter","name":"filter","selector":"fa-filter"},{"filter":"briefcase","name":"briefcase","selector":"fa-briefcase"},{"filter":"arrows-alt","name":"arrows-alt","selector":"fa-arrows-alt"},{"filter":"users","name":"users","selector":"fa-users"},{"filter":"link","name":"link","selector":"fa-link"},{"filter":"cloud","name":"cloud","selector":"fa-cloud"},{"filter":"flask","name":"flask","selector":"fa-flask"},{"filter":"scissors","name":"scissors","selector":"fa-scissors"},{"filter":"files-o","name":"files-o","selector":"fa-files-o"},{"filter":"paperclip","name":"paperclip","selector":"fa-paperclip"},{"filter":"floppy-o","name":"floppy-o","selector":"fa-floppy-o"},{"filter":"square","name":"square","selector":"fa-square"},{"filter":"bars","name":"bars","selector":"fa-bars"},{"filter":"list-ul","name":"list-ul","selector":"fa-list-ul"},{"filter":"list-ol","name":"list-ol","selector":"fa-list-ol"},{"filter":"strikethrough","name":"strikethrough","selector":"fa-strikethrough"},{"filter":"underline","name":"underline","selector":"fa-underline"},{"filter":"table","name":"table","selector":"fa-table"},{"filter":"magic","name":"magic","selector":"fa-magic"},{"filter":"truck","name":"truck","selector":"fa-truck"},{"filter":"pinterest","name":"pinterest","selector":"fa-pinterest"},{"filter":"pinterest-square","name":"pinterest-square","selector":"fa-pinterest-square"},{"filter":"google-plus-square","name":"google-plus-square","selector":"fa-google-plus-square"},{"filter":"google-plus","name":"google-plus","selector":"fa-google-plus"},{"filter":"money","name":"money","selector":"fa-money"},{"filter":"caret-down","name":"caret-down","selector":"fa-caret-down"},{"filter":"caret-up","name":"caret-up","selector":"fa-caret-up"},{"filter":"caret-left","name":"caret-left","selector":"fa-caret-left"},{"filter":"caret-right","name":"caret-right","selector":"fa-caret-right"},{"filter":"columns","name":"columns","selector":"fa-columns"},{"filter":"sort","name":"sort","selector":"fa-sort"},{"filter":"sort-asc","name":"sort-asc","selector":"fa-sort-asc"},{"filter":"sort-desc","name":"sort-desc","selector":"fa-sort-desc"},{"filter":"envelope","name":"envelope","selector":"fa-envelope"},{"filter":"linkedin","name":"linkedin","selector":"fa-linkedin"},{"filter":"undo","name":"undo","selector":"fa-undo"},{"filter":"gavel","name":"gavel","selector":"fa-gavel"},{"filter":"tachometer","name":"tachometer","selector":"fa-tachometer"},{"filter":"comment-o","name":"comment-o","selector":"fa-comment-o"},{"filter":"comments-o","name":"comments-o","selector":"fa-comments-o"},{"filter":"bolt","name":"bolt","selector":"fa-bolt"},{"filter":"sitemap","name":"sitemap","selector":"fa-sitemap"},{"filter":"umbrella","name":"umbrella","selector":"fa-umbrella"},{"filter":"clipboard","name":"clipboard","selector":"fa-clipboard"},{"filter":"lightbulb-o","name":"lightbulb-o","selector":"fa-lightbulb-o"},{"filter":"exchange","name":"exchange","selector":"fa-exchange"},{"filter":"cloud-download","name":"cloud-download","selector":"fa-cloud-download"},{"filter":"cloud-upload","name":"cloud-upload","selector":"fa-cloud-upload"},{"filter":"user-md","name":"user-md","selector":"fa-user-md"},{"filter":"stethoscope","name":"stethoscope","selector":"fa-stethoscope"},{"filter":"suitcase","name":"suitcase","selector":"fa-suitcase"},{"filter":"bell-o","name":"bell-o","selector":"fa-bell-o"},{"filter":"coffee","name":"coffee","selector":"fa-coffee"},{"filter":"cutlery","name":"cutlery","selector":"fa-cutlery"},{"filter":"file-text-o","name":"file-text-o","selector":"fa-file-text-o"},{"filter":"building-o","name":"building-o","selector":"fa-building-o"},{"filter":"hospital-o","name":"hospital-o","selector":"fa-hospital-o"},{"filter":"ambulance","name":"ambulance","selector":"fa-ambulance"},{"filter":"medkit","name":"medkit","selector":"fa-medkit"},{"filter":"fighter-jet","name":"fighter-jet","selector":"fa-fighter-jet"},{"filter":"beer","name":"beer","selector":"fa-beer"},{"filter":"h-square","name":"h-square","selector":"fa-h-square"},{"filter":"plus-square","name":"plus-square","selector":"fa-plus-square"},{"filter":"angle-double-left","name":"angle-double-left","selector":"fa-angle-double-left"},{"filter":"angle-double-right","name":"angle-double-right","selector":"fa-angle-double-right"},{"filter":"angle-double-up","name":"angle-double-up","selector":"fa-angle-double-up"},{"filter":"angle-double-down","name":"angle-double-down","selector":"fa-angle-double-down"},{"filter":"angle-left","name":"angle-left","selector":"fa-angle-left"},{"filter":"angle-right","name":"angle-right","selector":"fa-angle-right"},{"filter":"angle-up","name":"angle-up","selector":"fa-angle-up"},{"filter":"angle-down","name":"angle-down","selector":"fa-angle-down"},{"filter":"desktop","name":"desktop","selector":"fa-desktop"},{"filter":"laptop","name":"laptop","selector":"fa-laptop"},{"filter":"tablet","name":"tablet","selector":"fa-tablet"},{"filter":"mobile","name":"mobile","selector":"fa-mobile"},{"filter":"circle-o","name":"circle-o","selector":"fa-circle-o"},{"filter":"quote-left","name":"quote-left","selector":"fa-quote-left"},{"filter":"quote-right","name":"quote-right","selector":"fa-quote-right"},{"filter":"spinner","name":"spinner","selector":"fa-spinner"},{"filter":"circle","name":"circle","selector":"fa-circle"},{"filter":"reply","name":"reply","selector":"fa-reply"},{"filter":"github-alt","name":"github-alt","selector":"fa-github-alt"},{"filter":"folder-o","name":"folder-o","selector":"fa-folder-o"},{"filter":"folder-open-o","name":"folder-open-o","selector":"fa-folder-open-o"},{"filter":"smile-o","name":"smile-o","selector":"fa-smile-o"},{"filter":"frown-o","name":"frown-o","selector":"fa-frown-o"},{"filter":"meh-o","name":"meh-o","selector":"fa-meh-o"},{"filter":"gamepad","name":"gamepad","selector":"fa-gamepad"},{"filter":"keyboard-o","name":"keyboard-o","selector":"fa-keyboard-o"},{"filter":"flag-o","name":"flag-o","selector":"fa-flag-o"},{"filter":"flag-checkered","name":"flag-checkered","selector":"fa-flag-checkered"},{"filter":"terminal","name":"terminal","selector":"fa-terminal"},{"filter":"code","name":"code","selector":"fa-code"},{"filter":"reply-all","name":"reply-all","selector":"fa-reply-all"},{"filter":"mail-reply-all","name":"mail-reply-all","selector":"fa-mail-reply-all"},{"filter":"star-half-o","name":"star-half-o","selector":"fa-star-half-o"},{"filter":"location-arrow","name":"location-arrow","selector":"fa-location-arrow"},{"filter":"crop","name":"crop","selector":"fa-crop"},{"filter":"code-fork","name":"code-fork","selector":"fa-code-fork"},{"filter":"chain-broken","name":"chain-broken","selector":"fa-chain-broken"},{"filter":"question","name":"question","selector":"fa-question"},{"filter":"info","name":"info","selector":"fa-info"},{"filter":"exclamation","name":"exclamation","selector":"fa-exclamation"},{"filter":"superscript","name":"superscript","selector":"fa-superscript"},{"filter":"subscript","name":"subscript","selector":"fa-subscript"},{"filter":"eraser","name":"eraser","selector":"fa-eraser"},{"filter":"puzzle-piece","name":"puzzle-piece","selector":"fa-puzzle-piece"},{"filter":"microphone","name":"microphone","selector":"fa-microphone"},{"filter":"microphone-slash","name":"microphone-slash","selector":"fa-microphone-slash"},{"filter":"shield","name":"shield","selector":"fa-shield"},{"filter":"calendar-o","name":"calendar-o","selector":"fa-calendar-o"},{"filter":"fire-extinguisher","name":"fire-extinguisher","selector":"fa-fire-extinguisher"},{"filter":"rocket","name":"rocket","selector":"fa-rocket"},{"filter":"maxcdn","name":"maxcdn","selector":"fa-maxcdn"},{"filter":"chevron-circle-left","name":"chevron-circle-left","selector":"fa-chevron-circle-left"},{"filter":"chevron-circle-right","name":"chevron-circle-right","selector":"fa-chevron-circle-right"},{"filter":"chevron-circle-up","name":"chevron-circle-up","selector":"fa-chevron-circle-up"},{"filter":"chevron-circle-down","name":"chevron-circle-down","selector":"fa-chevron-circle-down"},{"filter":"html5","name":"html5","selector":"fa-html5"},{"filter":"css3","name":"css3","selector":"fa-css3"},{"filter":"anchor","name":"anchor","selector":"fa-anchor"},{"filter":"unlock-alt","name":"unlock-alt","selector":"fa-unlock-alt"},{"filter":"bullseye","name":"bullseye","selector":"fa-bullseye"},{"filter":"ellipsis-h","name":"ellipsis-h","selector":"fa-ellipsis-h"},{"filter":"ellipsis-v","name":"ellipsis-v","selector":"fa-ellipsis-v"},{"filter":"rss-square","name":"rss-square","selector":"fa-rss-square"},{"filter":"play-circle","name":"play-circle","selector":"fa-play-circle"},{"filter":"ticket","name":"ticket","selector":"fa-ticket"},{"filter":"minus-square","name":"minus-square","selector":"fa-minus-square"},{"filter":"minus-square-o","name":"minus-square-o","selector":"fa-minus-square-o"},{"filter":"level-up","name":"level-up","selector":"fa-level-up"},{"filter":"level-down","name":"level-down","selector":"fa-level-down"},{"filter":"check-square","name":"check-square","selector":"fa-check-square"},{"filter":"pencil-square","name":"pencil-square","selector":"fa-pencil-square"},{"filter":"external-link-square","name":"external-link-square","selector":"fa-external-link-square"},{"filter":"share-square","name":"share-square","selector":"fa-share-square"},{"filter":"compass","name":"compass","selector":"fa-compass"},{"filter":"caret-square-o-down","name":"caret-square-o-down","selector":"fa-caret-square-o-down"},{"filter":"caret-square-o-up","name":"caret-square-o-up","selector":"fa-caret-square-o-up"},{"filter":"caret-square-o-right","name":"caret-square-o-right","selector":"fa-caret-square-o-right"},{"filter":"eur","name":"eur","selector":"fa-eur"},{"filter":"gbp","name":"gbp","selector":"fa-gbp"},{"filter":"usd","name":"usd","selector":"fa-usd"},{"filter":"inr","name":"inr","selector":"fa-inr"},{"filter":"jpy","name":"jpy","selector":"fa-jpy"},{"filter":"rub","name":"rub","selector":"fa-rub"},{"filter":"krw","name":"krw","selector":"fa-krw"},{"filter":"btc","name":"btc","selector":"fa-btc"},{"filter":"file","name":"file","selector":"fa-file"},{"filter":"file-text","name":"file-text","selector":"fa-file-text"},{"filter":"sort-alpha-asc","name":"sort-alpha-asc","selector":"fa-sort-alpha-asc"},{"filter":"sort-alpha-desc","name":"sort-alpha-desc","selector":"fa-sort-alpha-desc"},{"filter":"sort-amount-asc","name":"sort-amount-asc","selector":"fa-sort-amount-asc"},{"filter":"sort-amount-desc","name":"sort-amount-desc","selector":"fa-sort-amount-desc"},{"filter":"sort-numeric-asc","name":"sort-numeric-asc","selector":"fa-sort-numeric-asc"},{"filter":"sort-numeric-desc","name":"sort-numeric-desc","selector":"fa-sort-numeric-desc"},{"filter":"thumbs-up","name":"thumbs-up","selector":"fa-thumbs-up"},{"filter":"thumbs-down","name":"thumbs-down","selector":"fa-thumbs-down"},{"filter":"youtube-square","name":"youtube-square","selector":"fa-youtube-square"},{"filter":"youtube","name":"youtube","selector":"fa-youtube"},{"filter":"xing","name":"xing","selector":"fa-xing"},{"filter":"xing-square","name":"xing-square","selector":"fa-xing-square"},{"filter":"youtube-play","name":"youtube-play","selector":"fa-youtube-play"},{"filter":"dropbox","name":"dropbox","selector":"fa-dropbox"},{"filter":"stack-overflow","name":"stack-overflow","selector":"fa-stack-overflow"},{"filter":"instagram","name":"instagram","selector":"fa-instagram"},{"filter":"flickr","name":"flickr","selector":"fa-flickr"},{"filter":"adn","name":"adn","selector":"fa-adn"},{"filter":"bitbucket","name":"bitbucket","selector":"fa-bitbucket"},{"filter":"bitbucket-square","name":"bitbucket-square","selector":"fa-bitbucket-square"},{"filter":"tumblr","name":"tumblr","selector":"fa-tumblr"},{"filter":"tumblr-square","name":"tumblr-square","selector":"fa-tumblr-square"},{"filter":"long-arrow-down","name":"long-arrow-down","selector":"fa-long-arrow-down"},{"filter":"long-arrow-up","name":"long-arrow-up","selector":"fa-long-arrow-up"},{"filter":"long-arrow-left","name":"long-arrow-left","selector":"fa-long-arrow-left"},{"filter":"long-arrow-right","name":"long-arrow-right","selector":"fa-long-arrow-right"},{"filter":"apple","name":"apple","selector":"fa-apple"},{"filter":"windows","name":"windows","selector":"fa-windows"},{"filter":"android","name":"android","selector":"fa-android"},{"filter":"linux","name":"linux","selector":"fa-linux"},{"filter":"dribbble","name":"dribbble","selector":"fa-dribbble"},{"filter":"skype","name":"skype","selector":"fa-skype"},{"filter":"foursquare","name":"foursquare","selector":"fa-foursquare"},{"filter":"trello","name":"trello","selector":"fa-trello"},{"filter":"female","name":"female","selector":"fa-female"},{"filter":"male","name":"male","selector":"fa-male"},{"filter":"gittip","name":"gittip","selector":"fa-gittip"},{"filter":"sun-o","name":"sun-o","selector":"fa-sun-o"},{"filter":"moon-o","name":"moon-o","selector":"fa-moon-o"},{"filter":"archive","name":"archive","selector":"fa-archive"},{"filter":"bug","name":"bug","selector":"fa-bug"},{"filter":"vk","name":"vk","selector":"fa-vk"},{"filter":"weibo","name":"weibo","selector":"fa-weibo"},{"filter":"renren","name":"renren","selector":"fa-renren"},{"filter":"pagelines","name":"pagelines","selector":"fa-pagelines"},{"filter":"stack-exchange","name":"stack-exchange","selector":"fa-stack-exchange"},{"filter":"arrow-circle-o-right","name":"arrow-circle-o-right","selector":"fa-arrow-circle-o-right"},{"filter":"arrow-circle-o-left","name":"arrow-circle-o-left","selector":"fa-arrow-circle-o-left"},{"filter":"caret-square-o-left","name":"caret-square-o-left","selector":"fa-caret-square-o-left"},{"filter":"dot-circle-o","name":"dot-circle-o","selector":"fa-dot-circle-o"},{"filter":"wheelchair","name":"wheelchair","selector":"fa-wheelchair"},{"filter":"vimeo-square","name":"vimeo-square","selector":"fa-vimeo-square"},{"filter":"try","name":"try","selector":"fa-try"},{"filter":"plus-square-o","name":"plus-square-o","selector":"fa-plus-square-o"}]'
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="left control-label">排序：</label>
                            <div class="right">
                                <input type="text" class="form-control input" name="sort" value="<?php echo ((isset($info["sort"]) && ($info["sort"] !== ""))?($info["sort"]):0); ?>">
                            </div>
                        </div>
                    </div>
                    <?php if(($info["id"]) != "1"): ?><div id="tab2" class="tab-pane">
                            <div class="form-group"></div>
                            <div class="form-group">
                                <div class="auth">
                                    <?php if(is_array($all_module_menu_list)): $i = 0; $__LIST__ = $all_module_menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; $module_name = $key; ?>
                                        <div class="<?php echo ($module_name); ?>">
                                            <div class="cui-control cui-checkbox">
                                                <label class="checkbox-label checkbox-inline">
                                                    <input type="checkbox" name="menu_auth[<?php echo ($module_name); ?>][]" data-module-name="<?php echo ($module_name); ?>" <?php if(in_array($vo1['id'], $info['menu_auth'][$module_name])) echo "checked"; ?> value="<?php echo ($vo1["id"]); ?>">
                                                    <span class="cui-control-indicator"></span>
                                                    <span> <?php echo ($vo1["title"]); ?></span>
                                                </label>
                                                <div class="auth<?php echo ($vo1["id"]); ?>" style="padding-left: 25px;margin-top: 10px;">
                                                    <?php if(is_array($vo1["_child"])): $i = 0; $__LIST__ = $vo1["_child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><label class="checkbox-label checkbox-inline">
                                                            <input type="checkbox" name="menu_auth[<?php echo ($module_name); ?>][]" data-module-name="<?php echo ($module_name); ?>" <?php if(in_array($vo2['id'], $info['menu_auth'][$module_name])) echo "checked"; ?> value="<?php echo ($vo2["id"]); ?>">
                                                            <span class="cui-control-indicator"></span>
                                                            <span> <?php echo ($vo2["title"]); ?></span>
                                                        </label>
                                                        <div class="auth<?php echo ($vo2["id"]); ?>" style="padding-left: 25px;margin-top: 10px;">
                                                            <?php if(is_array($vo2["_child"])): foreach($vo2["_child"] as $key=>$vo3): ?><label class="checkbox-label checkbox-inline">
                                                                    <input type="checkbox" name="menu_auth[<?php echo ($module_name); ?>][]" data-module-name="<?php echo ($module_name); ?>" <?php if(in_array($vo3['id'], $info['menu_auth'][$module_name])) echo "checked"; ?> value="<?php echo ($vo3["id"]); ?>">
                                                                    <span class="cui-control-indicator"></span>
                                                                    <span> <?php echo ($vo3["title"]); ?></span>
                                                                </label>
                                                                <?php if(!empty($vo3["_child"])): ?><div class="auth<?php echo ($vo3["id"]); ?>" style="padding-left: 25px;margin-top: 10px;margin-bottom: 10px;">
                                                                        <?php if(is_array($vo3["_child"])): $i = 0; $__LIST__ = $vo3["_child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo4): $mod = ($i % 2 );++$i; if(!empty($vo4["_child"])): ?><label class="checkbox-inline" style="display: block;margin-top: 10px;margin-left: 0px;">
                                                                                    <input type="checkbox" name="menu_auth[<?php echo ($module_name); ?>][]" data-module-name="<?php echo ($module_name); ?>" <?php if(in_array($vo4['id'], $info['menu_auth'][$module_name])) echo "checked"; ?> value="<?php echo ($vo4["id"]); ?>">
                                                                                    <span class="cui-control-indicator"></span>
                                                                                    <span> <?php echo ($vo4["title"]); ?></span>
                                                                                </label>
                                                                            <?php else: ?>
                                                                                 <label class="checkbox-inline">
                                                                                    <input type="checkbox" name="menu_auth[<?php echo ($module_name); ?>][]" data-module-name="<?php echo ($module_name); ?>" <?php if(in_array($vo4['id'], $info['menu_auth'][$module_name])) echo "checked"; ?> value="<?php echo ($vo4["id"]); ?>">
                                                                                    <span class="cui-control-indicator"></span>
                                                                                    <span> <?php echo ($vo4["title"]); ?></span>
                                                                                </label><?php endif; ?>
                                                                            <?php if(!empty($vo4["_child"])): ?><div class="auth<?php echo ($vo4["id"]); ?>" style="padding-left: 25px;margin-top: 10px;margin-bottom: 10px;">
                                                                                    <?php if(is_array($vo4["_child"])): foreach($vo4["_child"] as $key=>$vo5): ?><label class="checkbox-inline">
                                                                                            <input type="checkbox" name="menu_auth[<?php echo ($module_name); ?>][]" data-module-name="<?php echo ($module_name); ?>" <?php if(in_array($vo5['id'], $info['menu_auth'][$module_name])) echo "checked"; ?> value="<?php echo ($vo5["id"]); ?>">
                                                                                            <span class="cui-control-indicator"></span>
                                                                                            <span> <?php echo ($vo5["title"]); ?></span>
                                                                                        </label><?php endforeach; endif; ?>
                                                                                </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                                                    </div><?php endif; endforeach; endif; ?>
                                                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <hr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                            <div class="form-group"></div>
                        </div><?php endif; ?>
                </div>
                <div class="form-group"></div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>">
                    <button class="btn btn-primary submit ajax-post" type="submit" target-form="form">确定</button>
                    <button class="btn btn-default return" onclick="javascript:history.back(-1);return false;">返回</button>
                </div>
            </form>
        </div>
    </div>

            <?php endif; ?>
        
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
            
    <script type="text/javascript" src="http://admin.thinkphp.com/Public/libs/lyui/dist/js/lyui.extend.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.auth input[type="checkbox"]').on('change',function(){
                //遍历选中当前权限的子权限
                $('.'+$(this).attr('data-module-name')+' .auth'+$(this).val()).find('input').prop('checked',this.checked);
            });
        });
    </script>

        </div>
    </div>
</body>
</html>