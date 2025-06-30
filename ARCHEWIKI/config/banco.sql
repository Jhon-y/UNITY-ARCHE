CREATE DATABASE arche;
USE arche;

-- Tabela de Usuário
CREATE TABLE usuario (
    idU INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45),
    email VARCHAR(45),
    senha VARCHAR(45)
);
ALTER TABLE usuario ADD tipo VARCHAR(20);

-- Tabela de Saves
CREATE TABLE saves (
    idS INT PRIMARY KEY,
    idU INT,
    descS VARCHAR(45),
    FOREIGN KEY (idU) REFERENCES usuario(idU)
);
ALTER TABLE saves MODIFY idS INT NOT NULL AUTO_INCREMENT;
alter table saves add column progresso varchar(45);

-- Tabela de Personagem
CREATE TABLE personagem (
    idP INT PRIMARY KEY,
    ascendencia VARCHAR(45),
    tipoP VARCHAR(45),
    idS INT,
    nomePersonagem VARCHAR(45),
    vida INT,
    FOREIGN KEY (idS) REFERENCES saves(idS)
);

-- Tabela de Habilidade
CREATE TABLE habilidade (
    idH INT PRIMARY KEY,
    descH VARCHAR(45),
    tipoH VARCHAR(45),
    efeito VARCHAR(45)
);
ALTER TABLE habilidade MODIFY idH INT NOT NULL AUTO_INCREMENT;

-- Tabela de relacionamento Personagem x Habilidade
CREATE TABLE personagemHabilidade (
    idP INT,
    idH INT,
    PRIMARY KEY (idP, idH),
    FOREIGN KEY (idP) REFERENCES personagem(idP),
    FOREIGN KEY (idH) REFERENCES habilidade(idH)
);