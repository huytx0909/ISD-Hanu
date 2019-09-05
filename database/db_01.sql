DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(30) NOT NULL,
  `author_name` varchar(30) NOT NULL,
  `date_publication` date DEFAULT NULL,
  `prize` int(11) DEFAULT NULL,
   `status` varchar(30),
  `max_expired_day` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_image` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` varchar(30),
  `salary` double, 
  `id_role` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `id_department` int(11) DEFAULT NULL,
  `id_team` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `id_department` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_book` int(11) DEFAULT NULL,
  `placeOrder_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

ALTER TABLE user
ADD CONSTRAINT FK_UserRole
FOREIGN KEY (id_role) REFERENCES role(id);

ALTER TABLE user
ADD CONSTRAINT FK_UserDepartment
FOREIGN KEY (id_department) REFERENCES department(id);

ALTER TABLE user
ADD CONSTRAINT FK_UserTeam
FOREIGN KEY (id_team) REFERENCES team(id);

ALTER TABLE book
ADD CONSTRAINT FK_BookCategory
FOREIGN KEY (id_category) REFERENCES category(id);

ALTER TABLE book
ADD CONSTRAINT FK_BookImage
FOREIGN KEY (id_image) REFERENCES image(id);

ALTER TABLE team
ADD CONSTRAINT FK_TeamDepartment
FOREIGN KEY (id_department) REFERENCES department(id);

ALTER TABLE `order`
ADD CONSTRAINT FK_OrderUser
FOREIGN KEY (id_user) REFERENCES user(id);

ALTER TABLE `order`
ADD CONSTRAINT FK_OrderBook
FOREIGN KEY (id_book) REFERENCES book(id);

