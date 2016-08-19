/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Version : 50709
 Source Host           : localhost
 Source Database       : feiadmin

 Target Server Version : 50709
 File Encoding         : utf-8

 Date: 04/28/2016 15:13:53 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `branch` tinyint(4) NOT NULL DEFAULT '1' COMMENT '管理部门',
  `work_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '在职状态：1在职2离职3暂停',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT COMMENT='管理员';

-- ----------------------------
--  Records of `admin_user`
-- ----------------------------
BEGIN;
INSERT INTO `admin_user` VALUES ('1', 'admin', '', '$2y$13$nRTt9./F7XQzJrzL7RIEGOGxTrAucZNGRVBcVDvb6JXbhc7ebEz4a', null, 'a@a.com', '10', '1461198606', '1461198606', '9', '1'), ('2', 'test', '', '$2y$13$jwlWgEcq5OHE.hZFYbUDBunX.F4.T3u4.HC6V8N1/5gMLOZfM96BC', null, 'b@a.com', '10', '1461802688', '1461802688', '9', '1');
COMMIT;

-- ----------------------------
--  Table structure for `album`
-- ----------------------------
DROP TABLE IF EXISTS `album`;
CREATE TABLE `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '名称',
  `des` text NOT NULL COMMENT '描述',
  `category_id` int(11) NOT NULL COMMENT '分类1、旅行 2、生活',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态1显示 2隐藏',
  `create_at` datetime NOT NULL COMMENT '创建时间',
  `update_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='相册';

-- ----------------------------
--  Records of `album`
-- ----------------------------
BEGIN;
INSERT INTO `album` VALUES ('1', '太湖旅行', '太湖旅行', '1', '1', '2016-04-24 13:34:15', '2016-04-24 13:34:15'), ('2', '上海旅行', '', '1', '1', '2016-04-24 13:36:36', '2016-04-24 13:36:36');
COMMIT;

-- ----------------------------
--  Table structure for `auth_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `auth_assignment`
-- ----------------------------
BEGIN;
INSERT INTO `auth_assignment` VALUES ('超级管理员', '1', '1461724404');
COMMIT;

-- ----------------------------
--  Table structure for `auth_item`
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `auth_item`
-- ----------------------------
BEGIN;
INSERT INTO `auth_item` VALUES ('/admin-user/*', '2', null, null, null, '1461726243', '1461726243'), ('/admin/*', '2', null, null, null, '1461726442', '1461726442'), ('/album/*', '2', null, null, null, '1461725989', '1461725989'), ('/dd/*', '2', null, null, null, '1461726348', '1461726348'), ('/gallery/*', '2', null, null, null, '1461725996', '1461725996'), ('/post-comment/*', '2', null, null, null, '1461822827', '1461822827'), ('/post/*', '2', null, null, null, '1461724369', '1461724369'), ('/systemconfig/*', '2', null, null, null, '1461726353', '1461726353'), ('/tool/*', '2', null, null, null, '1461726160', '1461726160'), ('分配权限', '2', null, null, null, '1461726455', '1461726455'), ('后台用户', '2', null, null, null, '1461726259', '1461726259'), ('图片库', '2', null, null, null, '1461726043', '1461726043'), ('工具', '2', '上传、缓存', null, null, '1461726187', '1461726187'), ('文章', '2', null, null, null, '1461724310', '1461724310'), ('相册', '2', null, null, null, '1461726020', '1461726020'), ('系统配制', '2', null, null, null, '1461726332', '1461726332'), ('评论', '2', null, null, null, '1461822841', '1461822841'), ('超级管理员', '1', null, null, null, '1461724225', '1461724225');
COMMIT;

-- ----------------------------
--  Table structure for `auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `auth_item_child`
-- ----------------------------
BEGIN;
INSERT INTO `auth_item_child` VALUES ('后台用户', '/admin-user/*'), ('分配权限', '/admin/*'), ('相册', '/album/*'), ('系统配制', '/dd/*'), ('图片库', '/gallery/*'), ('评论', '/post-comment/*'), ('文章', '/post/*'), ('系统配制', '/systemconfig/*'), ('工具', '/tool/*'), ('超级管理员', '分配权限'), ('超级管理员', '后台用户'), ('超级管理员', '图片库'), ('超级管理员', '工具'), ('超级管理员', '文章'), ('超级管理员', '相册'), ('超级管理员', '系统配制'), ('超级管理员', '评论');
COMMIT;

-- ----------------------------
--  Table structure for `auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `dd`
-- ----------------------------
DROP TABLE IF EXISTS `dd`;
CREATE TABLE `dd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dd_name` varchar(50) NOT NULL COMMENT '名称',
  `table_name` varchar(50) NOT NULL COMMENT '数据表',
  `field_name` varchar(50) NOT NULL COMMENT '字段',
  `field_key` varchar(50) NOT NULL COMMENT '键值',
  `field_value` varchar(100) NOT NULL COMMENT '值',
  `num` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态：1启用、2停用 3 暂停',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='数据字典';

-- ----------------------------
--  Records of `dd`
-- ----------------------------
BEGIN;
INSERT INTO `dd` VALUES ('1', '配制参数-类型', 'systemconfig', 'type', 'website', '系统设置', '1', '1'), ('2', '配制参数-类型', 'systemconfig', 'type', 'mail', '邮件', '1', '1'), ('8', '配制参数-类型', 'systemconfig', 'type', 'page', '页面配制', '1', '1'), ('9', '数据字典-状态', 'dd', 'status', '1', '启用', '1', '1'), ('10', '数据字典-状态', 'dd', 'status', '2', '停用', '1', '1'), ('11', '数据字典-状态', 'dd', 'status', '3', '暂停', '1', '1'), ('12', '管理员-状态', 'adminuser', 'status', '1', '在职', '1', '1'), ('13', '管理员-状态', 'adminuser', 'status', '2', '离职', '1', '1'), ('14', '管理员-状态', 'adminuser', 'status', '3', '暂停', '1', '1'), ('15', '配制参数-类型', 'systemconfig', 'type', 'upyun', '又拍云配置', '1', '1'), ('16', '配制参数-类型', 'systemconfig', 'type', 'alipay', '支付配置-支付宝', '1', '1'), ('18', '配制参数-类型', 'systemconfig', 'type', 'qiniu', '七牛云存储配制', '1', '1'), ('19', '配制参数-类型', 'systemconfig', 'type', 'wechat', '支付配置-微信支付', '1', '1'), ('35', '配制参数-类型', 'systemconfig', 'type', 'system_secure', '系统安全token', '1', '1'), ('41', '管理员－部门', 'adminuser', 'branch', '1', '技术部', '1', '1'), ('43', '管理员－部门', 'adminuser', 'branch', '2', '运营部', '1', '1'), ('44', '管理员－部门', 'adminuser', 'branch', '3', '市场部', '1', '1'), ('45', '管理员－部门', 'adminuser', 'branch', '4', '总裁办', '1', '1'), ('46', '管理员－部门', 'adminuser', 'branch', '5', '人事部', '1', '1'), ('48', '配制参数-类型', 'systemconfig', 'type', 'friend_link', '友情链接', '1', '1'), ('49', '管理员－部门', 'adminuser', 'branch', '6', '财务部', '1', '1'), ('62', '管理员－部门', 'adminuser', 'branch', '7', '客服部', '1', '1'), ('63', '管理员－部门', 'adminuser', 'branch', '8', '师资部', '1', '1'), ('64', '管理员－部门', 'adminuser', 'branch', '9', '其它 ', '1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `gallery`
-- ----------------------------
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(255) NOT NULL COMMENT '图片地址',
  `img_url_thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `album_id` int(11) NOT NULL DEFAULT '1' COMMENT '相册ID ',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `desc` text NOT NULL COMMENT '描述',
  `is_page_img` tinyint(4) NOT NULL DEFAULT '1' COMMENT '封面图 1、否 2、是',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态1、显示 2隐藏',
  `create_at` datetime NOT NULL COMMENT '创建时间',
  `update_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='图像库';

-- ----------------------------
--  Table structure for `keyword`
-- ----------------------------
DROP TABLE IF EXISTS `keyword`;
CREATE TABLE `keyword` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态1启用 2暂停',
  `create_at` datetime NOT NULL COMMENT '创建时间',
  `update_at` datetime NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='非法关键词';

-- ----------------------------
--  Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `menu`
-- ----------------------------
BEGIN;
INSERT INTO `menu` VALUES ('1', 'post', null, null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `migration`
-- ----------------------------
BEGIN;
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', '1461722926');
COMMIT;

-- ----------------------------
--  Table structure for `post`
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `post_category_id` int(11) NOT NULL DEFAULT '1' COMMENT '分类',
  `desc` text NOT NULL COMMENT '描述',
  `content` mediumtext NOT NULL COMMENT '内容',
  `topic_img` varchar(255) NOT NULL COMMENT '特色图',
  `author` varchar(20) NOT NULL COMMENT '作者',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态1、草稿 2、发布 3、删除',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '阅读数',
  `create_at` datetime NOT NULL COMMENT '创建时间',
  `update_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 COMMENT='文章';

-- ----------------------------
--  Records of `post`
-- ----------------------------
BEGIN;
INSERT INTO `post` VALUES ('100', '关于', '99', '', '<p>李飞 &nbsp;@yidianling.com\r\n\r\n前685金融网CTO、八亿八医药技术经理。<a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/08/weixin.jpg\"><img class=\"alignnone size-medium wp-image-39\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/08/weixin-225x300.jpg\" alt=\"weixin\" width=\"225\" height=\"300\"/></a></p>', '', '', '1', '0', '2015-08-18 02:06:43', '2016-04-27 21:41:11'), ('113', '坚持blog', '1', '始于2007年写博客，期间也写过不少技术文章，停过几次。继续坚持blog,如果一件事坚持10年，20年，总会成功的。\r\n', '', '', '', '1', '0', '2015-08-18 02:00:36', '2016-04-24 02:00:36'), ('114', '如何同步文件到又拍云', '1', '需求：前端同学使用了又拍云静态资源,每次使用ftp进行上传，但有几个隐患，一是代码覆盖错了或者误删除非常危险，二是每次都要定位具体文件，操作非常不便。\r\n\r\n如是有下面解决方案，前端使用svn或者git管理，使用一个台测试同步这些资源，然后将资源同步到又拍云。', '<p>需求：前端同学使用了又拍云静态资源,每次使用ftp进行上传，但有几个隐患，一是代码覆盖错了或者误删除非常危险，二是每次都要定位具体文件，操作非常不便。\r\n\r\n如是有下面解决方案，前端使用svn或者git管理，使用一个台测试同步这些资源，然后将资源同步到又拍云。</p><!--more--><p>1、测试服务器git同步</p><pre>#!/bin/sh\r\ncd /var/www/test\r\ngit checkout dev\r\ngit pull</pre><p>可根据情况切换到哪个分支，例子这里是dev分支\r\n\r\n2、资源同步到又拍云</p><pre>#!/bin/bash\r\n\r\nHOST=&quot;v0.ftp.upyun.com&quot;\r\nUSER=&quot;test/test&quot;\r\nPASS=&quot;test&quot;\r\n\r\nLCD=&quot;/var/www/test&quot;\r\nRCD=&quot;/&quot;\r\nlftp -c &quot;open ftp://$HOST;\r\n\r\nuser $USER $PASS &amp;&amp; \\\r\nlcd $LCD &amp;&amp; \\\r\ncd $RCD &amp;&amp; \\\r\n\r\nmirror --reverse --delete --dereference --verbose \\\r\n--exclude-glob=*.svn/ \\\r\n--exclude-glob=*.DS_Store \\\r\n--exclude-glob=*.sh \\\r\n--exclude-glob=*.git/&quot;</pre><p>说明：USER为又拍云账号，PASS为密码。LCD 为本地目录，RCD为又拍云目录。特别注意的时候，如果又拍云/目录已经有资源了，同步的时候会删除里面的资源，建议RCD 为 /document 这样可以避免其它文件删除了。exclude-glob忽略不同步的文件或者目录。运行此代码最好是测试的又拍云账号，调试通了再换成正式账号。\r\n\r\n&nbsp;</p>', '', '', '1', '0', '2015-08-18 02:02:04', '2016-04-24 02:02:04'), ('115', 'mysql备份脚本', '1', 'mysql备份分:主要功能有备份多个数据库，将这几个数据库一起打包。只保留最近一星期的备份，结合ftp脚本可以传到另外一台服务器。', '<p>mysql备份分:主要功能有备份多个数据库，将这几个数据库一起打包。只保留最近一星期的备份，结合ftp脚本可以传到另外一台服务器。</p><!--more--><pre>#!/bin/bash\r\n\r\n# Use mysqldump --help get more detail.\r\n\r\n#\r\n# 定义变量，请根据具体情况修改\r\n# 定义脚本目录\r\nscriptsDir=`pwd`\r\n\r\n# 定义用于备份数据库的用户名和密码\r\nuser=root\r\nuserPWD=*********\r\n\r\n# 定义备份数据库名称  *** 代表数据名，用空格隔开\r\ndbNames=(*** ***)\r\n# 定义备份目录\r\ndataBackupDir=/var/mysqlfile\r\n\r\n# 定义邮件正文文件\r\neMailFile=$dataBackupDir/log/email.txt\r\n\r\n# 定义邮件地址\r\neMail=*****\r\n\r\n# 定义备份日志文件\r\nlogFile=$dataBackupDir/log/mysqlbackup.log\r\n\r\n# DATE=`date -I`\r\nDATE=`date  +%Y%m%d`\r\n\r\nWEEKDATE=`date -d &#39;-7 day&#39; +%Y%m%d`\r\n\r\necho `date  &quot;+%Y-%m-%d %H:%M:%S&quot;` &gt; $eMailFile\r\n\r\nfor dbName in ${dbNames[*]}\r\ndo\r\n        # 定义备份文件名\r\n        dumpFile=$dataBackupDir/$dbName-$DATE.sql.gz\r\n\r\n        # 使用mysqldump备份数据库，请根据具体情况设置参数\r\n        mysqldump -u$user -p$userPWD $dbName | gzip &gt; $dumpFile\r\n\r\ndone\r\n\r\n#文件打包\r\ncd $dataBackupDir\r\ntar -zcvf db.linode.$DATE.tar.gz  *$DATE.sql.gz\r\n#删除不是打包的文件,保留总的备份\r\nrm -f *$DATE.sql.gz\r\n\r\n\r\n#删除一星期前总的备份\r\nrm -f  db.linode.$WEEKDATE.tar.gz\r\n\r\nif [[ $? == 0 ]]; then\r\n        echo &quot;DataBase Backup Success!&quot; &gt;&gt; $eMailFile\r\nelse\r\n        echo &quot;DataBase Backup Fail!&quot; &gt;&gt; $emailFile\r\nfi\r\n\r\n# 写日志文件\r\necho &quot;================================&quot; &gt;&gt; $logFile\r\ncat $eMailFile &gt;&gt; $logFile\r\necho $dumpFile &gt;&gt; $logFile\r\n\r\n\r\n# 发送邮件通知\r\ncat $eMailFile | mail -s &quot;MySQL Backup&quot; $eMail</pre>', '', '', '1', '0', '2015-08-20 02:02:52', '2016-04-24 02:02:52'), ('116', 'keynote完美的流程图，mac的品质', '1', 'Keynote,多次在苹果大会发挥作用，大家都是做PPT的利器，绚丽的外表，他也是做流程图的好工具。这里不讨论OmniGraffle、Axure的对比，只能只想展示keynote的简洁与美。', '<p>Keynote,多次在苹果大会发挥作用，大家都是做PPT的利器，绚丽的外表，他也是做流程图的好工具。这里不讨论OmniGraffle、Axure的对比，只能只想展示keynote的简洁与美。\r\n\r\n先看效果图：一张购物车的流程，请忽略细节-_-<img class=\"aligncenter size-large wp-image-38\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/09/cart-752x1024.jpg\" alt=\"cart\" width=\"660\" height=\"899\"/></p><!--more--><p>虽然keynote用来作流程图比较方便，但为我所用，还是要稍微调整下。\r\n\r\n1、流程图有些比较大，而keynote每个页面大小是有限的，修改文稿，更改幻灯片大小；\r\n\r\n2、形状里自带的几个常用流程图图片，个人觉得图片太大，文字也无法很好的写入。所以调整图片的标签大小，此位置在右边&quot;文件&quot;，选中一个图片，调节字体大小的时候会出现“标签”更新，一点更新后，以后新加入的形状就固定了。\r\n\r\n3、如何画垂直剪头，感觉keynote太简了，为么不出一个可以双向的剪头或者垂直箭头，实现办法也是有的，用一个直线再加一个剪头，就完成了垂直的剪头做法\r\n\r\n小技巧：可以把做好的流程图存好，下次要用的时候复制一个出来，避免做重复工作，不要重复的造轮子是吧。\r\n\r\n附：设置帮助：<img class=\"aligncenter size-large wp-image-41\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/09/flow_help-1024x430.jpg\" alt=\"flow_help\" width=\"660\" height=\"277\"/></p>', '', '', '1', '0', '2015-09-30 02:03:37', '2016-04-24 02:03:37'), ('117', '2015年国庆5天骑车太湖行', '2', '国庆前计划去骑行，各个行程对比了，一，徽杭古道，行程稍短，但是玩过杭州十里琅珰的都知道，路线比较徒，而且自行车车胎容易爆，出发之前，前轮胎已经换了下，结果路上后胎还是爆了。二、千岛湖骑过，所以也不考虑，太湖景色不错，路程远，但是比较轻松，就定了太湖行。', '<p>国庆前计划去骑行，各个行程对比了，一，徽杭古道，行程稍短，但是玩过杭州十里琅珰的都知道，路线比较徒，而且自行车车胎容易爆，出发之前，前轮胎已经换了下，结果路上后胎还是爆了。二、千岛湖骑过，所以也不考虑，太湖景色不错，路程远，但是比较轻松，就定了太湖行。\r\n\r\n得益于手机App，我们出发前基本上就查了下百度地图，大致了解下路线，准备了几件衣服，就上路了。\r\n\r\n路线图：杭州-湖洲-长兴-常州-无锡-苏州-嘉兴-桐乡-余杭-杭州，全程大概400多公里。10.1出发，10.5回杭州，总体路线比较轻松。<img class=\"aligncenter size-large wp-image-53\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3557-576x1024.png\" alt=\"太湖行程\" width=\"576\" height=\"1024\"/></p><!--more--><p>10.1第一天早上6点出发，天气非常好，刚下完雨，非常凉爽，我骑到文二路和另外一个同事会和，路上开始下起了大雨，从早上6点到9点多，逆风，我们才骑了不到20公里，然后沿着运河一起向北，路上几乎没什么车，因为不是高速，有几段路是泥巴路，全身湿了，今后得出一个经验，鞋套还是要备一个的，因为鞋子湿了非常难受，路上换袜子都来不急。<a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3237.jpg\"><img class=\"aligncenter size-large wp-image-81\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3237-1024x1024.jpg\" alt=\"运湖路上\" width=\"660\" height=\"660\"/></a>当我们骑到太湖边-喜来登酒店，看到这么好的酒店就兴奋了，并且决定一路就这么奢侈干下去，马上点评下订单入住，虽然3000多元,中间为了升级高级房间，又加了300多元，进去后，服务果然好的。楼上有日本料理和酒吧，一楼是自助餐厅，国庆价400多元一位，自助餐厅海鲜有不少，红酒畅饮，有大闸蟹，人均2个，吃的完全撑不下。<a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3244.jpg\"><img class=\"aligncenter size-large wp-image-85\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3244-1024x1024.jpg\" alt=\"IMG_3244\" width=\"660\" height=\"660\"/></a><a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3250.jpg\"><img class=\"aligncenter size-large wp-image-90\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3250-1024x1024.jpg\" alt=\"IMG_3250\" width=\"660\" height=\"660\"/></a><a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3264.jpg\"><img class=\"aligncenter size-large wp-image-101\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3264-1024x1024.jpg\" alt=\"IMG_3264\" width=\"660\" height=\"660\"/></a><a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3262.jpg\"><img class=\"aligncenter size-large wp-image-99\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3262-1024x1024.jpg\" alt=\"IMG_3262\" width=\"660\" height=\"660\"/></a><a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3286.jpg\"><img class=\"aligncenter size-large wp-image-123\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3286-768x1024.jpg\" alt=\"IMG_3286\" width=\"660\" height=\"880\"/></a><a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3310.jpg\"><img class=\"aligncenter size-large wp-image-141\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3310-1024x1024.jpg\" alt=\"IMG_3310\" width=\"660\" height=\"660\"/></a><a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3334.jpg\"><img class=\"aligncenter size-large wp-image-163\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3334-1024x768.jpg\" alt=\"IMG_3334\" width=\"660\" height=\"495\"/></a>&nbsp;\r\n\r\n10.2第二天，早上起来又去大吃一顿，11点多退房，马上就开始环太湖了，只能说湖州太湖这边骑起来安静，我们骑到30公里/小时，事实上后面我们也有经验了，20公里/小时是最轻松的，太快没有用，后面还要休闲，实践中出真理呀。路上碰到很多骑行车队，上海的，苏州的，我们看他们慢慢，很得意，骑这么慢，-_-. 下午的时候，和上海暴走骑队，跟在他们后面，一路骑到无锡。到无锡的时候，我们就开始订喜来登酒店，居然全部订完了，最后住了个四星级的酒店，这家酒店说实话很差的，感觉3星都不到，为了第三天能顺利住到酒店，当天晚上了订了10.3苏州喜来登。<a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3377.jpg\"><img class=\"aligncenter size-large wp-image-195\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3377-1024x768.jpg\" alt=\"IMG_3377\" width=\"660\" height=\"495\"/></a><a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3369.jpg\"><img class=\"aligncenter size-large wp-image-189\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3369-1024x1024.jpg\" alt=\"IMG_3369\" width=\"660\" height=\"660\"/></a><a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3400.jpg\"><img class=\"aligncenter size-large wp-image-221\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3400-1024x1024.jpg\" alt=\"IMG_3400\" width=\"660\" height=\"660\"/></a>&nbsp;\r\n\r\n10.3太阳很大，我们下午3点就到苏州了，感觉有点疲惫，所以哪儿也不去了，就在酒店泡泡澡，休息，准备第4天的行程。本计划去苏州西山，但考虑到苏州到杭州还有180公里的路途，如果去西山，又多了90公里路途，估计还得3天回杭，所以直接骑到嘉兴，这样最轻松了，事实上选择这个路线非常明智。<a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3419.jpg\"><img class=\"aligncenter size-large wp-image-233\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3419-1024x768.jpg\" alt=\"IMG_3419\" width=\"660\" height=\"495\"/></a><a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3423.jpg\"><img class=\"aligncenter size-large wp-image-238\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3423-1024x1024.jpg\" alt=\"IMG_3423\" width=\"660\" height=\"660\"/></a><a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3445.jpg\"><img class=\"aligncenter size-large wp-image-248\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3445-1024x768.jpg\" alt=\"IMG_3445\" width=\"660\" height=\"495\"/></a>&nbsp;\r\n\r\n&nbsp;\r\n\r\n10.4上午10点多出发，路上下起了阵雨，我们半停半休，骑了80多公里到了嘉兴希尔顿酒店。虽然有点遗憾没去西山，要不然到不了嘉兴。可惜了我的骑行App记录没记录上行程。<a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3521.jpg\"><img class=\"aligncenter size-large wp-image-309\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3521-768x1024.jpg\" alt=\"IMG_3521\" width=\"660\" height=\"880\"/></a><a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3510.jpg\"><img class=\"aligncenter size-large wp-image-298\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3510-1024x1024.jpg\" alt=\"IMG_3510\" width=\"660\" height=\"660\"/></a><a href=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3498.jpg\"><img class=\"aligncenter size-large wp-image-288\" src=\"http://ffeeii.b0.upaiyun.com/ffeeii.com/2015/10/IMG_3498-1024x768.jpg\" alt=\"IMG_3498\" width=\"660\" height=\"495\"/></a>&nbsp;\r\n\r\n10.5直接回杭，骑到桐乡的时候，后轮轮胎居然又爆了，没办法，叫了个车，送到了余杭捷安特店，换了个轮胎继续出发。到家下午4点多。\r\n\r\n总结：全程400多公里，日均90公里，是个非常轻松的路线，我们在路一天骑6-9小时左右，其它时间都在酒店休闲，晚上都是吃海鲜，第二天早上吃饱了出发，一点也不累，这次骑行出发前没有规划，路线没想好，全在路上决定的，惊喜不断，行动起来，爱骑车和旅行的朋友们。</p>', '', '', '1', '0', '2015-10-06 02:04:13', '2016-04-24 02:04:13'), ('118', 'mac 10.11  EI capitan 安装pear', '1', '刚刚新安装了OS X   EI capitan,10.11这个系统在mac速度提升了很多，刚刚安装好后，pear这个命令是没有的。\r\n', '<p>刚刚新安装了OS X&nbsp;&nbsp; EI capitan,10.11这个系统在mac速度提升了很多，刚刚安装好后，pear这个命令是没有的。</p><pre>pecl: command not found</pre><p>如何安装pear?</p><!--more--><p>1、下载pear.phar，没有权限在前面加上sudo</p><pre>curl -O  http://pear.php.net/go-pear.phar</pre><p>2、安装pear</p><pre>sudo php -d detect_unicode=0 go-pear.phar</pre><p>3、会提示安装目录，直接按Enter键发现没有安装权限，就算加上了sudo然并卵。</p><pre>elow is a suggested file layout for your new PEAR installation.  To\r\nchange individual locations, type the number in front of the\r\ndirectory.  Type &#39;all&#39; to change all of them or simply press Enter to\r\naccept these locations.\r\n\r\n 1. Installation base ($prefix)                   : /usr\r\n 2. Temporary directory for processing            : /tmp/pear/install\r\n 3. Temporary directory for downloads             : /tmp/pear/install\r\n 4. Binaries directory                            : /usr/bin\r\n 5. PHP code directory ($php_dir)                 : /usr/share/pear\r\n 6. Documentation directory                       : /usr/docs\r\n 7. Data directory                                : /usr/data\r\n 8. User-modifiable configuration files directory : /usr/cfg\r\n 9. Public Web Files directory                    : /usr/www\r\n10. System manual pages directory                 : /usr/man\r\n11. Tests directory                               : /usr/tests\r\n12. Name of configuration file                    : /private/etc/pear.conf\r\n\r\n1-12, &#39;all&#39; or Enter to continue: 1\r\n(Use $prefix as a shortcut for &#39;/usr&#39;, etc.)\r\nInstallation base ($prefix) [/usr] : /usr/local/pear</pre><p>选择1，将默认/usr 换成 /usr/local/pear\r\n\r\n4、修改 /etc/php.ini</p><pre>Would you like to alter php.ini ? [Y/n] : y</pre><p>5、给pecl命令创建软链接</p><pre>sudo ln -s /usr/local/pear/bin/pear  /opt/local/bin/pear\r\nsudo ln -s /usr/local/pear/bin/pecl /opt/local/bin/pecl</pre><p>6、测试</p><pre>pear version</pre><p>安装成功！</p>', '', '', '1', '0', '2015-10-10 02:05:14', '2016-04-24 02:05:14'), ('119', 'mac 10.11 关闭Rootless', '1', '10.11系统，有些目录是没有权限的,使用sudo 也是没有权限 ，安装有些软件非常麻烦。为了解决Operation not permitted\r\n先关闭Rootless, 10月10日实验可行。', '<p>10.11系统，有些目录是没有权限的,使用sudo 也是没有权限 ，安装有些软件非常麻烦。为了解决Operation not permitted\r\n先关闭Rootless, 10月10日实验可行。\r\n\r\n1、重启电脑，Command + R键，进入启动界面\r\n2、菜单上面找到终端，打开终端\r\n3、输入 csrutil disable \r\n4、重启电脑生效</p>', '', '', '1', '0', '2015-10-10 02:05:54', '2016-04-28 11:24:49');
COMMIT;

-- ----------------------------
--  Table structure for `post_comment`
-- ----------------------------
DROP TABLE IF EXISTS `post_comment`;
CREATE TABLE `post_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL COMMENT '作者',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '评论',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1审核、 2审核通过、 3审核失败',
  `create_at` datetime NOT NULL COMMENT '创建时间',
  `update_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='文章评论';

-- ----------------------------
--  Records of `post_comment`
-- ----------------------------
BEGIN;
INSERT INTO `post_comment` VALUES ('1', '119', 'a', '', 'abcc', '2', '2016-04-28 10:54:42', '2016-04-28 10:54:42'), ('2', '119', 'a', '', 'baaa', '1', '2016-04-28 11:00:08', '2016-04-28 11:00:08'), ('3', '119', 'aaadsadsf', '', 'sfad\r\n\r\nasdfasdf\r\n', '1', '2016-04-28 11:19:24', '2016-04-28 11:19:24'), ('4', '119', 'aaadsadsf', '', 'sfad\r\n\r\nasdfasdf\r\n', '1', '2016-04-28 11:20:01', '2016-04-28 11:20:01'), ('5', '119', 'aaadsadsf', '', 'sfad\r\n\r\nasdfasdf\r\n', '1', '2016-04-28 11:20:05', '2016-04-28 11:20:05'), ('6', '119', 'aaadsadsf', '', 'sfad\r\n\r\nasdfasdf\r\n', '1', '2016-04-28 11:20:14', '2016-04-28 11:20:14'), ('7', '119', 'aaadsadsf', '', 'sfad\r\n\r\nasdfasdf\r\n', '1', '2016-04-28 11:20:20', '2016-04-28 11:20:20'), ('8', '119', 'aaadsadsf', '', 'sfad\r\n\r\nasdfasdf\r\n', '1', '2016-04-28 11:20:40', '2016-04-28 11:20:40'), ('9', '119', 'aaadsadsf', '', 'sfad\r\n\r\nasdfasdf\r\n', '1', '2016-04-28 11:24:02', '2016-04-28 11:24:02'), ('10', '119', 'fad', '', 'asd', '1', '2016-04-28 12:35:37', '2016-04-28 12:35:37');
COMMIT;

-- ----------------------------
--  Table structure for `systemconfig`
-- ----------------------------
DROP TABLE IF EXISTS `systemconfig`;
CREATE TABLE `systemconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL COMMENT '1系统配制2邮件3短信 4交易 9其它',
  `name` varchar(200) NOT NULL COMMENT '名称',
  `keyword` varchar(50) NOT NULL COMMENT '关键字',
  `value1` text NOT NULL COMMENT '值1',
  `value2` text NOT NULL COMMENT '值2',
  `value3` text NOT NULL COMMENT '值3',
  `is_open` tinyint(4) NOT NULL COMMENT '启用状态 1启用 2关闭',
  `sort_number` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `remark` varchar(50) NOT NULL COMMENT '备注',
  `create_time` datetime NOT NULL COMMENT '添加时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `keyword` (`keyword`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统配制';

-- ----------------------------
--  Records of `systemconfig`
-- ----------------------------
BEGIN;
INSERT INTO `systemconfig` VALUES ('5', 'website', '统计代码', 'statistics_code', '', '<script>\r\n(function(){\r\n    var bp = document.createElement(\'script\');\r\n    bp.src = \'//push.zhanzhang.baidu.com/push.js\';\r\n    var s = document.getElementsByTagName(\"script\")[0];\r\n    s.parentNode.insertBefore(bp, s);\r\n})();\r\n</script>\r\n            \r\n<div style=\"display:none;\">\r\n<script>\r\nvar _hmt = _hmt || [];\r\n(function() {\r\n  var hm = document.createElement(\"script\");\r\n  hm.src = \"//hm.baidu.com/hm.js?3efabdcee5ceafc4958fc807865a5313\";\r\n  var s = document.getElementsByTagName(\"script\")[0]; \r\n  s.parentNode.insertBefore(hm, s);\r\n})();\r\n</script>\r\n<script type=\"text/javascript\">var cnzz_protocol = ((\"https:\" == document.location.protocol) ? \" https://\" : \" http://\");document.write(unescape(\"%3Cspan id=\'cnzz_stat_icon_1257579146\'%3E%3C/span%3E%3Cscript src=\'\" + cnzz_protocol + \"s95.cnzz.com/z_stat.php%3Fid%3D1257579146%26show%3Dpic1\' type=\'text/javascript\'%3E%3C/script%3E\"));</script>\r\n</div>', '', '1', '0', '', '2014-11-01 20:13:41', '2016-02-23 10:41:34'), ('13', 'website', '网站LOGO(大)', 'big_logo', '', '', '', '1', '0', '网站LOGO(大)', '2015-04-26 09:23:04', '2016-04-21 08:44:49'), ('14', 'website', '网站LOGO(大)', 'small_logo', 'http://tb2.bdstatic.com/tb/static-common/img/search_logo_big_282cef2.gif', '', '', '1', '0', '', '2015-04-26 09:33:27', '0000-00-00 00:00:00'), ('15', 'website', '网站是否维护', 'website_open', '0', '', '', '1', '0', '0不维护，1维护', '2015-04-26 09:37:22', '0000-00-00 00:00:00'), ('16', 'website', '网站域名', 'www_domain', 'http://www.ffeeii.com', '', '', '1', '0', '网站域名', '2015-04-26 19:51:02', '2016-01-05 11:56:31'), ('17', 'website', '根域名', 'domain_base', 'www.ffeeii.com', '', '', '1', '0', '根域名', '2015-04-26 19:51:45', '2015-08-14 10:57:29'), ('32', 'website', '网站后台域名', 'manage_domain', 'http://fa.ffeeii.com', '', '', '1', '0', '', '2015-05-15 23:01:34', '2015-08-14 10:56:06'), ('33', 'website', '网站api域名', 'api_domain', 'http://www.ffeeii.com', '', '', '1', '0', '', '2015-05-15 23:02:07', '2015-08-14 10:56:17'), ('36', 'website', '网站名称', 'website_name', 'ffeeii', '', '', '1', '0', '', '2015-05-16 10:46:56', '2015-07-25 16:49:40'), ('37', 'website', '公司名称', 'company', '上海袋虎信息技术有限公司', '', '', '1', '0', '', '2015-05-16 10:47:41', '2015-08-05 17:09:43'), ('38', 'website', '网站备案号', 'icp', '沪ICP备15037258号', '', '', '1', '0', '', '2015-05-16 10:48:16', '2015-08-13 17:01:23'), ('41', 'website', '联系电话', 'contact_tel', '4008-789-610', '', '', '1', '0', '', '2015-05-21 12:50:48', '2015-09-01 12:24:09'), ('42', 'website', '静态资源站点', 'static_domain', 'http://static.yidianling.com', '', '', '1', '0', '', '2015-05-21 13:46:45', '2015-08-14 11:19:27'), ('48', 'website', '当前发布版本', 'version', '1', '', '', '1', '0', '', '2015-05-21 23:07:14', '0000-00-00 00:00:00'), ('63', 'website', '微信网页地址', 'wechat_index', 'http://m.yidianling.com/', '', '', '1', '0', '', '2015-07-08 13:53:29', '2015-08-14 10:56:41'), ('64', 'website', '微信静态资源地址', 'wechat_static', 'http://static.yidianling.com/weixin/', '', '', '1', '0', '', '2015-07-08 13:54:29', '2015-08-13 19:17:58'), ('67', 'website', '用户端接口地址', 'inter_url', 'http://api.yidianling.com/uv1/', '', '', '1', '0', '', '2015-07-15 18:16:14', '2015-08-24 12:25:14'), ('68', 'website', '医生-服务收费标准', 'fee_standard', '{\"1\":10,\"2\":20,\"3\":50,\"4\":100,\"5\":200,\"6\":300,\"7\":500}', '', '', '1', '0', '', '2015-07-17 15:40:19', '2015-07-17 15:43:10'), ('70', 'qiniu', '七牛access_key', 'qiniu_access_key', 'MGCa78iZNlw9YL3vwVyHJpYp8x9e1Z83L-QeH6ZX', '', '', '1', '0', '', '2015-07-24 11:27:05', '0000-00-00 00:00:00'), ('71', 'qiniu', '七牛secret_key', 'qiniu_secret_key', '8T9t8ZpUqo81y6VaaKEg4p08SnH9rTMgnV-NxBoT', '', '', '1', '0', '', '2015-07-24 11:35:26', '0000-00-00 00:00:00'), ('72', 'qiniu', '七牛bucket', 'qiniu_bucket', 'ydlvideo', '', '', '1', '0', '', '2015-07-24 11:35:56', '2015-07-28 15:09:23'), ('73', 'qiniu', '七牛域名', 'qiniu_domain', 'http://video.yidianling.com', '', '', '1', '0', '', '2015-07-24 11:37:16', '2015-08-14 12:23:45'), ('74', 'qiniu', '七牛绑定域名', 'qiniu_bind_domain', 'http://7xkld4.media1.z0.glb.clouddn.com', '', '', '1', '0', '例如 img.domain.com', '2015-07-24 11:38:20', '2015-07-28 15:13:41'), ('75', 'qiniu', '七牛returnUrl', 'qiniu_return_url', 'http://hp.yidianling.com/tools/qiniu', '', '', '1', '0', '', '2015-07-24 11:39:00', '2015-09-18 14:46:33'), ('76', 'qiniu', '七牛persistentNotifyUrl', 'qiniu_persistent_notify_url', 'http://manage.ishuiguo.com/site/qiniu', '', '', '1', '0', '', '2015-07-24 11:44:30', '0000-00-00 00:00:00'), ('83', 'website', '短信通道选择', 'sms_type', 'cl', '', '', '1', '0', '短信通道：云通讯：ytx；云片：yp；发财金：fcj；创蓝：cl；阿里大鱼：dayu；', '2015-07-27 16:18:59', '2015-12-04 10:26:44'), ('89', 'website', '联系邮箱', 'contact_email', 'kf@yidianling.com', '', '', '1', '0', '联系邮箱', '2015-08-05 15:31:04', '2015-08-05 17:11:21'), ('91', 'website', '后台登陆页面验证码开关', 'verify_open', '1', '', '', '1', '0', '1 开 2 关', '2015-08-07 15:35:06', '0000-00-00 00:00:00'), ('92', 'website', '关于我们', 'aboutUs', 'http://yidianling.b0.upaiyun.com/v1/html/app_about.html', '', '', '1', '0', '', '2015-08-17 16:15:42', '0000-00-00 00:00:00'), ('93', 'website', 'ios支持链接', 'iosLink', 'http://www.yidianling.com', '', '', '1', '0', '', '2015-08-17 16:16:53', '0000-00-00 00:00:00'), ('94', 'website', '用户协议地址', 'userContract', 'http://yidianling.b0.upaiyun.com/v1/html/app_agreement.html', '', '', '1', '0', '', '2015-08-17 16:17:33', '0000-00-00 00:00:00'), ('111', 'website', '专家咨询专用号码', 'expertBookingPhone', '051081134067', '', '', '1', '1', '', '2015-09-21 16:40:38', '2015-09-21 16:40:38'), ('113', 'website', '客服手机号码', 'cs_phone', '18658110127,13588630703', '', '', '1', '1', '', '2015-10-08 15:07:11', '2015-12-15 22:02:31'), ('147', 'website', '业绩报告人员', 'our_big_data', '15000210629,', '', '', '1', '0', '', '2015-12-29 22:07:56', '2015-12-29 22:07:56'), ('169', 'website', '专家域名', 'zj_domain', 'http://test.zj.yidianling.com', '', '', '1', '1', '', '2016-02-29 15:17:07', '2016-02-29 15:17:07'), ('170', 'website', '全站维护公告（整站禁止访问）', 'all_fix', '', '', '', '2', '1', '', '2016-03-12 13:55:46', '2016-04-21 08:45:06'), ('171', 'website', '局部维护公告（首页顶部提示）', 'part_fix', '<p style=\"background: #FBFFBF;color:red;font-size: 14px;padding: 10px 10%;line-height:18px;\">网站将于2015-3-2 17:00-19:00系统升级，给您带来不便，深感歉意！感谢您对壹点灵的支持！</p>', '', '', '2', '1', '', '2016-03-12 14:34:22', '2016-03-12 14:46:27'), ('172', 'website', '壹点灵api', 'ydl_api_address', 'http://test.app.yidianling.com/v1/', '', '', '1', '1', '', '2016-03-24 11:32:24', '2016-03-24 11:32:24'), ('174', 'upyun', '又拍云用户名', 'upyun_username', 'imgffeeii', '', '', '1', '0', '', '2016-04-21 16:06:52', '2016-04-21 16:06:52'), ('175', 'upyun', '又拍云密码', 'upyun_password', 'imgffeeii123', '', '', '1', '0', '', '2016-04-21 16:07:54', '2016-04-21 16:07:54'), ('176', 'upyun', '又拍云bucket', 'upyun_bucket', 'imgffeeii', '', '', '1', '0', '', '2016-04-21 16:08:22', '2016-04-21 16:08:22'), ('177', 'upyun', '又拍云http域名', 'upyun_http_domain', 'http://imgffeeii.b0.upaiyun.com', '', '', '1', '0', '', '2016-04-21 16:08:54', '2016-04-21 16:08:54'), ('178', 'upyun', '又拍云https域名', 'upyun_https_domain', 'https://imgffeeii.b0.upaiyun.com', '', '', '1', '0', '', '2016-04-21 16:09:18', '2016-04-21 16:09:18'), ('179', 'upyun', '又拍云表单api密钥', 'upyun_ form_api_secret', 'LUx1snO6hgtMyTy/dqhwcMZqPCw=', '', '', '1', '0', '', '2016-04-21 16:22:29', '2016-04-21 16:22:29'), ('180', 'upyun', '又拍云上传目录', 'upyun_upload_dir', 'testdir', '', '', '1', '0', '', '2016-04-21 16:37:37', '2016-04-21 16:37:37');
COMMIT;

-- ----------------------------
--  Table structure for `test`
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '名字',
  `create_at` datetime NOT NULL,
  `content` text NOT NULL COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='测试表';

-- ----------------------------
--  Records of `test`
-- ----------------------------
BEGIN;
INSERT INTO `test` VALUES ('1', 'aaaa', '0000-00-00 00:00:00', ''), ('2', 'ttt ee ', '0000-00-00 00:00:00', ''), ('3', 'aacontent', '0000-00-00 00:00:00', '');
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
