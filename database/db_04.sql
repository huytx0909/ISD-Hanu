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


DROP TABLE IF EXISTS `holiday`;
CREATE TABLE `holiday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS `leave_application`
CREATE TABLE `leave_application`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
   `id_user` int(11) NOT NULL,
  `leave_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `application_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

ALTER TABLE leave_application
ADD CONSTRAINT FK_UserLeaveApp
FOREIGN KEY (id_user) REFERENCES user(id) on DELETE CASCADE;

ALTER TABLE `leave_application`
ADD personal_reason varchar(255) DEFAULT NULL;

DROP TABLE IF EXISTS `task`;
CREATE TABLE `task`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
   `id_team` int(11) NOT NULL,
  `task_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

ALTER TABLE `task`
ADD CONSTRAINT FK_TeamTask
FOREIGN KEY (id_team) REFERENCES team(id) on DELETE CASCADE;



DROP TABLE IF EXISTS `employee_award`;
CREATE TABLE `employee_award`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
   `id_user` int(11) NOT NULL,
  `award_title` varchar(255) DEFAULT NULL,
  `gift_item` varchar(255) DEFAULT NULL,
  `award_amount` varchar(255) DEFAULT NULL,
  `award_date` date DEFAULT NULL,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

ALTER TABLE `employee_award`
ADD CONSTRAINT FK_UserAward
FOREIGN KEY (id_user) REFERENCES user(id) on DELETE CASCADE;