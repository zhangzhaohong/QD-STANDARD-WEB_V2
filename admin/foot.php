<?php
include_once '../includes/function.php';
if (checkmobile() == false){ ?>
    <ul style="min-width: 400px;list-style:none;margin-bottom: 0px;padding-left: 0px;padding-right: 0px;text-align: center">
        <li>Powered by <a href="https://data.meternity.cn/" target="_blank" style="color: grey;"><strong style="color: #0d0d0f">MEternity Data System</strong></a></li>
        <li style="text-align: center;margin-left: -5px">© 2011-2019 <a href="https://data.meternity.cn/" target="_blank" style="color: #0d0d0f;">MEternity</a> Inc.</li>
    </ul>
<?php }else{ ?>
    <ul style="list-style:none;margin-bottom: 0px;padding-left: 0px;padding-right: 0px;text-align: center">
        <li>Powered by <a href="https://data.meternity.cn/" target="_blank" style="color: grey;"><strong style="color: #0d0d0f">MEternity Data System</strong></a></li>
        <li style="text-align: center;margin-left: -5px">© 2011-2019 <a href="https://data.meternity.cn/" target="_blank" style="color: #0d0d0f;">MEternity</a> Inc.</li>
    </ul>
<?php } ?>