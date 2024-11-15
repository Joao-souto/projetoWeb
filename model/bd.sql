DROP DATABASE IF EXISTS projeto_web;
CREATE DATABASE projeto_web;
USE projeto_web;
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE publicacoes (
    id_publicacao INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    descricao VARCHAR(255) NOT NULL,
    anexo VARCHAR(255),
    data_publicacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('ativo', 'excluido', 'pendente') DEFAULT 'ativo',
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

INSERT INTO usuarios (nome, email, senha) VALUES ('João Souto', 'joao.souto@gmail.com', 'senhaTeste1'), ('Gabriel Câmara', 'gabriel.camara@gmail.com', 'senhaTeste2'), ('Adriano', 'adriano@gmail.com', 'senhaTeste3'), ('Sarah', 'sarah@gmail.com', 'senhaTeste4');