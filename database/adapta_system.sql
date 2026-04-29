-- Criação do banco
CREATE DATABASE adapta_system;
USE adapta_system;



-- Tabela de professores 
CREATE TABLE professores (
   id_professor INT PRIMARY KEY AUTO_INCREMENT,
   nome VARCHAR(255) NOT NULL,
   email VARCHAR(255) NOT NULL UNIQUE,
   senha VARCHAR(255) NOT NULL,
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
