

ALTER TABLE book
MODIFY prize varchar(255);



ALTER TABLE image
MODIFY url varchar(255);


ALTER TABLE user
MODIFY salary varchar(255);

ALTER TABLE user
ADD fullName varchar(255);

ALTER TABLE user
ADD level varchar(255);



alter table `user` drop foreign key `FK_UserRole`;
ALTER TABLE `user` DROP FOREIGN KEY `FK_UserDepartment`;
ALTER TABLE `user` DROP FOREIGN KEY `FK_UserTeam`;
ALTER TABLE `book` DROP FOREIGN KEY `FK_BookCategory`;
ALTER TABLE `book` DROP FOREIGN KEY `FK_BookImage`;
ALTER TABLE `team` DROP FOREIGN KEY `FK_TeamDepartment`;
ALTER TABLE `order` DROP FOREIGN KEY `FK_OrderUser`;
ALTER TABLE `order` DROP FOREIGN KEY `FK_OrderBook`;





ALTER TABLE user
ADD CONSTRAINT FK_UserRole
FOREIGN KEY (id_role) REFERENCES role(id) on DELETE CASCADE;

ALTER TABLE user
ADD CONSTRAINT FK_UserDepartment
FOREIGN KEY (id_department) REFERENCES department(id)on DELETE CASCADE;

ALTER TABLE user
ADD CONSTRAINT FK_UserTeam
FOREIGN KEY (id_team) REFERENCES team(id) on DELETE CASCADE;

ALTER TABLE book
ADD CONSTRAINT FK_BookCategory
FOREIGN KEY (id_category) REFERENCES category(id) on DELETE CASCADE;

ALTER TABLE book
ADD CONSTRAINT FK_BookImage
FOREIGN KEY (id_image) REFERENCES image(id) on DELETE CASCADE;

ALTER TABLE team
ADD CONSTRAINT FK_TeamDepartment
FOREIGN KEY (id_department) REFERENCES department(id) on DELETE CASCADE;

ALTER TABLE `order`
ADD CONSTRAINT FK_OrderUser
FOREIGN KEY (id_user) REFERENCES user(id) on DELETE CASCADE;

ALTER TABLE `order`
ADD CONSTRAINT FK_OrderBook
FOREIGN KEY (id_book) REFERENCES book(id) on DELETE CASCADE;
