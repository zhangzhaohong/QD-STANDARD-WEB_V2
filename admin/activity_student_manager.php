<?php
/**
 * 学生活动管理
 **/
$title = '学生活动管理';
$file = 'activity_student_manager';
include_once 'head.php';
$page = (isset($_GET['page']) ? $_GET['page'] : 1);
?>
<html>
<link rel="stylesheet" href="../assets/css/setting_common.css">
<body>
<link href="../assets/zui_package/1.9.2/lib/datagrid/zui.datagrid.css" rel="stylesheet">
<script src="../assets/zui_package/1.9.2/lib/datagrid/zui.datagrid.js"></script>
<link href="../assets/zui_package/1.9.2/lib/datagrid/zui.datagrid.min.css" rel="stylesheet">
<script src="../assets/zui_package/1.9.2/lib/datagrid/zui.datagrid.min.js"></script>
<link rel="stylesheet" href="../assets/css/users_common.css">
<script src="../assets/js/setting_common.js"></script>
<?php

$my = isset($_GET['my']) ? $_GET['my'] : null;

if ($my == 'add')
{

    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">添加学生活动</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./activity_student_manager.php?my=add_submit" method="POST">
<div class="form-group">
<label>活动名称:</label><br>
<select name="activity_id">';
    $sql = "1";
    $rs = $DB->query("SELECT * FROM activity_data WHERE {$sql} order by jobid desc");
    while ($res = $DB->fetch($rs)) {
        if ($rs) {
            echo '<option value="' . $res['jobid'] . '">' . $res['activity_title'] . '</option>';
        }
    }
    echo '</select>
</div>
<div class="form-group">
<label>学生userId:</label><br>
<input type="text" class="form-control" name="user_id" value="" required>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定添加"></form>';
    echo '<br/><a href="./activity_student_manager.php">>>返回学生活动管理</a>';
    echo '</div></div>';
} elseif ($my == 'add_submit') {
    $activity_id = $_POST['activity_id'];
    $user_id = $_POST['user_id'];

    if ($activity_id == NULL or $user_id == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        $time = date('Y-m-d H:i:s');
        $rowUser = $DB->get_row("SELECT * FROM users WHERE account='{$user_id}' limit 1");
        if ($rowUser) {
            $enjoyRow = $DB->get_row("SELECT * FROM activity_stuInfo WHERE student_userKey='{$rowUser['user_key']}' and activity_jobId='{$activity_id}' limit 1");
            if ($enjoyRow) {
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"该用户已加入相关活动！\");\r\n";
                echo "</script>";
                echo '<script>FailedSettingMessage();</script>';
            } else {
                if (!$DB->query("INSERT INTO `activity_stuInfo`(`activity_jobId`, `student_userKey`, `operation_time`) VALUES ('" . $activity_id . "','" . $rowUser['user_key'] . "','" . $time . "')"))
                    echo '<script>FailedSettingMessage();</script>';
                $activityRow = $DB->get_row("SELECT * FROM activity_data WHERE jobid='{$activity_id}' limit 1");
                if ($activityRow) {
                    $stuNum = $activityRow['activity_joinedNum'] + 1;
                    $DB->query("update activity_data set activity_joinedNum='$stuNum' where jobid='{$activity_id}'");
                }
                echo '<script>SuccessSettingMessage();</script>';
            }
        } else {
            echo "<script language=\"JavaScript\">\r\n";
            echo " alert(\"用户不存在！\");\r\n";
            echo "</script>";
            echo '<script>FailedSettingMessage();</script>';
        }
    }
} elseif ($my == 'delete') {
    $jobid = $_GET['jobid'];
    $actInfo = $DB->get_row("SELECT * FROM activity_stuInfo WHERE jobid='$jobid' limit 1");
    if ($actInfo) {
        $activityJobid = $actInfo['activity_jobId'];
        $activityInfo = $DB->get_row("SELECT * FROM activity_data WHERE jobid='$activityJobid' limit 1");
        if ($activityInfo) {
            $stuNum = $activityInfo['activity_joinedNum'] - 1;
            if ($stuNum < 0)
                $stuNum = 0;
            $DB->query("update activity_data set activity_joinedNum='$stuNum' where jobid='{$activityJobid}'");
        }
    }
    $sql = "DELETE FROM activity_stuInfo WHERE jobid='$jobid' limit 1";
    if ($DB->query($sql))
        echo '<script>SuccessSettingMessage();</script>';
    else
        echo '<script>FailedSettingMessage();</script>';
}
else
{
?>
</div>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">活动列表</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <?php
        if ($_GET['activity_id_search'] != "" && $_GET['activity_id_search'] != null) {
            $sql = " `activity_jobId`='{$_GET['activity_id_search']}'";
            $numrows = $DB->count("SELECT count(*) from activity_stuInfo WHERE{$sql}");
            $activityInfoSearch = $DB->get_row("SELECT * FROM activity_data WHERE jobid='{$_GET['activity_id_search']}' limit 1");
            if ($activityInfoSearch) {
                $activityNameSearch = $activityInfoSearch['activity_title'];
            }
            $con = '加入活动  ' . $activityNameSearch . ' 的共有 <b>' . $numrows . '</b> 位同学';
            echo '<div class="alert alert-info" style="margin-bottom: 0px;">' . $con . '</div>';
        } elseif ($_GET['user_id_search'] != "" && $_GET['user_id_search'] != null) {
            $id = $_GET['user_id_search'];
            $userInfoSearch = $DB->get_row("SELECT * FROM users WHERE account='{$id}' limit 1");
            if ($userInfoSearch) {
                $userKey = $userInfoSearch['user_key'];
                $userName = $userInfoSearch['private_name'];
                $sql = "`student_userKey`='{$userKey}'";
                $numrows = $DB->count("SELECT count(*) from activity_stuInfo WHERE {$sql}");
            } else {
                $userName = "NULL";
                $numrows = '0';
            }
            $con = $userName . '共加入了 <b>' . $numrows . '</b> 个活动';
            echo '<div class="alert alert-info" style="margin-bottom: 0px;">' . $con . '</div>';
        } else {
            $numrows = $DB->count("SELECT count(*) from activity_stuInfo");
            $sql = "1";
            echo '<div class="alert alert-info" style="margin-bottom: 0px;">系统共有' . $numrows . '条学生参加活动信息。<br><a href="./activity_student_manager.php?my=add" class="btn btn-primary">添加学生活动</a>';
            echo '</div>';
        } ?>
        <div class="table-responsive">
            <table class="table table-bordered scrollbar-hover" id="tableDataGrid">
                <thead>
                <tr>
                    <th style="min-width: 100px;">操作</th>
                    <th>活动名称</th>
                    <th>学生姓名</th>
                    <th>加入时间</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $pagesize = 30;
                $pages = intval($numrows / $pagesize);
                if ($numrows % $pagesize) {
                    $pages++;
                }
                if (isset($page)) {
                    $page = intval($page);
                } else {
                    $page = 1;
                }
                $offset = $pagesize * ($page - 1);

                $rs = $DB->query("SELECT * FROM activity_stuInfo WHERE {$sql} order by jobid desc limit $offset,$pagesize");
                while ($res = $DB->fetch($rs)) {
                    $activityInfo = $DB->get_row("SELECT * FROM activity_data WHERE jobid='{$res['activity_jobId']}' limit 1");
                    if ($activityInfo) {
                        $activityName = $activityInfo['activity_title'];
                    } else {
                        $activityName = '未查询到活动信息';
                    }
                    $userInfo = $DB->get_row("SELECT * FROM users WHERE user_key='{$res['student_userKey']}' limit 1");
                    if ($userInfo) {
                        $stuName = $userInfo['private_name'];
                    } else {
                        $stuName = '未查询到学生信息';
                    }
                    echo '<tr><td>' . '<a href="./activity_student_manager.php?my=delete&jobid=' . $res['jobid'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这条记录吗？\');">删除</a></td><td>' . $activityName . '</td><td>' . $stuName . '</td><td><b>' . $res['operation_time'] . '</b></td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
        $first = 1;
        $prev = $page - 1;
        $next = $page + 1;
        $last = $pages;
        if (isset($page)) {
            $page = intval($page);
        } else {
            $page = 1;
        }
        echo '<div class="pager_data">';
        echo '<ul id="pager" class="pager" data-ride="pager" data-page="' . $page . '" data-rec-total="' . $numrows . '" data-max-nav-count="5" data-rec-per-page="30" data-elements="prev_icon,nav,next_icon">';
        echo '</ul>';
        echo '</div>';
        #分页
        }
        ?>
    </div>
</div>
<script>
    $('#pager').on('onPageChange', function (e, state, oldState) {
        if (state.page !== oldState.page) {
            //console.log('页码从', oldState.page, '变更为', state.page);
            var page_num = state.page;
            window.location.href = '<?php echo $file?>.php?page=' + page_num;
        }
    });
</script>
</body>
</html>
