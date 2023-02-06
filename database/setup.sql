CREATE DATABASE userdb;
USE userdb;
CREATE TABLE users (id int NOT NULL AUTO_INCREMENT, username CHAR(12), pass CHAR(64), primary key(id));
INSERT INTO users (username, pass)
VALUES('testuser', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92');