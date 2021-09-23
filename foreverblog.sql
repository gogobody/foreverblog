/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : foreverblog

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 31/08/2020 09:59:31

 TODO 部署完毕后，后台地址：http://yourdomain.com/admin
 默认账号：admin
 密码：123456
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
BEGIN;
INSERT INTO `admin_menu` VALUES (1, 0, 1, '仪表盘', 'fa-bar-chart', '/', NULL, NULL, '2019-11-26 01:00:37');
INSERT INTO `admin_menu` VALUES (2, 0, 11, '权限管理', 'fa-tasks', NULL, NULL, NULL, '2020-08-31 09:57:53');
INSERT INTO `admin_menu` VALUES (3, 2, 12, '管理员', 'fa-users', 'auth/users', NULL, NULL, '2020-08-31 09:57:53');
INSERT INTO `admin_menu` VALUES (4, 2, 13, '角色', 'fa-user', 'auth/roles', NULL, NULL, '2020-08-31 09:57:53');
INSERT INTO `admin_menu` VALUES (5, 2, 14, '权限', 'fa-ban', 'auth/permissions', NULL, NULL, '2020-08-31 09:57:53');
INSERT INTO `admin_menu` VALUES (6, 2, 15, '菜单', 'fa-bars', 'auth/menu', NULL, NULL, '2020-08-31 09:57:53');
INSERT INTO `admin_menu` VALUES (7, 2, 16, '操作日志', 'fa-history', 'auth/logs', NULL, NULL, '2020-08-31 09:57:53');
INSERT INTO `admin_menu` VALUES (8, 0, 4, '博客管理', 'fa-bars', 'blogs', NULL, '2019-11-26 03:00:06', '2019-12-06 22:52:37');
INSERT INTO `admin_menu` VALUES (9, 0, 3, '文章管理', 'fa-file-text-o', 'articles', NULL, '2019-11-26 07:45:26', '2019-12-06 22:52:37');
INSERT INTO `admin_menu` VALUES (10, 0, 6, '大事记管理', 'fa-list-alt', 'datelines', NULL, '2019-11-26 12:05:54', '2019-12-06 22:52:37');
INSERT INTO `admin_menu` VALUES (11, 0, 5, '评论管理', 'fa-comments-o', 'comments', NULL, '2019-11-26 13:16:05', '2019-11-26 13:16:10');
INSERT INTO `admin_menu` VALUES (12, 0, 9, '系统设置', 'fa-cog', 'settings', NULL, '2019-11-27 02:47:43', '2019-12-13 16:40:42');
INSERT INTO `admin_menu` VALUES (13, 0, 7, '页面管理', 'fa-pagelines', 'pages', NULL, '2019-11-30 16:38:00', '2019-12-06 22:52:37');
INSERT INTO `admin_menu` VALUES (14, 0, 2, '公告管理', 'fa-align-justify', 'notices', NULL, '2019-12-06 22:52:08', '2019-12-06 22:52:37');
INSERT INTO `admin_menu` VALUES (15, 0, 8, '手动检测', 'fa-calendar-check-o', 'check', NULL, '2019-12-13 16:40:31', '2019-12-13 16:40:42');
INSERT INTO `admin_menu` VALUES (16, 0, 10, '媒体管理', 'fa-file', 'media', NULL, '2020-08-31 09:54:52', '2020-08-31 09:57:53');
COMMIT;

-- ----------------------------
-- Table structure for admin_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `admin_operation_log`;
CREATE TABLE `admin_operation_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `admin_operation_log_user_id_index` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `admin_permissions_name_unique` (`name`) USING BTREE,
  UNIQUE KEY `admin_permissions_slug_unique` (`slug`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
BEGIN;
INSERT INTO `admin_permissions` VALUES (1, '所有权限', '*', '', '*', NULL, '2019-12-10 18:01:54');
INSERT INTO `admin_permissions` VALUES (2, '仪表盘', 'dashboard', 'GET', '/', NULL, '2019-12-10 18:01:05');
INSERT INTO `admin_permissions` VALUES (3, '登录', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, '2019-12-10 18:01:18');
INSERT INTO `admin_permissions` VALUES (4, '管理员设置', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, '2019-12-10 18:01:31');
INSERT INTO `admin_permissions` VALUES (5, '权限管理', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, '2019-12-10 18:01:43');
INSERT INTO `admin_permissions` VALUES (6, '公告管理', 'notices', '', '/notices*', '2019-12-10 17:39:04', '2019-12-10 17:50:02');
INSERT INTO `admin_permissions` VALUES (7, '文章管理', 'articles', '', '/articles*', '2019-12-10 17:50:35', '2019-12-10 17:50:35');
INSERT INTO `admin_permissions` VALUES (8, '博客管理', 'blogs', '', '/blogs*', '2019-12-10 17:51:01', '2019-12-10 17:51:01');
INSERT INTO `admin_permissions` VALUES (9, '评论管理', 'comments', '', '/comments*', '2019-12-10 17:51:18', '2019-12-10 17:51:18');
INSERT INTO `admin_permissions` VALUES (10, '大事记管理', 'datelines', '', '/datelines*', '2019-12-10 17:51:35', '2019-12-10 17:51:35');
INSERT INTO `admin_permissions` VALUES (11, '页面管理', 'pages', '', '/pages*', '2019-12-10 17:51:54', '2019-12-10 17:51:54');
INSERT INTO `admin_permissions` VALUES (12, '系统设置', 'settings', '', '/settings*', '2019-12-10 18:02:51', '2019-12-10 18:02:59');
INSERT INTO `admin_permissions` VALUES (13, '手动检测', 'check', '', '/check*', '2020-04-26 16:54:52', '2020-04-26 16:55:00');
INSERT INTO `admin_permissions` VALUES (14, '媒体管理', 'ext.media-manager', '', '/media*', '2020-08-31 09:54:52', '2020-08-31 09:56:59');
COMMIT;

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------
BEGIN;
INSERT INTO `admin_role_menu` VALUES (1, 2, NULL, NULL);
INSERT INTO `admin_role_menu` VALUES (1, 12, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for admin_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_permissions`;
CREATE TABLE `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of admin_role_permissions
-- ----------------------------
BEGIN;
INSERT INTO `admin_role_permissions` VALUES (1, 1, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (3, 3, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (3, 2, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (3, 6, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (3, 4, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (3, 7, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (3, 8, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (3, 9, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (3, 10, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (3, 11, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for admin_role_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_users`;
CREATE TABLE `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of admin_role_users
-- ----------------------------
BEGIN;
INSERT INTO `admin_role_users` VALUES (1, 1, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `admin_roles_name_unique` (`name`) USING BTREE,
  UNIQUE KEY `admin_roles_slug_unique` (`slug`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of admin_roles
-- ----------------------------
BEGIN;
INSERT INTO `admin_roles` VALUES (1, 'Administrator', 'administrator', '2019-11-25 08:06:57', '2019-11-25 08:06:57');
INSERT INTO `admin_roles` VALUES (3, 'Admin', 'admin', '2019-12-10 17:43:26', '2019-12-10 17:43:26');
COMMIT;

-- ----------------------------
-- Table structure for admin_user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_permissions`;
CREATE TABLE `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of admin_user_permissions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `admin_users_username_unique` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
BEGIN;
INSERT INTO `admin_users` VALUES (1, 'admin@admin.cn', 'admin', '$2y$10$cLxXb1NYGK2nY7PoyWnmyu0bBgnu8GDNbsfO1XxT6TnajKMRocr.O', '十年之约项目组', NULL, 'llzMo7dNGLhKQmJEJuwNXgeXxFDPpQPbLhqineEh2c2hsCW7e7hgv3350zgS', '2019-11-25 08:06:57', '2020-08-19 11:33:00');
COMMIT;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '发布人名称',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '发布人email',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `is_comment` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否开启评论:1=开启,0=关闭',
  `type` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '类型:notice=公告,article=文章,page=单页',
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '页面标识，用于单页链接',
  `read_num` int(11) NOT NULL DEFAULT '0' COMMENT '阅读数量',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT COMMENT='文章表';

-- ----------------------------
-- Records of article
-- ----------------------------
BEGIN;
INSERT INTO `article` VALUES (1, 'System', 'admin@foreverblog.cn', '关于', '<p>这是一个记录十年之约的网站，所以，这个网站会存在十年或者更久。</p><!--more--><p>1.何为十年之约？</p><blockquote><p>即从加入这个活动起，我们的博客10年不关闭或者更久，保持更新和活力。</p></blockquote><p>2.如何加入这个活动?</p><blockquote><p>确认您已经阅读过<a href=\"https://www.foreverblog.cn/usr/uploads/2018/08/1809571569.pdf\">《十年公约》</a>，并且您即将提交的站点符合所述的要求。博客提交：<a href=\"https://www.foreverblog.cn/treaty.html\">点这里</a> ,我们会在审核后完成添加。</p></blockquote><p>3.加入后会怎样？</p><blockquote><p>我们会跟踪记录你的博客这10年的大事记，主要会记录你博客的死亡时间。</p></blockquote><p>4.这个项目有何意义？</p><blockquote><p>把博客从爱好变成一种习惯，坚持10年，是一项很有意义的活动，我们希望更多的博主加入！</p></blockquote><p>5.这个项目谁在维护？</p><blockquote><p>目前由<a href=\"https://www.1000yun.cn/\">雨落泪尽</a>，<a href=\"https://www.artisanbox.org/zh/\">工匠盒子</a>、<a href=\"https://tunanshan.com/\">图南山</a>、<a href=\"http://qq52o.me\">沈唁志</a>以及<a href=\"http://yyjn.org\" target=\"_blank\">羽忆江南</a>维护，<a href=\"http://www.52bz.la\">皮皮赖</a>、<a href=\"http://www.5ibug.net\">吾爱bug</a>、<a href=\"http://wispx.cn\">Wisp X</a>提供技术支持！我们希望更多的人加入维护，有兴趣请联系我们！</p></blockquote><p><b><u>6.十年之约博客专属标识(</u></b><a href=\"http://lastone.art\" target=\"_blank\">一稿计划</a>设计.<b><u>)</u></b></p><blockquote><p><img src=\"data:image/jpeg;base64,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\" data-filename=\"21E4D04A-E59E-4E54-988A-718F544AE872.jpeg\" style=\"width: 249px;\"><br></p></blockquote><p><b><u>您可在适当位置添加以下代码！</u></b></p><p>代码：</p><p><span style=\"-webkit-text-size-adjust: 100%;\">&lt;a href=\"https://www.foreverblog.cn/\" target=\"_blank\" &gt; &lt;img src=\"https://img.foreverblog.cn/logo_en_default.png\" alt=\"\" style=\"width:auto;height:16px;\"&gt; &lt;/a&gt;</span></p>', 1, 'page', 'about', 6381, '2020-08-19 10:06:37', '2017-11-06 05:48:00');
INSERT INTO `article` VALUES (2, 'System', 'admin@foreverblog.cn', '捐赠', '<p>十年之约是一个非盈利项目，项目运营均依赖各种形式的捐赠，若您想帮助这样一个活动更好的走下去，您可以通过邮件联系我们：admin#foreverblog.cn(用@替换#)</p><p>捐赠形式包括但不限于:转账、实物奖品、虚拟奖品！</p><p>转账可通过支付宝、微信、QQ等方式，暂不支持虚拟币，转账资金用于服务器、域名以及其它运营支出；实物、虚拟奖品作为十年之约活动的奖品。</p><blockquote><p><img src=\"https://www.foreverblog.cn/usr/uploads/2018/12/1804036207.png\" alt=\"3687764522.png\" title=\"3687764522.png\"><br>请用QQ，微信，支付宝扫码</p></blockquote>', 1, 'page', 'donate', 6314, '2020-08-19 13:10:17', '2018-05-19 12:19:00');
INSERT INTO `article` VALUES (3, 'System', 'admin@foreverblog.cn', '留言', '<p style=\"margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline;\">十年博客用户:</p><p style=\"margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline;\">有什么问题请在下方留言，不要再在群里发，信息不太集中，有些容易遗忘。</p><p style=\"margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline;\"><b><u>留言时请附上你的详细需求，若要更改博客信息，请在你的博客大事记页面留言！</u></b></p><p style=\"margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline;\">若有需要，也可发送邮件至官方邮箱：admin#foreverblog.cn（用@替换#）</p>', 1, 'page', 'message', 13816, '2020-08-19 10:06:59', '2018-02-28 16:18:00');
INSERT INTO `article` VALUES (4, 'System', 'admin@foreverblog.cn', '条约', '<pre><code>（2020年8月16日第三次修订）试行\r\n</code></pre><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\"><span style=\"box-sizing: inherit; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">在您加入“十年之约”之前，请承诺您会仔细阅读并遵守如下条文中的规定和要求。</span></p><blockquote style=\"box-sizing: inherit; margin-bottom: 0px; padding: 4px; border-width: 0px 0px 0px 2px; border-top-style: initial; border-right-style: initial; border-bottom-style: initial; border-top-color: initial; border-right-color: initial; border-bottom-color: initial; border-left-color: rgb(32, 155, 254); border-image: initial; font-style: italic; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; quotes: none; margin-block-start: 0px; margin-block-end: 0px; margin-inline-start: 0px; margin-inline-end: 0px; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\"><p style=\"box-sizing: inherit; margin-right: 2px; margin-left: 2px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">第一条  总则<br style=\"box-sizing: inherit;\"></p></blockquote><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">“十年之约”是由“十年之约”项目组维护的非营利性、自愿加入的博客活动。加入“十 年之约”可锻炼您的写作能力，进而提升您的思考、观察、记录、分享等能力，是 一项非常有意义的活动。“十年之约”的宗旨是：我们的博客十年不关闭或者更久， 并保持更新和活力。</p><blockquote style=\"box-sizing: inherit; margin-bottom: 0px; padding: 4px; border-width: 0px 0px 0px 2px; border-top-style: initial; border-right-style: initial; border-bottom-style: initial; border-top-color: initial; border-right-color: initial; border-bottom-color: initial; border-left-color: rgb(32, 155, 254); border-image: initial; font-style: italic; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; quotes: none; margin-block-start: 0px; margin-block-end: 0px; margin-inline-start: 0px; margin-inline-end: 0px; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\"><p style=\"box-sizing: inherit; margin-right: 2px; margin-left: 2px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">第二条  加入“十年之约”， 须同时满足如下条件<br style=\"box-sizing: inherit;\"></p></blockquote><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（一）  加入“十年之约”的博客，需具有独立的域名，域名的注册和使用符合ICANN 的要求。谢绝免费域名（如 tk、ml、ga 等），谢绝二级域名（如 co.cc，但com.cn 类型的除外）。如果您的博客正在使用二级域名，您必须拥有该二级域名对应主域名的所有权。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（二）  备案要求：加入“十年之约”的博客不限制是否备案。如果您的博客已备案，需保证您的备案信息为您个人的真实信息，且域名所有人与备案信息一致，并按工信部和公安机关的要求在博客页脚标注备案号。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（三）  内容要求：</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">生活记录类：加入“十年之约”的生活记录类博客，原则上需已建立 一年及以上，并已有15篇及以上的文章，其中原创文章占 75%以上。博客不得含有违反中国大陆相关法律法规的内容。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">学习记录类：加入“十年之约”的学习记录类博客，原则上需已建立 一年及以上，并已有30篇及以上的文章，其中原创文章占 60%以上。博客不得含有违反中国大陆相关法律法规的内容。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（四）  优秀文章展示：凡加入十年之约的用户，可在加入满一年及以上向项目组申请站点加入十年之约RSS订阅地址：（http://rss.foreverblog.cn/）。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（五）  博客内容版权：加入“十年之约”的博客，博主需对其博客内容拥有全部版权。对于转载、引用的博文或片段，符合原作者的版权要求。其博客使用的程序、主题、框架等，在博客页脚或站内相关页面有明确的版权声明。对产生版权纠纷的博客，我们会将其进行违约处理。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\"> （六）  不允许加入“十年之约”的博客：（1）非博客类型的网站；（2）宣扬暴力、血腥、战争、歧视等；（3）涉及黑产、灰产，传播淫秽色情，以及存在为涉及此类内容的网站打广告的情形；（4）纯采集、纯转载类、纯搬运类；（5）造谣、传播谣言；（6）含有诽谤他人、无端对他人进行人身攻击等侵犯他人权利的内容；（7）含有其他违反中国法律法规和地方性行政规定的内容。</p><blockquote style=\"box-sizing: inherit; margin-bottom: 0px; padding: 4px; border-width: 0px 0px 0px 2px; border-top-style: initial; border-right-style: initial; border-bottom-style: initial; border-top-color: initial; border-right-color: initial; border-bottom-color: initial; border-left-color: rgb(32, 155, 254); border-image: initial; font-style: italic; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; quotes: none; margin-block-start: 0px; margin-block-end: 0px; margin-inline-start: 0px; margin-inline-end: 0px; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\"><p style=\"box-sizing: inherit; margin-right: 2px; margin-left: 2px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">第三条  加入“十年之约”的方法<br style=\"box-sizing: inherit;\"></p></blockquote><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（一）  在“十年之约”官方网站按要求如实提交您的资料，项目组 将按第二条审核您的申请，并通过邮箱发送申请结果。</p><blockquote style=\"box-sizing: inherit; margin-bottom: 0px; padding: 4px; border-width: 0px 0px 0px 2px; border-top-style: initial; border-right-style: initial; border-bottom-style: initial; border-top-color: initial; border-right-color: initial; border-bottom-color: initial; border-left-color: rgb(32, 155, 254); border-image: initial; font-style: italic; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; quotes: none; margin-block-start: 0px; margin-block-end: 0px; margin-inline-start: 0px; margin-inline-end: 0px; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\"><p style=\"box-sizing: inherit; margin-right: 2px; margin-left: 2px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">第四条  审核人员要求<br style=\"box-sizing: inherit;\"></p></blockquote><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（一）  当用户提交后，审核人员会在15个工作日内对内容进行审核，由于一些不确定因素，最长不超过30个工作日。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（二）  当用户信息发生变更或修改时，审核人员会在10-30个工作日进行处理，信息修改请移步个人专属页面留言。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（三）  审核人员在审核时，如果肆意将公约内不强制要求的条件视为重要条件，或将不具有优先级的条件作为优先条件，或将不符合公约要求的博客以包括但不限于“已备案”、“使用.cn域名”等条件将其审核通过的，或故意引导博主注册特定域名后缀、在特定注册商注册、在特定地区注册等情况，将被逐出审核人员队伍，永不录用，情节严重的将对其个人博客标记违约处理。</p><blockquote style=\"box-sizing: inherit; margin-bottom: 0px; padding: 4px; border-width: 0px 0px 0px 2px; border-top-style: initial; border-right-style: initial; border-bottom-style: initial; border-top-color: initial; border-right-color: initial; border-bottom-color: initial; border-left-color: rgb(32, 155, 254); border-image: initial; font-style: italic; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; quotes: none; margin-block-start: 0px; margin-block-end: 0px; margin-inline-start: 0px; margin-inline-end: 0px; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\"><p style=\"box-sizing: inherit; margin-right: 2px; margin-left: 2px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">第五条  加入“十年之约”后，您享受的权利<br style=\"box-sizing: inherit;\"></p></blockquote><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（一）  您可邀请他人加入“十年之约”，但被邀请的博客需满足第二条的要求。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（二）  在必要的情况下，您可自由退出“十年之约”，但退出前需向项目组提交申请说明退出理由</p><blockquote style=\"box-sizing: inherit; margin-bottom: 0px; padding: 4px; border-width: 0px 0px 0px 2px; border-top-style: initial; border-right-style: initial; border-bottom-style: initial; border-top-color: initial; border-right-color: initial; border-bottom-color: initial; border-left-color: rgb(32, 155, 254); border-image: initial; font-style: italic; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; quotes: none; margin-block-start: 0px; margin-block-end: 0px; margin-inline-start: 0px; margin-inline-end: 0px; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\"><p style=\"box-sizing: inherit; margin-right: 2px; margin-left: 2px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">第六条  违规判断及处理</p></blockquote><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（一）  博客停止更新长达6个月及以上的，项目组会以邮件形式联系博主确认是否还在维护，若已确认不再维护或项目组邮件发出的一个月内没有回复，则记录违约；</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（二）  博客在三个月内连续水文或发布无营养内容超过10篇，项目组会以邮件形式进行提示，如未做出修改的标记违约；</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（三）  博客若出现删库或长时间无法打开长达7个自然日，未向项目组申报或记录违约长达30天的，按原公约进行申请；</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（四）  博客类型发生变更（包括但不限于纯搬运、采集、广告、下载、影视、博彩、信贷、金融等具有商业性质或违法性质内容），或不再符合个人独立博客类型的，记录违约;</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（五）  标记违约后的30天内，若博客整改至符合十年公约要求，可发送邮件至项目组邮箱申请恢复，项目组将于收到申请后评议是否予以恢复，并将结果通过邮件反馈。标记违约后仅受理一次恢复申请，且标记违约超过30天的博客将不再接受恢复申请。</p><blockquote style=\"box-sizing: inherit; margin-bottom: 0px; padding: 4px; border-width: 0px 0px 0px 2px; border-top-style: initial; border-right-style: initial; border-bottom-style: initial; border-top-color: initial; border-right-color: initial; border-bottom-color: initial; border-left-color: rgb(32, 155, 254); border-image: initial; font-style: italic; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; quotes: none; margin-block-start: 0px; margin-block-end: 0px; margin-inline-start: 0px; margin-inline-end: 0px; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">第七条  隐私条款</blockquote><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（一）  加入“十年之约”后，您提供的邮箱需要支持 Gravatar 头像，该头像将用于在“十年之约”官方网站上公开展示。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（二）  加入“十年之约”后，同意“十年之约”官方网站抓取您博客的 RSS 并在官网公开展示。该功能用于展示各位博友的最近更新，便于其他成员访问。若您不希望“十年之约”展示您的最近更新，可向项目组说明。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（三）  加入“十年之约”后，同意“十年之约”官方网站记录您的昵称、电子邮箱、博客描述、博客关键词等信息，项目组承诺会对您的电子邮箱等隐私信息进行严格保密，如有其他信息需要保密，可向项目组说明。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（四）  加入“十年之约”后，如您的博客提前关闭，同意“十年之约”项目组记录您博客的关闭时间，并在官网公示。</p><blockquote style=\"box-sizing: inherit; margin-bottom: 0px; padding: 4px; border-width: 0px 0px 0px 2px; border-top-style: initial; border-right-style: initial; border-bottom-style: initial; border-top-color: initial; border-right-color: initial; border-bottom-color: initial; border-left-color: rgb(32, 155, 254); border-image: initial; font-style: italic; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; quotes: none; margin-block-start: 0px; margin-block-end: 0px; margin-inline-start: 0px; margin-inline-end: 0px; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\"><p style=\"box-sizing: inherit; margin-right: 2px; margin-left: 2px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\"> 第八条  “十年之约”项目组倡导之博友精神<br style=\"box-sizing: inherit;\"></p></blockquote><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（一）  守法。“十年之约”成员的博客建立、维护均遵守相关的法律法规。如果博客在境内主机建立，则经过合法的 ICP 备案且信息真实有效。如果博客在境外主机建立，则符合主机所在地有关法律法规的要求。博客所使用的域名和主机会及时续费。尊重他人知识产权和版权，未经原作者授权，不转发、转卖、转赠、公开分享他人的知识产物（包括但不限于付费的模板、插件、文章、图片、源码等）。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（二）  平等。无论“十年之约”的成员来自哪里、是男性还是女性、年龄大小、工作类型、使用的是什么域名和主机、主机在境外还是境内、主机和域名的价格高低、文笔好坏、更新频率快或慢等，均人人平等。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（三）  互访。“十年之约”的成员间，会经常对博客进行互访，常来常往。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（四）  互助。“十年之约”的成员如发生博客故障、域名解析失败、主机问题、被垃圾评论攻击等，其他成员会在自己能力范围内予以一定的帮助，如有特殊要求，可付费帮助。但提问者必须独立思考，事先利用官方网站帮助页面、搜索引擎等查找资料并尝试解决问题。如遇到不自行查找资料，直接提问的成员，其他成员有权拒绝提供帮助。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（五）  互敬。“十年之约”的成员会尊重其他成员的工作性质、个人习惯、宗教信仰等。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（六）  活力。“十年之约”的成员，拥有写博的热情，保持博客的活力。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">（七）  真诚。“十年之约”的成员，真诚对待其他成员，在博客留言时，不说谎话、假话 、套话，不 留 虚 假 信 息 欺 骗 他 人 （ 如 将 邮 箱 写 成 qq@qq.com 或admin@qq.com），不留无意义的和垃圾评论（如仅仅写“学习了”或提交无关评论）。如对其博文观点有异议，可以在遵守所有博友精神的基础上展开辩论，但不得进行人身攻击、诽谤造谣等违法行为。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\"><br style=\"box-sizing: inherit;\"></p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">十年之约项目组有制定、修改与解释本公约的权利，本公约内容如有变更，将在官网通知，如有异议，请联系项目组。</p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\"><br style=\"box-sizing: inherit;\"></p><p style=\"box-sizing: inherit; margin-right: 2px; margin-bottom: 0px; margin-left: 2px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18.6667px; line-height: inherit; font-family: Lato, sans-serif; vertical-align: baseline; color: rgb(124, 128, 129); letter-spacing: 0.466667px;\">本“公约”自 2020 年 8 月 16 日起试行。</p><br><a href=\"/join.html\"><div style=\"background-color: #8ca8c5;color: #fff;text-align: center;\">您已完全理解并同意遵守以上条款，点我申请。</div></a>', 1, 'page', 'treaty', 21195, '2020-08-19 13:10:19', '2018-08-29 03:40:00');
COMMIT;

-- ----------------------------
-- Table structure for blog
-- ----------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '链接',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '寄语',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态值:0=审核中,1=正常,2=未通过,3=疑似异常,4=异常',
  `is_comment` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否允许评论,1=允许,0=不允许',
  `history` text COLLATE utf8mb4_unicode_ci COMMENT '博客历史事件',
  `views` int(11) DEFAULT '0' COMMENT '阅读量',
  `slug` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Slug',
  `is_notify` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已发送审核结果通知，1=已发送，0=未发送',
  `abnormal_num` int(11) NOT NULL DEFAULT '0' COMMENT '异常次数',
  `abnormal_at` int(11) DEFAULT '0' COMMENT '上次异常时间',
  `adopted_at` timestamp NULL DEFAULT NULL COMMENT '通过时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT COMMENT='博客表';

ALTER TABLE `blog` ADD COLUMN `feed_link` varchar(255) NULL COMMENT 'rss地址' after `link`;
ALTER TABLE `blog` ADD COLUMN `feed_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态值:0=未填写,1=正常,2=抓取异常,3=未检测';

-- ----------------------------
-- Records of blog
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for feed
-- ----------------------------
DROP TABLE IF EXISTS `feed`;
CREATE TABLE `feed` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `blog_id` int(11) NOT NULL DEFAULT '0' COMMENT '外键ID',
    `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
    `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '作者',
    `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '链接',
    `desc` text COLLATE utf8mb4_unicode_ci COMMENT '描述',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '上级评论ID',
  `reply_id` int(11) DEFAULT '0' COMMENT '回复评论ID',
  `foreign_id` int(11) NOT NULL COMMENT '外键ID',
  `type` enum('article','blog') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型:article=文章,blog=博客',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '邮箱',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '链接',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '评论内容',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '来源:0=普通用户,1=管理员',
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '状态:0=违规,1=正常,2=审核中',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT COMMENT='评论表';

-- ----------------------------
-- Records of comment
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置名',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '配置值',
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '配置说明',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of config
-- ----------------------------
BEGIN;
INSERT INTO `config` VALUES (1, 'review_comment', '1', '评论是否需要审核');
INSERT INTO `config` VALUES (2, 'close_apply', '0', '是否关闭申请，1=是，0=否');
INSERT INTO `config` VALUES (3, 'auto_detection', '0', '是否开启自动检测，1=是，0=否');
INSERT INTO `config` VALUES (4, 'auto_writing_dateline', '0', '自动检测到异常后是否自动写入大事记，1=是，0=否');
INSERT INTO `config` VALUES (5, 'auto_writing_period', '2', '自动检测周期(小时)');
INSERT INTO `config` VALUES (6, 'max_abnormal_num', '3', '最大异常次数');
COMMIT;

-- ----------------------------
-- Table structure for dateline
-- ----------------------------
DROP TABLE IF EXISTS `dateline`;
CREATE TABLE `dateline` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `blog_id` int(11) NOT NULL DEFAULT '0' COMMENT '博客ID',
  `date` timestamp NULL DEFAULT NULL COMMENT '时间',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态,0=审核中,1=审核通过,2=审核不通过',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT COMMENT='博客时间线表';

-- ----------------------------
-- Records of dateline
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2016_01_04_173148_create_admin_tables', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
