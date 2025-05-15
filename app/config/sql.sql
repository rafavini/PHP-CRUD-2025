create database turma31;
use turma31;
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(128) NOT NULL,
    email VARCHAR(254) UNIQUE,
    role INT NOT NULL,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    date_joined DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_login DATETIME,
    profile_image VARCHAR(255) DEFAULT NULL
);


create table roles(
	id INT AUTO_INCREMENT PRIMARY KEY,
    name varchar(100) not null unique,
    is_active BOOLEAN NOT NULL DEFAULT TRUE
);


insert into roles(name) values("admin");
insert into roles(name) values("normal");
insert into usuario(username, password,email, role) values("rafavini","1234", "rafaelgerminari@gmail.com", 1);
insert into usuario(username, password, email,role) values("normal","1234","normal@gmail.com",2);