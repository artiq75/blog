-- Active: 1668415348532@@127.0.0.1@3306@blog

CREATE DATABASE IF NOT EXISTS blog;

USE blog;

DROP TABLE IF EXISTS posts;

DROP TABLE IF EXISTS users;

CREATE TABLE
    IF NOT EXISTS users (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        username TINYTEXT NOT NULL,
        email TINYTEXT NOT NULL UNIQUE,
        password TINYTEXT NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS posts (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        title TINYTEXT NOT NULL UNIQUE,
        slug TINYTEXT NOT NULL UNIQUE,
        body TEXT NOT NULL,
        created_at INT NOT NULL DEFAULT UNIX_TIMESTAMP(),
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE
        SET NULL
    );

INSERT INTO
    users (username, email, password)
VALUES (
        'tariq',
        'tariq@email.dev',
        'password'
    );

INSERT INTO
    posts (title, slug, body, user_id)
VALUES (
        'Les animaux de la forêt noir',
        'les-animaux-de-la-foret-noir',
        'Le corps de l\'article',
        1
    ), (
        'La révolution du Metaverse',
        'la-revolution-du-metaverse',
        'Le corps de l\'article',
        1
    ), (
        'Comment internet nous influence',
        'comment-internet-nous-influence',
        'Le corps de l\'article',
        1
    );