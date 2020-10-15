<?php
/**
 * 课程学生搜索
 **/
$title = '课程学生搜索';
$file = 'course_student_search';
include_once 'head.php';
?>
<link rel="stylesheet" href="../assets/css/setting_common.css">
<body>
<link href="../assets/zui_package/1.9.2/lib/datagrid/zui.datagrid.css" rel="stylesheet">
<script src="../assets/zui_package/1.9.2/lib/datagrid/zui.datagrid.js"></script>
<link href="../assets/zui_package/1.9.2/lib/datagrid/zui.datagrid.min.css" rel="stylesheet">
<script src="../assets/zui_package/1.9.2/lib/datagrid/zui.datagrid.min.js"></script>
<link rel="stylesheet" href="../assets/css/users_common.css">
<script src="../assets/js/setting_common.js"></script>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">课程学生搜索</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <form action="./course_student_manager.php" method="get" class="form-inline" role="form">
            <div class="col-sm-4">
                <div style="border: 1px solid #ddd; padding: 10px; margin: 10px;">
                    <label>课程名称:</label><br>
                    <select name="course_id_search">
                        <?php
                        $sql = "1";
                        $rs = $DB->query("SELECT * FROM course_data WHERE {$sql} order by jobid desc");
                        while ($res = $DB->fetch($rs)) {
                            if ($rs) {
                                echo '<option value="' . $res['jobid'] . '">' . $res['course_title'] . '</option>';
                            }
                        }
                        echo '</select>'
                        ?>
                </div>
            </div>
            <div style="margin: 10px 10px 20px;">
                <button class="btn btn-primary" type="submit" style="width: 100%">立即查询</button>
            </div>
        </form>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">学生加入课程搜索</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <form action="./course_student_manager.php" method="get" class="form-inline" role="form">
            <div class="col-sm-4">
                <div style="border: 1px solid #ddd; padding: 10px; margin: 10px;">
                    <div class="form-group">
                        <label>学生userId:</label><br>
                        <input type="text" class="form-control" name="user_id_search" value="" required>
                    </div>
                </div>
            </div>
            <div style="margin: 10px 10px 20px;">
                <button class="btn btn-primary" type="submit" style="width: 100%">立即查询</button>
            </div>
        </form>
    </div>
</div>
</body>