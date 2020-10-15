<?php
/**
 * 用户列表
 **/
$title = '用户列表';
$file = 'users';
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
        // 仅选择日期
        $(".form-date").datetimepicker(
            {
                language: "zh-CN",
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0,
                format: "yyyy-mm-dd"
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

$sql = "select * from users order by jobid desc limit 1";//获取persons中的数据，并按id倒叙排列，取其中两条;
$rs = $DB->query($sql);
$row = $DB->fetch($rs);
$rows = $DB->get_row("SELECT * FROM yonhu WHERE z='10000001' limit 1");
if (empty($row) || $row["account"] < 10000001) {
    $account = '10000001';
} else {
    $account = $row["account"] + 1;
}

if ($my == 'add')
{
    init_library();

    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">添加账号</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./users.php?my=add_submit" method="POST">
<div class="form-group">
<label>账号:</label><br>
<input type="text" class="form-control" name="account" value="' . $account . '" required>
</div>
<div class="form-group">
<label>密码:</label><br>
<input type="text" class="form-control" name="password" value="" required>
</div>
<div class="form-group">
<label>头像:</label><br>
<input type="text" class="form-control" name="avatar" value="' . $row['user_avatar'] . '" required>
</div>
<div class="form-group">
<label>昵称:</label><br>
<input type="text" class="form-control" name="private_name" value="" required>
</div>
<div class="form-group">
<label>生日:</label><br>
<input type="text" class="form-control form-date" placeholder="选择或者输入一个日期：yyyy-MM-dd" name="user_birthday" value="" required>
</div>
<div class="form-group">
<label>邮箱:</label><br>
<input type="text" class="form-control" name="user_email" value="" required>
</div>
<div class="form-group">
<label>手机号:</label><br>
<input type="text" class="form-control" name="user_phoneNumber" value="' . $row['user_phoneNumber'] . '" required>
</div>
<div class="form-group">
<label>用户等级:</label><br>
<select name="user_level" value="">
<option value="">请选择</option>
<option value="0">普通用户</option>
<option value="1">vip</option>
<option value="2">svip</option>
<option value="3">管理员</option>
<option value="-1">禁止访问</option>
</select>
<!--input type="text" class="form-control" name="user_level" value="" required-->
</div>
<div class="form-group">
<label>灰度等级:</label><br>
<select name="log_level" value="">
<option value="">请选择</option>
<option value="0">无染色模式</option>
<option value="1">一级染色</option>
<option value="2">二级染色</option>
<option value="3">三级染色</option>
<option value="4">四级染色</option>
<option value="5">五级染色</option>
</select>
</div>
<div class="form-group">
<label>到期日期:</label><br>
<input type="text" class="form-control form-date" placeholder="选择或者输入一个日期：yyyy-MM-dd" name="user_available_date" value="" required>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定添加"></form>';
    echo '<br/><a href="./users.php">>>返回用户列表</a>';
    echo '</div></div>';
    echo '<script>initDatePicker();</script>';
} elseif ($my == 'edit') {
    init_library();
    $id = $_GET['id'];
    $row = $DB->get_row("select * from users where jobid='$id' limit 1");

    if ($row['user_level'] == '0') {
        $yhdj = '<option value="0">普通用户</option>
<option value="1">vip</option>
<option value="2">svip</option>
<option value="3">管理员</option>
<option value="-1">禁止访问</option>';
    } else if ($row['user_level'] == '1') {
        $yhdj = '<option value="1">vip</option>
<option value="0">普通用户</option>
<option value="2">svip</option>
<option value="3">管理员</option>
<option value="-1">禁止访问</option>';
    } else if ($row['user_level'] == '2') {
        $yhdj = '<option value="2">svip</option>
<option value="0">普通用户</option>
<option value="1">vip</option>
<option value="3">管理员</option>
<option value="-1">禁止访问</option>';
    } else if ($row['user_level'] == '3') {
        $yhdj = '<option value="3">管理员</option>
<option value="0">普通用户</option>
<option value="1">vip</option>
<option value="2">svip</option>
<option value="-1">禁止访问</option>';
    } else if ($row['user_level'] == '-1') {
        $yhdj = '<option value="-1">禁止访问</option>
<option value="0">普通用户</option>
<option value="1">管理员</option>
<option value="2">vip</option>
<option value="3">svip</option>';
    } else {
        $yhdj = '<option value="">请选择</option>
<option value="0">普通用户</option>
<option value="1">vip</option>
<option value="2">svip</option>
<option value="3">管理员</option>
<option value="-1">禁止访问</option>';
    }

    if ($row['log_level'] == '0') {

        $hddj = '<option value="0">无染色模式</option>
<option value="1">一级染色</option>
<option value="2">二级染色</option>
<option value="3">三级染色</option>
<option value="4">四级染色</option>
<option value="5">五级染色</option>';
    } else if ($row['log_level'] == '1') {

        $hddj = '<option value="1">一级染色</option>
<option value="0">无染色模式</option>
<option value="2">二级染色</option>
<option value="3">三级染色</option>
<option value="4">四级染色</option>
<option value="5">五级染色</option>';
    } else if ($row['log_level'] == '2') {

        $hddj = '<option value="2">二级染色</option>
<option value="0">无染色模式</option>
<option value="1">一级染色</option>
<option value="3">三级染色</option>
<option value="4">四级染色</option>
<option value="5">五级染色</option>';
    } else if ($row['log_level'] == '3') {

        $hddj = '<option value="3">三级染色</option>
<option value="0">无染色模式</option>
<option value="1">一级染色</option>
<option value="2">二级染色</option>
<option value="4">四级染色</option>
<option value="5">五级染色</option>';
    } else if ($row['log_level'] == '4') {

        $hddj = '<option value="4">四级染色</option>
<option value="0">无染色模式</option>
<option value="1">一级染色</option>
<option value="2">二级染色</option>
<option value="3">三级染色</option>
<option value="5">五级染色</option>';
    } else if ($row['log_level'] == '5') {

        $hddj = '<option value="5">五级染色</option>
<option value="0">无染色模式</option>
<option value="1">一级染色</option>
<option value="2">二级染色</option>
<option value="3">三级染色</option>
<option value="4">四级染色</option>';
    } else {

        $hddj = '<option value="">请选择</option>
<option value="0">无染色模式</option>
<option value="1">一级染色</option>
<option value="2">二级染色</option>
<option value="3">三级染色</option>
<option value="4">四级染色</option>
<option value="5">五级染色</option>';
    }


    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改用户信息</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./users.php?my=edit_submit&jobid=' . $id . '" method="POST">
<div class="form-group">
<label>账号:</label><br>
<label>' . $row['account'] . '</label><br>
</div>
<div class="form-group">
<label>密码:</label><br>
<input type="text" class="form-control" name="password" value="' . $row['password'] . '" required>
</div>
<div class="form-group">
<label>头像:</label><br>
<input type="text" class="form-control" name="avatar" value="' . $row['user_avatar'] . '" required>
</div>
<div class="form-group">
<label>昵称:</label><br>
<input type="text" class="form-control" name="private_name" value="' . $row['private_name'] . '" required>
</div>
<div class="form-group">
<label>生日:</label><br>
<input type="text" class="form-control form-date" placeholder="选择或者输入一个日期：yyyy-MM-dd" name="user_birthday" value="' . $row['user_birthday'] . '" required>
</div>
<div class="form-group">
<label>邮箱:</label><br>
<input type="text" class="form-control" name="user_email" value="' . $row['user_email'] . '" required>
</div>
<div class="form-group">
<label>手机号:</label><br>
<input type="text" class="form-control" name="user_phoneNumber" value="' . $row['user_phoneNumber'] . '" required>
</div>
<div class="form-group">
<label>用户等级:</label><br>
<select name="user_level" value="' . $row['user_level'] . '"">
' . $yhdj . '
</select>
</div>
<div class="form-group">
<label>灰度等级:</label><br>
<select name="log_level" value="' . $row['log_level'] . '">
' . $hddj . '
</select>
</div>
<div class="form-group">
<label>到期日期:</label><br>
<input type="text" class="form-control form-date" placeholder="选择或者输入一个日期：yyyy-MM-dd" name="user_available_date" value="' . $row['user_available_date'] . '" required>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
    echo '<br/><a href="./users.php">>>返回用户列表</a>';
    echo '</div></div>
<script>initDatePicker();</script>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>';
} elseif ($my == 'add_submit') {
    $account = $_POST['account'];
    $password = $_POST['password'];
    $private_name = $_POST['private_name'];
    $user_birthday = $_POST['user_birthday'];
    $user_email = $_POST['user_email'];
    $user_level = $_POST['user_level'];
    $log_level = $_POST['log_level'];
    $user_available_date = $_POST['user_available_date'];
    $avatar = $_POST['avatar'];
    $user_phoneNumber = $_POST['user_phoneNumber'];
    if ($account == NULL or $password == NULL or $private_name == NULL or $user_birthday == NULL or $user_email == NULL or $user_level == NULL or $log_level == NULL or $user_available_date == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        $user_key = Security::public_encrypt($account . $user_birthday . $password);
        $check_account = $DB->get_row("select * from users where account='$account' limit 1");
        if ($check_account) {

            $sql = "select * from users order by jobid desc limit 1";//获取persons中的数据，并按id倒叙排列，取其中两条;
            $rs = $DB->query($sql);
            $row = $DB->fetch($rs);
            $rows = $DB->get_row("SELECT * FROM yonhu WHERE z='10000001' limit 1");
            if (empty($row) || $row["account"] < 10000001) {
                $account = '10000001';
            } else {
                $account = $row["account"] + 1;
            }

            if (!$DB->query("insert into `users` (`account`,`password`,`private_name`,`user_birthday`,`user_email`,`user_key`,`user_level`,`log_level`,`user_available_date`,`user_avatar`,`user_phoneNumber`) values ('" . $account . "','" . $password . "','" . $private_name . "','" . $user_birthday . "','" . $user_email . "','" . $user_key . "','" . $user_level . "','" . $log_level . "','" . $user_available_date . "','" . $avatar . "','" . $user_phoneNumber . "')"))
                echo '<script>FailedSettingMessage();</script>';
            if (!$DB->query("INSERT INTO `users_data`(`account`, `user_key`) VALUES ('" . $account . "','" . $user_key . "')"))
                echo '<script>FailedSettingMessage();</script>';
            if (!$DB->query("INSERT INTO `users_member`(`account`, `user_key`) VALUES ('" . $account . "','" . $user_key . "')"))
                echo '<script>FailedSettingMessage();</script>';
            echo "<script language=\"JavaScript\">\r\n";
            echo " alert(\"由于旧账号已经被占用，现已经重新获取，新账号：'.$account.\");\r\n";
            echo "</script>";
            echo '<script>SuccessSettingMessage();</script>';

        } else {
            if (!$DB->query("insert into `users` (`account`,`password`,`private_name`,`user_birthday`,`user_email`,`user_key`,`user_level`,`log_level`,`user_available_date`,`user_avatar`,`user_phoneNumber`) values ('" . $account . "','" . $password . "','" . $private_name . "','" . $user_birthday . "','" . $user_email . "','" . $user_key . "','" . $user_level . "','" . $log_level . "','" . $user_available_date . "','" . $avatar . "','" . $user_phoneNumber . "')"))
                echo '<script>FailedSettingMessage();</script>';
            if (!$DB->query("INSERT INTO `users_data`(`account`, `user_key`) VALUES ('" . $account . "','" . $user_key . "')"))
                echo '<script>FailedSettingMessage();</script>';
            if (!$DB->query("INSERT INTO `users_member`(`account`, `user_key`) VALUES ('" . $account . "','" . $user_key . "')"))
                echo '<script>FailedSettingMessage();</script>';
            echo '<script>SuccessSettingMessage();</script>';
        }
    }
} elseif ($my == 'edit_submit') {
    $jobid = $_GET['jobid'];
    $rows = $DB->get_row("select * from users where jobid='$jobid' limit 1");
    if (!$rows)
        echo '<script>FailedMessage();</script>';
    $id = $_POST['id'];
    $password = $_POST['password'];
    $private_name = $_POST['private_name'];
    $user_birthday = $_POST['user_birthday'];
    $user_email = $_POST['user_email'];
    $user_level = $_POST['user_level'];
    $log_level = $_POST['log_level'];
    $user_available_date = $_POST['user_available_date'];
    $avatar = $_POST['avatar'];
    $user_phoneNumber = $_POST['user_phoneNumber'];
    if ($password == NULL or $private_name == NULL or $user_birthday == NULL or $user_email == NULL or $user_level == NULL or $log_level == NULL or $user_available_date == NULL) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        if ($DB->query("update users set password='$password',private_name='$private_name',user_birthday='$user_birthday',user_email='$user_email',user_level='$user_level',log_level='$log_level',user_available_date='$user_available_date',user_avatar='$avatar',user_phoneNumber='$user_phoneNumber' where jobid='{$jobid}'"))
            echo '<script>SuccessSettingMessage();</script>';
        else
            echo '<script>FailedSettingMessage();</script>';
    }
} elseif ($my == 'delete') {
    $jobid = $_GET['jobid'];
    $rowid = $DB->get_row("select * from users where jobid='$jobid' limit 1");
    $rowyhzh = $rowid['account'];
    $sql = "DELETE FROM users WHERE jobid='$jobid' limit 1";
    $sql1 = "DELETE FROM users_data WHERE account='$rowyhzh' limit 1";
    $sql2 = "DELETE FROM users_member WHERE account='$rowyhzh' limit 1";
    if ($DB->query($sql) && $DB->query($sql1) && $DB->query($sql2))
        echo '<script>SuccessSettingMessage();</script>';
    else
        echo '<script>FailedSettingMessage();</script>';
}
else
{
?>
</div>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">用户列表</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <?php
        if (isset($_GET['data'])) {
            if ($_GET['type'] == 1) {
                $sql = " `account` LIKE '%{$_GET['data']}%'";
                $numrows = $DB->count("SELECT count(*) from users WHERE{$sql}");
                $con = '账号包含 ' . $_GET['data'] . ' 的共有 <b>' . $numrows . '</b> 位用户';
            } elseif ($_GET['type'] == 2) {
                $sql = " `user_level`='{$_GET['data']}'";
                $numrows = $DB->count("SELECT count(*) from users WHERE{$sql}");
                $con = '共有 <b>' . $numrows . '</b> 位' . $_GET['data'] . '等级的用户';
            } elseif ($_GET['type'] == 3) {
                $sql = " `user_email`LIKE'%{$_GET['data']}%'";
                $numrows = $DB->count("SELECT count(*) from users WHERE{$sql}");
                $con = '共有 <b>' . $numrows . '</b> 位邮箱包含' . $_GET['data'] . '的用户';
            }
        } else {
            $numrows = $DB->count("SELECT count(*) from users");
            $sql = " 1";
            echo '<div class="alert alert-info" style="margin-bottom: 0px;">系统共有' . $numrows . '位用户。<br><a href="./users.php?my=add" class="btn btn-primary">添加一位用户</a>';
            echo '</div>';
        }

        echo $con;
        ?>
        <div class="table-responsive">
            <table class="table table-bordered scrollbar-hover" id="tableDataGrid">
                <thead>
                <tr>
                    <th style="min-width: 100px;">操作</th>
                    <th>状态</th>
                    <th>头像</th>
                    <th>账号</th>
                    <th>密码</th>
                    <th>昵称</th>
                    <th>手机</th>
                    <th>生日</th>
                    <th>邮箱</th>
                    <th>用户key</th>
                    <th>用户等级</th>
                    <th>灰度等级</th>
                    <th>有效期</th>
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

                $rs = $DB->query("SELECT * FROM users WHERE{$sql} order by jobid desc limit $offset,$pagesize");
                while ($res = $DB->fetch($rs)) {
                    if ($res['user_level'] == '')
                        $user_level_now = '普通用户';
                    else if ($res['user_level'] == '0')
                        $user_level_now = '普通用户';
                    else if ($res['user_level'] == '1')
                        $user_level_now = 'vip';
                    else if ($res['user_level'] == '2')
                        $user_level_now = 'svip';
                    else if ($res['user_level'] == '3')
                        $user_level_now = '管理员';
                    else if ($res['user_level'] == '-1')
                        $user_level_now = '禁止访问';
                    if ($res['log_level'] == '')
                        $log_level_now = '无染色模式';
                    else if ($res['log_level'] == '0')
                        $log_level_now = '无染色模式';
                    else if ($res['log_level'] == '1')
                        $log_level_now = '一级染色';
                    else if ($res['log_level'] == '2')
                        $log_level_now = '二级染色';
                    else if ($res['log_level'] == '3')
                        $log_level_now = '三级染色';
                    else if ($res['log_level'] == '4')
                        $log_level_now = '四级染色';
                    else if ($res['log_level'] == '5')
                        $log_level_now = '五级染色';
                    if ((int)$res['user_status'] < 1)
                        $user_status_mail = "<b style='color: red'>未激活</b>";
                    else
                        $user_status_mail = "<b>已激活</b>";
                    echo '<tr><td>' . '<a href="./users.php?my=edit&id=' . $res['jobid'] . '" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./users.php?my=delete&jobid=' . $res['jobid'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此用户吗？\');">删除</a></td><td>' . $user_status_mail . '</td><td><img data-toggle="lightbox" src="' . $res['user_avatar'] . '" data-image="' . $res['user_avatar'] . '" data-caption="avatar" class="img-thumbnail" alt="" width="50" style="pointer-events: none;margin:0 auto;"></td><td><b>' . $res['account'] . '</b></td><td>' . $res['password'] . '</td><td>' . $res['private_name'] . '</td><td>' . $res['user_phoneNumber'] . '</td><td>' . $res['user_birthday'] . '</td><td>' . $res['user_email'] . '</td><td>' . $res['user_key'] . '</td><td>' . $user_level_now . '</td><td>' . $log_level_now . '</td><td>' . $res['user_available_date'] . '</td></tr>';
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
