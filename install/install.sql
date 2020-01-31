/*
 Navicat Premium Data Transfer
 Source Server         : data
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:8889
 Source Schema         : data_meternity
 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001
 Date: 31/01/2020 14:49:18
*/
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
-- ----------------------------
-- Table structure for app_debug_manager
-- ----------------------------
DROP TABLE IF EXISTS `app_debug_manager`;
CREATE TABLE `app_debug_manager` (
                                     `jobid` int(11) NOT NULL AUTO_INCREMENT,
                                     `app_id` text,
                                     `app_debug_account` text,
                                     `app_debug_user_code` text,
                                     `app_debug_is_allowed` text,
                                     PRIMARY KEY (`jobid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of app_debug_manager
-- ----------------------------
BEGIN;
COMMIT;
-- ----------------------------
-- Table structure for app_infos
-- ----------------------------
DROP TABLE IF EXISTS `app_infos`;
CREATE TABLE `app_infos` (
                             `jobid` int(11) NOT NULL AUTO_INCREMENT,
                             `app_key` text,
                             `app_name` text,
                             `app_package_name` text,
                             `app_is_beta` text,
                             `app_is_apply_beta` text,
                             `app_is_debug` text,
                             `app_beta_available_date` datetime DEFAULT NULL,
                             `app_secret_key` text,
                             `app_debug_key` text,
                             `app_key_available_date` datetime DEFAULT NULL,
                             PRIMARY KEY (`jobid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of app_infos
-- ----------------------------
BEGIN;
COMMIT;
-- ----------------------------
-- Table structure for app_manager
-- ----------------------------
DROP TABLE IF EXISTS `app_manager`;
CREATE TABLE `app_manager` (
                               `jobid` int(11) NOT NULL AUTO_INCREMENT,
                               `app_id` text,
                               `app_type` text,
                               `kind` text,
                               `random_key` text,
                               `status` text,
                               PRIMARY KEY (`jobid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of app_manager
-- ----------------------------
BEGIN;
COMMIT;
-- ----------------------------
-- Table structure for app_notice_manager
-- ----------------------------
DROP TABLE IF EXISTS `app_notice_manager`;
CREATE TABLE `app_notice_manager` (
                                      `jobid` int(11) NOT NULL AUTO_INCREMENT,
                                      `app_id` text,
                                      `app_type` text,
                                      `app_low_version` text,
                                      `app_top_version` text,
                                      `status` text,
                                      `random_key` text,
                                      `random_key_app` text,
                                      PRIMARY KEY (`jobid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of app_notice_manager
-- ----------------------------
BEGIN;
COMMIT;
-- ----------------------------
-- Table structure for app_update_manager
-- ----------------------------
DROP TABLE IF EXISTS `app_update_manager`;
CREATE TABLE `app_update_manager` (
                                      `jobid` int(11) NOT NULL AUTO_INCREMENT,
                                      `app_id` text,
                                      `app_type` text,
                                      `app_low_version` text,
                                      `app_top_version` text,
                                      `status` text,
                                      `random_key` text,
                                      `random_key_app` text,
                                      PRIMARY KEY (`jobid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of app_update_manager
-- ----------------------------
BEGIN;
COMMIT;
-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
                          `k` varchar(32) NOT NULL,
                          `v` text,
                          PRIMARY KEY (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of config
-- ----------------------------
BEGIN;
INSERT INTO `config` VALUES ('admin_pwd', 'h0ngOOO814');
INSERT INTO `config` VALUES ('admin_user', 'zhangzhaohong');
INSERT INTO `config` VALUES ('announce', '');
INSERT INTO `config` VALUES ('bottom', '');
INSERT INTO `config` VALUES ('cache', '');
INSERT INTO `config` VALUES ('cipher_key_128', '');
INSERT INTO `config` VALUES ('cipher_key_256', '');
INSERT INTO `config` VALUES ('description', 'DC自助授权系统');
INSERT INTO `config` VALUES ('keywords', 'DC自助授权系统');
INSERT INTO `config` VALUES ('kfqq', '544901005');
INSERT INTO `config` VALUES ('mail_debug', '0');
INSERT INTO `config` VALUES ('mail_password', '');
INSERT INTO `config` VALUES ('mail_port', '465');
INSERT INTO `config` VALUES ('mail_smtp', 'smtp.qq.com');
INSERT INTO `config` VALUES ('mail_username', '');
INSERT INTO `config` VALUES ('notice', '');
INSERT INTO `config` VALUES ('qq_jump', '0');
INSERT INTO `config` VALUES ('service_Status', '0');
INSERT INTO `config` VALUES ('sitename', 'DC自助授权系统');
INSERT INTO `config` VALUES ('version', '100');
COMMIT;
-- ----------------------------
-- Table structure for notice_manager
-- ----------------------------
DROP TABLE IF EXISTS `notice_manager`;
CREATE TABLE `notice_manager` (
                                  `jobid` int(11) NOT NULL AUTO_INCREMENT,
                                  `random_key` text,
                                  `app_id` text,
                                  `app_type` text,
                                  `app_notice_version` text,
                                  `app_notice_content` text,
                                  `app_notice_available_date` text,
                                  `status` text,
                                  PRIMARY KEY (`jobid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of notice_manager
-- ----------------------------
BEGIN;
COMMIT;
-- ----------------------------
-- Table structure for qiu_cjs
-- ----------------------------
DROP TABLE IF EXISTS `qiu_cjs`;
CREATE TABLE `qiu_cjs` (
                           `jobid` int(11) NOT NULL AUTO_INCREMENT,
                           `id` bigint(11) NOT NULL,
                           `addtime` date DEFAULT NULL,
                           `lasttime` date DEFAULT NULL,
                           `endtime` date DEFAULT NULL,
                           `app_jobid` text,
                           `app_type` text,
                           PRIMARY KEY (`jobid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of qiu_cjs
-- ----------------------------
BEGIN;
COMMIT;
-- ----------------------------
-- Table structure for qiu_kms
-- ----------------------------
DROP TABLE IF EXISTS `qiu_kms`;
CREATE TABLE `qiu_kms` (
                           `id` int(11) NOT NULL AUTO_INCREMENT,
                           `kind` tinyint(1) NOT NULL DEFAULT '1',
                           `km` varchar(64) DEFAULT NULL,
                           `value` int(11) NOT NULL DEFAULT '0',
                           `isuse` tinyint(1) DEFAULT '0',
                           `user` varchar(50) DEFAULT NULL,
                           `usetime` datetime DEFAULT NULL,
                           `addtime` datetime DEFAULT NULL,
                           `app_type` text,
                           PRIMARY KEY (`id`),
                           KEY `km` (`km`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of qiu_kms
-- ----------------------------
BEGIN;
COMMIT;
-- ----------------------------
-- Table structure for register_manager
-- ----------------------------
DROP TABLE IF EXISTS `register_manager`;
CREATE TABLE `register_manager` (
                                    `imei` text NOT NULL,
                                    `times` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of register_manager
-- ----------------------------
BEGIN;
COMMIT;
-- ----------------------------
-- Table structure for update_manager
-- ----------------------------
DROP TABLE IF EXISTS `update_manager`;
CREATE TABLE `update_manager` (
                                  `jobid` int(11) NOT NULL AUTO_INCREMENT,
                                  `random_key` text,
                                  `app_id` text,
                                  `app_type` text,
                                  `app_build` text,
                                  `app_version` text,
                                  `app_software_version` text,
                                  `app_code` text,
                                  `app_update_content` text,
                                  `app_update_url` text,
                                  `app_update_code` text,
                                  `app_update_available_date` text,
                                  `app_is_must_update` text,
                                  `status` text,
                                  PRIMARY KEY (`jobid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of update_manager
-- ----------------------------
BEGIN;
COMMIT;
-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `jobid` int(11) NOT NULL AUTO_INCREMENT,
                         `account` text,
                         `password` text,
                         `private_name` text,
                         `user_birthday` text,
                         `user_email` text,
                         `user_key` text,
                         `user_level` text,
                         `log_level` text,
                         `user_available_date` text,
                         `user_status` text,
                         PRIMARY KEY (`jobid`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, '10000001', 'h0ngOOO814', 'zzh', '1990-08-14', '544901005@qq.com', 'hWCgdnVwyPPjUVyCnOhad6QRkL4x/gYpjX8wgEUByvU=', '1', '5', '2019-12-02', '0');
INSERT INTO `users` VALUES (2, '10000002', '.4247464', '666', '2000-01-20', '1911085102@qq.com', 'l0fQwpq91JvExpfTvIHYH2EU4FXnD3xGBW9NkD0DVJ4=', '0', '0', '2020-01-07', '0');
INSERT INTO `users` VALUES (3, '10000003', 'zpy082323', '天启', '2000-01-14', '2391624941@qq.com', 'KJgFkSJJ2WJwroFzLihQczB6Jy4wS7f+h8T95oQG8Cw=', '0', '0', '2018-09-23', '0');
INSERT INTO `users` VALUES (4, '10000004', 'lu7875', 'ww', '2000-01-01', '2332283750@qq.com', 'QdGTs8FdrRB5O2rdbQjxFcSrgZgLqD5CCjEhCzant/I=', '0', '0', '2018-09-28', '0');
INSERT INTO `users` VALUES (5, '10000005', 'owen64752867', 'owen', '2000-08-14', '544910005@qq.com', '9kUQgyosMcj1TB5juW2q36QRkL4x/gYpjX8wgEUByvU=', '0', '0', '2019-12-06', '0');
INSERT INTO `users` VALUES (6, '10000006', '123456789', 'Adam', '2001-10-10', '1010117430@qq.com', '0bteWij8VR9O0+FYcZUrsh82Hf8x0xMsFiyUj81pQYA=', '0', '0', '2018-09-28', '0');
INSERT INTO `users` VALUES (7, '10000007', '12345678', 'ffggg', '2000-01-20', '1879541824@qq.com', 'M+goPtVVZSTZwcLiA4ipfmsUez8hUILqpxm64QRwRHusMXy9vZ+VlmB8zSO/0Paz', '0', '0', '2019-04-30', '0');
INSERT INTO `users` VALUES (8, '10000008', '5201314', '1139665532', '2000-01-14', '1139665532@qq.com', 'tvCKbn0bdc6mKYeEmzNw+zVsVHlrzpOKwW2zLow8wHY=', '0', '0', '2018-10-03', '0');
INSERT INTO `users` VALUES (9, '10000009', '5201314', '玖梦大神', '2000-01-01', '2583001642@qq.com', 'vbNZS+6ZaKwvZW0RJAeF9rwOEdZVqKt/57AR9nJlhk4=', '0', '0', '2018-10-07', '0');
INSERT INTO `users` VALUES (10, '10000010', 'DuHuang0', '毒皇', '2000-01-01', '2487686673@qq.com', 'M+5+0jrl4JOslY4fsKaSaWfALEP1ZKuXyCkETDg4RBI=', '0', '0', '2019-04-30', '0');
INSERT INTO `users` VALUES (11, '10000011', '123456', '急急急', '2000-01-01', '201380599@qq.com', 'yviy0J9J5WHdpIxUOOcTKWc3lzkND0amarAo30dvOrY=', '0', '0', '2018-10-07', '0');
INSERT INTO `users` VALUES (12, '10000012', '258036', '苏柒', '2000-01-01', '3083161652@qq.com', 'tQSxsA2hH/6oX84IYCGSWTZprNogExa1PxrWn8Qy38s=', '0', '0', '2018-10-07', '0');
INSERT INTO `users` VALUES (13, '10000013', '2433', '方丈', '2000-01-01', '2516669369@qq.com', '3sXQCoGo7Ras1Q/3EjC/k+H2Ivk4HEVrMpWo1eQOVB8=', '0', '0', '2018-10-07', '0');
INSERT INTO `users` VALUES (14, '10000014', '2433', 'aaa', '2000-01-01', '2433@qq.com', 'fxHhyxtAbzJ3XGNnXo9pM+H2Ivk4HEVrMpWo1eQOVB8=', '0', '0', '2018-10-07', '0');
INSERT INTO `users` VALUES (15, '10000015', '2433', '326', '2000-01-01', '555@qq.com', 'qp37xiVPJu0jQcDfeaG2w+H2Ivk4HEVrMpWo1eQOVB8=', '0', '0', '2018-10-07', '0');
INSERT INTO `users` VALUES (16, '10000016', '024680', 'heh', '2000-01-01', '2931212318@qq.com', 'uHi7My2eHdozYzF0Qe0GgYoVbTVtqRrTHXxSmwXuJgM=', '0', '0', '2018-10-07', '0');
INSERT INTO `users` VALUES (17, '10000017', 'L2631463345', '星毅', '2000-01-01', '2631463345@qq.com', 'LDsgt+iGtFSMXagqjyddYQXymif0yIqr/nCHvxAvDk8=', '0', '0', '2018-10-07', '0');
INSERT INTO `users` VALUES (18, '10000018', '1002182324', '，？', '2000-01-01', '1002182327@qq.com', 'YT1zK3Mm0wirb2M8W4i8oBaBGWcLKREZQqHdGQH2qvM=', '0', '0', '2018-10-07', '0');
INSERT INTO `users` VALUES (19, '10000019', '123456', '而是没什么', '2000-01-01', '501026200@qq.com', '6F4qCyFOnX72Hlau4DUz1Gc3lzkND0amarAo30dvOrY=', '0', '0', '2018-10-13', '0');
INSERT INTO `users` VALUES (20, '10000020', 'zm666.666', '墨逸', '2000-01-01', '2172307677@qq.com', 'Onz9a+aRK2ROuqM2dDf3FL1Q/OquOhg7SXqRaCaRg4c=', '0', '0', '2018-10-16', '0');
INSERT INTO `users` VALUES (21, '10000021', '0922zx', 'ChainPlay', '1992-09-22', '570663228@qq.com', 'mI78EXI3wRfDbh3peklaAbSUwZM+Yjav/+uSNfvWufo=', '0', '0', '2018-10-16', '0');
INSERT INTO `users` VALUES (22, '10000022', 'Ada13686833124', 'Ada荣耀', '1998-01-04', '18406656334@163.com', 'RxcQf5t2fuNRV52jzjKnRzFrqSy6n/FAMMajvyvjl9k=', '0', '0', '2019-08-25', '0');
INSERT INTO `users` VALUES (23, '10000023', '1234567890', 'test', '2000-01-01', '1234567890@xxx.com', 'kEsImF03nZ5tBWYV6nAO3eKtFhM1dbTcExMzQzSNrE8=', '0', '0', '2018-10-17', '0');
INSERT INTO `users` VALUES (24, '10000024', 'h0ngOOO814', 'owen_test', '2000-08-14', 'owen0008114@outlook.com', 'y71oCdKhHmt6M7YaqSAvoqQRkL4x/gYpjX8wgEUByvU=', '0', '0', '2019-04-03', '0');
INSERT INTO `users` VALUES (25, '10000025', '64752867', 'test_03', '2000-08-14', 'honghong000814@126.com', 'mf/6cOZKWQgUPOKe1rnL8aQRkL4x/gYpjX8wgEUByvU=', '0', '0', '2019-10-17', '0');
INSERT INTO `users` VALUES (26, '10000026', 'fanyuanfang521', '风籽', '2000-01-01', '2315771411@qq.com', 'vTyl3I+oDShM9m75r6Z7lr7eKbQ2U/KTkTvNU4scXI6sMXy9vZ+VlmB8zSO/0Paz', '0', '0', '2018-10-26', '0');
INSERT INTO `users` VALUES (27, '10000027', 'xsk54088', '老乌龟', '2000-01-01', '2318878380@vip.qq.com', '8tYn0FQdn9WQIku928qKE/YRZl5LGEsL6XrKB9rQNoI=', '0', '0', '2018-11-09', '0');
INSERT INTO `users` VALUES (28, '10000028', 'xsk54088', '老污比', '2000-01-01', '2318878380@qq.com', 'imUQ4s0d3enyTkyQ9z3/avYRZl5LGEsL6XrKB9rQNoI=', '0', '0', '2018-11-09', '0');
INSERT INTO `users` VALUES (29, '10000029', 'GYJ123456789', '此生未做完的梦', '2001-08-16', '1589206218@qq.com', 'YlbVwLOSrUaG1rSPKPtio943A0BQm71Lc2bT+cqNjsU=', '0', '0', '2018-11-10', '0');
INSERT INTO `users` VALUES (30, '10000030', '64752867', 'test', '2000-01-01', 'honghong000814@163.com', '5do36l9RDIV6Siu0oi0VpZqPbBHvU7n8TjYj+o+tI8A=', '0', '0', '2018-11-10', '0');
INSERT INTO `users` VALUES (31, '10000031', '123456', '123456', '2000-01-01', '10@qq.com', 'T/P2jMacoH/MUqnAF97Xfmc3lzkND0amarAo30dvOrY=', '0', '0', '2018-12-02', '0');
INSERT INTO `users` VALUES (32, '10000032', 'zhangjing', '静', '1965-02-16', 'lfb_zhang@126.com', 'VkTNC0+AIhjJLu8IrUgmXkgrVcdmFjviwYG99Llz8Cw=', '0', '0', '2019-12-03', '0');
INSERT INTO `users` VALUES (33, '10000033', 'FFHW123@@@', '缘', '2000-01-01', 'gxqbkf@foxmail.com', 'kLlyzI6PE9Z1UPSgA+RDYF4fgRO5p94oXlqIhRUr6js=', '0', '0', '2018-12-28', '0');
INSERT INTO `users` VALUES (34, '10000034', '64752867', 'owen816', '2000-01-01', '2152441872@qq.com', 'kJhWOsCqdQCfJQeCvgzwXZqPbBHvU7n8TjYj+o+tI8A=', '0', '0', '2019-01-01', '0');
INSERT INTO `users` VALUES (35, '10000035', 'a10000035', 'tnc', '2000-01-01', '18930859485@189.cn', 'SLDL4PiVNTje90OA7i3/aJRQbL1sgD/MRs730YNVeEA=', '0', '0', '2019-01-01', '0');
INSERT INTO `users` VALUES (36, '10000036', 'zm666.666', '墨逸', '2000-01-01', '180693659@qq.com', '+sB0D4jhNEbf6uYskKmbu71Q/OquOhg7SXqRaCaRg4c=', '0', '0', '2019-01-01', '0');
INSERT INTO `users` VALUES (37, '10000037', 'xiaobin19910501', '小宾', '1991-05-01', '542015332@qq.com', '9BintD3EPGS8cwTcDgVEk0kMz3O9B+8KFLtuvNhK728=', '0', '0', '2019-11-26', '0');
INSERT INTO `users` VALUES (38, '10000038', 'xiaobin19910501', '罗小宾', '1991-05-01', '2545703109@qq.com', 'HFtShPD+vI09oBoaG68rI0kMz3O9B+8KFLtuvNhK728=', '0', '0', '2019-11-26', '0');
INSERT INTO `users` VALUES (39, '10000039', '64752867', 'zhang103', '2000-01-01', '3367400146@qq.com', 'rDeAwj4OtFrP/ZBme997lJqPbBHvU7n8TjYj+o+tI8A=', '0', '0', '2019-01-03', '0');
INSERT INTO `users` VALUES (40, '10000040', '64752867', 'zhang104', '2000-01-01', 'home_family@126.com', 'fAkUzXff+TVopZ/I99eDp5qPbBHvU7n8TjYj+o+tI8A=', '0', '0', '2019-01-03', '0');
INSERT INTO `users` VALUES (41, '10000041', '64752867', 'test_106', '2000-01-01', '2113536811@qq.com', 'RsQShwsrkfODr+s2Ao7JwJqPbBHvU7n8TjYj+o+tI8A=', '0', '0', '2019-01-06', '0');
INSERT INTO `users` VALUES (42, '10000042', 'PLE082323', '天启', '2000-01-01', '758864998@qq.com', 'JgMzzrfO2P+WHGf8agec0Gtuexq3Br2k+Nzn5r82Ry8=', '1', '0', '2019-11-26', '0');
INSERT INTO `users` VALUES (43, '10000043', '12345', '那里看', '2000-01-01', '5665@qq.com', 'skj9uObuh//CVUSOHuI3io+p0dvHpyyibe2IYWgta7U=', '0', '0', '2019-02-07', '0');
INSERT INTO `users` VALUES (44, '10000044', '111', '哈哈哈', '2000-01-01', 'h@qq.com', 'jCku1TsXnPTyDLktbCAD7cOrxY11SQE8CjoooOdx0VU=', '0', '0', '2019-02-28', '0');
INSERT INTO `users` VALUES (45, '10000045', '258036+++', '酥皮', '2000-01-01', '15768738540@163.com', 'qLaZr/0PCZBQB097kl51QTZprNogExa1PxrWn8Qy38s=', '0', '0', '2019-11-24', '0');
INSERT INTO `users` VALUES (46, '10000046', 'qazwsx123', 'qaz', '1986-01-01', '106939382@qq.com', 'Xneib341skCTvSbe72xukjNxq8s6WY/T1jQO/A66Sqg=', '0', '0', '2019-04-30', '0');
INSERT INTO `users` VALUES (47, '10000047', 'GYJ123456789', 'Scave', '2001-08-16', '647013414@qq.com', 'QRiSVGVCJJK93ztRAeTO1d43A0BQm71Lc2bT+cqNjsU=', '0', '0', '2019-04-30', '0');
INSERT INTO `users` VALUES (48, '10000048', 'yangling', 'YL10032', '2000-03-14', '3428918327@qq.com', 'xHwAE6U1iPnTbYzRrWBguLCqD1Y98XZLGu8tI1iiWv0=', '0', '0', '2019-04-30', '0');
INSERT INTO `users` VALUES (49, '10000049', 'gzm123456', '雨点', '1993-10-13', '18292717252@163.com', '5Td0AayeWFcKYWmQ4tlnFUEsfPkk12OYKHrgCOyGVrI=', '0', '0', '2019-04-30', '0');
INSERT INTO `users` VALUES (50, '10000050', 'qweqwea', '熊猫', '2000-01-01', '491782852@qq.com', '0mZ9ViG/FDk0IxqJoegmM1si7qi3SU1dUpY1ILlzOAU=', '0', '0', '2019-04-30', '0');
INSERT INTO `users` VALUES (51, '10000051', 'yangling', 'YL10032', '2000-05-12', '2476345317@qq.com', 'x3T99cLp9qhnLJcZtv4FFFX9Mz0gSiZ1nEjVBxNXiTU=', '0', '0', '2019-05-01', '0');
INSERT INTO `users` VALUES (52, '10000052', 'r0203030', 'zzh', '1995-11-01', '1280918110@qq.com', 'WHn4y+A1C/yqPqV3NTTlXRvzlAgdYCBkZTgd+wzsIaI=', '0', '0', '2019-06-18', '0');
INSERT INTO `users` VALUES (53, '10000053', 'xw19990805', '熊伟', '1999-08-05', '1299056790@qq.com', 'B5lRHCyFBDP4VmbH6KxHEWRYahm8IjQqF6KiRi9uKas=', '2', '0', '2019-10-11', '0');
INSERT INTO `users` VALUES (54, '10000054', 'qd1234567', '代码修复后勤', '2000-01-01', '1969997867@qq.com', 'MgA5vyr03HprE1pxYVhIaREKc5qexjWNktTmiNRpd7k=', '0', '0', '2019-10-11', '0');
INSERT INTO `users` VALUES (55, '10000055', '12345678', 'QAQ', '2000-01-01', 'mrdong916@163.com', 'um1FpO4KHo6sadwr6LgUHmc3lzkND0amarAo30dvOrY=', '0', '0', '2019-11-25', '0');
INSERT INTO `users` VALUES (56, '10000056', 'g123456', '慕容', '2019-05-20', '328355277@qq.com', 'd+NcZkybwcoKHGrJ6/cSJ//1KUL2ttax5iixyitzb+o=', '0', '0', '2019-08-21', '0');
INSERT INTO `users` VALUES (57, '10000057', 'QD123QD', '版本', '2000-01-01', 'gbnnnnn@foxmail.com', 'RsjnHDr+lf/7tHzNQb5GHzT/yrNjc8ExxuKxSVmVUgc=', '0', '0', '2019-11-22', '0');
INSERT INTO `users` VALUES (58, '10000058', '123456', '蛋蛋无光', '2000-01-01', '1833555@qq.com', 'Kxh6MrDIBCfsWhGodZr9/Wc3lzkND0amarAo30dvOrY=', '0', '0', '2019-08-21', '0');
INSERT INTO `users` VALUES (59, '10000059', 'qwertyuiop', '小杰', '2000-01-31', '372884832@qq.com', 'lC7a1nBm9kyUodXAivcCqfOEeDRetWIxJAZz2Moc5bM=', '2', '0', '2019-11-23', '0');
INSERT INTO `users` VALUES (60, '10000060', 'jidian0v0', '0v0', '2000-02-19', '1159854998@qq.com', '7v0F9bbSUgvfVD8Q2opuH1vhqhZxl1I5Ag2rsM370lU=', '0', '0', '2019-08-22', '0');
INSERT INTO `users` VALUES (61, '10000061', 'asd12345.', '小雨点', '1977-01-01', '646219385@qq.com', '3MSXBXMZRHgkT/siRLElm8K+05c5ZlzLX75KHG2dBuI=', '0', '0', '2020-01-12', '0');
INSERT INTO `users` VALUES (62, '10000062', 'qd199121', '小葵', '1999-12-12', '18017202346@163.com', '3qQPdMXCIo9Paiz1P6cgix9KFLM/WSW4iV3Ooy0tgCI=', '0', '0', '2020-01-07', '0');
INSERT INTO `users` VALUES (63, '10000063', 'Gsj980804', 'cherish', '1998-08-04', '731765632@qq.com', 'vPdYDApfyZK/IsHfaNvReWgBGQplVAwZC9dUR6PfVbo=', '0', '0', '2020-01-11', '0');
INSERT INTO `users` VALUES (64, '10000064', 'goodluck', '云水禅心', '1982-03-02', '964602606@qq.com', 'hyXHsnfbUK0ZdLfje6LrUHvAWlGBm1bSVCo8GZDejJ0=', '0', '0', '2019-10-11', '0');
INSERT INTO `users` VALUES (65, '10000065', 'lg1230', '文心', '1989-04-28', '1226168778@qq.com', 'CDhfH7ubRDMtUgEMgG42cArxX2GA5MJ238FV2hEDZDw=', '0', '0', '2019-10-11', '0');
INSERT INTO `users` VALUES (66, '10000066', 'Czy13313396255', '寒枫', '1995-12-07', '598013955@qq.com', 'JhaBqS8w+YwSZQG1B0+2U07HIc78XcbJ9CjfNAzE/4SsMXy9vZ+VlmB8zSO/0Paz', '0', '0', '2019-10-11', '0');
INSERT INTO `users` VALUES (67, '10000067', 'Saber990809', 'Torta', '1999-08-09', 'saber990809@gmail.com', 'zSM53RIIaikPo2OjdUTkPgzmpMckTJ01j2Xnm3hx+sE=', '0', '0', '2019-10-11', '0');
INSERT INTO `users` VALUES (68, '10000068', '1234554321', '在轮回里游荡', '2000-07-24', 'tangjiawen158@foxmail.com', '/WVp9i2dZozwhWms3HwLBZrYuxZCkUFBSlsOzacFbMI=', '0', '0', '2019-10-11', '0');
INSERT INTO `users` VALUES (69, '10000069', 'lamborghini7504', 'Hennessy', '2000-01-11', '1582012491@qq.com', '8dOV+E9WkPtiVMP7ARZWQm4pYqfX/w5Q0eE5QnzWmilh53rkft7C6W4i1VBOBF6Y', '0', '0', '2019-10-11', '0');
INSERT INTO `users` VALUES (70, '10000070', '103520070810', '懿行', '2000-10-20', '1772760486@qq.com', 'K2TaS8uIVC5UmZCFykLquvVU2b+uCmRFuNrZ/EhmT5w=', '0', '0', '2019-10-11', '0');
INSERT INTO `users` VALUES (71, '10000071', '13663608819', '港岛妹夫', '2000-05-16', '1511506452@qq.com', 'z4fIqJWoNnAa1tTxhLUE8Rm6ek0oPcrE93lFLgXTXFU=', '0', '0', '2019-10-11', '0');
INSERT INTO `users` VALUES (72, '10000072', '998899', 'singya', '2000-01-01', 'admin@nbgames.net', '4dzxdQdgC2R46v39m78uNtLjiFKRSk2J+Qbc7qzHePc=', '0', '0', '2019-10-11', '0');
INSERT INTO `users` VALUES (73, '10000073', 'kongwy0229', 'skr wu', '2000-03-01', '1549715218@qq.com', 'dOos4dxHEEO2qDj/bf4HQe0wHjVBMpFNp8c7oiBvda4=', '0', '0', '2020-01-12', '0');
INSERT INTO `users` VALUES (74, '10000074', '123456..', '九邪', '2000-01-01', '85437589@qq.com', 'sYrLVpffIUfl+X8z/LHa6/n5vcb7qWjlzeWWp1v5IU4=', '0', '0', '2019-10-12', '0');
INSERT INTO `users` VALUES (75, '10000075', 'Fightwith1128', '哈哈哈哈哈哈哈哈哈', '2000-07-31', '1372718761@qq.com', '8L8ngQAqxLYrfqnY7ZnE8PRX5qUKTAVK1e2Lti3icpU=', '0', '0', '2019-10-12', '0');
INSERT INTO `users` VALUES (76, '10000076', '19991001zys', '江停', '1999-10-01', '921413855@qq.com', 'JLTMTjfJy5lKZd60WtGhUaE1pt2iBRkhMEodzygVdvU=', '0', '0', '2019-10-17', '0');
INSERT INTO `users` VALUES (77, '10000077', 'wzhwzh001', '末末一', '2001-08-09', '2198497673@qq.com', 'dqGoZqclTBUeY7G9TdQp1U/pOAsHQ8qviv5IctAflHQ=', '0', '0', '2019-10-26', '0');
INSERT INTO `users` VALUES (78, '10000078', 'mwj061499', '马大大大仙', '1999-06-14', '1479210581@qq.com', 'vxzfWH+3tsXa6pDELLJdOc8cljg7jtsSpaNlFrf4HiU=', '0', '0', '2019-11-23', '0');
INSERT INTO `users` VALUES (79, '10000079', '123456', '御马', '1973-04-01', '710885282@qq.com', 'OlNFflA0T8fu3NPz7RStCWc3lzkND0amarAo30dvOrY=', '0', '0', '2019-11-24', '0');
INSERT INTO `users` VALUES (80, '10000080', '123456789', '123456', '1995-04-24', '1550886060@qq.com', 'Qc2dBLxs+BMhxY+eMF3J9ZtE+pOuAaokhWQY1JokG9w=', '0', '0', '2019-11-25', '0');
INSERT INTO `users` VALUES (81, '10000081', 'g123456789', '慕容', '2000-01-01', '123456789@163.com', 'IipdCCHmdt0ymKqIFtVZzGYKstGg2vCUBAcLs/J85uM=', '0', '0', '2019-11-25', '0');
INSERT INTO `users` VALUES (82, '10000082', 'qwertyuiop', 'Bigbug', '1996-05-22', '3358850014@qq.com', 'LcFehcGNChejQOF328lqt/20HAGuopt7PJwwmo2SE/Q=', '0', '0', '2019-11-25', '0');
INSERT INTO `users` VALUES (83, '10000083', 'ljc123456', '黑色星期天', '2000-01-01', '398902840@qq.com', 'QMv8WHzKXwZPRKgcDhapsnlDk2qPvzPrZ+dLEV/f9VI=', '0', '0', '2019-11-25', '0');
INSERT INTO `users` VALUES (84, '10000084', '455655069', '简', '1998-09-04', '455655069@qq.com', 'OBEJPWKAwmZ5JZ+ckSl1HCQYsHjVOa8TLdQFF4yV5lw=', '0', '0', '2019-11-25', '0');
INSERT INTO `users` VALUES (85, '10000085', '19980910', '  ', '1997-09-01', '17751052364@qq.com', 'g0BhiJNPlBNimEVms1BJW2MORv1TEaem76t5KS2+sgY=', '0', '0', '2019-11-26', '0');
INSERT INTO `users` VALUES (86, '10000086', 'yzf512238', '一二三四五', '1991-08-24', '809626280@qq.com', 'brVT7vJ34Op1w1bv2kTVSS49mqg+KhJC/vNtp/CcBjw=', '0', '0', '2019-11-26', '0');
INSERT INTO `users` VALUES (87, '10000087', 'QAZ0720', '哈哈', '2000-01-01', '815341236@qq.com', 'hSWTFH+0R7hj4ZQz3TV5h5VBLSHoHK9qdrT/nfEHFEw=', '0', '0', '2019-11-26', '0');
COMMIT;
-- ----------------------------
-- Table structure for users_data
-- ----------------------------
DROP TABLE IF EXISTS `users_data`;
CREATE TABLE `users_data` (
                              `jobid` int(11) NOT NULL AUTO_INCREMENT,
                              `account` text,
                              `user_key` text,
                              `integrals` int(11) DEFAULT '0',
                              `prestige` int(11) DEFAULT '0',
                              `grow_integrals` int(11) DEFAULT '0',
                              `last_login` date NOT NULL,
                              `last_sign` date NOT NULL,
                              `keep_sign_times` int(11) DEFAULT '0',
                              PRIMARY KEY (`jobid`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of users_data
-- ----------------------------
BEGIN;
INSERT INTO `users_data` VALUES (1, '10000001', 'hWCgdnVwyPPjUVyCnOhad6QRkL4x/gYpjX8wgEUByvU=', 6483, 3230, 15298, '2019-10-12', '2019-10-11', 0);
INSERT INTO `users_data` VALUES (2, '10000002', 'l0fQwpq91JvExpfTvIHYH2EU4FXnD3xGBW9NkD0DVJ4=', 746, 213, 279, '2019-10-12', '2019-08-18', 0);
INSERT INTO `users_data` VALUES (3, '10000003', 'KJgFkSJJ2WJwroFzLihQczB6Jy4wS7f+h8T95oQG8Cw=', 31, 11, 13, '2018-08-10', '2018-08-10', 0);
INSERT INTO `users_data` VALUES (4, '10000004', 'QdGTs8FdrRB5O2rdbQjxFcSrgZgLqD5CCjEhCzant/I=', 8, 2, 1, '2018-06-28', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (5, '10000005', '9kUQgyosMcj1TB5juW2q36QRkL4x/gYpjX8wgEUByvU=', 1831, 459, 670, '2019-09-06', '2019-07-10', 1);
INSERT INTO `users_data` VALUES (6, '10000006', '0bteWij8VR9O0+FYcZUrsh82Hf8x0xMsFiyUj81pQYA=', 4, 2, 1, '2018-06-28', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (7, '10000007', 'M+goPtVVZSTZwcLiA4ipfmsUez8hUILqpxm64QRwRHusMXy9vZ+VlmB8zSO/0Paz', 28, 5, 5, '2019-01-30', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (8, '10000008', 'tvCKbn0bdc6mKYeEmzNw+zVsVHlrzpOKwW2zLow8wHY=', 39, 408, 8, '2018-07-06', '2018-07-06', 0);
INSERT INTO `users_data` VALUES (9, '10000009', 'vbNZS+6ZaKwvZW0RJAeF9rwOEdZVqKt/57AR9nJlhk4=', 402, 84, 176, '2018-09-15', '2018-09-15', 0);
INSERT INTO `users_data` VALUES (10, '10000010', 'M+5+0jrl4JOslY4fsKaSaWfALEP1ZKuXyCkETDg4RBI=', 47, 17, 21, '2019-01-30', '2018-09-02', 0);
INSERT INTO `users_data` VALUES (11, '10000011', 'yviy0J9J5WHdpIxUOOcTKWc3lzkND0amarAo30dvOrY=', 5, 2, 1, '2018-07-07', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (12, '10000012', 'tQSxsA2hH/6oX84IYCGSWTZprNogExa1PxrWn8Qy38s=', 14, 4, 4, '2018-07-07', '2018-07-07', 0);
INSERT INTO `users_data` VALUES (13, '10000013', '3sXQCoGo7Ras1Q/3EjC/k+H2Ivk4HEVrMpWo1eQOVB8=', 0, 0, 0, '0000-00-00', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (14, '10000014', 'fxHhyxtAbzJ3XGNnXo9pM+H2Ivk4HEVrMpWo1eQOVB8=', 0, 0, 0, '0000-00-00', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (15, '10000015', 'qp37xiVPJu0jQcDfeaG2w+H2Ivk4HEVrMpWo1eQOVB8=', 28, 6, 5, '2018-07-10', '2018-07-07', 0);
INSERT INTO `users_data` VALUES (16, '10000016', 'uHi7My2eHdozYzF0Qe0GgYoVbTVtqRrTHXxSmwXuJgM=', 12, 4, 4, '2018-07-07', '2018-07-07', 0);
INSERT INTO `users_data` VALUES (17, '10000017', 'LDsgt+iGtFSMXagqjyddYQXymif0yIqr/nCHvxAvDk8=', 10, 2, 1, '2018-07-07', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (18, '10000018', 'YT1zK3Mm0wirb2M8W4i8oBaBGWcLKREZQqHdGQH2qvM=', 3, 2, 1, '2018-07-07', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (26, '10000026', 'vTyl3I+oDShM9m75r6Z7lr7eKbQ2U/KTkTvNU4scXI6sMXy9vZ+VlmB8zSO/0Paz', 31, 9, 12, '2018-07-26', '2018-07-26', 0);
INSERT INTO `users_data` VALUES (19, '10000019', '6F4qCyFOnX72Hlau4DUz1Gc3lzkND0amarAo30dvOrY=', 136, 32, 33, '2018-07-21', '2018-07-21', 1);
INSERT INTO `users_data` VALUES (20, '10000020', 'Onz9a+aRK2ROuqM2dDf3FL1Q/OquOhg7SXqRaCaRg4c=', 7, 2, 1, '2018-07-16', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (21, '10000021', 'mI78EXI3wRfDbh3peklaAbSUwZM+Yjav/+uSNfvWufo=', 18, 4, 4, '2018-07-16', '2018-07-16', 0);
INSERT INTO `users_data` VALUES (22, '10000022', 'RxcQf5t2fuNRV52jzjKnRzFrqSy6n/FAMMajvyvjl9k=', 188, 41, 53, '2019-07-07', '2018-07-20', 0);
INSERT INTO `users_data` VALUES (23, '10000023', 'kEsImF03nZ5tBWYV6nAO3eKtFhM1dbTcExMzQzSNrE8=', 31, 7, 8, '2018-10-06', '2018-07-17', 0);
INSERT INTO `users_data` VALUES (24, '10000024', 'y71oCdKhHmt6M7YaqSAvoqQRkL4x/gYpjX8wgEUByvU=', 245, 78, 104, '2019-02-23', '2019-02-22', 1);
INSERT INTO `users_data` VALUES (25, '10000025', 'mf/6cOZKWQgUPOKe1rnL8aQRkL4x/gYpjX8wgEUByvU=', 145, 45, 60, '2019-07-17', '2019-07-17', 0);
INSERT INTO `users_data` VALUES (27, '10000027', '8tYn0FQdn9WQIku928qKE/YRZl5LGEsL6XrKB9rQNoI=', 0, 0, 0, '0000-00-00', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (28, '10000028', 'imUQ4s0d3enyTkyQ9z3/avYRZl5LGEsL6XrKB9rQNoI=', 30, 9, 12, '2018-08-09', '2018-08-09', 0);
INSERT INTO `users_data` VALUES (29, '10000029', 'YlbVwLOSrUaG1rSPKPtio943A0BQm71Lc2bT+cqNjsU=', 6, 323, 4, '2018-08-10', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (30, '10000030', '5do36l9RDIV6Siu0oi0VpZqPbBHvU7n8TjYj+o+tI8A=', 81, 15, 20, '2018-11-02', '2018-08-11', 0);
INSERT INTO `users_data` VALUES (31, '10000031', 'T/P2jMacoH/MUqnAF97Xfmc3lzkND0amarAo30dvOrY=', 6, 3, 4, '2018-09-02', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (32, '10000032', 'VkTNC0+AIhjJLu8IrUgmXkgrVcdmFjviwYG99Llz8Cw=', 244, 51, 68, '2019-09-23', '2019-06-03', 0);
INSERT INTO `users_data` VALUES (33, '10000033', 'kLlyzI6PE9Z1UPSgA+RDYF4fgRO5p94oXlqIhRUr6js=', 17, 3, 4, '2018-09-28', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (34, '10000034', 'kJhWOsCqdQCfJQeCvgzwXZqPbBHvU7n8TjYj+o+tI8A=', 11, 3, 4, '2018-10-06', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (35, '10000035', 'SLDL4PiVNTje90OA7i3/aJRQbL1sgD/MRs730YNVeEA=', 9, 3, 4, '2018-10-01', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (36, '10000036', '+sB0D4jhNEbf6uYskKmbu71Q/OquOhg7SXqRaCaRg4c=', 29, 9, 12, '2018-10-01', '2018-10-01', 0);
INSERT INTO `users_data` VALUES (37, '10000037', '9BintD3EPGS8cwTcDgVEk0kMz3O9B+8KFLtuvNhK728=', 65, 18, 24, '2019-08-31', '2019-08-26', 0);
INSERT INTO `users_data` VALUES (38, '10000038', 'HFtShPD+vI09oBoaG68rI0kMz3O9B+8KFLtuvNhK728=', 88, 30, 40, '2019-08-26', '2019-08-26', 0);
INSERT INTO `users_data` VALUES (39, '10000039', 'rDeAwj4OtFrP/ZBme997lJqPbBHvU7n8TjYj+o+tI8A=', 59, 9, 12, '2018-11-02', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (40, '10000040', 'fAkUzXff+TVopZ/I99eDp5qPbBHvU7n8TjYj+o+tI8A=', 96, 21, 28, '2018-10-11', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (42, '10000042', 'JgMzzrfO2P+WHGf8agec0Gtuexq3Br2k+Nzn5r82Ry8=', 457, 93, 172, '2019-08-26', '2019-08-26', 0);
INSERT INTO `users_data` VALUES (41, '10000041', 'RsQShwsrkfODr+s2Ao7JwJqPbBHvU7n8TjYj+o+tI8A=', 41, 6, 8, '2018-11-13', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (43, '10000043', 'skj9uObuh//CVUSOHuI3io+p0dvHpyyibe2IYWgta7U=', 25, 6, 8, '2018-11-08', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (44, '10000044', 'jCku1TsXnPTyDLktbCAD7cOrxY11SQE8CjoooOdx0VU=', 18, 3, 4, '2018-11-28', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (45, '10000045', 'qLaZr/0PCZBQB097kl51QTZprNogExa1PxrWn8Qy38s=', 569, 147, 196, '2019-09-13', '2019-08-10', 0);
INSERT INTO `users_data` VALUES (46, '10000046', 'Xneib341skCTvSbe72xukjNxq8s6WY/T1jQO/A66Sqg=', 22, 6, 8, '2019-02-04', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (47, '10000047', 'QRiSVGVCJJK93ztRAeTO1d43A0BQm71Lc2bT+cqNjsU=', 22, 9, 12, '2019-01-30', '2019-01-30', 0);
INSERT INTO `users_data` VALUES (48, '10000048', 'xHwAE6U1iPnTbYzRrWBguLCqD1Y98XZLGu8tI1iiWv0=', 36, 9, 12, '2019-01-30', '2019-01-30', 0);
INSERT INTO `users_data` VALUES (49, '10000049', '5Td0AayeWFcKYWmQ4tlnFUEsfPkk12OYKHrgCOyGVrI=', 109, 30, 40, '2019-02-06', '2019-02-06', 0);
INSERT INTO `users_data` VALUES (50, '10000050', '0mZ9ViG/FDk0IxqJoegmM1si7qi3SU1dUpY1ILlzOAU=', 18, 9, 12, '2019-01-30', '2019-01-30', 0);
INSERT INTO `users_data` VALUES (51, '10000051', 'x3T99cLp9qhnLJcZtv4FFFX9Mz0gSiZ1nEjVBxNXiTU=', 44, 6, 8, '2019-02-23', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (52, '10000052', 'WHn4y+A1C/yqPqV3NTTlXRvzlAgdYCBkZTgd+wzsIaI=', 7, 6, 8, '2019-03-23', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (53, '10000053', 'B5lRHCyFBDP4VmbH6KxHEWRYahm8IjQqF6KiRi9uKas=', 84, 27, 44, '2019-07-12', '2019-07-11', 0);
INSERT INTO `users_data` VALUES (54, '10000054', 'MgA5vyr03HprE1pxYVhIaREKc5qexjWNktTmiNRpd7k=', 25, 6, 8, '2019-07-11', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (55, '10000055', 'um1FpO4KHo6sadwr6LgUHmc3lzkND0amarAo30dvOrY=', 107, 27, 36, '2019-09-03', '2019-06-24', 0);
INSERT INTO `users_data` VALUES (56, '10000056', 'd+NcZkybwcoKHGrJ6/cSJ//1KUL2ttax5iixyitzb+o=', 14, 3, 4, '2019-05-21', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (57, '10000057', 'RsjnHDr+lf/7tHzNQb5GHzT/yrNjc8ExxuKxSVmVUgc=', 899, 222, 296, '2019-10-13', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (58, '10000058', 'Kxh6MrDIBCfsWhGodZr9/Wc3lzkND0amarAo30dvOrY=', 18, 6, 8, '2019-05-22', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (59, '10000059', 'lC7a1nBm9kyUodXAivcCqfOEeDRetWIxJAZz2Moc5bM=', 576, 141, 492, '2019-10-10', '2019-08-31', 0);
INSERT INTO `users_data` VALUES (60, '10000060', '7v0F9bbSUgvfVD8Q2opuH1vhqhZxl1I5Ag2rsM370lU=', 27, 9, 12, '2019-05-22', '2019-05-22', 0);
INSERT INTO `users_data` VALUES (61, '10000061', '3MSXBXMZRHgkT/siRLElm8K+05c5ZlzLX75KHG2dBuI=', 1080, 327, 436, '2019-10-12', '2019-07-25', 0);
INSERT INTO `users_data` VALUES (63, '10000063', 'vPdYDApfyZK/IsHfaNvReWgBGQplVAwZC9dUR6PfVbo=', 80, 24, 32, '2019-10-11', '2019-07-07', 0);
INSERT INTO `users_data` VALUES (62, '10000062', '3qQPdMXCIo9Paiz1P6cgix9KFLM/WSW4iV3Ooy0tgCI=', 351, 78, 104, '2019-10-13', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (64, '10000064', 'hyXHsnfbUK0ZdLfje6LrUHvAWlGBm1bSVCo8GZDejJ0=', 483, 147, 196, '2019-09-15', '2019-09-15', 0);
INSERT INTO `users_data` VALUES (65, '10000065', 'CDhfH7ubRDMtUgEMgG42cArxX2GA5MJ238FV2hEDZDw=', 26, 9, 12, '2019-07-11', '2019-07-11', 0);
INSERT INTO `users_data` VALUES (66, '10000066', 'JhaBqS8w+YwSZQG1B0+2U07HIc78XcbJ9CjfNAzE/4SsMXy9vZ+VlmB8zSO/0Paz', 63, 15, 20, '2019-08-14', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (67, '10000067', 'zSM53RIIaikPo2OjdUTkPgzmpMckTJ01j2Xnm3hx+sE=', 90, 18, 24, '2019-08-30', '2019-07-11', 0);
INSERT INTO `users_data` VALUES (68, '10000068', '/WVp9i2dZozwhWms3HwLBZrYuxZCkUFBSlsOzacFbMI=', 84, 18, 24, '2019-09-21', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (69, '10000069', '8dOV+E9WkPtiVMP7ARZWQm4pYqfX/w5Q0eE5QnzWmilh53rkft7C6W4i1VBOBF6Y', 8, 3, 4, '2019-07-11', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (70, '10000070', 'K2TaS8uIVC5UmZCFykLquvVU2b+uCmRFuNrZ/EhmT5w=', 31, 9, 12, '2019-08-26', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (71, '10000071', 'z4fIqJWoNnAa1tTxhLUE8Rm6ek0oPcrE93lFLgXTXFU=', 121, 27, 36, '2019-08-16', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (72, '10000072', '4dzxdQdgC2R46v39m78uNtLjiFKRSk2J+Qbc7qzHePc=', 21, 3, 4, '2019-07-11', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (73, '10000073', 'dOos4dxHEEO2qDj/bf4HQe0wHjVBMpFNp8c7oiBvda4=', 164, 51, 68, '2019-10-12', '2019-10-08', 0);
INSERT INTO `users_data` VALUES (74, '10000074', 'sYrLVpffIUfl+X8z/LHa6/n5vcb7qWjlzeWWp1v5IU4=', 14, 3, 4, '2019-07-12', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (75, '10000075', '8L8ngQAqxLYrfqnY7ZnE8PRX5qUKTAVK1e2Lti3icpU=', 94, 18, 24, '2019-07-29', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (76, '10000076', 'JLTMTjfJy5lKZd60WtGhUaE1pt2iBRkhMEodzygVdvU=', 33, 9, 12, '2019-07-17', '2019-07-17', 0);
INSERT INTO `users_data` VALUES (77, '10000077', 'dqGoZqclTBUeY7G9TdQp1U/pOAsHQ8qviv5IctAflHQ=', 122, 27, 36, '2019-08-19', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (78, '10000078', 'vxzfWH+3tsXa6pDELLJdOc8cljg7jtsSpaNlFrf4HiU=', 120, 30, 40, '2019-10-06', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (79, '10000079', 'OlNFflA0T8fu3NPz7RStCWc3lzkND0amarAo30dvOrY=', 234, 63, 84, '2019-10-12', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (80, '10000080', 'Qc2dBLxs+BMhxY+eMF3J9ZtE+pOuAaokhWQY1JokG9w=', 114, 42, 56, '2019-09-17', '2019-08-31', 0);
INSERT INTO `users_data` VALUES (81, '10000081', 'IipdCCHmdt0ymKqIFtVZzGYKstGg2vCUBAcLs/J85uM=', 49, 12, 16, '2019-08-26', '2019-08-26', 0);
INSERT INTO `users_data` VALUES (82, '10000082', 'LcFehcGNChejQOF328lqt/20HAGuopt7PJwwmo2SE/Q=', 6, 3, 4, '2019-08-25', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (83, '10000083', 'QMv8WHzKXwZPRKgcDhapsnlDk2qPvzPrZ+dLEV/f9VI=', 15, 3, 4, '2019-08-25', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (84, '10000084', 'OBEJPWKAwmZ5JZ+ckSl1HCQYsHjVOa8TLdQFF4yV5lw=', 11, 9, 12, '2019-08-25', '2019-08-25', 0);
INSERT INTO `users_data` VALUES (85, '10000085', 'g0BhiJNPlBNimEVms1BJW2MORv1TEaem76t5KS2+sgY=', 38, 12, 16, '2019-09-01', '2019-08-26', 0);
INSERT INTO `users_data` VALUES (86, '10000086', 'brVT7vJ34Op1w1bv2kTVSS49mqg+KhJC/vNtp/CcBjw=', 4, 3, 4, '2019-08-26', '0000-00-00', 0);
INSERT INTO `users_data` VALUES (87, '10000087', 'hSWTFH+0R7hj4ZQz3TV5h5VBLSHoHK9qdrT/nfEHFEw=', 41, 12, 16, '2019-10-01', '0000-00-00', 0);
COMMIT;
-- ----------------------------
-- Table structure for users_data_config
-- ----------------------------
DROP TABLE IF EXISTS `users_data_config`;
CREATE TABLE `users_data_config` (
                                     `jobid` int(11) NOT NULL AUTO_INCREMENT,
                                     `kind` text,
                                     `integrals` text,
                                     `prestige` int(11) DEFAULT '0',
                                     `grow_integrals` int(11) DEFAULT '0',
                                     `vip` int(11) DEFAULT '1',
                                     `svip` int(11) DEFAULT '1',
                                     PRIMARY KEY (`jobid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of users_data_config
-- ----------------------------
BEGIN;
INSERT INTO `users_data_config` VALUES (1, '每日登录奖励', '0|0', 0, 0, 0, 0);
INSERT INTO `users_data_config` VALUES (2, '每日签到奖励', '0|0', 0, 0, 0, 0);
INSERT INTO `users_data_config` VALUES (3, '上传资料奖励', '0', 0, 0, 1, 1);
INSERT INTO `users_data_config` VALUES (4, '下载资料扣除', '0', 0, 0, 1, 1);
COMMIT;
-- ----------------------------
-- Table structure for users_manager
-- ----------------------------
DROP TABLE IF EXISTS `users_manager`;
CREATE TABLE `users_manager` (
                                 `jobid` int(11) NOT NULL AUTO_INCREMENT,
                                 `account` text,
                                 `user_status` text,
                                 `user_available_date` date NOT NULL,
                                 PRIMARY KEY (`jobid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of users_manager
-- ----------------------------
BEGIN;
COMMIT;
-- ----------------------------
-- Table structure for users_member
-- ----------------------------
DROP TABLE IF EXISTS `users_member`;
CREATE TABLE `users_member` (
                                `jobid` int(11) NOT NULL AUTO_INCREMENT,
                                `account` text,
                                `user_key` text,
                                `vip_endtime` date NOT NULL,
                                `svip_endtime` date NOT NULL,
                                PRIMARY KEY (`jobid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of users_member
-- ----------------------------
BEGIN;
COMMIT;
SET FOREIGN_KEY_CHECKS = 1;