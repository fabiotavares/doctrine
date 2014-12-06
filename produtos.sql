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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Pen Drive Multilaser Twist 2 16GB',27.9,'Armazene suas fotos, músicas, planilhas, entre outros documentos com mais qualidade e segurança. É a Multilaser pensando em sua comodidade proporciona praticidade em seu dia a dia com esse Pen Drive Twist 2 16GB!'),(2,'Teclado Touch Sem Fio K400 - Logitech',139.9,'Um teclado potente, sem fio que pode ser usado para controlar a TV e o desktop. Além disso, você pode controlar o laptop recostado no sofá, mesmo quando estiver conectado à TV.'),(3,'HD Externo Portátil Samsung 1TB M3 Portable',269.9,'HD externo portátil Samsung oferece uma solução fácil de usar quando você precisa adicionar armazenamento instantaneamente ao seu computador e levar seus arquivos aonde você for.'),(4,'Roteador Wireless 150Mbps 740N - TP-Link',48.9,'O roteador sem-fios N TL-WR740N da TP-LINK é ideal para a praticidade de estudantes, executivos e aplicações comerciais em geral, especialmente projetado para pequenas empresas e escritórios residenciais. Ele integra tecnologias como Roteador NAT, Ponto de Acesso sem-fios, antena de 5dBi, SPI Firewall, Switch de quatro (4) portas, WPS, e o mais recém lançado chipset Align da ATHEROS.'),(5,'Pen Drive 8GB - Sandisk - Cruzer Blade',15.9,'Não hesite em levar para o seu dia a dia mais praticidade e comodidade!Com o Pen Drive Cruzer Blade você usufrui de 8GB de memória para transportar imagens, músicas, planilhas ou qualquer outro tipo de arquivo para onde quiser.É a Sandisk levando até você estilo, facilidade e alta qualidade, aproveite!'),(6,'Pen Drive Duracell 32GB Black',53.9,'Armazene suas fotos, músicas, planilhas, entre outros documentos com mais qualidade e segurança. É a Duracell pensando em sua comodidade proporcionando praticidade ao seu dia a dia com esse Pen Drive 32GB! É só conectar em seu PC ou Notebook e pronto, já transfere tudo com mais agilidade e estilo, aproveite!'),(7,'Pasta Para Notebook Multilaser 15,6 Polegadas - Preta',139.9,'A Pasta Para Notebook da Multilaser é produzida em Nylon de alta resistência, ou seja, protege seu material, pois o nylon evita que água ultrapasse o tecido. Possui zíper e costura reforçados. Multi compartimentos com extra proteção para notebook e é compatível com aparelhos de até 15,6 polegadas.'),(8,'Pasta Para Notebook Multilaser 14 Polegadas Casual - Preta',89.9,'A Pasta Para Notebook da Multilaser possui compartimento com forro de algodão. Protege seu material por dentro e por fora, pois a parte externa é confeccionada em nylon de alta qualidade. Bolsos externos e alça removível. Ideal para você levar seu material de um canto a outro de forma segura, pois o nylon não deixa que água ultrapasse o tecido.'),(9,'Bolsa Feminina Para Notebook 15 Polegadas - Preta',106,'Linda Bolsa Feminina para Notebook 15 polegadas. Fabricada em nylon, super resistente, com compartimento exclusivo para notebook de até 15,6\". Para auxiliar ainda possui três compartimentos multifuncionais. Sua alça de mão é feita com costura reforçada, o forro resistente e zíper personalizado. Tudo para você brilhar até mesmo na hora de carregar uma bolsa com seu notebook. Acomoda perfeitamente seu notebook 15 polegadas e deixa tudo bem encaixado e seguro.'),(10,'Pasta Primicia Executiva Em PVC/PU Preta',279,'Pasta executiva da Primicia com grande capacidade e um bolso frontal. Possui também bolso traseiro e alça tiracolo removível, totalmente ajustavel e almofadada de excelente qualidade.'),(11,'Mouse Retrátil Super Mini Ice USB - Multilaser',22.9,'Ideal para facilitar seu trabalho e te ajudar na praticidade, chegou o Mouse Retrátil, da Multilaser. Ele tem design compacto, facilitando seu armazenamento e transporte. Cheio de estilo tem acabamento brilhante, é retrátil e tem a facilidade de ser USB. Confira esta oportunidade!'),(12,'Mouse Slim 3419 USB - Branco - Leadership',21.99,'Mouse óptico modelo Slim 3419 Branco da Leadership, sofisticado de formato fino com cabo USB em forma de trena. Sensor ótico com alta resolução que oferece movimentos precisos e apurados. Possui botão Wheel macio para rolamento de telas e páginas.'),(13,'Mouse Nano Ótico Retrátil USB Rosa - Maxprint',27.9,'Design discreto e pequeno para maior portabilidade esse mouse da Maxprint é um acessório ideal para notebook, além de equipado com cabo retrátil de 80 centímetros. Tecnologia ótica ajuda a manter o sensor ótico uma precisão dos movimentos, sem peças móveis que se desgastem ou precisem de limpeza. Fácil instalação e operação. 3 botões: botão central de rolagem. Funciona em diversas superfícies diferentes.'),(14,'Mochila para Notebook Luxcel Poliéster Adventteam Preta até 15,6\"',129.9,'Tenha mais praticidade com a Mochila de Costas para Notebook Adventteam Luxcel. Confeccionada em poliéster é um produto resistente e durável, perfeita para transportar seu notebook ou netbook com elegância e segurança. Com compartimentos externos, você ainda pode guardar outros objetos para levar onde quiser.'),(15,'Mochila Motor Backpack TSB194 - Targus',99,'Organização e praticidade com discrição e segurança foram os critérios pensados pela Targus para confeccionar a Mochila Motor Backpack TSB194 ideal para estudantes e profissionais que procuram transportar e proteger seus objetos.'),(16,'Mochila Missy Notebag Leadership',39.9,'Transporte seu notebook com segurança e estilo. Resistente, espaçosa e com alças macias, que se encaixam perfeitamente em seus ombros, a Mochila Missy Notebag acomoda seu notebook para você carregá-lo para diversos locais no seu dia a dia. '),(17,'Teclado e Capa para Tablet Logitech Ultrathin',374,'A Logitech foi além e projetou uma capa exclusiva para seu iPad. Além de protegê-lo, ela também pode ser usada como um prático teclado, perfeito para tarefas que exigem uma digitação mais ágil e precisa.Com um belo design, clean e ultrafino, a capa da Logitech também proporciona conforto porque é feita em alumínio leve. E o teclado funciona sem fio, via conexão Bluetooth.Uma companhia perfeita para você e seu iPad.'),(18,'Capa para Ipad Air Couro Smart Case Vermelho - Apple',296.1,'A Apple lançou a Smart Case, um acessório capaz de fazer com que o seu iPad Air seja ainda melhor e mais completo do que já é. A Smart Case transforma-se, também, em um apoio para que você possa assistir e digitar o que quiser e quando quiser, além de despertar automaticamente o seu iPad.'),(19,'Capa Fólio Slim para iPad Air Stripes Green - Geonav',129.9,'Se você precisa de uma proteção permanente e resistente, a Capa Fólio Slim em Couro Sintético é fabricada exclusivamente para o seu iPad Air. A Capa Fólio Slim para iPad Air possui a função On/Off ao abrir e fechar a capa, fecho magnético e porta cartões interno e ainda função base de apoio ideal para assistir filmes ou realizar apresentações. É a melhor opção devido a sua resistência, compatibilidade e seu design elegante, tudo para proteger e embelezar o seu iPad Air! Vale a pena adquirir o seu!'),(20,'Capa para New iPad Angry Birds Gear4 Preto',79.9,'Capa para iPad (4Ger), New iPad (3Ger) e iPad 2 versão Angry Birds (Black Bomb) para usar junto com smart cover Apple. Permite utilizar câmera. Acesso aos plugs e conexões. Feita de policarbonato de alta resistência, essa capa proporciona uma combinação incrível de boa aparência, protege e prolonga a vida útil do seu aparelho. Possui design moderno e sofisticado, cobertura, estilo, qualidade e encaixa perfeitamente nas curvas de seu aparelho. Além de um perfil extremamente fino e leve o que garante maior conforto para uso e manuseio do dia a dia. A capa é rígida e protege as costas e as laterais de seu aparelho, proporcionando acesso completo a todas as portas e funções. Confira e torne seu iPad tão pessoal por fora quanto ele já é por dentro com a Angry Birds, a marca de sucesso mundial!');
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

-- Dump completed on 2014-12-06 18:22:44
