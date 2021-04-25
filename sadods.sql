-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: sadods
-- ------------------------------------------------------
-- Server version	5.7.33-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ods_acoes`
--

DROP TABLE IF EXISTS `ods_acoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ods_acoes` (
  `id_acao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `data_final` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `detalhes` text,
  `classificacao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_acao`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ods_acoes`
--

--
-- Table structure for table `ods_config`
--

DROP TABLE IF EXISTS `ods_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ods_config` (
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(45) DEFAULT NULL,
  `web_site` varchar(45) DEFAULT NULL,
  `versao` varchar(45) DEFAULT NULL,
  `logomarca` varchar(150) DEFAULT NULL,
  `logomarca_small` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ods_config`
--

LOCK TABLES `ods_config` WRITE;
/*!40000 ALTER TABLE `ods_config` DISABLE KEYS */;
INSERT INTO `ods_config` VALUES (2,'ODS','www.lenderbook.com/corporate','1.0','logomarca.jpg','logo_small.png');
/*!40000 ALTER TABLE `ods_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ods_indicadores`
--

DROP TABLE IF EXISTS `ods_indicadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ods_indicadores` (
  `id_indicador` int(11) NOT NULL AUTO_INCREMENT,
  `id_acao` int(11) DEFAULT NULL,
  `nome_indicador` varchar(150) DEFAULT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  `meta_comparativa` varchar(45) DEFAULT NULL,
  `unidade_contagem` varchar(45) DEFAULT NULL,
  `valor_referencia` int(11) DEFAULT NULL,
  `resultado` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_resultado` datetime DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id_indicador`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
--

--
-- Table structure for table `ods_indicadores_historico`
--

DROP TABLE IF EXISTS `ods_indicadores_historico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ods_indicadores_historico` (
  `id_historico` int(11) NOT NULL AUTO_INCREMENT,
  `id_acao` int(11) DEFAULT NULL,
  `id_indicador` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `resultado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_historico`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--

--
-- Table structure for table `ods_logs`
--

DROP TABLE IF EXISTS `ods_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ods_logs` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  `script` text,
  `id_acao` int(11) DEFAULT NULL,
  `id_indicador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
--
-- Table structure for table `ods_usuarios`
--

DROP TABLE IF EXISTS `ods_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ods_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `senha` varchar(150) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ultimo_acesso` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ods_usuarios`
--

LOCK TABLES `ods_usuarios` WRITE;
/*!40000 ALTER TABLE `ods_usuarios` DISABLE KEYS */;
INSERT INTO `ods_usuarios` VALUES (1,'user','emai@email.com.br','sadods','3331bc71fa5e08730920baaa4eb006a08e522418',3,1,'');
/*!40000 ALTER TABLE `ods_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-09 17:00:08
