CREATE DATABASE IF NOT EXISTS appDb CHARACTER SET utf8 COLLATE utf8_general_ci;
USE appDb;

CREATE TABLE IF NOT EXISTS sorts (
id INT NOT NULL AUTO_INCREMENT,
name TEXT NOT NULL,
PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS prices(
id INT NOT NULL AUTO_INCREMENT,
name TEXT NOT NULL,
price INT NOT NULL,
PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS users (
  id INT NOT NULL AUTO_INCREMENT,
  username TEXT NOT NULL,
  password TEXT NOT NULL,
  PRIMARY KEY (id)
);

INSERT IGNORE INTO users (username, password) VALUES ('user', '$apr1$ghioJb4j$eEZ1YLmYHT0Fu9Z/4rk3E0');


INSERT IGNORE INTO sorts (name) VALUES ('Арабика');
INSERT IGNORE INTO sorts (name) VALUES ('Робуста');
INSERT IGNORE INTO sorts (name) VALUES ('Либерика');
INSERT IGNORE INTO sorts (name) VALUES ('Эксцельса');
INSERT IGNORE INTO sorts (name) VALUES ('Стенофила');

INSERT IGNORE INTO prices(name, price) VALUES ('Латте',200);
INSERT IGNORE INTO prices(name, price) VALUES ('Раф',150);
INSERT IGNORE INTO prices(name, price) VALUES ('Капучино',300);





CREATE TABLE IF NOT EXISTS coffees (
  id INT NOT NULL AUTO_INCREMENT,
  name TEXT NOT NULL,
  price INT NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS desserts (
  id INT NOT NULL AUTO_INCREMENT,
  name TEXT NOT NULL,
  price INT NOT NULL,
  PRIMARY KEY (id)
);


INSERT INTO coffees (name, price) VALUES
('Cappuccino', 120),
('Espresso', 100),
('Americano', 90),
('Latte', 110);

INSERT INTO desserts (name, price) VALUES
('Cheesecake', 80),
('Donut', 50),
('Eclair', 50);