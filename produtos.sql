CREATE DATABASE  IF NOT EXISTS `code_doctrine` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `code_doctrine`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: code_doctrine
-- ------------------------------------------------------
-- Server version	5.6.21-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `valor` double NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Fritadeira GF Airfryer',599.9,'Com a Fritadeira George Foreman Airfryer você frita, assa, tosta e grelha sem óleo, sem perder o sabor! Prepare alimentos mais saudáveis com esse produto versátil e saudável para preparar batatas fritas, carne, peixe, vegetais, e até mesmo bolos e cup cakes sem a necessidade de óleo. O aparelho possui janela para visualização do alimento durante o preparo e sistema halógeno de aquecimento e circulação de ar em alta velocidade. Vem com alça encaixável termoisolante (com trava de segurança) para retirada da cesta mantendo a distância entre a mão e as partes quentes. A fritadeira George Foreman Airfryer é fácil de limpar, acompanha bandeja coletora de resíduos e a cesta antiaderente pode ser retirada e lavada até mesmo na lava-louça. Possui temporizador de 60 minutos com desligamento automático e aviso sonoro, controle de temperatura ajustável de até 220ºC, pé de apoio antiderrapante e aquece por igual. Seu design exclusivo com painel elegante em aço inoxidável e coloração preta moderna vai deixar sua cozinha ainda mais sofisticada e atual. Vale a pena conferir!'),(2,'iPhone 6 16GB Dourado',3199,'O iPhone 6 não é só maior, ele é melhor em todos os sentidos. É maior, muito mais fino, mais poderoso, e consome muito menos energia. A superfície de metal lisa se integra perfeitamente à nossa tela Multi-Touch mais avançada. É uma nova geração de iPhone melhor em tudo.'),(3,'Console XBOX ONE 500GB',1777.67,'Poderoso. Divertido. Completo. Leve mais diversão e entretenimento para toda a família com o Xbox One. Além de um console de jogos de última geração, o XBOX ONE permite que você tenha acesso aos seus filmes, jogos e músicas favoritas sem precisar mudar as entradas na sua TV. Você pode gerenciar todas essas funções apenas com o comando da sua voz. '),(4,'Multifuncional Epson Xp214',299,'Com a Multifuncional Epson Expression™ XP-214 você tem alta performance de impressão em tamanho compacto!');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-04 15:10:08
