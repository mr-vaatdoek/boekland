DROP DATABASE IF EXISTS backendwebshop;

CREATE DATABASE backendwebshop;

USE backendwebshop;

CREATE TABLE `users` (
    id int AUTO_INCREMENT PRIMARY KEY,
    username varchar(100) NOT NULL,
    password varchar(100) NOT NULL,
    email varchar(40) NOT NULL
);



INSERT INTO users (username, password, email) VALUES
('admin1', 'adminadmin1', 'admin1@gmail.com');

