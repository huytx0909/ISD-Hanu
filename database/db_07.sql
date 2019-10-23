ALTER TABLE user
ADD id_image int(11);

ALTER TABLE user
ADD CONSTRAINT FK_UserImage
FOREIGN KEY (id_image) REFERENCES image(id) on DELETE CASCADE;


ALTER TABLE `user`
CHANGE `salary` `gross_salary` varchar(255);

ALTER TABLE `user`
ADD `net_salary` varchar(255);

DROP TABLE IF EXISTS `salary_deduction`;
CREATE TABLE `salary_deduction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `deduction_amount` varchar(255),
  `deduction_reason` varchar(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;



ALTER TABLE `salary_deduction`
ADD CONSTRAINT FK_UserSalary
FOREIGN KEY (id_user) REFERENCES user(id) on DELETE CASCADE;

ALTER TABLE `salary_deduction`
ADD `deduction_date` date;


DROP TABLE IF EXISTS `announcement`;
CREATE TABLE `announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255),
  `content` varchar(255),
  `date_created` varchar(255),
  `announcer` varchar(255),  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;




CREATE TABLE `password_reset_temp` (
  `email` varchar(250) NOT NULL,
  `key` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
)



ALTER TABLE `announcement` CHANGE `content` `content` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;