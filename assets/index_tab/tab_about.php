<?php
//鉴权禁止直接访问
if ($_SERVER['PHP_SELF'] == '/assets/index_tab/tab_about.php'){
    exit("<script>window.location.href='../../'</script>");
}
?>
<?php include_once 'admin/version.php'?>
<table class="table table-hover" style="margin-bottom: 0px;">
    <tbody>
    <tr>
        <td>作者</td>
        <td>Owen</td>
    </tr>
    <tr>
        <td>联系方式</td>
        <td>QQ:544901005<br>phone:18116361893<br>Email:owen000814@outlook.com</td>
    </tr>
    <tr>
        <td>版权信息</td>
        <td>©️2001-2019 MEternity Inc.</td>
    </tr>
    <tr>
        <td>系统软件版本号</td>
        <td><?php echo $SystemVersion;?></td>
    </tr>
    <tr>
        <td>系统编译日期</td>
        <td><?php echo $SystemBuildTime;?></td>
    </tr>
    <tr>
        <td>Build版本号</td>
        <td><?php echo $SystemBuildName;?></td>
    </tr>
    <tr>
        <td>系统软件更新日期</td>
        <td><?php echo $SystemUpdateTime;?></td>
    </tr>
    <tr>
        <td>Api版本号</td>
        <td><?php echo $ApiVersion;?></td>
    </tr>
    </tbody>
</table>