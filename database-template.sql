/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : boyoty

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-08-01 10:18:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for person_group
-- ----------------------------
DROP TABLE IF EXISTS `person_group`;
CREATE TABLE `person_group` (
  `person_groupid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `person_groupname` varchar(255) NOT NULL,
  `person_grouporder` int(11) unsigned NOT NULL DEFAULT '99999',
  PRIMARY KEY (`person_groupid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of person_group
-- ----------------------------
INSERT INTO `person_group` VALUES ('1', 'Admin ระบบหลัก', '1');
INSERT INTO `person_group` VALUES ('2', 'User ทั่วไป', '2');

-- ----------------------------
-- Table structure for person_groupmember
-- ----------------------------
DROP TABLE IF EXISTS `person_groupmember`;
CREATE TABLE `person_groupmember` (
  `person_groupid` int(11) unsigned NOT NULL,
  `person_id` varchar(13) NOT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`person_groupid`,`person_id`),
  KEY `person_groupmember_fk2` (`person_id`),
  CONSTRAINT `person_groupmember_fk1` FOREIGN KEY (`person_groupid`) REFERENCES `person_group` (`person_groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of person_groupmember
-- ----------------------------
INSERT INTO `person_groupmember` VALUES ('1', '1111111111111', '1');
INSERT INTO `person_groupmember` VALUES ('2', '1111111111111', '0');

-- ----------------------------
-- Table structure for person_main
-- ----------------------------
DROP TABLE IF EXISTS `person_main`;
CREATE TABLE `person_main` (
  `person_id` varchar(13) NOT NULL,
  `prename` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `position_code` int(11) unsigned NOT NULL,
  `pic` varchar(150) DEFAULT NULL,
  `department` int(11) NOT NULL DEFAULT '0',
  `status` int(11) unsigned NOT NULL DEFAULT '1',
  `person_order` int(11) unsigned NOT NULL DEFAULT '99999',
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `officer` varchar(13) DEFAULT NULL,
  `rec_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `person_id` (`person_id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE,
  KEY `person_main_fk1` (`position_code`),
  KEY `person_main_fk2` (`status`),
  CONSTRAINT `person_main_fk1` FOREIGN KEY (`position_code`) REFERENCES `person_position` (`position_code`),
  CONSTRAINT `person_main_fk2` FOREIGN KEY (`status`) REFERENCES `person_status` (`person_statusid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of person_main
-- ----------------------------
INSERT INTO `person_main` VALUES ('1111111111111', 'นาย', 'ศาสตรา', 'ดอนโอฬาร', '1', '39c74-4603.jpg', '1', '1', '1', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '1111111111111', '2016-07-31 13:26:49');

-- ----------------------------
-- Table structure for person_position
-- ----------------------------
DROP TABLE IF EXISTS `person_position`;
CREATE TABLE `person_position` (
  `position_code` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `position_name` varchar(50) NOT NULL,
  `position_type` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`position_code`),
  UNIQUE KEY `position_code` (`position_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of person_position
-- ----------------------------
INSERT INTO `person_position` VALUES ('1', 'ผู้ดูแลระบบ', '1');

-- ----------------------------
-- Table structure for person_status
-- ----------------------------
DROP TABLE IF EXISTS `person_status`;
CREATE TABLE `person_status` (
  `person_statusid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `person_statusname` varchar(50) NOT NULL,
  PRIMARY KEY (`person_statusid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of person_status
-- ----------------------------
INSERT INTO `person_status` VALUES ('1', 'ปกติ');
INSERT INTO `person_status` VALUES ('2', 'ยกเลิก');

-- ----------------------------
-- Table structure for smartpush
-- ----------------------------
DROP TABLE IF EXISTS `smartpush`;
CREATE TABLE `smartpush` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gcm_regid` varchar(256) NOT NULL DEFAULT 'smartpush',
  `gcm_id` varchar(13) NOT NULL DEFAULT '999999',
  `gcm_user` varchar(45) NOT NULL DEFAULT 'john',
  `created_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of smartpush
-- ----------------------------

-- ----------------------------
-- Table structure for smartpush_module
-- ----------------------------
DROP TABLE IF EXISTS `smartpush_module`;
CREATE TABLE `smartpush_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gcm_regid` varchar(255) NOT NULL,
  `gcm_id` varchar(13) NOT NULL,
  `push_module` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of smartpush_module
-- ----------------------------

-- ----------------------------
-- Table structure for smartpush_temp
-- ----------------------------
DROP TABLE IF EXISTS `smartpush_temp`;
CREATE TABLE `smartpush_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(256) NOT NULL,
  `title` varchar(145) NOT NULL,
  `department` varchar(45) NOT NULL,
  `pushdate` varchar(45) NOT NULL,
  `gcm_id` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of smartpush_temp
-- ----------------------------

-- ----------------------------
-- Table structure for system_config
-- ----------------------------
DROP TABLE IF EXISTS `system_config`;
CREATE TABLE `system_config` (
  `configkey` varchar(50) NOT NULL,
  `configvalue` varchar(255) NOT NULL,
  `configdesc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`configkey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_config
-- ----------------------------
INSERT INTO `system_config` VALUES ('footer_title', 'Copyright © 2014-2015 <a href=\"http://almsaeedstudio.com\">Almsaeed Studio</a>.', 'ข้อความส่วนท้ายของเว็บ');
INSERT INTO `system_config` VALUES ('footer_version', '1.0', 'เวอร์ชั่นแสดงที่ส่วนท้ายของเว็บ');
INSERT INTO `system_config` VALUES ('show_notification', 'true', 'แสดงรายการแจ้งเตือนด้านบน (true,false)');
INSERT INTO `system_config` VALUES ('web_fname', 'Web', 'ชื่อเว็บส่วนหน้า');
INSERT INTO `system_config` VALUES ('web_sname', 'NAME', 'ชื่อเว็บส่วนหลัง');
INSERT INTO `system_config` VALUES ('web_title', 'WebTitle', 'ไตเติ้ลเว็บ');

-- ----------------------------
-- Table structure for system_department
-- ----------------------------
DROP TABLE IF EXISTS `system_department`;
CREATE TABLE `system_department` (
  `department` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  `department_precis` varchar(100) NOT NULL,
  `department_typeid` int(11) unsigned NOT NULL,
  `department_statusid` int(11) unsigned NOT NULL DEFAULT '1',
  `department_masterid` int(11) unsigned NOT NULL,
  `department_refid` varchar(50) NOT NULL,
  `department_order` int(11) unsigned NOT NULL DEFAULT '99999',
  PRIMARY KEY (`department`),
  UNIQUE KEY `department` (`department`) USING BTREE,
  KEY `system_department_fk1` (`department_typeid`) USING BTREE,
  KEY `system_department_fk2` (`department_statusid`) USING BTREE,
  CONSTRAINT `system_department_fk1` FOREIGN KEY (`department_typeid`) REFERENCES `system_department_type` (`department_typeid`),
  CONSTRAINT `system_department_fk2` FOREIGN KEY (`department_statusid`) REFERENCES `system_department_status` (`department_statusid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_department
-- ----------------------------
INSERT INTO `system_department` VALUES ('1', 'สำนักงานเขตพื้นที่การศึกษาประถมศึกษากาฬสินธุ์ เขต 3', 'สพป.กาฬสินธุ์ เขต 3', '1', '1', '0', 'ศธ 04022', '0');

-- ----------------------------
-- Table structure for system_department_group
-- ----------------------------
DROP TABLE IF EXISTS `system_department_group`;
CREATE TABLE `system_department_group` (
  `department_groupid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_groupname` varchar(255) NOT NULL,
  `department_grouporder` int(11) unsigned NOT NULL DEFAULT '99999',
  PRIMARY KEY (`department_groupid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_department_group
-- ----------------------------
INSERT INTO `system_department_group` VALUES ('1', 'สำนักงานเขตพื้นที่การศึกษา', '1');
INSERT INTO `system_department_group` VALUES ('2', 'โรงเรียน', '2');

-- ----------------------------
-- Table structure for system_department_groupmember
-- ----------------------------
DROP TABLE IF EXISTS `system_department_groupmember`;
CREATE TABLE `system_department_groupmember` (
  `department_groupid` int(11) unsigned NOT NULL,
  `department_id` int(11) unsigned NOT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`department_groupid`,`department_id`),
  KEY `system_department_groupmember_fk2` (`department_id`),
  CONSTRAINT `system_department_groupmember_fk1` FOREIGN KEY (`department_groupid`) REFERENCES `system_department_group` (`department_groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_department_groupmember
-- ----------------------------
INSERT INTO `system_department_groupmember` VALUES ('1', '1', '0');

-- ----------------------------
-- Table structure for system_department_status
-- ----------------------------
DROP TABLE IF EXISTS `system_department_status`;
CREATE TABLE `system_department_status` (
  `department_statusid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_statusname` varchar(50) NOT NULL,
  PRIMARY KEY (`department_statusid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_department_status
-- ----------------------------
INSERT INTO `system_department_status` VALUES ('1', 'เปิด');
INSERT INTO `system_department_status` VALUES ('2', 'ปิด');

-- ----------------------------
-- Table structure for system_department_type
-- ----------------------------
DROP TABLE IF EXISTS `system_department_type`;
CREATE TABLE `system_department_type` (
  `department_typeid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_typename` varchar(100) NOT NULL,
  PRIMARY KEY (`department_typeid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_department_type
-- ----------------------------
INSERT INTO `system_department_type` VALUES ('1', 'สำนักงานเขตพื้นที่การศึกษา');
INSERT INTO `system_department_type` VALUES ('2', 'โรงเรียน');

-- ----------------------------
-- Table structure for system_loginlog
-- ----------------------------
DROP TABLE IF EXISTS `system_loginlog`;
CREATE TABLE `system_loginlog` (
  `loginid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personid` varchar(13) NOT NULL,
  `username` varchar(20) NOT NULL,
  `logintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipaddress` varchar(50) NOT NULL,
  `hostname` varchar(50) NOT NULL,
  `os` varchar(50) NOT NULL,
  `browser` varchar(50) NOT NULL,
  PRIMARY KEY (`loginid`),
  KEY `system_loginlog_fk1` (`personid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_loginlog
-- ----------------------------

-- ----------------------------
-- Table structure for system_menu
-- ----------------------------
DROP TABLE IF EXISTS `system_menu`;
CREATE TABLE `system_menu` (
  `menu_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) NOT NULL,
  `menu_link` varchar(255) NOT NULL,
  `module` varchar(100) NOT NULL,
  `menu_statusid` int(11) unsigned NOT NULL DEFAULT '1',
  `menu_order` int(11) unsigned NOT NULL DEFAULT '99999',
  PRIMARY KEY (`menu_id`),
  KEY `system_menu_fk1` (`module`),
  KEY `system_menu_fk2` (`menu_statusid`),
  CONSTRAINT `system_menu_fk1` FOREIGN KEY (`module`) REFERENCES `system_module` (`module`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `system_menu_fk2` FOREIGN KEY (`menu_statusid`) REFERENCES `system_menu_status` (`menu_statusid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_menu
-- ----------------------------
INSERT INTO `system_menu` VALUES ('1', 'แก้ไขข้อมูลส่วนตัว', 'admin/person_profile', 'admin', '1', '10');
INSERT INTO `system_menu` VALUES ('2', 'ข้อมูลบุคลากร', 'admin/person_main', 'admin', '1', '20');
INSERT INTO `system_menu` VALUES ('3', 'ตำแหน่งบุคลากร', 'admin/person_position', 'admin', '1', '30');
INSERT INTO `system_menu` VALUES ('4', 'หน่วยงาน', 'admin/system_department', 'admin', '1', '40');
INSERT INTO `system_menu` VALUES ('5', 'ประเภทหน่วยงาน', 'admin/system_department_type', 'admin', '1', '50');
INSERT INTO `system_menu` VALUES ('6', 'กลุ่มหน่วยงาน', 'admin/system_department_group', 'admin', '1', '60');
INSERT INTO `system_menu` VALUES ('7', 'ตั้งค่าระบบ config', 'admin/system_config', 'admin', '1', '70');
INSERT INTO `system_menu` VALUES ('8', 'ประวัติการใช้งาน log', 'admin/system_loginlog', 'admin', '1', '80');
INSERT INTO `system_menu` VALUES ('9', 'กลุ่มโมดูล', 'menu/system_modulegroup', 'menu', '1', '90');
INSERT INTO `system_menu` VALUES ('10', 'เมนู', 'menu/system_menu', 'menu', '1', '120');
INSERT INTO `system_menu` VALUES ('11', 'สิทธิ์การใช้งาน', 'menu/person_group', 'menu', '1', '110');
INSERT INTO `system_menu` VALUES ('12', 'โมดูล', 'menu/system_module', 'menu', '1', '100');
INSERT INTO `system_menu` VALUES ('13', 'เขียนบันทึกข้อความ', 'ioffice/book', 'ioffice', '1', '10');

-- ----------------------------
-- Table structure for system_menumember
-- ----------------------------
DROP TABLE IF EXISTS `system_menumember`;
CREATE TABLE `system_menumember` (
  `menu_id` int(11) unsigned NOT NULL,
  `person_groupid` int(11) unsigned NOT NULL,
  `priority` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`menu_id`,`person_groupid`),
  KEY `system_menumember_fk2` (`person_groupid`),
  CONSTRAINT `system_menumember_fk2` FOREIGN KEY (`person_groupid`) REFERENCES `person_group` (`person_groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_menumember
-- ----------------------------
INSERT INTO `system_menumember` VALUES ('1', '1', '0');
INSERT INTO `system_menumember` VALUES ('1', '2', '1');
INSERT INTO `system_menumember` VALUES ('2', '1', '0');
INSERT INTO `system_menumember` VALUES ('3', '1', '0');
INSERT INTO `system_menumember` VALUES ('4', '1', '0');
INSERT INTO `system_menumember` VALUES ('5', '1', '0');
INSERT INTO `system_menumember` VALUES ('6', '1', '0');
INSERT INTO `system_menumember` VALUES ('7', '1', '0');
INSERT INTO `system_menumember` VALUES ('8', '1', '0');
INSERT INTO `system_menumember` VALUES ('9', '1', '0');
INSERT INTO `system_menumember` VALUES ('10', '1', '0');
INSERT INTO `system_menumember` VALUES ('11', '1', '0');
INSERT INTO `system_menumember` VALUES ('12', '1', '0');
INSERT INTO `system_menumember` VALUES ('13', '2', '0');

-- ----------------------------
-- Table structure for system_menu_status
-- ----------------------------
DROP TABLE IF EXISTS `system_menu_status`;
CREATE TABLE `system_menu_status` (
  `menu_statusid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_statusname` varchar(30) NOT NULL,
  PRIMARY KEY (`menu_statusid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_menu_status
-- ----------------------------
INSERT INTO `system_menu_status` VALUES ('1', 'เปิด');
INSERT INTO `system_menu_status` VALUES ('2', 'ปิด');

-- ----------------------------
-- Table structure for system_module
-- ----------------------------
DROP TABLE IF EXISTS `system_module`;
CREATE TABLE `system_module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(50) NOT NULL,
  `module_desc` varchar(100) NOT NULL,
  `module_controller` varchar(255) DEFAULT NULL,
  `workgroup` tinyint(4) DEFAULT NULL,
  `module_icon` varchar(100) DEFAULT 'fa-th-list',
  `module_statusid` tinyint(4) NOT NULL DEFAULT '1',
  `module_order` int(11) NOT NULL DEFAULT '9999',
  PRIMARY KEY (`id`),
  UNIQUE KEY `module` (`module`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_module
-- ----------------------------
INSERT INTO `system_module` VALUES ('1', 'admin', 'ข้อมูลหลัก', 'admin/person_main', '1', 'fa-th-list', '1', '1');
INSERT INTO `system_module` VALUES ('2', 'menu', 'จัดการเมนู', 'menu/system_menu', '1', 'fa-th-list', '1', '2');
INSERT INTO `system_module` VALUES ('3', 'ioffice', 'บันทึกเสนอสั่งการ', null, '2', 'fa-th-list', '1', '10');
INSERT INTO `system_module` VALUES ('4', 'mail', 'ไปรษณีย์', null, '2', 'fa-th-list', '1', '20');

-- ----------------------------
-- Table structure for system_modulegroup
-- ----------------------------
DROP TABLE IF EXISTS `system_modulegroup`;
CREATE TABLE `system_modulegroup` (
  `modulegroup` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `modulegroup_desc` varchar(50) NOT NULL,
  `modulegroup_icon` varchar(100) NOT NULL DEFAULT 'fa-desktop',
  `modulegroup_order` int(11) NOT NULL,
  PRIMARY KEY (`modulegroup`),
  UNIQUE KEY `menugroup` (`modulegroup`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_modulegroup
-- ----------------------------
INSERT INTO `system_modulegroup` VALUES ('1', 'จัดการระบบ', 'fa-cogs', '99999');
INSERT INTO `system_modulegroup` VALUES ('2', 'บริหารทั่วไป', '', '10');

-- ----------------------------
-- Table structure for system_module_status
-- ----------------------------
DROP TABLE IF EXISTS `system_module_status`;
CREATE TABLE `system_module_status` (
  `module_statusid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_statusname` varchar(200) NOT NULL,
  PRIMARY KEY (`module_statusid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_module_status
-- ----------------------------
INSERT INTO `system_module_status` VALUES ('1', 'เปิด');
INSERT INTO `system_module_status` VALUES ('2', 'ปิด');

-- ----------------------------
-- View structure for view_node
-- ----------------------------
DROP VIEW IF EXISTS `view_node`;
CREATE ALGORITHM=UNDEFINED DEFINER=`%`@`localhost` SQL SECURITY INVOKER  VIEW `view_node` AS select concat('P',`person_main`.`person_id`) AS `nodeid`,concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`) AS `nodename` from (`person_main` left join `person_position` on((`person_main`.`position_code` = `person_position`.`position_code`))) union all select concat('D',`system_department`.`department`) AS `nodeid`,`system_department`.`department_name` AS `nodename` from `system_department` ;

-- ----------------------------
-- View structure for view_person_main
-- ----------------------------
DROP VIEW IF EXISTS `view_person_main`;
CREATE ALGORITHM=UNDEFINED DEFINER=`%`@`localhost` SQL SECURITY INVOKER  VIEW `view_person_main` AS SELECT
person_main.person_id AS person_id,
concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) AS fullname,
person_position.position_name AS position_name,
system_department.department_name AS department_name,
system_department.department_precis AS department_precis,
concat(`person_position`.`position_name`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) AS position_fullname,
concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`) AS fullname_position,
concat(`system_department`.`department_precis`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) AS department_fullname,
concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`system_department`.`department_precis`) AS fullname_department
from ((`person_main` left join `person_position` on((`person_main`.`position_code` = `person_position`.`position_code`))) left join `system_department` on((`person_main`.`department` = `system_department`.`department`))) ;
