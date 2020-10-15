<?php
/**
 * 用户数据管理
 **/
$title='用户数据管理';
$file = 'users_data';
include_once 'head.php';
$my=isset($_GET['my'])?$_GET['my']:null;
?>
<html>
<link rel="stylesheet" href="../assets/css/setting_common.css">
<body>
<link rel="stylesheet" href="../assets/css/users_common.css">
<script src="../assets/js/setting_common.js"></script>

<?php
if($my=='edit')
{
$id=$_GET['jobid'];
$row=$DB->get_row("select * from users_data where jobid='$id' limit 1");


echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改用户数据</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./users_data.php?my=edit_submit&jobid='.$id.'" method="POST">
<div class="form-group">
<label>账号:</label><br>
<label>'.$row['account'].'</label><br>
</div>
<div class="form-group">
<label>积分:</label><br>
<input type="text" class="form-control" name="integrals" value="'.$row['integrals'].'" required>
</div>
<div class="form-group">
<label>威望:</label><br>
<input type="text" class="form-control" name="prestige" value="'.$row['prestige'].'" required>
</div>
<div class="form-group">
<label>成长值:</label><br>
<input type="text" class="form-control" name="grow_integrals" value="'.$row['grow_integrals'].'" required>
</div>
<div class="form-group">
<label>登录奖励领取日期:</label><br>
<input type="text" id="d11" class="form-control Wdate" name="last_login" value="'.$row['last_login'].'" onClick="WdatePicker({isShowClear:false})" autocomplete="off" required>
</div>
<div class="form-group">
<label>签到日期:</label><br>
<input type="text" id="d11" class="form-control Wdate" name="last_sign" value="'.$row['last_sign'].'" onClick="WdatePicker({isShowClear:false})" autocomplete="off" required>
</div>
<div class="form-group">
<label>连续签到天数:</label><br>
<input type="text" class="form-control" name="keep_sign_times" value="'.$row['keep_sign_times'].'" required>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
echo '<br/><a href="./users_data.php">>>返回用户列表</a>';
echo '</div></div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>';
}
elseif($my=='edit_submit')
{
$jobid=$_GET['jobid'];
$rows=$DB->get_row("select * from users where jobid='$jobid' limit 1");
if(!$rows)
    echo '<script>FailedSettingMessage();</script>';
$id=$_POST['id'];
$integrals=$_POST['integrals'];
$prestige=$_POST['prestige'];
$grow_integrals=$_POST['grow_integrals'];
$last_login=$_POST['last_login'];
$last_sign=$_POST['last_sign'];
$keep_sign_times=$_POST['keep_sign_times'];
if($integrals==NULL or $prestige==NULL or $grow_integrals==NULL or $last_login==NULL or $last_sign==NULL or $keep_sign_times==NULL ){
    echo '<script>FailedSettingMessage();</script>';
} else {
if(!$DB->query("update users_data set integrals='$integrals',prestige='$prestige',grow_integrals='$grow_integrals',last_login='$last_login',last_sign='$last_sign',keep_sign_times='$keep_sign_times' where jobid='{$jobid}'"))
	echo '<script>FailedSettingMessage();</script>';
echo '<script>SuccessSettingMessage();</script>';
}
}
else {
?>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">数据配置</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <?php
        if(isset($_GET['data'])) {
            if($_GET['type']==1) {
                $sql=" `account` LIKE '%{$_GET['data']}%'";
                $numrows=$DB->count("SELECT count(*) from users_data WHERE{$sql}");
                echo '账号包含 '.$_GET['data'].' 的共有 <b>'.$numrows.'</b> 位用户';
            }
        }else {
            $numrows = $DB->count("SELECT count(*) from users_data");
            $sql = " 1";
            echo '<div class="alert alert-info" style="margin-bottom: 0px;">系统共有' . $numrows . '用户。<br>';
            echo '</div>';
        }
        ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead><tr><th>账号</th><th>用户key</th><th>积分</th><th>威望</th><th>成长值</th><th>登录奖励领取日期</th><th>签到日期</th><th>连续签到天数</th><th>累计课程签到次数</th><th>操作</th></tr></thead>
                    <tbody>
                    <?php
                    $pagesize = 30;
                    $pages = intval($numrows / $pagesize);
                    if ($numrows % $pagesize) {
                        $pages++;
                    }
                    if (isset($_GET['page'])) {
                        $page = intval($_GET['page']);
                    } else {
                        $page = 1;
                    }
                    $offset = $pagesize * ($page - 1);

                    $rs=$DB->query("SELECT * FROM users_data WHERE {$sql} order by jobid desc limit $offset,$pagesize");
                    while($res = $DB->fetch($rs))
                    {
                        $userInfo = $DB->get_row("SELECT * FROM users WHERE account='{$res['account']}' limit 1");
                        if ($userInfo) {
                            if ($userInfo['signed_times'] == "" || $userInfo['signed_times'] == null) {
                                $signedTimes = 0;
                            } else {
                                $signedTimes = $userInfo['signed_times'];
                            }
                        } else {
                            $signedTimes = 0;
                        }
                        echo '<tr><td><b>'.$res['account'].'</b></td><td>'.$res['user_key'].'</td><td>'.$res['integrals'].'</td><td>'.$res['prestige'].'</td><td>'.$res['grow_integrals'].'</td><td>'.$res['last_login'].'</td><td>'.$res['last_sign'].'</td><td>'.$res['keep_sign_times'].'</td><td>'.$signedTimes.'</td><td>'.'<a href="./users_data.php?my=edit&jobid='.$res['jobid'].'" class="btn btn-info btn-xs">编辑</a></td></tr>';
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
        }?>
    </div>
</div>
<script>
    $('#pager').on('onPageChange', function(e, state, oldState) {
        if (state.page !== oldState.page) {
            //console.log('页码从', oldState.page, '变更为', state.page);
            var page_num = state.page;
            window.location.href='<?php echo $file?>.php?page=' + page_num;
        }
    });
</script>
</body>
</html>