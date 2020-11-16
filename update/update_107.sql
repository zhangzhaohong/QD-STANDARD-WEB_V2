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
-- Table structure for live_data
-- ----------------------------
DROP TABLE IF EXISTS `live_data`;
CREATE TABLE `live_data`
(
    `jobid`     int(11) NOT NULL AUTO_INCREMENT,
    `cover`     varchar(255),
    `file`      varchar(255),
    `content`   varchar(255),
    `file_type` varchar(255),
    PRIMARY KEY (`jobid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

SET FOREIGN_KEY_CHECKS = 1;