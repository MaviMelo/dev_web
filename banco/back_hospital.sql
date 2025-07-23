-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: hospital
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.24.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `medico`
--

DROP TABLE IF EXISTS `medico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medico` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(65) NOT NULL,
  `especialidade` varchar(65) NOT NULL,
  `crm` varchar(10) NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_medico_usuario1_idx` (`usuario_id`),
  CONSTRAINT `fk_medico_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medico`
--

LOCK TABLES `medico` WRITE;
/*!40000 ALTER TABLE `medico` DISABLE KEYS */;
INSERT INTO `medico` VALUES (1,'Maria J.','Psiquiatria','123456/PE',10),(3,'J. Oliveira.','Cardiologia','123321/PE',8),(4,'Clarice Silva','Pediatria','223366/MG',4),(5,'M. Rita','Dermatologista','883366/Sp',3);
/*!40000 ALTER TABLE `medico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medico_paciente`
--

DROP TABLE IF EXISTS `medico_paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medico_paciente` (
  `medico_id` int NOT NULL,
  `paciente_id` int NOT NULL,
  `data_hora` datetime NOT NULL,
  `observacao` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`medico_id`,`paciente_id`,`data_hora`),
  KEY `fk_medico_has_paciente_paciente1_idx` (`paciente_id`),
  KEY `fk_medico_has_paciente_medico_idx` (`medico_id`),
  CONSTRAINT `fk_medico_has_paciente_medico` FOREIGN KEY (`medico_id`) REFERENCES `medico` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_medico_has_paciente_paciente1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medico_paciente`
--

LOCK TABLES `medico_paciente` WRITE;
/*!40000 ALTER TABLE `medico_paciente` DISABLE KEYS */;
INSERT INTO `medico_paciente` VALUES (1,1,'2025-07-31 15:08:00',' Seção de auto ajuda.'),(3,2,'2025-08-21 19:47:00',' Exame de rotina.');
/*!40000 ALTER TABLE `medico_paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(65) NOT NULL,
  `data_nascimento` date NOT NULL,
  `tipo_sanguineo` varchar(10) NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_paciente_usuario1_idx` (`usuario_id`),
  CONSTRAINT `fk_paciente_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES (1,'Maria J.','1993-05-06','BA +',10),(2,'Maviael Melo','2017-02-18','A+',2),(3,'Tiago J.','2012-07-04','O +',7),(4,'José','1987-11-18','A+',1);
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(65) NOT NULL,
  `senha` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'José','$2y$10$Lq3TEC.4QaOYSeReDLf.JOlYbl4YQyDojfS7h0gPbxOdvy36TKVuK'),(2,'Maviael Melo','$2y$10$EM0k7RVV2QOhz8icDTDudurz9kNUMa/un0.x1ANdMPikAzB3462Au'),(3,'Maria Rita','$2y$10$bXx43dryqxwxRnBaGeqVR.kYwZJb4tjuhs1F8q08J1LfzDpzVPADi'),(4,'Clarice silva','$2y$10$ue.q6iY/5zbVHg.4tPYsmOhEsfAE44mVfJmgwq5bCwYOZZzduQx1m'),(5,'Fábio silva','$2y$10$On/6E0ewVCV2nt4I8eVSU..kMlFHPvvz/xUM42CcWcD1ZwOV8h22S'),(6,'carlos Rocha','$2y$10$UWXkTvQq4pE9YFFGcOrvROIv/Fy31PLPvDYwYmEky3S3yRfhKHwBm'),(7,'Thiago José','$2y$10$oTLUdD0MIFj4SSg6AvWTC.a42MB6sHro0dZGG3b/lWNn3FtnxnKuy'),(8,'Jessica oliveira','$2y$10$xqDtn9Q5Fzy0bqfk6Ad7jeEeT92B6geVWFG/moXbeOtk8zM5YIk7a'),(9,'josé silva','$2y$10$U41tentBProWxkjgm0aFbuRIq2Kc7GHKMxn4aQUVWwEDZX46Naa2i'),(10,'Maria José','$2y$10$0zqP7YnC8Bius6Kg1lrIr.ZxHYv8oL8RjP2fzTkjwgsrMIzeh4Ma.');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-20 15:53:36
