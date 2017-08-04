/*
Navicat MySQL Data Transfer

Source Server         : fuck.io
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : weblavarel

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-08-04 17:15:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '用户名',
  `password` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '密码',
  `loginnum` int(11) DEFAULT '0' COMMENT '登陆次数',
  `last_login_ip` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) DEFAULT '0' COMMENT '最后登录时间',
  `real_name` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '真实姓名',
  `status` int(1) DEFAULT '0' COMMENT '状态',
  `typeid` int(11) DEFAULT '1' COMMENT '用户角色id',
  `img` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('6', 'jksm', 'eyJpdiI6Im5reW1WYTdNXC83d1FUMVIyeWR4WitnPT0iLCJ2YWx1ZSI6ImxaVEdtS1laVlFOQk5pWlBNRUNrVlE9PSIsIm1hYyI6IjkzNTkyMjQ1ZDM4ZWY5MjIzMTQxN2IzZTYwY2IwODEyMTMyMTQxZTkyNzBmZTcwMmVlYTZiMjZiZmRkZDQ1ZjcifQ==', '71', '127.0.0.1', '1501828665', 'jksm', '1', '1', null);

-- ----------------------------
-- Table structure for columns
-- ----------------------------
DROP TABLE IF EXISTS `columns`;
CREATE TABLE `columns` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `enname` varchar(255) DEFAULT NULL,
  `sort` int(255) DEFAULT '88',
  `pid` int(255) DEFAULT '0',
  `path` varchar(255) DEFAULT NULL,
  `rewrite` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `recommend` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `state` int(10) DEFAULT NULL,
  `lang` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of columns
-- ----------------------------
INSERT INTO `columns` VALUES ('25', '关于我们', null, '1', '0', '0', 'guanyuwomen', '0', null, '0', 'a', '1', 'cn');
INSERT INTO `columns` VALUES ('26', '公司简介', null, '99', '25', '0-25', 'gongsijianjie', '1', null, '0', 'd', '1', 'cn');
INSERT INTO `columns` VALUES ('27', '产品中心', null, '99', '0', '0', '12', '0', null, '0', 'dd', '1', 'cn');
INSERT INTO `columns` VALUES ('28', '新闻中心', null, '99', '0', '0', '123ds', '0', null, '0', 'sdf', '1', 'cn');
INSERT INTO `columns` VALUES ('29', '公司新闻', null, '99', '28', '0-28', 'w', '3', null, '0', 'd', '1', 'cn');

-- ----------------------------
-- Table structure for content
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `enname` varchar(255) DEFAULT NULL,
  `rewrite` varchar(255) DEFAULT NULL,
  `lid` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `info` mediumtext,
  `img` varchar(255) DEFAULT NULL,
  `moreimg` varchar(255) DEFAULT NULL,
  `down` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `recommend` int(10) DEFAULT NULL,
  `type` int(255) DEFAULT NULL,
  `click` int(255) DEFAULT NULL,
  `show` int(10) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `sort` int(50) DEFAULT '88',
  `miaoshu` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of content
-- ----------------------------
INSERT INTO `content` VALUES ('28', '公司简介', null, null, '26', '0-25', null, null, '<p>12213213ffddsdf</p><p>测试成功<br></p>', null, null, null, '是多少', '等等', null, null, '1', null, null, null, '2', null, null, '2017-08-04 11:42:52');
INSERT INTO `content` VALUES ('59', '0', null, 'UHYRvpdt5w', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '10', null, null, '2017-08-04 16:59:17');
INSERT INTO `content` VALUES ('60', '1', null, 'SNhvjNhkwt', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('61', '2', null, '5anBisKS8g', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('62', '3', null, 'FXTI7uE7ux', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('63', '4', null, 'aeMWXBZyqr', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('64', '5', null, 'Q8dk1g7Ryh', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('65', '6', null, 'FXk7K4P7uf', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('66', '7', null, 'TrRnkeJ6zM', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('67', '8', null, 'GCP4albogZ', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('68', '9', null, '5rMG12RrIy', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('69', '10', null, 'Zk30WGG2qd', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('70', '11', null, 'q9pAM3IF7c', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('71', '12', null, 'jnl89lF8Ty', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('72', '13', null, 'BbcnLpwjSq', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('73', '14', null, 'ecL0KPL1K1', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('74', '15', null, '532AKw6LF7', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('75', '16', null, 't8GgamuBV0', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('76', '17', null, 'ZXLndEiITd', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('77', '18', null, '24S6AfMUxH', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('78', '19', null, 'XWyucXEnXh', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('79', '20', null, '3VOPD8A6TU', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('80', '21', null, 'LFsNdvpHeV', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('81', '22', null, 'Uc1ghWyQZ7', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('82', '23', null, 'BZ0xHn9Tmk', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('83', '24', null, 'DIROMwuA6w', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('84', '25', null, 'tNZ03XsL38', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('85', '26', null, 'aWFpYyzn4Q', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('86', '27', null, '5pv7fkB7QP', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('87', '28', null, 'RWSCrg99I9', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);
INSERT INTO `content` VALUES ('88', '29', null, 'ILq3gMsxWY', null, null, null, null, null, null, null, null, null, null, 'cn', '0', '2', null, '1', null, '88', null, null, null);

-- ----------------------------
-- Table structure for field
-- ----------------------------
DROP TABLE IF EXISTS `field`;
CREATE TABLE `field` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `fieldname` varchar(255) DEFAULT NULL,
  `at_type` varchar(255) DEFAULT NULL,
  `sort` int(50) DEFAULT '99',
  `the_column` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of field
-- ----------------------------
INSERT INTO `field` VALUES ('7', '简单描述', '1', '1', '99', 'miaoshu');
INSERT INTO `field` VALUES ('8', '邮箱', '1', '5', '99', 'mail');
INSERT INTO `field` VALUES ('9', '电话', '1', '5', '99', 'tel');

-- ----------------------------
-- Table structure for gbook
-- ----------------------------
DROP TABLE IF EXISTS `gbook`;
CREATE TABLE `gbook` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gbook
-- ----------------------------

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `real_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');

-- ----------------------------
-- Table structure for node
-- ----------------------------
DROP TABLE IF EXISTS `node`;
CREATE TABLE `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_name` varchar(155) NOT NULL DEFAULT '' COMMENT '节点名称',
  `mark` varchar(155) NOT NULL COMMENT '方法名',
  `is_menu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否是菜单项 1不是 2是',
  `typeid` int(11) NOT NULL COMMENT '父级节点id',
  `style` varchar(155) DEFAULT '' COMMENT '菜单样式',
  `sort` int(50) DEFAULT '99',
  `route` varchar(155) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of node
-- ----------------------------
INSERT INTO `node` VALUES ('1', '基本管理', '#', '2', '0', 'fa fa-cog', '1', '');
INSERT INTO `node` VALUES ('2', '用户管理', '#', '2', '0', 'fa fa-user', '2', null);
INSERT INTO `node` VALUES ('3', '栏目管理', '#', '2', '0', 'fa fa-bars', '3', null);
INSERT INTO `node` VALUES ('4', '会员管理', '#', '2', '0', 'fa fa-user-circle', '4', null);
INSERT INTO `node` VALUES ('5', '留言管理', '#', '2', '0', 'fa fa-commenting-o', '5', null);
INSERT INTO `node` VALUES ('6', '内容管理', '#', '2', '0', 'fa fa-pencil-square-o', '6', null);
INSERT INTO `node` VALUES ('35', '下载管理', '', '2', '6', '', '5', null);
INSERT INTO `node` VALUES ('11', '微信管理', '#', '2', '0', 'fa fa-weixin', '11', null);
INSERT INTO `node` VALUES ('12', '插件管理', '#', '2', '0', 'fa fa-plug', '12', null);
INSERT INTO `node` VALUES ('13', '文件管理', '#', '2', '0', 'fa fa-folder-open', '13', null);
INSERT INTO `node` VALUES ('14', '系统管理', '#', '2', '0', 'fa fa-desktop', '14', null);
INSERT INTO `node` VALUES ('31', '单篇管理 ', '', '2', '6', '', '1', 'Page');
INSERT INTO `node` VALUES ('32', '产品管理', '', '2', '6', '', '2', 'Product');
INSERT INTO `node` VALUES ('33', '文章管理', '', '2', '6', '', '3', null);
INSERT INTO `node` VALUES ('34', '图片管理', '', '2', '6', '', '4', null);
INSERT INTO `node` VALUES ('15', '内容回收站', '#', '2', '0', 'fa fa-recycle', '15', null);
INSERT INTO `node` VALUES ('16', '基本设置', '', '2', '1', '', '99', 'site');
INSERT INTO `node` VALUES ('17', '幻灯片管理', '', '2', '1', '', '99', 'SlideIndex');
INSERT INTO `node` VALUES ('18', '添加幻灯片', '', '1', '17', '', '99', 'SlideCreate');
INSERT INTO `node` VALUES ('19', '编辑幻灯片', '', '1', '17', '', '99', 'SlideEdit');
INSERT INTO `node` VALUES ('20', '删除幻灯片', '', '1', '17', '', '99', 'SlideDelete');
INSERT INTO `node` VALUES ('21', '用户列表', '', '2', '2', '', '99', 'UserIndex');
INSERT INTO `node` VALUES ('22', '添加用户', '', '1', '21', '', '99', 'UserCreate');
INSERT INTO `node` VALUES ('23', '编辑用户', '', '1', '21', '', '99', 'UserEdit');
INSERT INTO `node` VALUES ('24', '删除用户', '', '1', '21', '', '99', 'UserDelete');
INSERT INTO `node` VALUES ('25', '角色列表', '', '2', '2', '', '99', 'Role');
INSERT INTO `node` VALUES ('26', '添加角色', '', '1', '25', '', '99', 'RoleCreate');
INSERT INTO `node` VALUES ('27', '编辑角色', '', '1', '25', '', '99', 'RoleEdit');
INSERT INTO `node` VALUES ('28', '删除角色', '', '1', '25', '', '99', 'RoleDelete');
INSERT INTO `node` VALUES ('29', '分配权限', '', '1', '25', '', '99', 'giveAccess');
INSERT INTO `node` VALUES ('30', '栏目列表', '', '2', '3', '', '99', 'Column');
INSERT INTO `node` VALUES ('36', '单篇编辑', '', '1', '31', '', '99', 'PageEdit');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('563960993@qq.com', '$2y$10$X1AnicYlVfecAtMU7Fjqvu06TNmhLAAAo/qM2Icem28ltLd5VSAjy', '2017-06-20 02:13:41');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `rolename` varchar(155) NOT NULL COMMENT '角色名称',
  `rule` varchar(255) DEFAULT '' COMMENT '权限节点数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员', '');
INSERT INTO `role` VALUES ('2', '普通管理员', '1,2,3,4,5');

-- ----------------------------
-- Table structure for slide
-- ----------------------------
DROP TABLE IF EXISTS `slide`;
CREATE TABLE `slide` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `slide_name` varchar(255) DEFAULT NULL,
  `slide_sort` int(255) DEFAULT '99',
  `slide_img` varchar(255) DEFAULT NULL,
  `slide_type` varchar(255) DEFAULT NULL,
  `slide_a` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slide
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'boge', '563960993@qq.com', '$2y$10$J21hdKoQTeu1BWbpB.oZ7e90v8de1lcmbPyRw3oS3ozFlyZbH.9SO', 'pt87dxRjglI2obNeTNqAzezgku5w7dr43nYn9bBMiMGYrFJnpLJYS3BwECYb', '2017-06-20 01:55:31', '2017-06-20 01:55:31');
