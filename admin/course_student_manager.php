<?php
/**
 * 课程学生管理
 **/
$title = '课程学生管理';
$file = 'course_student_manager';
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
<script>
    function initDatePicker() {
        // 选择时间
        $(".form-date").datetimepicker(
            {
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0,
                format: "yyyymmdd"
            });
    }
</script>
<?php

function init_library()
{
    echo '<link href="../assets/zui_package/1.9.2/lib/datetimepicker/datetimepicker.css" rel="stylesheet">';
    echo '<script src="../assets/zui_package/1.9.2/lib/datetimepicker/datetimepicker.js"></script>';
    echo '<link href="../assets/zui_package/1.9.2/lib/datetimepicker/datetimepicker.min.css" rel="stylesheet">';
    echo '<script src="../assets/zui_package/1.9.2/lib/datetimepicker/datetimepicker.min.js"></script>';
}

$my = isset($_GET['my']) ? $_GET['my'] : null;

if ($my == 'add')
{
    init_library();

    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">添加课程学生</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./course_student_manager.php?my=add_submit" method="POST">
<div class="form-group">
<label>课程名称:</label><br>
<select name="course_id">';
    $sql = "1";
    $rs = $DB->query("SELECT * FROM course_data WHERE {$sql} order by jobid desc");
    while ($res = $DB->fetch($rs)) {
        if ($rs) {
            echo '<option value="' . $res['jobid'] . '">' . $res['course_title'] . '</option>';
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
    echo '<br/><a href="./course_student_manager.php">>>返回课程学生管理</a>';
    echo '</div></div>';
    echo '<script>initDatePicker();</script>';
} elseif ($my == 'edit') {
    init_library();
    $id = $_GET['id'];
    $row = $DB->get_row("select * from course_stuInfo where jobid='$id' limit 1");
    $courseInfo = $DB->get_row("SELECT * FROM course_data WHERE jobid='{$row['course_jobId']}' limit 1");
    if ($courseInfo) {
        $courseName = $courseInfo['course_title'];
    } else {
        $courseName = '未查询到课程信息';
    }
    $userInfo = $DB->get_row("SELECT * FROM users WHERE user_key='{$row['student_userKey']}' limit 1");
    if ($userInfo) {
        $stuName = $userInfo['private_name'];
    } else {
        $stuName = '未查询到学生信息';
    }
    if ($row['signed_time'] == "" || $row['signed_time'] == null) {
        $signedTime = '0';
    } else {
        $signedTime = $row['signed_time'];
    }

    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改课程学生信息</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./course_student_manager.php?my=edit_submit&jobid=' . $id . '" method="POST">
<div class="form-group">
<label>课程名称:</label><br>
<input type="text" class="form-control" value="' . $courseName . '" disabled>
</div>
<div class="form-group">
<label>学生姓名:</label><br>
<input type="text" class="form-control" value="' . $stuName . '" disabled>
</div>
<div class="form-group">
<label>加入时间:</label><br>
<input type="text" class="form-control" value="' . $row['operation_time'] . '" disabled>
</div>
<div class="form-group">
<label>签到次数:</label><br>
<input type="text" class="form-control" name="signed_time" value="' . $signedTime . '" required>
</div>
<div class="form-group">
<label>最近签到时间:</label><br>
<input type="text" class="form-control form-date" name="signed_date" placeholder="选择或者输入一个日期：yyyyMMdd" value="' . $row['signed_date'] . '" required>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
    echo '<br/><a href="./course_student_manager.php">>>返回课程学生管理</a>';
    echo '</div></div>
<script>initDatePicker();</script>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>';
} elseif ($my == 'add_submit') {
    $course_id = $_POST['course_id'];
    $user_id = $_POST['user_id'];

    if ($course_id == NULL or $user_id == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        $time = date('Y-m-d H:i:s');
        $rowUser = $DB->get_row("SELECT * FROM users WHERE account='{$user_id}' limit 1");
        if ($rowUser) {
            $enjoyRow = $DB->get_row("SELECT * FROM course_stuInfo WHERE student_userKey='{$rowUser['user_key']}' and course_jobId='{$course_id}' limit 1");
            if ($enjoyRow) {
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"该用户已加入相关课程！\");\r\n";
                echo "</script>";
                echo '<script>FailedSettingMessage();</script>';
            } else {
                if (!$DB->query("INSERT INTO `course_stuInfo`(`course_jobId`, `student_userKey`, `operation_time`) VALUES ('" . $course_id . "','" . $rowUser['user_key'] . "','" . $time . "')"))
                    echo '<script>FailedSettingMessage();</script>';
                $courseRow = $DB->get_row("SELECT * FROM course_data WHERE jobid='{$course_id}' limit 1");
                if ($courseRow) {
                    $stuNum = $courseRow['course_studentNum'] + 1;
                    $DB->query("update course_data set course_studentNum='$stuNum' where jobid='{$course_id}'");
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
} elseif ($my == 'edit_submit') {
    $jobid = $_GET['jobid'];
    $rows = $DB->get_row("select * from course_stuInfo where jobid='$jobid' limit 1");
    if (!$rows)
        echo '<script>FailedMessage();</script>';
    $signed_time = $_POST['signed_time'];
    $signed_date = $_POST['signed_date'];
    if ($signed_time == NULL or $signed_date == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        if ($DB->query("update course_stuInfo set signed_time='$signed_time',signed_date='$signed_date' where jobid='{$jobid}'"))
            echo '<script>SuccessSettingMessage();</script>';
        else
            echo '<script>FailedSettingMessage();</script>';
    }
} elseif ($my == 'delete') {
    $jobid = $_GET['jobid'];
    $sql = "DELETE FROM course_stuInfo WHERE jobid='$jobid' limit 1";
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
    <div class="panel-heading" contenteditable="false">课程列表</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <?php
        if ($_GET['course_id_search'] != "" && $_GET['course_id_search'] != null) {
            $sql = " `course_jobId`='{$_GET['course_id_search']}'";
            $numrows = $DB->count("SELECT count(*) from course_stuInfo WHERE{$sql}");
            $courseInfoSearch = $DB->get_row("SELECT * FROM course_data WHERE jobid='{$_GET['course_id_search']}' limit 1");
            if ($courseInfoSearch) {
                $courseNameSearch = $courseInfoSearch['course_title'];
            }
            $con = '加入课程  ' . $courseNameSearch . ' 的共有 <b>' . $numrows . '</b> 位同学';
            echo '<div class="alert alert-info" style="margin-bottom: 0px;">' . $con . '</div>';
        } elseif ($_GET['user_id_search'] != "" && $_GET['user_id_search'] != null) {
            $id = $_GET['user_id_search'];
            $userInfoSearch = $DB->get_row("SELECT * FROM users WHERE account='{$id}' limit 1");
            if ($userInfoSearch) {
                $userKey = $userInfoSearch['user_key'];
                $userName = $userInfoSearch['private_name'];
                $sql = "`student_userKey`='{$userKey}'";
                $numrows = $DB->count("SELECT count(*) from course_stuInfo WHERE {$sql}");
            } else {
                $userName = "NULL";
                $numrows = '0';
            }
            $con = $userName . '共加入了 <b>' . $numrows . '</b> 门课程';
            echo '<div class="alert alert-info" style="margin-bottom: 0px;">' . $con . '</div>';
        } else {
            $numrows = $DB->count("SELECT count(*) from course_stuInfo");
            $sql = "1";
            echo '<div class="alert alert-info" style="margin-bottom: 0px;">系统共有' . $numrows . '条学生参加课程信息。<br><a href="./course_student_manager.php?my=add" class="btn btn-primary">添加学生课程</a>';
            echo '</div>';
        } ?>
        <div class="table-responsive">
            <table class="table table-bordered scrollbar-hover" id="tableDataGrid">
                <thead>
                <tr>
                    <th style="min-width: 100px;">操作</th>
                    <th>课程名称</th>
                    <th>学生姓名</th>
                    <th>加入时间</th>
                    <th>签到次数</th>
                    <th>最近签到时间</th>
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

                $rs = $DB->query("SELECT * FROM course_stuInfo WHERE {$sql} order by jobid desc limit $offset,$pagesize");
                while ($res = $DB->fetch($rs)) {
                    $courseInfo = $DB->get_row("SELECT * FROM course_data WHERE jobid='{$res['course_jobId']}' limit 1");
                    if ($courseInfo) {
                        $courseName = $courseInfo['course_title'];
                    } else {
                        $courseName = '未查询到课程信息';
                    }
                    $userInfo = $DB->get_row("SELECT * FROM users WHERE user_key='{$res['student_userKey']}' limit 1");
                    if ($userInfo) {
                        $stuName = $userInfo['private_name'];
                    } else {
                        $stuName = '未查询到学生信息';
                    }
                    if ($res['signed_time'] == "" || $res['signed_time'] == null) {
                        $signedTime = '待签到';
                    } else {
                        $signedTime = $res['signed_time'];
                    }
                    if ($res['signed_date'] == "" || $res['signed_date'] == null) {
                        $signedDate = '待签到';
                    } else {
                        $signedDate = $res['signed_date'];
                    }
                    echo '<tr><td>' . '<a href="./course_student_manager.php?my=edit&id=' . $res['jobid'] . '" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./course_student_manager.php?my=delete&jobid=' . $res['jobid'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这条记录吗？\');">删除</a></td><td>' . $courseName . '</td><td>' . $stuName . '</td><td><b>' . $res['operation_time'] . '</b></td><td>' . $signedTime . '</td><td>' . $signedDate . '</td></tr>';
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
