<?php
/**
 * 音视频管理
 **/
$title = '音视频管理';
$file = 'live_data_manager';
include_once 'head.php';
$page = (isset($_GET['page']) ? $_GET['page'] : 1);
$type = (isset($_GET['type']) ? $_GET['type'] : 0);
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
<div class="panel-heading"><h3 class="panel-title">添加数据</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./live_data_manager.php?my=add_submit" method="POST">
<div class="form-group">
<label>封面:</label><br>
<input type="text" class="form-control" name="cover" value="" required>
</div>
<div class="form-group">
<label>文件路径:</label><br>
<input type="text" class="form-control" name="fileUrl" value="" required>
</div>
<div class="form-group">
<label>描述:</label><br>
<input type="text" class="form-control" name="content" value="">
</div>
<div class="form-group">
<label>类型:</label><br>
<select name="file_type" value="">
<option value="">请选择</option>
<option value="0">视频</option>
<option value="1">图片</option>
</select>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定添加"></form>';
    echo '<br/><a href="./live_data_manager.php">>>返回数据列表</a>';
    echo '</div></div>';
} elseif ($my == 'edit') {
    $id = $_GET['id'];
    $row = $DB->get_row("select * from live_data where jobid='$id' limit 1");

    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改数据信息</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./live_data_manager.php?my=edit_submit&jobid=' . $id . '" method="POST">
<div class="form-group">
<label>封面:</label><br>
<input type="text" class="form-control" name="cover" value="' . $row['cover'] . '" required>
</div>
<div class="form-group">
<label>文件路径:</label><br>
<input type="text" class="form-control" name="fileUrl" value="' . $row['file'] . '" required>
</div>
<div class="form-group">
<label>描述:</label><br>
<input type="text" class="form-control" name="content" value="' . $row['content'] . '">
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
    echo '<br/><a href="./live_data_manager.php">>>返回数据列表</a>';
    echo '</div></div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>';
} elseif ($my == 'add_submit') {
    $cover = $_POST['cover'];
    $fileUrl = $_POST['fileUrl'];
    $file_type = $_POST['file_type'];
    $content = $_POST['content'];
    if ($cover == NULL or $fileUrl == NULL or $file_type == NULL or $file_type == "") {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        if (!$DB->query("INSERT INTO `live_data`(`cover`, `file`, `content`, `file_type`) VALUES ('" . $cover . "','" . $fileUrl . "','" . $content . "','" . $file_type . "')"))
            echo '<script>FailedSettingMessage();</script>';
        echo '<script>SuccessSettingMessage();</script>';
    }
} elseif ($my == 'edit_submit') {
    $jobid = $_GET['jobid'];
    $rows = $DB->get_row("select * from live_data where jobid='$jobid' limit 1");
    if (!$rows)
        echo '<script>FailedMessage();</script>';
    $cover = $_POST['cover'];
    $fileUrl = $_POST['fileUrl'];
    $content = $_POST['content'];
    if ($cover == NULL or $fileUrl == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        if ($DB->query("update live_data set cover='$cover',file='$fileUrl',content='$content' where jobid='{$jobid}'"))
            echo '<script>SuccessSettingMessage();</script>';
        else
            echo '<script>FailedSettingMessage();</script>';
    }
} elseif ($my == 'delete') {
    $jobid = $_GET['jobid'];
    $sql = "DELETE FROM live_data WHERE jobid='$jobid' limit 1";
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
    <div class="panel-heading" contenteditable="false">数据列表</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <?php
        $sql = "file_type=" . $type;
        $numrows = $DB->count("SELECT count(*) from live_data where {$sql}");
        if ($type == 0) {
            $type_content = "视频";
        } else {
            $type_content = "图片";
        }
        echo '<div class="alert alert-info" style="margin-bottom: 0px;">系统共有' . $numrows . '条' . $type_content . '信息。<br><a href="./live_data_manager.php?my=add" class="btn btn-primary">添加一条数据</a>';
        ?>
        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                <?php echo $type_content;?>列表 <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="./live_data_manager.php?page=<?php echo $page?>&type=0">视频列表</a></li>
                <li><a href="./live_data_manager.php?page=<?php echo $page?>&type=1">图片列表</a></li>
            </ul>
        </div>
        <?php
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
                    <th>封面</th>
                    <th>文件路径</th>
                    <th>描述</th>
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

                $rs = $DB->query("SELECT * FROM live_data WHERE {$sql} order by jobid desc limit $offset,$pagesize");
                while ($res = $DB->fetch($rs)) {
                    echo '<tr><td>' . '<a href="./live_data_manager.php?my=edit&id=' . $res['jobid'] . '" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./live_data_manager.php?my=delete&jobid=' . $res['jobid'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这条数据吗？\');">删除</a></td><td><img data-toggle="lightbox" src="' . $res['cover'] . '" data-image="' . $res['cover'] . '" data-caption="avatar" class="img-thumbnail" alt="" width="200" style="pointer-events: none;margin:0 auto;"></td><td>' . $res['file'] . '</td><td>' . $res['content'] . '</td></tr>';
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
