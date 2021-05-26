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

 Date: 26/05/2021 20:37:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for zh_article
-- ----------------------------
DROP TABLE IF EXISTS `zh_article`;
CREATE TABLE `zh_article`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title_img` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '标题图片',
  `is_host` int(10) UNSIGNED ZEROFILL NULL DEFAULT NULL COMMENT '是否热门1是0否',
  `is_top` int(10) UNSIGNED ZEROFILL NULL DEFAULT NULL COMMENT '是否置顶1是0否',
  `cate_id` int(0) NULL DEFAULT NULL COMMENT '栏目主键',
  `user_id` int(0) NULL DEFAULT NULL COMMENT '用户主键',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '文档标题',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '文档内容',
  `pv` int(0) NULL DEFAULT 0 COMMENT '阅读量',
  `status` int(0) NULL DEFAULT NULL COMMENT '状态1显示0隐藏',
  `create_time` int(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` int(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '文档表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
