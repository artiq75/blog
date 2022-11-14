-- Active: 1668415348532@@127.0.0.1@3306@blog

CREATE DATABASE IF NOT EXISTS blog;

USE blog;

DROP TABLE IF EXISTS posts;

CREATE TABLE
    IF NOT EXISTS posts (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        title TINYTEXT NOT NULL UNIQUE,
        slug TINYTEXT NOT NULL UNIQUE,
        body TEXT NOT NULL,
        created_at INT NOT NULL DEFAULT UNIX_TIMESTAMP()
    );

INSERT INTO
    posts (title, slug, body)
VALUES (
        'Les animaux de la forêt noir',
        'les-animaux-de-la-foret-noir',
        'Le corps de l\'article'
    ), (
        'La révolution du Metaverse',
        'la-revolution-du-metaverse',
        'Le corps de l\'article'
    ), (
        'Comment internet nous influence',
        'comment-internet-nous-influence',
        'Le corps de l\'article'
    );