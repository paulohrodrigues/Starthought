/*
Navicat MySQL Data Transfer

Source Server         : banco
Source Server Version : 50628
Source Host           : localhost:3306
Source Database       : rede

Target Server Type    : MYSQL
Target Server Version : 50628
File Encoding         : 65001

Date: 2016-09-11 12:33:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `comentarios`
-- ----------------------------
DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE `comentarios` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `texto` text NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_escrito` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of comentarios
-- ----------------------------

-- ----------------------------
-- Table structure for `escrito`
-- ----------------------------
DROP TABLE IF EXISTS `escrito`;
CREATE TABLE `escrito` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_user` int(255) NOT NULL,
  `texto` text NOT NULL,
  `tipo` text NOT NULL,
  `like` int(255) NOT NULL,
  `privacidade` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of escrito
-- ----------------------------

-- ----------------------------
-- Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `nome` text NOT NULL,
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `foto` text NOT NULL,
  `login` text NOT NULL,
  `email` text NOT NULL,
  `senha` text NOT NULL,
  `id_face` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
