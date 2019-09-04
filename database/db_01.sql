CREATE TABLE user (
id INT(11)  AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL,
email VARCHAR(50),
phone varchar(30),
role varchar(30),
date_created date,
id_department int(11),
id_team int(11)
);

CREATE TABLE book (
id INT(11)  AUTO_INCREMENT PRIMARY KEY,
book_title VARCHAR(30) NOT NULL,
author_name VARCHAR(30) NOT NULL,
date_publication date,
prize int(11),
max_expired_day int(11),
id_category int(11)
);