/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : rgusports

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-04-29 21:16:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for fixture_players
-- ----------------------------
DROP TABLE IF EXISTS `fixture_players`;
CREATE TABLE `fixture_players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fixture_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `availability` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `student_id_2` (`student_id`),
  KEY `fixture_id` (`fixture_id`,`student_id`),
  CONSTRAINT `fixture_players_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of fixture_players
-- ----------------------------
INSERT INTO `fixture_players` VALUES ('1', '4', '1872321', '1', '2020-04-29 21:13:40');
INSERT INTO `fixture_players` VALUES ('2', '4', '2000916', '1', '2020-04-29 21:13:04');
INSERT INTO `fixture_players` VALUES ('3', '4', '2000419', '1', '2020-04-29 21:13:38');
INSERT INTO `fixture_players` VALUES ('4', '5', '1872321', '0', '2020-04-29 21:12:53');
INSERT INTO `fixture_players` VALUES ('5', '5', '2000419', '0', '2020-04-29 21:12:54');
INSERT INTO `fixture_players` VALUES ('6', '5', '2000916', '0', '2020-04-29 21:12:54');

-- ----------------------------
-- Table structure for fixture_team
-- ----------------------------
DROP TABLE IF EXISTS `fixture_team`;
CREATE TABLE `fixture_team` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `fixture_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fixture_id` (`fixture_id`,`student_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `fixture_team_ibfk_1` FOREIGN KEY (`fixture_id`) REFERENCES `fixtures` (`id`),
  CONSTRAINT `fixture_team_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of fixture_team
-- ----------------------------
INSERT INTO `fixture_team` VALUES ('1', '4', '1872321', '2020-04-29 21:13:54');
INSERT INTO `fixture_team` VALUES ('2', '4', '2000916', '2020-04-29 21:13:54');
INSERT INTO `fixture_team` VALUES ('3', '4', '2000419', '2020-04-29 21:13:54');

-- ----------------------------
-- Table structure for fixtures
-- ----------------------------
DROP TABLE IF EXISTS `fixtures`;
CREATE TABLE `fixtures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` varchar(255) DEFAULT NULL,
  `away` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `game_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`),
  KEY `team_id_2` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of fixtures
-- ----------------------------
INSERT INTO `fixtures` VALUES ('4', '1', 'Chelsea', 'London', '2020-04-29 12:00:00');
INSERT INTO `fixtures` VALUES ('5', '1', 'Manchester United', 'Old Trafford', '2020-04-30 12:00:00');
INSERT INTO `fixtures` VALUES ('6', '1', 'Aberdeen FC', 'Aberdeen', '2020-05-01 18:00:00');
INSERT INTO `fixtures` VALUES ('7', '1', 'Liverpool', 'Anfield', '2020-05-14 00:45:00');
INSERT INTO `fixtures` VALUES ('8', '1', 'Super Eagles', 'Abuja', '2020-05-21 12:00:00');
INSERT INTO `fixtures` VALUES ('9', '1', 'Barcelona', 'Camp Nou', '2020-05-28 20:00:00');
INSERT INTO `fixtures` VALUES ('10', '1', 'Real Madrid', 'Santiago Bernabeu', '2020-05-30 12:00:00');

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES ('3', '2000916', 'Jane Doe', 'johnedoe@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'Bryan-Williams_faces-750x0-c-default.jpg', '2020-04-29 20:37:36');
INSERT INTO `students` VALUES ('4', '2000419', 'John Appleseed', 'johnappleseed@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'chris_robert_faces-750x0-c-default.jpg', '2020-04-29 20:37:14');
INSERT INTO `students` VALUES ('5', '1982345', 'John Holt', 'johnholt@yahoo.com', '7c222fb2927d828af22f592134e8932480637c0d', 'image 1.jpg', '2020-04-29 20:38:28');
INSERT INTO `students` VALUES ('6', '1872321', 'Coco Chanel', 'cocchanel@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'victoria_romulo_faces_nu-750x0-c-default.jpg', '2020-04-29 20:39:08');

-- ----------------------------
-- Table structure for swap_requests
-- ----------------------------
DROP TABLE IF EXISTS `swap_requests`;
CREATE TABLE `swap_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fixture_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fixture_id` (`fixture_id`,`student_id`),
  KEY `student_id` (`student_id`),
  KEY `fixture_id_2` (`fixture_id`,`student_id`),
  CONSTRAINT `swap_requests_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of swap_requests
-- ----------------------------
INSERT INTO `swap_requests` VALUES ('1', '4', '2000916', 'Please swap me for John in the next game', '2020-04-29 21:15:30');

-- ----------------------------
-- Table structure for team_managers
-- ----------------------------
DROP TABLE IF EXISTS `team_managers`;
CREATE TABLE `team_managers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manager_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `manager_id` (`manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of team_managers
-- ----------------------------
INSERT INTO `team_managers` VALUES ('1', '3000001', 'Christopher Columbus', 'christopher@yahoo.com', '7c222fb2927d828af22f592134e8932480637c0d', '2020-04-29 20:40:21');
INSERT INTO `team_managers` VALUES ('2', '6732323', 'Marco Polo', 'marco@settles.com', '7c222fb2927d828af22f592134e8932480637c0d', '2020-04-29 21:00:41');

-- ----------------------------
-- Table structure for team_members
-- ----------------------------
DROP TABLE IF EXISTS `team_members`;
CREATE TABLE `team_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`,`student_id`),
  KEY `team_id_2` (`team_id`,`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of team_members
-- ----------------------------
INSERT INTO `team_members` VALUES ('1', '1', '2000916', '1');
INSERT INTO `team_members` VALUES ('2', '1', '2000419', '1');
INSERT INTO `team_members` VALUES ('3', '1', '1982345', '0');
INSERT INTO `team_members` VALUES ('4', '1', '1872321', '1');

-- ----------------------------
-- Table structure for teams
-- ----------------------------
DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of teams
-- ----------------------------
INSERT INTO `teams` VALUES ('1', 'Football', '3000001', '2020-04-29 21:01:44');
INSERT INTO `teams` VALUES ('2', 'Volleyball', '6732323', '2020-04-29 21:01:45');
