code -100 加解密秘钥异常 msg未加密
Aes私钥
Security::set_256_key("10000000000000000000000000000000");
echo Security::encrypt("test");
//使用前必须使用set方法
register.php
/*
注册账号获取
*/
？imei=xxxx
imei需要两次公钥加密
code -1：imei参数异常 msg一次公钥加密生成提示语
code -2：账号生成失败 msg一次公钥加密生成提示语
code 0：生成成功 account一次公钥加密生成账号