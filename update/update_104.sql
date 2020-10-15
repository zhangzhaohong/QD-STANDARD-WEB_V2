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

ALTER TABLE `users` ADD `user_phoneNumber` text;
ALTER TABLE `users` ADD `user_avatar` text;
ALTER TABLE `users` ADD `signed_times` text;

SET FOREIGN_KEY_CHECKS = 1;