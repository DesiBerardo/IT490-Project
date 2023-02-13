CREATE DATABASE userdb;
USE userdb;
CREATE TABLE users (id int NOT NULL AUTO_INCREMENT, username CHAR(12), pass CHAR(64), primary key(id));
INSERT INTO users (username, pass)
VALUES('testuser', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5');
