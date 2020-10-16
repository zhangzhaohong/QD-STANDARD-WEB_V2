<?php
include_once '../includes/common.php';
include_once '../includes/member.php';
//include '../includes/function.php';
if ($islogin == 1) {
} else exit("<script language='javascript'>window.location.href='login.php';</script>");
$index_file = 'index';
$users_file = 'users,users_data,users_data_config';
$course_file = 'course_manager,course_student_manager,course_student_search,activity_manager,activity_student_manager,activity_student_search';
$setting_file = 'setting_common,setting_logo,setting_announce,setting_keys,setting_mail,setting_bottom,update_system';
$menu_file = 'menu_manager,news_manager';
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ZUI 标准版压缩后的 CSS 文件 -->
    <link rel="stylesheet" href="../assets/zui_package/1.9.2/css/zui.min.css">
    <!-- ZUI Javascript 依赖 jQuery -->
    <script src="../assets/zui_package/1.9.2/lib/jquery/jquery.js"></script>
    <!-- ZUI 标准版压缩后的 JavaScript 文件 -->
    <script src="../assets/zui_package/1.9.2/js/zui.min.js"></script>
    <title><?php echo $title; ?></title>
</head>
<body>
<?php
if (checkmobile()) { ?>
    <div class="col-sm-4" style="margin-top: 10px;">
        <ul class="nav nav-stacked nav-pills">
            <li class="nav-heading"><strong style="font-size: 15px;color: #4a59b4"><a href="index.php"
                                                                                      style="border-bottom: #ffffff;"><i
                                class="icon icon-desktop"></i>&nbsp;管理中心</a></strong></li>
            <li class="<?php echo checkIfActive($file, $index_file) ?>">
                <a href="index.php">首页 </a>
            </li>
            <!--<li>
                <a href="###">动态 <span class="label label-badge label-success pull-right">4</span></a>
            </li>
            <li>
                <a href="###">项目 </a>
            </li>-->
            <li class="<?php echo checkIfActive($file, $users_file) ?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="">用户管理 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="users.php">用户列表</a>
                    </li>
                    <li>
                        <a href="users_data.php">用户数据管理</a>
                    </li>
                    <li>
                        <a href="users_data_config.php">数据配置</a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo checkIfActive($file, $course_file) ?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="">课程选课/活动管理 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="course_manager.php">课程列表</a>
                    </li>
                    <li>
                        <a href="course_student_manager.php">课程学生管理</a>
                    </li>
                    <li>
                        <a href="course_student_search.php">课程学生搜索</a>
                    </li>
                    <li>
                        <a href="activity_manager.php">活动列表</a>
                    </li>
                    <li>
                        <a href="activity_student_manager.php">学生活动管理</a>
                    </li>
                    <li>
                        <a href="activity_student_search.php">活动参加情况搜索</a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo checkIfActive($file, $menu_file) ?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="">菜单/食堂新闻管理 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="menu_manager.php">菜单管理</a>
                    </li>
                    <li>
                        <a href="news_manager.php">食堂新闻管理</a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo checkIfActive($file, $setting_file) ?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="">系统设置 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="setting_common.php">基础设置</a>
                    </li>
                    <li>
                        <a href="setting_logo.php">首页logo设置</a>
                    </li>
                    <li>
                        <a href="setting_announce.php">首页公告配置</a>
                    </li>
                    <li>
                        <a href="setting_bottom.php">首页底部友链配置</a>
                    </li>
                    <li>
                        <a href="setting_keys.php">API加解密KEY管理中心</a>
                    </li>
                    <li>
                        <a href="setting_mail.php">邮件账号配置</a>
                    </li>
                    <li>
                        <a href="update_system.php">系统更新</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="login.php?logout">退出登陆 </a>
            </li>
        </ul>
    </div>
<?php } else { ?>
    <article>
        <div class="nav-view" style="min-width: 320px;">
            <ul class="nav nav-justified nav-tabs" style="margin-top: 10px;">
                <li class="nav-heading"><strong style="font-size: 20px;color: #4a59b4;margin: 10px;"><a href="index.php"
                                                                                                        style="border-bottom: #ffffff;"><i
                                    class="icon icon-10x icon-desktop"></i>&nbsp;管理中心</a></strong></li>
                <li class="<?php echo checkIfActive($file, $index_file) ?>">
                    <a href="index.php">首页</a>
                </li>
                <!--<li>
                    <a href="###">动态</a>
                </li>
                <li class="disabled">
                    <a href="###">项目</a>
                </li>-->
                <li class="<?php echo checkIfActive($file, $users_file) ?>">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">用户管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="users.php">用户列表</a>
                        </li>
                        <li>
                            <a href="users_data.php">用户数据管理</a>
                        </li>
                        <li>
                            <a href="users_data_config.php">数据配置</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo checkIfActive($file, $course_file) ?>">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">课程选课/活动管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="course_manager.php">课程列表</a>
                        </li>
                        <li>
                            <a href="course_student_manager.php">课程学生管理</a>
                        </li>
                        <li>
                            <a href="course_student_search.php">课程学生搜索</a>
                        </li>
                        <li>
                            <a href="activity_manager.php">活动列表</a>
                        </li>
                        <li>
                            <a href="activity_student_manager.php">学生活动管理</a>
                        </li>
                        <li>
                            <a href="activity_student_search.php">活动参加情况搜索</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo checkIfActive($file, $menu_file) ?>">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">菜单/食堂新闻管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="menu_manager.php">菜单管理</a>
                        </li>
                        <li>
                            <a href="news_manager.php">食堂新闻管理</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo checkIfActive($file, $setting_file) ?>">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">系统设置 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="setting_common.php">基础设置</a>
                        </li>
                        <li>
                            <a href="setting_logo.php">首页logo设置</a>
                        </li>
                        <li>
                            <a href="setting_announce.php">首页公告配置</a>
                        </li>
                        <li>
                            <a href="setting_bottom.php">首页底部友链配置</a>
                        </li>
                        <li>
                            <a href="setting_keys.php">API加解密KEY管理中心</a>
                        </li>
                        <li>
                            <a href="setting_mail.php">邮件账号配置</a>
                        </li>
                        <li>
                            <a href="update_system.php">系统更新</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="login.php?logout">退出登陆 </a>
                </li>
            </ul>
        </div>
    </article>
<?php } ?>
<body>
</html>

