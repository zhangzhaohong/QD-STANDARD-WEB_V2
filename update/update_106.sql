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
-- Table structure for menu_data
-- ----------------------------
DROP TABLE IF EXISTS `menu_data`;
CREATE TABLE `menu_data`
(
    `jobid`       int(11) NOT NULL AUTO_INCREMENT,
    `title`       varchar(255),
    `price`       varchar(255),
    `unit`        varchar(255),
    `description` varchar(255),
    PRIMARY KEY (`jobid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

-- ----------------------------
-- Table structure for course_stuInfo
-- ----------------------------
DROP TABLE IF EXISTS `news_data`;
CREATE TABLE `news_data`
(
    `jobid`  int(11) NOT NULL AUTO_INCREMENT,
    `title`  varchar(255),
    `date`   varchar(255),
    `status` varchar(255),
    PRIMARY KEY (`jobid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

SET FOREIGN_KEY_CHECKS = 1;