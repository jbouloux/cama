CREATE DATABASE IF NOT EXISTS db_camagru CHARACTER SET 'utf8';
USE db_camagru;
CREATE TABLE t_users
					(id_user INT PRIMARY KEY AUTO_INCREMENT NOT NULL
					, login VARCHAR(32) NOT NULL UNIQUE
					, email VARCHAR(255) NOT NULL UNIQUE
					, confirm_mail VARCHAR(1024)
					, passwd VARCHAR(1024) NOT NULL
					, register_date date NOT NULL
					, avatar_path VARCHAR(255) DEFAULT "default.png"
					, access_right INT
					);

CREATE TABLE t_pics
					(id_pic INT PRIMARY KEY AUTO_INCREMENT NOT NULL
					, name VARCHAR(255) DEFAULT "no_pic"
					, nb_like INT DEFAULT 0
					, id_owner INT DEFAULT 1
					, format VARCHAR(8) NOT NULL
				);

CREATE TABLE t_layers
					(id_layer INT PRIMARY KEY AUTO_INCREMENT NOT NULL
					, layer_path VARCHAR(255) NOT NULL
					, layer_name VARCHAR(255) DEFAULT "No name"
					, nb_usage INT DEFAULT 0
					);

CREATE TABLE t_likes
					(id_like INT PRIMARY KEY AUTO_INCREMENT NOT NULL
					, id_user INT NOT NULL
					, id_pic INT NOT NULL);

CREATE TABLE t_comments
					(id_comment INT PRIMARY KEY AUTO_INCREMENT NOT NULL
					, id_user INT NOT NULL
					, id_pic INT NOT NULL
					, comment VARCHAR(4096) DEFAULT ""
					, comment_date date NOT NULL
					);

-- INSERTION LAYERS DE BASE
INSERT INTO t_layers (layer_path, layer_name) VALUES ("ballon.png", "Ballon");

-- CREATION DU COMPTE ADMIN
INSERT INTO t_users (login, email, confirm_mail, passwd, register_date, access_right) VALUES
			("admin", "jbouloux@student.42.fr", NULL,
			"2f5affe8f11d9bacfe9381d7303d8f5d5d42a5738e00aff595e54506ebbf6000122f527369bc1bce5c86f2a16871b14474289713d5670d3b600690a261a40952", NOW(), 1);
INSERT INTO t_users (login, email, confirm_mail, passwd, register_date, access_right) VALUES
			("test", "test@test.fr", NULL,
			"58c99a1ef13940c320e7872654a322d59c9d3531797f61998d5d04dcc7e0c768194cfe2ef1a86d3e21e920db3c0c6a214d729466b9d91418c65b4e0af92f069b", NOW(), 0);
