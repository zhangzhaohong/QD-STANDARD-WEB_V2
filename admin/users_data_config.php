<?php
/**
 * 数据配置
 **/
$title='数据配置';
$file = 'users_data_config';
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
    $row=$DB->get_row("select * from users_data_config where jobid='$id' limit 1");

//echo "select * from users_data_config where jobid='$id' limit 1";

//echo $row[integrals];


    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改配置信息</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./users_data_config.php?my=edit_submit&jobid='.$id.'" method="POST">
<div class="form-group">
<label>积分 格式【最小值|最大值 如：1|40 前者必须大于后者，且为数字 如需相等 则前后数字必须相等，仍用|分割 如：3|3】:</label><br>
<input type="text" class="form-control" name="integrals" value="'.$row[integrals].'" required>
</div>
<div class="form-group">
<label>威望:</label><br>
<input type="text" class="form-control" name="prestige" value="'.$row[prestige].'" required>
</div>
<div class="form-group">
<label>成长值:</label><br>
<input type="text" class="form-control" name="grow_integrals" value="'.$row[grow_integrals].'" required>
</div>
<div class="form-group">
<label>vip成长加速（积分额外奖励/成长值加倍）:</label><br>
<input type="text" class="form-control" name="vip" value="'.$row[vip].'" required>
</div>
<div class="form-group">
<label>svip成长加速（积分额外奖励/成长值加倍）:</label><br>
<input type="text" class="form-control" name="svip" value="'.$row[svip].'" required>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
    echo '<br/><a href="./users_data_config.php">>>返回配置列表</a>';
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
    $rows=$DB->get_row("select * from users_data_config where jobid='$jobid' limit 1");
    if(!$rows){
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"当前记录不存在!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    }
    $id=$_POST['id'];
    $integrals=$_POST['integrals'];
    $prestige=$_POST['prestige'];
    $grow_integrals=$_POST['grow_integrals'];
    $vip=$_POST['vip'];
    $svip=$_POST['svip'];
    if($integrals==NULL or $prestige==NULL or $grow_integrals==NULL or $vip==NULL or $svip==NULL ){
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"保存错误,请确保加*项都不为空!\");\r\n";
        echo "</script>";
        echo '<script>FailedSettingMessage();</script>';
    } else {
        $var_random=explode("|",$integrals);
        if($var_random[0]<=$var_random[1]){
            if($DB->query("update users_data_config set integrals='$integrals',prestige='$prestige',grow_integrals='$grow_integrals',vip='$vip',svip='$svip' where jobid='{$jobid}'"))
                echo '<script>SuccessSettingMessage();</script>';
            else
                echo '<script>FailedSettingMessage();</script>';
        }else{
            echo "<script language=\"JavaScript\">\r\n";
            echo " alert(\"积分范围最小值大于最大值或范围格式错误\");\r\n";
            echo "</script>";
            echo '<script>FailedSettingMessage();</script>';
        }
    }
}
else {
?>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">数据配置</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <?php
        $numrows = $DB->count("SELECT count(*) from users_data_config");
        echo '<div class="alert alert-info" style="margin-bottom: 0px;">系统共有' . $numrows . '条配置。</div>';
        ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>配置种类</th>
                    <th>积分【最小值|最大值】</th>
                    <th>威望</th>
                    <th>成长值</th>
                    <th>VIP成长加速（积分额外奖励/成长值加倍）</th>
                    <th>SVIP成长加速（积分额外奖励/成长值加倍）</th>
                    <th>操作</th>
                </tr>
                </thead>
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

                $rs = $DB->query("SELECT * FROM users_data_config WHERE 1 order by jobid desc limit $offset,$pagesize");
                while ($res = $DB->fetch($rs)) {
                    echo '<tr><td><b>' . $res['kind'] . '</b></td><td>' . $res['integrals'] . '</td><td>' . $res['prestige'] . '</td><td>' . $res['grow_integrals'] . '</td><td>' . $res['vip'] . '</td><td>' . $res['svip'] . '</td><td>' . '<a href="./users_data_config.php?my=edit&jobid=' . $res['jobid'] . '" class="btn btn-info btn-xs">编辑</a></td></tr>';
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
