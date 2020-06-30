/*
 Navicat MySQL Data Transfer

 Source Server         : production
 Source Server Type    : MySQL
 Source Server Version : 50628
 Source Host           : 127.0.0.1
 Source Schema         : uips

 Target Server Type    : MySQL
 Target Server Version : 50628
 File Encoding         : 65001

 Date: 30/06/2020 15:20:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_blogroll
-- ----------------------------
DROP TABLE IF EXISTS `t_blogroll`;
CREATE TABLE `t_blogroll` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for t_category
-- ----------------------------
DROP TABLE IF EXISTS `t_category`;
CREATE TABLE `t_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `spell` varchar(16) NOT NULL DEFAULT '',
  `category_img` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_spell` (`spell`)
) ENGINE=InnoDB AUTO_INCREMENT=1004 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `mobile` char(11) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `head_img` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '认证：0 未认证，1已认证',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1008 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for t_user_publish
-- ----------------------------
DROP TABLE IF EXISTS `t_user_publish`;
CREATE TABLE `t_user_publish` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类id',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(60) NOT NULL DEFAULT '',
  `brief` varchar(255) NOT NULL DEFAULT '' COMMENT '简介',
  `cover_img` varchar(255) NOT NULL DEFAULT '' COMMENT '封面图',
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `is_show` tinyint(4) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  `read` int(11) NOT NULL DEFAULT '0' COMMENT '访问量',
  `is_recommend` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
