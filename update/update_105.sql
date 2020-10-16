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
-- Table structure for course_data
-- ----------------------------
DROP TABLE IF EXISTS `course_data`;
CREATE TABLE `course_data`
(
    `jobid`                 int(11) NOT NULL AUTO_INCREMENT,
    `course_title`          varchar(255),
    `course_type`           varchar(255),
    `course_time_week`      varchar(255),
    `course_time_startHour` varchar(255),
    `course_time_endHour`   varchar(255),
    `course_place`          varchar(255),
    `course_college`        varchar(255),
    `course_length`         varchar(255),
    `course_total`          varchar(255),
    `course_studentNum`     varchar(255),
    PRIMARY KEY (`jobid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

-- ----------------------------
-- Table structure for course_stuInfo
-- ----------------------------
DROP TABLE IF EXISTS `course_stuInfo`;
CREATE TABLE `course_stuInfo`
(
    `jobid`           int(11) NOT NULL AUTO_INCREMENT,
    `course_jobId`    varchar(255),
    `student_userKey` varchar(255),
    `operation_time`  varchar(255),
    `signed_time`     varchar(255),
    `signed_date`     varchar(255),
    PRIMARY KEY (`jobid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

-- ----------------------------
-- Table structure for activity_data
-- ----------------------------
DROP TABLE IF EXISTS `activity_data`;
CREATE TABLE `activity_data`
(
    `jobid`              int(11) NOT NULL AUTO_INCREMENT,
    `activity_title`     varchar(255),
    `activity_content`   text,
    `activity_pic`       varchar(255),
    `activity_vid`       varchar(255),
    `activity_joinedNum` varchar(255),
    `activity_maxNum`    varchar(255),
    PRIMARY KEY (`jobid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

-- ----------------------------
-- Table structure for activity_stuInfo
-- ----------------------------
DROP TABLE IF EXISTS `activity_stuInfo`;
CREATE TABLE `activity_stuInfo`
(
    `jobid`           int(11) NOT NULL AUTO_INCREMENT,
    `activity_jobId`  varchar(255),
    `student_userKey` varchar(255),
    `operation_time`  varchar(255),
    PRIMARY KEY (`jobid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

SET FOREIGN_KEY_CHECKS = 1;