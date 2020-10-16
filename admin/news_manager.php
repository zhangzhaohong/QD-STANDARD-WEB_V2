<?php
/**
 * 食堂新闻管理
 **/
$title = '食堂新闻管理';
$file = 'news_manager';
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
        $(".form-datetime").datetimepicker(
            {
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1,
                format: "yyyy-mm-dd hh:ii"
            });
    }
</script>
<?php

$my = isset($_GET['my']) ? $_GET['my'] : null;

function init_library()
{
    echo '<link href="../assets/zui_package/1.9.2/lib/datetimepicker/datetimepicker.css" rel="stylesheet">';
    echo '<script src="../assets/zui_package/1.9.2/lib/datetimepicker/datetimepicker.js"></script>';
    echo '<link href="../assets/zui_package/1.9.2/lib/datetimepicker/datetimepicker.min.css" rel="stylesheet">';
    echo '<script src="../assets/zui_package/1.9.2/lib/datetimepicker/datetimepicker.min.js"></script>';
}

if ($my == 'add')
{
    init_library();
    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">添加新闻</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./news_manager.php?my=add_submit" method="POST">
<div class="form-group">
<label>新闻标题:</label><br>
<input type="text" class="form-control" name="title" value="" required>
</div>
<div class="form-group">
<label>发生时间:</label><br>
<input type="text" class="form-control form-datetime" placeholder="选择或者输入一个日期+时间：yyyy-MM-dd hh:mm" name="date" value="" required>
</div>
<div class="form-group">
<label>状态:</label><br>
<input type="text" class="form-control" name="status" value="">
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定添加"></form>';
    echo '<br/><a href="./news_manager.php">>>返回新闻列表</a>';
    echo '</div></div>';
    echo '<script>initDatePicker();</script>';
} elseif ($my == 'edit') {
    init_library();
    $id = $_GET['id'];
    $row = $DB->get_row("select * from news_data where jobid='$id' limit 1");

    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改新闻信息</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./news_manager.php?my=edit_submit&jobid=' . $id . '" method="POST">
<div class="form-group">
<label>新闻标题:</label><br>
<input type="text" class="form-control" name="title" value="' . $row['title'] . '" required>
</div>
<div class="form-group">
<label>发生时间:</label><br>
<input type="text" class="form-control form-datetime" placeholder="选择或者输入一个日期+时间：yyyy-MM-dd hh:mm" name="date" value="' . $row['date'] . '" required>
</div>
<div class="form-group">
<label>状态:</label><br>
<input type="text" class="form-control" name="status" value="' . $row['status'] . '">
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
    echo '<br/><a href="./news_manager.php">>>返回新闻列表</a>';
    echo '</div></div>
<script>initDatePicker();</script>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>';
} elseif ($my == 'add_submit') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    if ($title == NULL or $date == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        if (!$DB->query("INSERT INTO `news_data`(`title`, `date`, `status`) VALUES ('" . $title . "','" . $date . "','" . $status . "')"))
            echo '<script>FailedSettingMessage();</script>';
        echo '<script>SuccessSettingMessage();</script>';
    }
} elseif ($my == 'edit_submit') {
    $jobid = $_GET['jobid'];
    $rows = $DB->get_row("select * from news_data where jobid='$jobid' limit 1");
    if (!$rows)
        echo '<script>FailedMessage();</script>';
    $title = $_POST['title'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    if ($title == NULL or $date == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        if ($DB->query("update news_data set title='$title',date='$date',status='$status' where jobid='{$jobid}'"))
            echo '<script>SuccessSettingMessage();</script>';
        else
            echo '<script>FailedSettingMessage();</script>';
    }
} elseif ($my == 'delete') {
    $jobid = $_GET['jobid'];
    $sql = "DELETE FROM news_data WHERE jobid='$jobid' limit 1";
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
    <div class="panel-heading" contenteditable="false">新闻列表</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <?php
        $numrows = $DB->count("SELECT count(*) from news_data");
        $sql = "1";
        echo '<div class="alert alert-info" style="margin-bottom: 0px;">系统共有' . $numrows . '条新闻。<br><a href="./news_manager.php?my=add" class="btn btn-primary">添加一条新闻</a>';
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
                    <th>标题</th>
                    <th>日期</th>
                    <th>状态</th>
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

                $rs = $DB->query("SELECT * FROM news_data WHERE {$sql} order by jobid desc limit $offset,$pagesize");
                while ($res = $DB->fetch($rs)) {
                    echo '<tr><td>' . '<a href="./news_manager.php?my=edit&id=' . $res['jobid'] . '" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./news_manager.php?my=delete&jobid=' . $res['jobid'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这条新闻吗？\');">删除</a></td><td>' . $res['title'] . '</td><td>' . $res['date'] . '</td><td><b>' . $res['status'] . '</b></td><td>' . $res['description'] . '</td></tr>';
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
