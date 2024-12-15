DROP DATABASE IF EXISTS projeto_web;
CREATE DATABASE projeto_web;
USE projeto_web;
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    foto_perfil VARCHAR(255),
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

INSERT INTO usuarios (nome, email, senha, foto_perfil) VALUES ("João Souto","joaozinho@gmail.com","senhaForte","../img/profiles/perfil_1.jpeg");
INSERT INTO publicacoes (id_usuario, descricao, anexo) VALUES (1,"Bem vindo!", "../img/posts/publicacao_1.png");