<?php
/**
 * 课程管理
 **/
$title = '课程列表';
$file = 'course_manager';
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
        $(".form-time").datetimepicker({
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 1,
            minView: 0,
            maxView: 1,
            forceParse: 0,
            format: 'hh:ii'
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
<div class="panel-heading"><h3 class="panel-title">添加课程</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./course_manager.php?my=add_submit" method="POST">
<div class="form-group">
<label>课程名称:</label><br>
<input type="text" class="form-control" name="course_title" value="" required>
</div>
<div class="form-group">
<label>课程种类:</label><br>
<select name="course_type">
<option value="">请选择</option>
<option value="0">必修</option>
<option value="1">选修</option>
</select>
<!--input type="text" class="form-control" name="user_level" value="" required-->
</div>
<div class="form-group">
<label>课程日期（如：周一）:</label><br>
<select name="course_time_week">
<option value="">请选择</option>
<option value="0">周一</option>
<option value="1">周二</option>
<option value="2">周三</option>
<option value="3">周四</option>
<option value="4">周五</option>
<option value="5">周六</option>
<option value="6">周日</option>
</select>
</div>
<div class="form-group">
<label>开始时间:</label><br>
<input type="text" class="form-control form-time" name="course_time_startHour" placeholder="开始时间：hh:mm" value="" required>
</div>
<div class="form-group">
<label>结束时间:</label><br>
<input type="text" class="form-control form-time" name="course_time_endHour" placeholder="结束时间：hh:mm" value="" required>
</div>
<div class="form-group">
<label>课程地点:</label><br>
<input type="text" class="form-control" name="course_place" value="" required>
</div>
<div class="form-group">
<label>课程学院:</label><br>
<input type="text" class="form-control" name="course_college" value="" required>
</div>
<div class="form-group">
<label>课程学时:</label><br>
<input type="text" class="form-control" name="course_length" value="" required>
</div>
<div class="form-group">
<label>课程人数:</label><br>
<input type="text" class="form-control" name="course_total" value="" required>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定添加"></form>';
    echo '<br/><a href="./course_manager.php">>>返回课程列表</a>';
    echo '</div></div>';
    echo '<script>initDatePicker();</script>';
} elseif ($my == 'edit') {
    init_library();
    $id = $_GET['id'];
    $row = $DB->get_row("select * from course_data where jobid='$id' limit 1");

    if ($row['course_type'] == "") {
        $course_type_selector = '<select name="course_type" value="' . $row['course_type'] . '>
<option value="0">必修</option>
<option value="1">选修</option>
</select>';
    } else if ($row['course_type'] == "0") {
        $course_type_selector = '<select name="course_type" value="' . $row['course_type'] . '>
<option value="0">必修</option>
<option value="1">选修</option>
</select>';
    } else if ($row['course_type'] == "1") {
        $course_type_selector = '<select name="course_type" value="' . $row['course_type'] . '>
<option value="1">选修</option>
<option value="0">必修</option>
</select>';
    }

    if ($row['course_time_week'] == "") {
        $course_time_week_selector = '<select name="course_time_week" value="' . $row['course_time_week'] . '>
<option value="0">周一</option>
<option value="1">周二</option>
<option value="2">周三</option>
<option value="3">周四</option>
<option value="4">周五</option>
<option value="5">周六</option>
<option value="6">周日</option>
</select>';
    } else if ($row['course_time_week'] == "0") {
        $course_time_week_selector = '<select name="course_time_week" value="' . $row['course_time_week'] . '>
<option value="0">周一</option>
<option value="1">周二</option>
<option value="2">周三</option>
<option value="3">周四</option>
<option value="4">周五</option>
<option value="5">周六</option>
<option value="6">周日</option>
</select>';
    } else if ($row['course_time_week'] == "1") {
        $course_time_week_selector = '<select name="course_time_week" value="' . $row['course_time_week'] . '>
<option value="1">周二</option>
<option value="0">周一</option>
<option value="2">周三</option>
<option value="3">周四</option>
<option value="4">周五</option>
<option value="5">周六</option>
<option value="6">周日</option>
</select>';
    } else if ($row['course_time_week'] == "2") {
        $course_time_week_selector = '<select name="course_time_week" value="' . $row['course_time_week'] . '>
<option value="2">周三</option>
<option value="0">周一</option>
<option value="1">周二</option>
<option value="3">周四</option>
<option value="4">周五</option>
<option value="5">周六</option>
<option value="6">周日</option>
</select>';
    } else if ($row['course_time_week'] == "3") {
        $course_time_week_selector = '<select name="course_time_week" value="' . $row['course_time_week'] . '>
<option value="3">周四</option>
<option value="0">周一</option>
<option value="1">周二</option>
<option value="2">周三</option>
<option value="4">周五</option>
<option value="5">周六</option>
<option value="6">周日</option>
</select>';
    } else if ($row['course_time_week'] == "4") {
        $course_time_week_selector = '<select name="course_time_week" value="' . $row['course_time_week'] . '>
<option value="4">周五</option>
<option value="0">周一</option>
<option value="1">周二</option>
<option value="2">周三</option>
<option value="3">周四</option>
<option value="5">周六</option>
<option value="6">周日</option>
</select>';
    } else if ($row['course_time_week'] == "5") {
        $course_time_week_selector = '<select name="course_time_week" value="' . $row['course_time_week'] . '>
<option value="5">周六</option>
<option value="0">周一</option>
<option value="1">周二</option>
<option value="2">周三</option>
<option value="3">周四</option>
<option value="4">周五</option>
<option value="6">周日</option>
</select>';
    } else if ($row['course_time_week'] == "6") {
        $course_time_week_selector = '<select name="course_time_week" value="' . $row['course_time_week'] . '>
<option value="6">周日</option>
<option value="0">周一</option>
<option value="1">周二</option>
<option value="2">周三</option>
<option value="3">周四</option>
<option value="4">周五</option>
<option value="5">周六</option>
</select>';
    }

    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改课程信息</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./course_manager.php?my=edit_submit&jobid=' . $id . '" method="POST">
<div class="form-group">
<label>课程名称:</label><br>
<input type="text" class="form-control" name="course_title" value="' . $row['course_title'] . '" required>
</div>
<div class="form-group">
<label>课程种类:</label><br>
' . $course_type_selector . '
<!--input type="text" class="form-control" name="user_level" value="" required-->
</div>
<div class="form-group">
<label>课程日期（如：周一）:</label><br>
' . $course_time_week_selector . '
</div>
<div class="form-group">
<label>开始时间:</label><br>
<input type="text" class="form-control form-time" name="course_time_startHour" placeholder="开始时间：hh:mm" value="' . $row['course_time_startHour'] . '" required>
</div>
<div class="form-group">
<label>结束时间:</label><br>
<input type="text" class="form-control form-time" name="course_time_endHour" placeholder="结束时间：hh:mm" value="' . $row['course_time_endHour'] . '" required>
</div>
<div class="form-group">
<label>课程地点:</label><br>
<input type="text" class="form-control" name="course_place" value="' . $row['course_place'] . '" required>
</div>
<div class="form-group">
<label>课程学院:</label><br>
<input type="text" class="form-control" name="course_college" value="' . $row['course_college'] . '" required>
</div>
<div class="form-group">
<label>课程学时:</label><br>
<input type="text" class="form-control" name="course_length" value="' . $row['course_length'] . '" required>
</div>
<div class="form-group">
<label>课程人数:</label><br>
<input type="text" class="form-control" name="course_total" value="' . $row['course_total'] . '" required>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
    echo '<br/><a href="./course_manager.php">>>返回课程列表</a>';
    echo '</div></div>
<script>initDatePicker();</script>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>';
} elseif ($my == 'add_submit') {
    $course_title = $_POST['course_title'];
    $course_type = $_POST['course_type'];
    $course_time_week = $_POST['course_time_week'];
    $course_time_startHour = $_POST['course_time_startHour'];
    $course_time_endHour = $_POST['course_time_endHour'];
    $course_place = $_POST['course_place'];
    $course_college = $_POST['course_college'];
    $course_length = $_POST['course_length'];
    $course_total = $_POST['course_total'];
    $course_studentNum = '0';

    if ($course_title == NULL or $course_type == NULL or $course_time_week == NULL or $course_time_startHour == NULL or $course_time_endHour == NULL or $course_place == NULL or $course_college == NULL or $course_length == NULL or $course_total == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        if (!$DB->query("INSERT INTO `course_data`(`course_title`, `course_type`, `course_time_week`, `course_time_startHour`, `course_time_endHour`, `course_place`, `course_college`, `course_length`, `course_total`, `course_studentNum`) VALUES ('" . $course_title . "','" . $course_type . "','" . $course_time_week . "','" . $course_time_startHour . "','" . $course_time_endHour . "','" . $course_place . "','" . $course_college . "','" . $course_length . "','" . $course_total . "','" . $course_studentNum . "')"))
            echo '<script>FailedSettingMessage();</script>';
        echo '<script>SuccessSettingMessage();</script>';
    }
} elseif ($my == 'edit_submit') {
    $jobid = $_GET['jobid'];
    $rows = $DB->get_row("select * from course_data where jobid='$jobid' limit 1");
    if (!$rows)
        echo '<script>FailedMessage();</script>';
    $course_title = $_POST['course_title'];
    $course_type = $_POST['course_type'];
    $course_time_week = $_POST['course_time_week'];
    $course_time_startHour = $_POST['course_time_startHour'];
    $course_time_endHour = $_POST['course_time_endHour'];
    $course_place = $_POST['course_place'];
    $course_college = $_POST['course_college'];
    $course_length = $_POST['course_length'];
    $course_total = $_POST['course_total'];
    if ($course_title == NULL or $course_type == NULL or $course_time_week == NULL or $course_time_startHour == NULL or $course_time_endHour == NULL or $course_place == NULL or $course_college == NULL or $course_length == NULL or $course_total == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        if ($DB->query("update course_data set course_title='$course_title',course_type='$course_type',course_time_week='$course_time_week',course_time_startHour='$course_time_startHour',course_time_endHour='$course_time_endHour',course_place='$course_place',course_college='$course_college',course_length='$course_length',course_total='$course_total' where jobid='{$jobid}'"))
            echo '<script>SuccessSettingMessage();</script>';
        else
            echo '<script>FailedSettingMessage();</script>';
    }
} elseif ($my == 'delete') {
    $jobid = $_GET['jobid'];
    $sql = "DELETE FROM course_data WHERE jobid='$jobid' limit 1";
    $rs = $DB->query("SELECT * FROM course_stuInfo WHERE course_jobid='$jobid' order by jobid desc");
    while ($res = $DB->fetch($rs)) {
        $jobIdData = $res['jobid'];
        $del = "DELETE FROM course_stuInfo WHERE jobid='$jobIdData' limit 1";
        $DB->query($del);
    }
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
        $numrows = $DB->count("SELECT count(*) from course_data");
        $sql = " 1";
        echo '<div class="alert alert-info" style="margin-bottom: 0px;">系统共有' . $numrows . '条课程信息。<br><a href="./course_manager.php?my=add" class="btn btn-primary">添加一门课程</a>';
        echo '</div>';
        function getStuInfo($total, $stuNum)
        {
            return $stuNum . '/' . $total;
        }

        function getTime($week, $startHour, $endHour)
        {
            if ($week == '0') {
                $week = '周一';
            } else if ($week == '1') {
                $week = '周二';
            } else if ($week == '2') {
                $week = '周三';
            } else if ($week == '3') {
                $week = '周四';
            } else if ($week == '4') {
                $week = '周五';
            } else if ($week == '5') {
                $week = '周六';
            } else if ($week == '6') {
                $week = '周日';
            }
            return $week . "  " . $startHour . " - " . $endHour;
        }

        ?>
        <div class="table-responsive">
            <table class="table table-bordered scrollbar-hover" id="tableDataGrid">
                <thead>
                <tr>
                    <th style="min-width: 100px;">操作</th>
                    <th>课程名称</th>
                    <th>课程种类</th>
                    <th>课程时间</th>
                    <th>课程地点</th>
                    <th>课程学院</th>
                    <th>课程课时</th>
                    <th>课程学生余量</th>
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

                $rs = $DB->query("SELECT * FROM course_data WHERE{$sql} order by jobid desc limit $offset,$pagesize");
                while ($res = $DB->fetch($rs)) {
                    if ($res['course_type'] == "") {
                        $courseType = "必修";
                    } else if ($res['course_type'] == "0") {
                        $courseType = "必修";
                    } else {
                        $courseType = "选修";
                    }
                    echo '<tr><td>' . '<a href="./course_manager.php?my=edit&id=' . $res['jobid'] . '" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./course_manager.php?my=delete&jobid=' . $res['jobid'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这门课程吗？\');">删除</a></td><td>' . $res['course_title'] . '</td><td>' . $courseType . '</td><td><b>' . getTime($res['course_time_week'], $res['course_time_startHour'], $res['course_time_endHour']) . '</b></td><td>' . $res['course_place'] . '</td><td>' . $res['course_college'] . '</td><td>' . $res['course_length'] . '</td><td>' . getStuInfo($res['course_total'], $res['course_studentNum']) . '</td></tr>';
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
