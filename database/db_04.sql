ALTER TABLE `order` ADD status varchar(255);


DROP TABLE IF EXISTS `training`;
CREATE TABLE `training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_name` varchar(30) DEFAULT NULL,
   `description` varchar(255) DEFAULT NULL,
    
    `start_date` date,
    `end_date` date,
    `id_trainer` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


ALTER TABLE training
ADD CONSTRAINT FK_trainer
FOREIGN KEY (id_trainer) REFERENCES user(id) on DELETE CASCADE;




DROP TABLE IF EXISTS `trainee`;
CREATE TABLE `trainee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_training` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
      PRIMARY KEY (`id`)
);


ALTER TABLE trainee
ADD CONSTRAINT FK_training
FOREIGN KEY (id_training) REFERENCES training(id) on DELETE CASCADE;

ALTER TABLE trainee
ADD CONSTRAINT FK_trainingUser
FOREIGN KEY (id_user) REFERENCES user(id) on DELETE CASCADE;

alter TABLE training
add column max_trainees int(11);

alter TABLE training
add column number_trainees int(11);

