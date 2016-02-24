/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : tmp_pikolor

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2016-02-24 19:33:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for p_channels
-- ----------------------------
DROP TABLE IF EXISTS `p_channels`;
CREATE TABLE `p_channels` (
  `name` varchar(150) NOT NULL,
  `group_id` int(10) DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_channels
-- ----------------------------

-- ----------------------------
-- Table structure for p_components
-- ----------------------------
DROP TABLE IF EXISTS `p_components`;
CREATE TABLE `p_components` (
  `title` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_components
-- ----------------------------

-- ----------------------------
-- Table structure for p_custom_field_photos
-- ----------------------------
DROP TABLE IF EXISTS `p_custom_field_photos`;
CREATE TABLE `p_custom_field_photos` (
  `original_title` varchar(255) DEFAULT NULL,
  `path` varchar(250) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_custom_field_photos
-- ----------------------------

-- ----------------------------
-- Table structure for p_fields
-- ----------------------------
DROP TABLE IF EXISTS `p_fields`;
CREATE TABLE `p_fields` (
  `name` varchar(100) NOT NULL,
  `label` varchar(20) NOT NULL,
  `info` varchar(250) DEFAULT NULL,
  `group_id` int(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `multilang` tinyint(1) DEFAULT NULL,
  `show` tinyint(1) DEFAULT NULL,
  `order` int(9) DEFAULT NULL,
  `options` text,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`) USING BTREE,
  KEY `label` (`label`) USING BTREE,
  CONSTRAINT `p_fields_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `p_fields_groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_fields
-- ----------------------------

-- ----------------------------
-- Table structure for p_fields_groups
-- ----------------------------
DROP TABLE IF EXISTS `p_fields_groups`;
CREATE TABLE `p_fields_groups` (
  `name` varchar(100) DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_fields_groups
-- ----------------------------

-- ----------------------------
-- Table structure for p_field_types
-- ----------------------------
DROP TABLE IF EXISTS `p_field_types`;
CREATE TABLE `p_field_types` (
  `name` varchar(50) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `label` varchar(50) DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_field_types
-- ----------------------------

-- ----------------------------
-- Table structure for p_nodes
-- ----------------------------
DROP TABLE IF EXISTS `p_nodes`;
CREATE TABLE `p_nodes` (
  `uri` varchar(250) NOT NULL,
  `channel_id` int(10) NOT NULL,
  `template` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'pending',
  `home_page` tinyint(1) DEFAULT '0',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `channel_id` (`channel_id`) USING BTREE,
  CONSTRAINT `p_nodes_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `p_channels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_nodes
-- ----------------------------

-- ----------------------------
-- Table structure for p_node_fields
-- ----------------------------
DROP TABLE IF EXISTS `p_node_fields`;
CREATE TABLE `p_node_fields` (
  `label` varchar(50) DEFAULT NULL,
  `node_id` int(10) NOT NULL,
  `field_id` int(10) DEFAULT NULL,
  `lang` varchar(10) DEFAULT NULL,
  `value` text,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `p_key` (`label`,`node_id`,`lang`) USING BTREE,
  KEY `field_id` (`field_id`) USING BTREE,
  KEY `node_id` (`node_id`) USING BTREE,
  CONSTRAINT `p_node_fields_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `p_fields` (`id`) ON DELETE CASCADE,
  CONSTRAINT `p_node_fields_ibfk_2` FOREIGN KEY (`node_id`) REFERENCES `p_nodes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_node_fields
-- ----------------------------

-- ----------------------------
-- Table structure for p_roles
-- ----------------------------
DROP TABLE IF EXISTS `p_roles`;
CREATE TABLE `p_roles` (
  `role` varchar(50) DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_roles
-- ----------------------------
INSERT INTO `p_roles` VALUES ('admin', '1');

-- ----------------------------
-- Table structure for p_users
-- ----------------------------
DROP TABLE IF EXISTS `p_users`;
CREATE TABLE `p_users` (
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_users
-- ----------------------------
INSERT INTO `p_users` VALUES ('admin@localhost', 'Admin', '2751819b092e7d976bb47f8c56e0ec64', '1', '1');

-- ----------------------------
-- Table structure for p_user_roles
-- ----------------------------
DROP TABLE IF EXISTS `p_user_roles`;
CREATE TABLE `p_user_roles` (
  `user_id` int(10) NOT NULL,
  `role_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `role_key` (`user_id`,`role_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `role_id` (`role_id`) USING BTREE,
  CONSTRAINT `p_user_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `p_roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `p_user_roles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `p_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_user_roles
-- ----------------------------
INSERT INTO `p_user_roles` VALUES ('1', '1');
