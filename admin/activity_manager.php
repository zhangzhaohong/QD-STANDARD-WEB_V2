<?php
/**
 * 活动列表
 **/
$title = '活动列表';
$file = 'activity_manager';
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
<div class="panel-heading"><h3 class="panel-title">添加活动</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./activity_manager.php?my=add_submit" method="POST">
<div class="form-group">
<label>活动名称:</label><br>
<input type="text" class="form-control" name="activity_title" value="" required>
</div>
<div class="form-group">
<label>活动简介:</label><br>
<textarea class="form-control" name="activity_content" value="" rows="10" required></textarea>
</div>
<div class="form-group">
<label>活动图片:</label><br>
<input type="text" class="form-control" name="activity_pic" value="">
</div>
<div class="form-group">
<label>活动视频（vid）:</label><br>
<input type="text" class="form-control" name="activity_vid" value="">
</div>
<div class="form-group">
<label>活动最大参加人数:</label><br>
<input type="text" class="form-control" name="activity_maxNum" value="" required>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定添加"></form>';
    echo '<br/><a href="./activity_manager.php">>>返回活动列表</a>';
    echo '</div></div>';
    echo '<script>initDatePicker();</script>';
} elseif ($my == 'edit') {
    $id = $_GET['id'];
    $row = $DB->get_row("select * from activity_data where jobid='$id' limit 1");

    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改活动信息</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./activity_manager.php?my=edit_submit&jobid=' . $id . '" method="POST">
<div class="form-group">
<label>活动名称:</label><br>
<input type="text" class="form-control" name="activity_title" value="' . $row['activity_title'] . '" required>
</div>
<div class="form-group">
<label>活动简介:</label><br>
<textarea class="form-control" name="activity_content" rows="10" required>' . $row['activity_content'] . '</textarea>
</div>
<div class="form-group">
<label>活动图片:</label><br>
<input type="text" class="form-control" name="activity_pic" value="' . $row['activity_pic'] . '">
</div>
<div class="form-group">
<label>活动视频（vid）:</label><br>
<input type="text" class="form-control" name="activity_vid" value="' . $row['activity_vid'] . '">
</div>
<div class="form-group">
<label>活动最大参加人数:</label><br>
<input type="text" class="form-control" name="activity_maxNum" value="' . $row['activity_maxNum'] . '" required>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
    echo '<br/><a href="./activity_manager.php">>>返回活动列表</a>';
    echo '</div></div>
<script>initDatePicker();</script>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>';
} elseif ($my == 'add_submit') {
    $activity_title = $_POST['activity_title'];
    $activity_content = $_POST['activity_content'];
    $activity_pic = $_POST['activity_pic'];
    $activity_vid = $_POST['activity_vid'];
    $activity_maxNum = $_POST['activity_maxNum'];
    $activity_joinedNum = '0';

    if ($activity_title == NULL or $activity_content == NULL or $activity_maxNum == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        if (!$DB->query("INSERT INTO `activity_data`(`activity_title`, `activity_content`, `activity_pic`, `activity_vid`, `activity_joinedNum`, `activity_maxNum`) VALUES ('" . $activity_title . "','" . $activity_content . "','" . $activity_pic . "','" . $activity_vid . "','" . $activity_joinedNum . "','" . $activity_maxNum . "')"))
            echo '<script>FailedSettingMessage();</script>';
        echo '<script>SuccessSettingMessage();</script>';
    }
} elseif ($my == 'edit_submit') {
    $jobid = $_GET['jobid'];
    $rows = $DB->get_row("select * from activity_data where jobid='$jobid' limit 1");
    if (!$rows)
        echo '<script>FailedMessage();</script>';
    $activity_title = $_POST['activity_title'];
    $activity_content = $_POST['activity_content'];
    $activity_pic = $_POST['activity_pic'];
    $activity_vid = $_POST['activity_vid'];
    $activity_maxNum = $_POST['activity_maxNum'];
    $activity_joinedNum = '0';

    if ($activity_title == NULL or $activity_content == NULL or $activity_maxNum == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        if ($DB->query("update activity_data set activity_title='$activity_title',activity_content='$activity_content',activity_pic='$activity_pic',activity_vid='$activity_vid',activity_maxNum='$activity_maxNum' where jobid='{$jobid}'"))
            echo '<script>SuccessSettingMessage();</script>';
        else
            echo '<script>FailedSettingMessage();</script>';
    }
} elseif ($my == 'delete') {
    $jobid = $_GET['jobid'];
    $rs = $DB->query("SELECT * FROM activity_stuInfo WHERE activity_jobid='$jobid' order by jobid desc");
    while ($res = $DB->fetch($rs)) {
        $jobIdData = $res['jobid'];
        $del = "DELETE FROM activity_stuInfo WHERE jobid='$jobIdData' limit 1";
        $DB->query($del);
    }
    $sql = "DELETE FROM activity_data WHERE jobid='$jobid' limit 1";
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
        $numrows = $DB->count("SELECT count(*) from activity_data");
        $sql = "1";
        echo '<div class="alert alert-info" style="margin-bottom: 0px;">系统共有' . $numrows . '条课程信息。<br><a href="./activity_manager.php?my=add" class="btn btn-primary">添加一门课程</a>';
        echo '</div>';
        function getActInfo($total, $now)
        {
            return $now . '/' . $total;
        }

        ?>
        <div class="table-responsive">
            <table class="table table-bordered scrollbar-hover" id="tableDataGrid">
                <thead>
                <tr>
                    <th style="min-width: 100px;">操作</th>
                    <th>活动标题</th>
                    <th>活动简介</th>
                    <th>活动图片</th>
                    <th>活动视频</th>
                    <th>活动已参加人数</th>
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

                $rs = $DB->query("SELECT * FROM activity_data WHERE {$sql} order by jobid desc limit $offset,$pagesize");
                while ($res = $DB->fetch($rs)) {
                    echo '<tr><td>' . '<a href="./activity_manager.php?my=edit&id=' . $res['jobid'] . '" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./activity_manager.php?my=delete&jobid=' . $res['jobid'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这条活动吗？\');">删除</a></td><td>' . $res['activity_title'] . '</td><td><textarea class="form-control" name="activity_content" rows="5" disabled>' . $res['activity_content'] . '</textarea></td><td><b>' . $res['activity_pic'] . '</b></td><td>' . $res['activity_vid'] . '</td><td>' . getActInfo($res['activity_maxNum'], $res['activity_joinedNum']) . '</td></tr>';
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
