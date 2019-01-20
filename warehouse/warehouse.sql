-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table warehouse.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(50) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `image` longblob,
  `purchase_price` decimal(10,2) NOT NULL,
  `sell_price` decimal(10,2) NOT NULL,
  `count` int(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productName` (`productName`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.products: 13 rows
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `productName`, `description`, `image`, `purchase_price`, `sell_price`, `count`) VALUES
	(1, 'table', 'wood', _binary 0x393135313034393433333131382E6A7067, 200.00, 250.00, 10),
	(2, 'stuff', '', _binary '', 15.50, 20.50, 50),
	(3, 'chair', 'wood', _binary '', 35.00, 50.00, 100),
	(4, 'wardrobe', '', _binary '', 260.50, 299.99, 32),
	(108, 'curtains', 'white', _binary 0x393434343139393639343336362E6A7067, 50.00, 67.40, 20),
	(109, 'carpet', '160/100', _binary '', 98.40, 120.90, 30),
	(111, 'coffee table', '', _binary '', 123.00, 150.00, 50),
	(112, 'sofa', '', _binary '', 980.00, 1199.90, 30);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table warehouse.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table warehouse.users: ~7 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `number`) VALUES
	(9, 'test_TEST', '495b3b9c944be4e2e0bb43ed0739b0ff', 'test_TEST@test.bg', '123');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
