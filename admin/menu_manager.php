<?php
/**
 * 菜品管理
 **/
$title = '菜品管理';
$file = 'menu_manager';
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
<div class="panel-heading"><h3 class="panel-title">添加菜品</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./menu_manager.php?my=add_submit" method="POST">
<div class="form-group">
<label>菜品名称:</label><br>
<input type="text" class="form-control" name="title" value="" required>
</div>
<div class="form-group">
<label>菜品价格:</label><br>
<input type="text" class="form-control" name="price" value="" required>
</div>
<div class="form-group">
<label>份量:</label><br>
<input type="text" class="form-control" name="unit" value="" required>
</div>
<div class="form-group">
<label>描述:</label><br>
<input type="text" class="form-control" name="description" value="">
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定添加"></form>';
    echo '<br/><a href="./menu_manager.php">>>返回菜品列表</a>';
    echo '</div></div>';
} elseif ($my == 'edit') {
    $id = $_GET['id'];
    $row = $DB->get_row("select * from menu_data where jobid='$id' limit 1");

    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改菜品信息</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./menu_manager.php?my=edit_submit&jobid=' . $id . '" method="POST">
<div class="form-group">
<label>菜品名称:</label><br>
<input type="text" class="form-control" name="title" value="' . $row['title'] . '" required>
</div>
<div class="form-group">
<label>菜品价格:</label><br>
<input type="text" class="form-control" name="price" value="' . $row['price'] . '" required>
</div>
<div class="form-group">
<label>份量:</label><br>
<input type="text" class="form-control" name="unit" value="' . $row['unit'] . '" required>
</div>
<div class="form-group">
<label>描述:</label><br>
<input type="text" class="form-control" name="description" value="' . $row['description'] . '">
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
    echo '<br/><a href="./menu_manager.php">>>返回菜品列表</a>';
    echo '</div></div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>';
} elseif ($my == 'add_submit') {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $description = $_POST['description'];

    if ($title == NULL or $price == NULL or $unit == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        if (!$DB->query("INSERT INTO `menu_data`(`title`, `price`, `unit`, `description`) VALUES ('" . $title . "','" . $price . "','" . $unit . "','" . $description . "')"))
            echo '<script>FailedSettingMessage();</script>';
        echo '<script>SuccessSettingMessage();</script>';
    }
} elseif ($my == 'edit_submit') {
    $jobid = $_GET['jobid'];
    $rows = $DB->get_row("select * from menu_data where jobid='$jobid' limit 1");
    if (!$rows)
        echo '<script>FailedMessage();</script>';
    $title = $_POST['title'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $description = $_POST['description'];

    if ($title == NULL or $price == NULL or $unit == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        if ($DB->query("update menu_data set title='$title',price='$price',unit='$unit',description='$description' where jobid='{$jobid}'"))
            echo '<script>SuccessSettingMessage();</script>';
        else
            echo '<script>FailedSettingMessage();</script>';
    }
} elseif ($my == 'delete') {
    $jobid = $_GET['jobid'];
    $sql = "DELETE FROM menu_data WHERE jobid='$jobid' limit 1";
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
    <div class="panel-heading" contenteditable="false">菜品列表</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <?php
        $numrows = $DB->count("SELECT count(*) from menu_data");
        $sql = "1";
        echo '<div class="alert alert-info" style="margin-bottom: 0px;">系统共有' . $numrows . '条菜品信息。<br><a href="./menu_manager.php?my=add" class="btn btn-primary">添加一个菜品</a>';
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
                    <th>菜名</th>
                    <th>价格</th>
                    <th>份量</th>
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

                $rs = $DB->query("SELECT * FROM menu_data WHERE {$sql} order by jobid desc limit $offset,$pagesize");
                while ($res = $DB->fetch($rs)) {
                    echo '<tr><td>' . '<a href="./menu_manager.php?my=edit&id=' . $res['jobid'] . '" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./menu_manager.php?my=delete&jobid=' . $res['jobid'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这个菜品吗？\');">删除</a></td><td>' . $res['title'] . '</td><td>' . $res['price'] . '</td><td><b>' . $res['unit'] . '</b></td><td>' . $res['description'] . '</td></tr>';
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
