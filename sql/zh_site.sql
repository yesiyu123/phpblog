/*
 Navicat MySQL Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 80020
 Source Host           : localhost:3306
 Source Schema         : phpmyblog

 Target Server Type    : MySQL
 Target Server Version : 80020
 File Encoding         : 65001

 Date: 26/05/2021 20:38:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for zh_site
-- ----------------------------
DROP TABLE IF EXISTS `zh_site`;
CREATE TABLE `zh_site`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '站点名称',
  `keywords` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '关键字',
  `is_open` int(0) NULL DEFAULT 1 COMMENT '是否开启1开0关',
  `is_reg` int(0) NULL DEFAULT 1 COMMENT '是否允许注册1是0否',
  `create_time` int(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` int(0) NULL DEFAULT NULL COMMENT '更新时间',
  `desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '网站描述',
  `status` int(0) NULL DEFAULT 1 COMMENT '状态',
  `is_comment` int(0) NULL DEFAULT NULL COMMENT '是否允许评论1是0否',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '站点信息表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
