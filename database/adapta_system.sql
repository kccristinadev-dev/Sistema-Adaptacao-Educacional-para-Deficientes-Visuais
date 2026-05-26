-- Criação do banco
CREATE DATABASE adapta_system;
USE adapta_system;


CREATE TABLE pessoas (
   id_pessoa INT PRIMARY KEY AUTO_INCREMENT,
   nome VARCHAR(255) NOT NULL,
   email VARCHAR(255) NOT NULL UNIQUE,
cpf VARCHAR(25) NOT NULL UNIQUE, 
 telefone VARCHAR(20) NOT NULL,
   senha VARCHAR(255) NOT NULL,
tipo ENUM('admin', 'professor', 'aluno'),
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABELA PROFESSORES
CREATE TABLE professores (
   id_professor INT PRIMARY KEY AUTO_INCREMENT,  id_pessoa INT NOT NULL UNIQUE,
 FOREIGN KEY (id_pessoa) REFERENCES pessoas(id_pessoa) ON DELETE CASCADE, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   
);


-- TABELA ALUNOS
CREATE TABLE alunos (
    id_aluno INT PRIMARY KEY AUTO_INCREMENT,
    matricula VARCHAR(25) NOT NULL UNIQUE, id_pessoa INT NOT NULL UNIQUE,
 FOREIGN KEY (id_pessoa) REFERENCES pessoas(id_pessoa) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



-- TABELA TURMAS
CREATE TABLE turmas (
  id_turma INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- MATÉRIA 
CREATE TABLE materias (
  id_materia INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
id_professor INT NOT NULL,
 FOREIGN KEY (id_professor) REFERENCES professores(id_professor) ON DELETE CASCADE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



-- ATIVIDADE 
CREATE TABLE atividades (
  id_atividade INT PRIMARY KEY AUTO_INCREMENT,
status ENUM('publicada', 'em andamento', 'Concluída', 'entregue),
  titulo VARCHAR(255) NOT NULL,
  descricao VARCHAR(300) NOT NULL,
  id_materia INT NOT NULL,
  id_turma INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_materia) REFERENCES materias(id_materia),
  FOREIGN KEY (id_turma) REFERENCES turmas(id_turma)
);

-- NECESSIDADE 
CREATE TABLE necessidades (
  id_necessidade INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  id_aluno INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_aluno) REFERENCES alunos(id_aluno) ON DELETE CASCADE
);



-- ADAPTAÇÃO 
CREATE TABLE adaptacoes (
  id_adaptacao INT PRIMARY KEY AUTO_INCREMENT,
  tipo ENUM ('audio descricao', 'alto_contraste', 'ampliacao de texto, 'text-to-speech', 'leitor de tela'),
  descricao TEXT,
  id_aluno INT NOT NULL,
  id_atividade INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_aluno) REFERENCES alunos(id_aluno) ON DELETE CASCADE,
  FOREIGN KEY (id_atividade) REFERENCES atividades(id_atividade) ON DELETE CASCADE
);


-- TURMA E ALUNOS 
CREATE TABLE aluno_turma (
  id_aluno INT NOT NULL,
  id_turma INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_aluno, id_turma),
  FOREIGN KEY (id_aluno) REFERENCES alunos(id_aluno) ON DELETE CASCADE,
  FOREIGN KEY (id_turma) REFERENCES turmas(id_turma) ON DELETE CASCADE
);