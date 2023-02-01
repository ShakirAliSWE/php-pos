DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `code` varchar(225) DEFAULT NULL,
  `title` varchar(225) DEFAULT NULL,
  `unit` varchar(225) DEFAULT NULL,
  `buyingPrice` double DEFAULT '0',
  `sellingPrice` double DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `addedAt` datetime DEFAULT NULL,
  `addedBy` int(11) DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(225) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `totalItems` int(11) DEFAULT '0',
  `totalAmount` double DEFAULT '0',
  `addedAt` datetime DEFAULT NULL,
  `addedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `purchases_items`; 

CREATE TABLE `purchases_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchaseId` int(11) DEFAULT NULL,
  `itemId` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT '0',
  `buyingPrice` double DEFAULT '0',
  `sellingPrice` double DEFAULT '0',
  `totalPrice` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `sells`; 
CREATE TABLE `sells` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(225) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `totalItems` int(11) DEFAULT '0',
  `totalAmount` double DEFAULT '0',
  `addedAt` datetime DEFAULT NULL,
  `addedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `sells_items`; 
CREATE TABLE `sells_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sellId` int(11) DEFAULT NULL,
  `itemId` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT '0',
  `buyingPrice` double DEFAULT '0',
  `sellingPrice` double DEFAULT '0',
  `totalPrice` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users`; 

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `addedAt` datetime DEFAULT NULL,
  `addedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`status`,`addedAt`,`addedBy`) values 
(1,'03113003776','$2y$10$iboBGfz7qlJCfSHCZ82znOc7ezODn5r.1U0WOal35r944GQXTemXW',1,'2023-01-31 11:22:49',1);



