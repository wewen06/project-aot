-- Jalankan file ini di phpMyAdmin atau terminal MySQL

CREATE DATABASE IF NOT EXISTS aot_website;
USE aot_website;

-- Tabel users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel characters
CREATE TABLE characters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    affiliation VARCHAR(100),
    rank VARCHAR(50),
    image_url VARCHAR(255)
);

-- Tabel battles
CREATE TABLE battles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(100),
    winner VARCHAR(100),
    date DATE
);

-- Tabel episodes
CREATE TABLE episodes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    season INT,
    episode_number INT,
    air_date DATE
);

-- Data contoh
INSERT INTO users (username, password, role) VALUES
('admin', MD5('admin123'), 'admin'),
('e_yeager', MD5('tatakae'), 'user');

INSERT INTO characters (name, affiliation, rank) VALUES
('Eren Yeager', 'Survey Corps', 'Soldier'),
('Levi Ackerman', 'Survey Corps', 'Captain'),
('Mikasa Ackerman', 'Survey Corps', 'Soldier');

INSERT INTO battles (name, location, winner, date) VALUES
('Battle of Trost', 'Trost District', 'Humanity', '845-01-01'),
('Return to Shiganshina', 'Shiganshina', 'Survey Corps', '850-01-01');

INSERT INTO episodes (title, season, episode_number, air_date) VALUES
('To You, in 2000 Years', 1, 1, '2013-04-07'),
('The Dawn of Humanity', 4, 28, '2021-01-10');