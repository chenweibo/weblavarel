/*
Navicat MySQL Data Transfer

Source Server         : 1
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : weblavarel

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-09-09 17:08:12
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
INSERT INTO `admin_user` VALUES ('6', 'jksm', 'eyJpdiI6Im5reW1WYTdNXC83d1FUMVIyeWR4WitnPT0iLCJ2YWx1ZSI6ImxaVEdtS1laVlFOQk5pWlBNRUNrVlE9PSIsIm1hYyI6IjkzNTkyMjQ1ZDM4ZWY5MjIzMTQxN2IzZTYwY2IwODEyMTMyMTQxZTkyNzBmZTcwMmVlYTZiMjZiZmRkZDQ1ZjcifQ==', '140', '127.0.0.1', '1504943969', 'jksm', '1', '1', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of columns
-- ----------------------------
INSERT INTO `columns` VALUES ('1', '关于许泰', null, '99', '0', '0', 'guanyuxutai', '0', null, '0', '#', '1', 'cn');
INSERT INTO `columns` VALUES ('2', '公司简介', null, '99', '1', '0-1', 'gongsijianjie', '1', null, '0', '/', '1', 'cn');
INSERT INTO `columns` VALUES ('3', '总裁致辞', null, '99', '1', '0-1', 'zongcaizhici', '1', null, '0', '/', '1', 'cn');
INSERT INTO `columns` VALUES ('4', '组织机构', null, '99', '1', '0-1', 'zuzhijigou', '1', null, '0', '/', '1', 'cn');
INSERT INTO `columns` VALUES ('5', '荣誉资质', null, '99', '1', '0-1', 'rongyuzizhi', '4', null, '0', '/', '1', 'cn');
INSERT INTO `columns` VALUES ('6', '新闻中心', null, '99', '0', '0', 'xinwenzhongxin', '0', null, '0', '/', '1', 'cn');
INSERT INTO `columns` VALUES ('7', '公司新闻', null, '99', '6', '0-6', 'gongsixinwen', '3', null, '0', '//', '1', 'cn');
INSERT INTO `columns` VALUES ('8', '行业动态', null, '99', '6', '0-6', 'hangyedongtai', '3', null, '0', '//', '1', 'cn');
INSERT INTO `columns` VALUES ('9', '试听中心', null, '99', '6', '0-6', 'shitingzhongxin', '1', null, '0', '//', '1', 'cn');
INSERT INTO `columns` VALUES ('10', '产品中心', null, '99', '0', '0', 'chanpinzhongxin', '0', null, '0', '//', '1', 'cn');
INSERT INTO `columns` VALUES ('11', '设备展示', null, '99', '0', '0', 'shebeizhanshi', '4', null, '0', '//', '1', 'cn');
INSERT INTO `columns` VALUES ('12', '客服服务', null, '99', '0', '0', 'kefufuwu', '0', null, '0', '//', '1', 'cn');
INSERT INTO `columns` VALUES ('13', '产品常识', null, '99', '12', '0-12', 'chanpinchangshi', '1', null, '0', '//', '1', 'cn');
INSERT INTO `columns` VALUES ('14', '技术资料', null, '99', '12', '0-12', 'jishuziliao', '1', null, '0', '//', '1', 'cn');
INSERT INTO `columns` VALUES ('15', '分类测试', null, '99', '10', '0-10', 'fenleiceshi', '2', null, '0', '//', '1', 'cn');
INSERT INTO `columns` VALUES ('16', '测试2', null, '99', '10', '0-10', 'ceshi2', '2', null, '0', '//', '1', 'cn');

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
  `moreimg` varchar(600) DEFAULT NULL,
  `down` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `recommend` int(10) DEFAULT NULL,
  `type` int(255) DEFAULT NULL,
  `click` int(255) NOT NULL DEFAULT '50',
  `show` int(10) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `sort` int(50) DEFAULT '88',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`click`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of content
-- ----------------------------
INSERT INTO `content` VALUES ('1', '公司简介', null, null, '2', '0-1', null, null, null, null, null, null, null, null, null, null, '1', '50', null, null, '88', null, null);
INSERT INTO `content` VALUES ('2', '总裁致辞', null, null, '3', '0-1', null, null, null, null, null, null, null, null, null, null, '1', '50', null, null, '88', null, null);
INSERT INTO `content` VALUES ('3', '组织机构', null, null, '4', '0-1', null, null, null, null, null, null, null, null, null, null, '1', '50', null, null, '88', null, null);
INSERT INTO `content` VALUES ('4', '试听中心', null, null, '9', '0-6', null, null, null, null, null, null, null, null, null, null, '1', '50', null, null, '88', null, null);
INSERT INTO `content` VALUES ('5', '新闻测试', null, 'xinwenceshi', '7', '0-6-7', '2017-09-06', null, '<p>测试描述测试描述测试描述<span style=\"line-height: 1.5; color: inherit;\">测试描述测试描述测试描述</span><span style=\"line-height: 1.5; color: inherit;\">测试描述测试描述测试描述</span><span style=\"line-height: 1.5; color: inherit;\">测试描述测试描述测试描述</span><span style=\"line-height: 1.5; color: inherit;\">测试描述测试描述测试描述</span><span style=\"line-height: 1.5; color: inherit;\">测试描述测试描述测试描述</span><span style=\"line-height: 1.5; color: inherit;\">测试描述测试描述测试描述</span><span style=\"line-height: 1.5; color: inherit;\">测试描述测试描述测试描述</span></p>', null, null, null, null, null, 'cn', '0', '3', '99', '1', null, '99', null, null);
INSERT INTO `content` VALUES ('6', '行业', null, 'hangye', '8', '0-6-8', '2017-09-06', null, '<p>123213</p>', null, null, null, null, null, 'cn', '0', '3', '99', '1', null, '99', null, null);
INSERT INTO `content` VALUES ('7', '产品常识', null, null, '13', '0-12', null, null, null, null, null, null, null, null, null, null, '1', '50', null, null, '88', null, null);
INSERT INTO `content` VALUES ('8', '技术资料', null, null, '14', '0-12', null, null, null, null, null, null, null, null, null, null, '1', '50', null, null, '88', null, null);
INSERT INTO `content` VALUES ('9', '1', null, '1', '5', '0-1-5', null, null, null, 'DSbF8IvMHc8G9hZLZfoR5Jrh7IjIZmJSi2fmci2L.jpeg', null, null, null, null, 'cn', '0', '4', '50', '1', null, '99', null, null);
INSERT INTO `content` VALUES ('10', '2', null, '2', '11', '0-11', null, null, null, 'fNkvjkeEhQkqyEI9sCS9L4fZgnURdgoj4mw8Ncbs.jpeg', null, null, null, null, 'cn', '0', '4', '50', '1', null, '99', null, null);
INSERT INTO `content` VALUES ('11', '测试', null, 'ceshi', '15', '0-10-15', null, null, null, 'qg91JtweQrrW9UkfW6ZP2DOKlQCjc27tY3Orq2PY.png', null, null, null, null, 'cn', '0', '2', '50', '1', null, '99', null, null);
INSERT INTO `content` VALUES ('12', '55', null, '55', '16', '0-10-16', null, null, null, null, null, null, null, null, 'cn', '0', '2', '50', '1', null, '99', null, null);

-- ----------------------------
-- Table structure for field
-- ----------------------------
DROP TABLE IF EXISTS `field`;
CREATE TABLE `field` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `column_name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `sort` int(50) DEFAULT '99',
  `column_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of field
-- ----------------------------

-- ----------------------------
-- Table structure for gbooks
-- ----------------------------
DROP TABLE IF EXISTS `gbooks`;
CREATE TABLE `gbooks` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gbooks
-- ----------------------------
INSERT INTO `gbooks` VALUES ('1', 'asdf', 'asdf', 'asfd', '2017-08-09 21:57:49', 'asfd', 'asdf');
INSERT INTO `gbooks` VALUES ('2', 'asdf', 'asdf', 'asfd', '2017-08-09 21:57:49', 'sdf', 'ws');
INSERT INTO `gbooks` VALUES ('3', '3213', null, 'sdf', '2017-09-07 11:06:02', 'sdf', '13587755084');

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
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of node
-- ----------------------------
INSERT INTO `node` VALUES ('1', '基本管理', '#', '2', '0', 'fa fa-cog', '1', '');
INSERT INTO `node` VALUES ('2', '用户管理', '#', '2', '0', 'fa fa-user', '2', null);
INSERT INTO `node` VALUES ('3', '栏目管理', '#', '2', '0', 'fa fa-bars', '3', null);
INSERT INTO `node` VALUES ('4', '会员管理', '#', '2', '0', 'fa fa-user-circle', '4', null);
INSERT INTO `node` VALUES ('5', '留言管理', '#', '2', '0', 'fa fa-commenting-o', '5', null);
INSERT INTO `node` VALUES ('6', '内容管理', '#', '2', '0', 'fa fa-pencil-square-o', '6', null);
INSERT INTO `node` VALUES ('35', '下载管理', '', '2', '6', '', '5', 'Down');
INSERT INTO `node` VALUES ('11', '微信管理', '#', '2', '0', 'fa fa-weixin', '11', null);
INSERT INTO `node` VALUES ('12', '插件管理', '#', '2', '0', 'fa fa-plug', '12', null);
INSERT INTO `node` VALUES ('13', '文件管理', '#', '2', '0', 'fa fa-folder-open', '13', null);
INSERT INTO `node` VALUES ('14', '系统管理', '#', '2', '0', 'fa fa-desktop', '14', null);
INSERT INTO `node` VALUES ('31', '单篇管理 ', '', '2', '6', '', '1', 'Page');
INSERT INTO `node` VALUES ('32', '产品管理', '', '2', '6', '', '2', 'Product');
INSERT INTO `node` VALUES ('33', '文章管理', '', '2', '6', '', '3', 'Aritcle');
INSERT INTO `node` VALUES ('34', '图片管理', '', '2', '6', '', '4', 'Image');
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
INSERT INTO `node` VALUES ('37', '栏目添加', '', '1', '30', '', '99', 'ColumnCreate');
INSERT INTO `node` VALUES ('38', '栏目编辑', '', '1', '30', '', '99', 'ColumnEdit');
INSERT INTO `node` VALUES ('39', '栏目删除', '', '1', '30', '', '99', 'ColumnDelete');
INSERT INTO `node` VALUES ('40', '产品添加', '', '1', '32', '', '99', 'ProductCreate');
INSERT INTO `node` VALUES ('41', '产品编辑', '', '1', '32', '', '99', 'ProductEdit');
INSERT INTO `node` VALUES ('42', '产品删除', '', '1', '32', '', '99', 'ProductDelete');
INSERT INTO `node` VALUES ('43', '批量删除', '', '1', '32', '', '99', 'ProductMoreDelete');
INSERT INTO `node` VALUES ('44', '会员列表', '', '2', '4', '', '99', 'MemberIndex');
INSERT INTO `node` VALUES ('45', '会员添加', '', '1', '44', '', '99', 'MemberCreate');
INSERT INTO `node` VALUES ('46', '会员编辑', '', '1', '44', '', '99', 'MemberEdit');
INSERT INTO `node` VALUES ('47', '会员删除', '', '1', '44', '', '99', 'MemberDelete');
INSERT INTO `node` VALUES ('48', '留言列表', '', '2', '5', '', '99', 'GbookIndex');
INSERT INTO `node` VALUES ('49', '留言查看', '', '1', '49', '', '99', 'GbookEdit');
INSERT INTO `node` VALUES ('50', '留言删除', '', '1', '49', '', '99', 'GbookDelete');
INSERT INTO `node` VALUES ('51', '回收站列表', '', '2', '15', '', '99', 'RecycleIndex');
INSERT INTO `node` VALUES ('52', '内容恢复', '', '1', '51', '', '99', 'RecycleRecover');
INSERT INTO `node` VALUES ('53', '彻底删除', '', '1', '51', '', '99', 'RecycleDelete');
INSERT INTO `node` VALUES ('54', '字段管理', '', '2', '6', '', '99', 'FieldIndex');
INSERT INTO `node` VALUES ('55', '字段添加', '', '1', '54', '', '99', 'FieldCreate');
INSERT INTO `node` VALUES ('56', '字段编辑', '', '1', '54', '', '99', 'FieldEdit');
INSERT INTO `node` VALUES ('57', '字段删除', '', '1', '54', '', '99', 'FieldDelete');
INSERT INTO `node` VALUES ('58', '文章添加', '', '1', '33', '', '99', 'AritcleCreate');
INSERT INTO `node` VALUES ('59', '文章编辑', '', '1', '33', '', '99', 'AritcleEdit');
INSERT INTO `node` VALUES ('60', '文章删除', '', '1', '33', '', '99', 'AritcleDelete');
INSERT INTO `node` VALUES ('61', '文章批量删除', '', '1', '33', '', '99', 'AritcleMoreDelete');
INSERT INTO `node` VALUES ('62', '图片添加', '', '1', '34', '', '99', 'ImageCreate');
INSERT INTO `node` VALUES ('63', '图片编辑', '', '1', '34', '', '99', 'ImageEdit');
INSERT INTO `node` VALUES ('64', '图片删除', '', '1', '34', '', '99', 'ImageDelete');
INSERT INTO `node` VALUES ('65', '图片批量删除', '', '1', '34', '', '99', 'ImageMoreDelete');
INSERT INTO `node` VALUES ('66', '下载添加', '', '1', '35', '', '99', 'DownCreate');
INSERT INTO `node` VALUES ('67', '下载编辑', '', '1', '35', '', '99', 'DownEdit');
INSERT INTO `node` VALUES ('68', '下载删除', '', '1', '35', '', '99', 'DownDelete');
INSERT INTO `node` VALUES ('69', '下载批量删除', '', '1', '35', '', '99', 'DownMoreDelete');
INSERT INTO `node` VALUES ('70', '公众号配置', '', '2', '11', '', '99', 'WechatConfig');
INSERT INTO `node` VALUES ('71', '菜单管理', '', '2', '11', '', '99', 'WechatIndex');
INSERT INTO `node` VALUES ('75', '菜单添加', '', '1', '71', '', '99', 'MenuCreate');
INSERT INTO `node` VALUES ('73', '回复设置', '', '2', '11', '', '99', 'Reply');
INSERT INTO `node` VALUES ('74', '消息管理', '', '2', '11', '', '99', 'Message');
INSERT INTO `node` VALUES ('76', '菜单编辑', '', '1', '71', '', '99', 'MenuEdit');
INSERT INTO `node` VALUES ('77', '菜单删除', '', '1', '71', '', '99', 'MenuDelete');
INSERT INTO `node` VALUES ('78', '菜单同步', '', '1', '71', '', '99', 'MenuChange');
INSERT INTO `node` VALUES ('79', '消息查看', '', '1', '74', '', '99', 'MessageRead');
INSERT INTO `node` VALUES ('80', '消息删除', '', '1', '74', '', '99', 'MessageDelete');
INSERT INTO `node` VALUES ('81', '消息回复', '', '1', '74', '', '99', 'userReply');
INSERT INTO `node` VALUES ('82', '回复添加', '', '1', '73', '', '99', 'ReplyCreate');
INSERT INTO `node` VALUES ('83', '回复编辑', '', '1', '73', '', '99', 'ReplyEdit');
INSERT INTO `node` VALUES ('84', '回复删除', '', '1', '73', '', '99', 'ReplyDelete');
INSERT INTO `node` VALUES ('85', '文件处理', '', '2', '13', '', '99', 'Files');

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `info` mediumtext,
  `lang` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES ('1', '关于我们', '<br>123&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>                             <p><br></p>', 'cn');
INSERT INTO `page` VALUES ('2', '招聘信息', '                                 <p style=\"text-indent:2em;\"> 科技、创新是企业长足发展的保障。一直以来，金天国际始终坚持科技创新是企业赖之以盈的基石，不断加大科研力度，经过25年的不断研发，独创生物气波、生态保养两大国际尖端的养生技术，拥有完全的知识产权，先后申报专利20多项，目前仍在保护期的专利有13项，这都是以中华民族中医药技术为研发基础而创新的新科技，在提升功效、品质、安全方面金天国际率先采用超声波破壁粉碎技术、高分子绕流撞击技术、智能化低温活性提取技术、智能化配料技术、精细纯棉布护理技术、活性因子疏通技术、缓释控释技术、非抗生素抑菌技术、无创排毒技术、生态养卵技术、会阴部定向导入透皮吸收技术等几十项专有技术，确保生态保养产业化的核心竞争力和领导地位，并在保护消费者利益，杜绝假冒提供了不可逾越的技术壁垒。 </p>\r\n        <p style=\"text-indent:2em;\">生态保养是一个科学的系统的养生体系，金天国际独家形成“疏通-抑菌-排毒-修复-营养-激活”完善的生态保养养生方案，并在此方案指导下先后研发出专项健康护理系列（雪莲要垫、雪莲更年轻护理垫、雪莲通经护理垫、雪莲臻华男女平衡液）、男女生态保养系列（雪莲生态保养、天保得乐）、洗浴养生系列（天山雪莲男女养生足浴、香妃浴）、天然有机化妆品系列（雪莲臻华男士紧致乳、雪莲臻华乳、雪莲臻华霜、雪莲臻华深层焕颜面膜、雪莲美足霜、雪莲香妃乳等）、金三角本源养生系列（雪莲生态美容贴套、生态保元1号套、生态美疗、抒情美疗等）。在此基础上，研发团队不断进行外延扩展，后续将源源不断的为市场提供健康食养系列如生态的健康养生酒、独特的果蔬营养液、绿色的有机养生饮等及智能化网络版的生物气波仪系列健康产品。强化生态保养产业链，为全面实现生态保养产业化，给市场持续提供强有力的经营活力。</p>\r\n        <p></p><h3><b>◇６大科技彰显尊贵品质</b></h3><p></p>\r\n        <p style=\"text-indent:2em;\">十万级净化车间全自动生产线一次成型，医用铝塑罩泡包装，钴60照射技术让产品安全、洁净、无菌、功效稳定；</p>\r\n        <p style=\"text-indent:2em;\">护理层采用100%新疆长绒棉，安全、舒适；</p>\r\n        <p style=\"text-indent:2em;\">缓释控释技术，使植物精华素均衡、稳定释放；</p>\r\n        <p style=\"text-indent:2em;\">低温活性提取技术，最大程度保留天山雪莲花、黄芪、芦笋、淫羊藿、锁阳等30余种草本植物的功效与活性；</p>\r\n        <p style=\"text-indent:2em;\">生态保养技术实现了非抗生素杀菌、无创排毒、生态养护的养生目的；</p>\r\n        <p style=\"text-indent:2em;\">国际领先透皮吸收、定向导入技术，使植物精华素持续吸收，功效显著、持久。</p>                   ', 'cn');
INSERT INTO `page` VALUES ('3', '营销网络', '                                 <img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/jidi001.jpg\"><p><br></p>', 'cn');
INSERT INTO `page` VALUES ('4', '30年规划', '<img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/guihua01.jpg\">\r\n        <p style=\"text-indent:2em;\">金天国际之所以能从无到有、从小到大，历经25年的发展成长为国际化的知名健康企业，最关键的是在公司成立之初就确立了30年发展规划，明确四个发展目标：一是研发一种能提升生命质量的新技术；二是开创一个全新的绿色健康产业；三是创造一种全新的商业模式，为千万有志之士提供优质创业平台；四是弘扬中医养生技术，实现生态保养产业化，成为国际著名企业和世界知名品牌，让更多的生命充满活力。</p>\r\n        <p style=\"text-indent:2em;\">为实现这四个目标，公司制定了30年发展战略规划，第一期为开创期。用10年时间完成企业的原始积累，1997年营业额达到2亿2千万，并保持稳步发展，2000年圆满结束。第二期为巩固期。完善企业核心技术，建立适应国际运作的现代企业管理机制，以及建立适应未来市场规模化发展的全新商业模式。经10年研发，现已拥有生态保养、生物气波两大国际尖端的养生技术及几十项专有专利技术，到2007年已按照产业化的格局形成了独有的知识产权和核心竞争力；2008年在新加坡组建的生态保养国际研发中心及金天国际集团总部，标志着企业拉开国际化运作的序幕。同时全新商业模式也逐步成熟完善，连锁经营机构遍布全球40多个国家和地区。</p>\r\n        <p style=\"text-indent:2em;\">2010年，金天国际步入了高速发展期，全力冲刺30年战略目标。时值2016年是国家十三五规划的开篇之年，也是集团六五规划的开篇之年，更是集团获得直销许可的开篇之年，可喜可贺。时至今日集团已为30万余人提供了无忧创业的平台，助力其实现创业梦、老板梦；让5000万产品使用者收益，健康生命，和谐家庭。未来5年，集团将大力弘扬中医养生技术，实现30年战略发展目标，全面实现生态保养产业化，让更多的生命充满活力，使产品和企业成为世界著名品牌。</p>', 'cn');
INSERT INTO `page` VALUES ('5', '书籍科普', '<h1 style=\"font-size: 20px; font-weight: bold; text-align: center; margin-bottom: 20px;\">《让生命充满活力》书籍科普篇</h1>\r\n        <img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/shuji01.jpg\">\r\n        <p style=\"margin-top: 30px;text-indent:2em;\">金天国际，自1991年成立伊始，即希望通过研发一种全新的健康养生科技实现“让生命充满活力”的目标，至2008年生态保养理念及系列产品的推出，标志着金天国际立足生态养生领域，不仅完成了企业文化核心价值的构建，更借助生态保养、生物气波等核心专有专利技术打造出易于形成规模化和产业化的蓝海事业平台，为无数渴求健康、幸福、成功的人士带去了新的希望。</p>\r\n        <p style=\"text-indent:2em;\">“让生命充满活力”，既是一种使命，也是一种追求，还是一种文化，更是支撑金天国际从无到有、从小到大、由弱及强的精神上的动力源泉。肩负这份使命、秉承这份追求、弘扬这种文化，金天人25年风雨兼程，获得了令人瞩目的成就，更迎了发展的新时代。</p>\r\n        <p style=\"text-indent:2em;\">金天国际《让生命充满活力》科普专著，经过由金天国际董事局主席祖明军在内的共20余名编委会成员近6个月时间编撰最终定稿刊发，得到了国家司法部副部长刘振宇、国务院新闻办副主任杨正泉、中共中央宣传部秘书长王伟华题贺，对外经济贸易部副部长、高级经济师周可仁作序，全书共分五大篇章，全面而深刻地阐述了“让生命充满活力”的文化内涵、创新属性、划时代意义及其蕴藏的大爱精神。</p>', 'cn');
INSERT INTO `page` VALUES ('6', '金天季刊', '<h1 style=\"font-size: 20px; font-weight: bold; text-align: center; margin-bottom: 20px;\">《金天季刊》 新起点 新跨越</h1>\r\n        <p style=\"text-indent:2em;\">人生若只如初见最美人间四月天。在这一年中最美好的时节，《金天季刊》首刊现正式发行。本刊洞悉行业纵横、记录金天历程、镌刻光辉与荣誉、传递精彩与感动，在这里面，不仅有你，还有我，更有我们共同携手走过的岁月和奋战过的征程。</p>\r\n        <p style=\"text-indent:2em;\">一年之际在于春，当时光跳转到4月，预示着时节正由春至夏，2016年第一季度已然成为过去，盘点走过的90个日日夜夜，你我与金天同行共赢，新起点、新跨越，携着发展的东风，我们用心血与汗水铬印了成长的足迹。我们用激情与奋斗谱写了辉煌的篇章，这段历程既值得我们记忆，更将为我们走向美好明天扬起胜利的风帆......</p>\r\n        <p style=\"text-indent:2em;\">肩负“扬中医养生之魂，振民族品牌之威，实现生态保养产业化，让更多的生命充满活力”的企业使命，本刊将把握时代发展的潮流，突出生态保养行业特色，倡导优良企业风采，传播生殖健康知识，塑造有活力的金天形象。</p>\r\n        <p style=\"text-indent:2em;\">《金天季刊》这株幼苗破土而出了。我们诚挚地希望金天家人们给予她爱与呵护，期待她枝繁叶茂，茁壮成长，繁花似锦，向着灿烂的阳光绽放，为金天文化百花园的绚烂多姿开启绿色的希望！</p>\r\n        <div style=\"float: left; padding: 0px 20px; margin-top: 20px;\"> <img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/jikan003.jpg\" style=\"float: left;\">\r\n          <div style=\"float: left; padding-top: 200px; font-size: 14px; margin-left: 10px;\"> <a href=\"http://jtgj.cc/Areas/GoldendaysModule/Content/jikan3/page.html\" target=\"_blank\"> <img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/yuedu.png\"> 马上阅读</a><br>\r\n            <a href=\"http://jtgj.cc/Areas/GoldendaysModule/Content/jikan3/金天季刊第三四期合刊.rar\" target=\"_blank\"> <img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/xiazai.png\"> 点击下载</a><br>\r\n            《金天季刊》<br>\r\n            第三、四期合刊 </div>\r\n        </div>\r\n        <div style=\"float: right; padding: 0px 20px; margin-top: 20px;\"> <img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/jikan002.jpg\" style=\"float: left;\">\r\n          <div style=\"float: left; padding-top: 200px; font-size: 14px; margin-left: 10px;\"> <a href=\"http://jtgj.cc/Areas/GoldendaysModule/Content/jikan2/page.html\" target=\"_blank\"> <img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/yuedu.png\"> 马上阅读 </a><br>\r\n            <a href=\"http://jtgj.cc/Areas/GoldendaysModule/Content/jikan2/金天季刊第二期.rar\" target=\"_blank\"> <img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/xiazai.png\"> 点击下载 </a><br>\r\n            《金天季刊》<br>\r\n            ——第二期 </div>\r\n        </div>\r\n        <img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/jikanfg.jpg\">\r\n        <div style=\"float: left; padding: 0px 20px; margin-top: 20px;\"> <img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/jikan001.jpg\" style=\"float: left;\">\r\n          <div style=\"float: left; padding-top: 200px; font-size: 14px; margin-left: 10px;\"> <a href=\"http://jtgj.cc/Areas/GoldendaysModule/Content/jikan1/page.html\" target=\"_blank\"> <img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/yuedu.png\"> 马上阅读 </a><br>\r\n            <a href=\"http://jtgj.cc/Areas/GoldendaysModule/Content/jikan1/金天季刊第一期.rar\" target=\"_blank\"> <img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/xiazai.png\"> 点击下载 </a><br>\r\n            《金天季刊》<br>\r\n            ——第一期 </div>\r\n        </div>\r\n        <img src=\"http://jtgj.cc/Areas/GoldendaysModule/Content/images/jikanfg.jpg\"> ', 'cn');
INSERT INTO `page` VALUES ('7', '企业之歌', '<div style=\"margin-top: 20px; text-align: center;\">\r\n          <p> 头顶旭日的阳光 迈开坚定的步伐<br>\r\n            走在金子铺就的大道上 我们内心充满激情充满爱<br>\r\n            我是年轻 快乐 活力四射的金天人 </p>\r\n          <p> 皑皑雪山上 雪莲闪耀璀璨星光<br>\r\n            神奇的生命之花 毅然绽放<br>\r\n            崭新的世界 在金天辉煌<br>\r\n            让生命充满活力 </p>\r\n          <p> 养青春之源 保活力之根<br>\r\n            和谐千万家的信念 不可阻挡<br>\r\n            炯炯的目光 指引着前进的方向<br>\r\n            放飞梦想 让它自由的飞翔<br>\r\n            自由的飞翔 </p>\r\n          <p> 与时俱进 拼搏进取 信念成就未来<br>\r\n            扬中医之魂 振民族之威<br>\r\n            开拓创新 诚信务实<br>\r\n            助力伟大的中国梦 </p>\r\n          <p> 金天人充满力量 昂首阔步<br>\r\n            让生命充满活力 一切不可阻挡<br>\r\n            金天人播撒大爱 坚定不移<br>\r\n            大爱变得无疆<br>\r\n            我们是自豪的金天人<br>\r\n            金天更辉煌 </p>\r\n        </div>', 'cn');
INSERT INTO `page` VALUES ('8', '联系我们', '', 'cn');

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
-- Table structure for recycles
-- ----------------------------
DROP TABLE IF EXISTS `recycles`;
CREATE TABLE `recycles` (
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
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of recycles
-- ----------------------------

-- ----------------------------
-- Table structure for reply
-- ----------------------------
DROP TABLE IF EXISTS `reply`;
CREATE TABLE `reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reply
-- ----------------------------
INSERT INTO `reply` VALUES ('1', '测试1', '1223123123ddd');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slide
-- ----------------------------
INSERT INTO `slide` VALUES ('1', '1', '99', 'xvoZXNlP5KBW9AkOIV36IClqbHjWm3bg6NjkeM67.jpeg', '1', null);
INSERT INTO `slide` VALUES ('2', '2', '99', 'vsGjpD1tZJk3DfVmmfGWnfTkf2gpDBlGT9cG6Zde.jpeg', '1', null);

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
  `status` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'boge', '563960993@qq.com', '$2y$10$J21hdKoQTeu1BWbpB.oZ7e90v8de1lcmbPyRw3oS3ozFlyZbH.9SO', 'pt87dxRjglI2obNeTNqAzezgku5w7dr43nYn9bBMiMGYrFJnpLJYS3BwECYb', '2017-06-20 01:55:31', '2017-06-20 01:55:31', '1');

-- ----------------------------
-- Table structure for wechatmenu
-- ----------------------------
DROP TABLE IF EXISTS `wechatmenu`;
CREATE TABLE `wechatmenu` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `pid` int(20) DEFAULT '0',
  `sort` int(255) DEFAULT '80',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wechatmenu
-- ----------------------------

-- ----------------------------
-- Table structure for wechatmessage
-- ----------------------------
DROP TABLE IF EXISTS `wechatmessage`;
CREATE TABLE `wechatmessage` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `OpenID` varchar(255) NOT NULL,
  `content` mediumtext,
  `time` int(50) DEFAULT NULL,
  `MsgId` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `recontent` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wechatmessage
-- ----------------------------
INSERT INTO `wechatmessage` VALUES ('2', 'oE9NywJw0oSfxN03wPyjqd8rWVfA', '/::)', '1503384008', '6456985148104134758', 'A0灵璧小伙子', null);
