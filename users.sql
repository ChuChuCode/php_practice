CREATE TABLE users(
	user_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    user_first varchar(256) not null,
	user_last varchar(256) not null,
	user_email varchar(256) not null,
    user_userid varchar(256) not null,
    user_pwd varchar(256) not null
);

INSERT INTO users (user_first,user_last,user_email,user_userid,user_pwd)
VALUES ("Keriwn","Chu","kerwinchu@gmail.com","kerwinchu","test123");