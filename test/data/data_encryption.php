<?php
exit("<script>window.location.href='./'</script>");
include_once '../../includes/common.php';
Security::set_256_key("10000000000000000000000000000000");
echo Security::encrypt("test");