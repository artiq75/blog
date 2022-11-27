-- Active: 1669400983478@@127.0.0.1@3306@blog

CREATE DATABASE IF NOT EXISTS blog;

USE blog;

DROP TABLE IF EXISTS posts;

DROP TABLE IF EXISTS categories;

DROP TABLE IF EXISTS users;

CREATE TABLE
    IF NOT EXISTS users (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        username TINYTEXT NOT NULL,
        email TINYTEXT NOT NULL UNIQUE,
        password TINYTEXT NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS categories (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name TINYTEXT NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS posts (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        title TINYTEXT NOT NULL UNIQUE,
        slug TINYTEXT NOT NULL UNIQUE,
        body TEXT NOT NULL,
        is_published BOOLEAN NOT NULL DEFAULT 0,
        created_at INT NOT NULL DEFAULT UNIX_TIMESTAMP(),
        user_id INT,
        category_id INT,
        FOREIGN KEY (user_id) REFERENCES users (id),
        FOREIGN KEY (category_id) REFERENCES categories (id)
    );

INSERT INTO
    users (username, email, password)
VALUES (
        'tariq',
        'tariq@email.dev',
        '$2y$10$j7mfQLgsfQ5Eav8WdfrIZ.vtmVdnirkAg07.r3rE0lDyBsjuP9aj.'
    );

INSERT INTO categories (name)
VALUES ('sport'), ('technologie'), ('politique'), ('gastronomie');

INSERT INTO
    posts (title, slug, body, is_published, user_id, category_id)
VALUES (
        'Les animaux de la forêt noir',
        'les-animaux-de-la-foret-noir',
        'Le corps de l\'article',
        1,
        1,
        2
    ), (
        'La révolution du Metaverse',
        'la-revolution-du-metaverse',
        'Le corps de l\'article',
        1,
        1,
        3
    ), (
        'Comment internet nous influence',
        'comment-internet-nous-influence',
        'Le corps de l\'article',
        1,
        1,
        4
    );