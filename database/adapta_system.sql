-- Criação do banco
CREATE DATABASE adapta_system;
USE adapta_system;

CREATE TABLE adaptacoes (
    id_adaptacao INT NOT NULL AUTO_INCREMENT,
    tipo ENUM('audio descricao','alto_contraste','ampliacao de texto','text-to-speech','leitor de tela') DEFAULT NULL,
    descricao TEXT DEFAULT NULL,
    id_aluno INT NOT NULL,
    id_atividade INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_adaptacao),
    KEY id_aluno (id_aluno),
    KEY id_atividade (id_atividade)
);

CREATE TABLE alunos (
    id_aluno INT NOT NULL AUTO_INCREMENT,
    matricula VARCHAR(25) NOT NULL,
    id_pessoa INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_aluno),
    UNIQUE KEY matricula (matricula),
    UNIQUE KEY id_pessoa (id_pessoa)
);

CREATE TABLE alunos_necessidades (
    id_aluno INT NOT NULL,
    id_necessidade INT NOT NULL,
    PRIMARY KEY (id_aluno, id_necessidade),
    KEY id_necessidade (id_necessidade)
);

CREATE TABLE aluno_turma (
    id_aluno INT NOT NULL,
    id_turma INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_aluno, id_turma),
    KEY id_turma (id_turma)
);

CREATE TABLE atividades (
    id_atividade INT NOT NULL AUTO_INCREMENT,
    status ENUM('publicada','em andamento','Concluída','entregue') DEFAULT NULL,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    id_materia INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    arquivo VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (id_atividade),
    KEY id_materia (id_materia)
);

CREATE TABLE atividades_turmas (
    id_atividade INT NOT NULL,
    id_turma INT NOT NULL,
    PRIMARY KEY (id_atividade, id_turma),
    KEY id_turma (id_turma)
);

CREATE TABLE materias (
    id_materia INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_materia)
);

CREATE TABLE necessidades (
    id_necessidade INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_necessidade)
);

CREATE TABLE pessoas (
    id_pessoa INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    cpf VARCHAR(25) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin','professor','aluno') DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_pessoa),
    UNIQUE KEY email (email),
    UNIQUE KEY cpf (cpf)
);

CREATE TABLE professores (
    id_professor INT NOT NULL AUTO_INCREMENT,
    id_pessoa INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_professor),
    UNIQUE KEY id_pessoa (id_pessoa)
);

CREATE TABLE professor_materia (
    id_professor INT NOT NULL,
    id_materia INT NOT NULL,
    PRIMARY KEY (id_professor, id_materia),
    KEY id_materia (id_materia)
);

CREATE TABLE professor_turma (
    id_professor INT NOT NULL,
    id_turma INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_professor, id_turma),
    KEY id_turma (id_turma)
);

CREATE TABLE respostas (
    id_resposta INT NOT NULL AUTO_INCREMENT,
    resposta TEXT NOT NULL,
    id_atividade INT NOT NULL,
    id_aluno INT NOT NULL,
    arquivo VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_resposta),
    KEY id_atividade (id_atividade),
    KEY id_aluno (id_aluno)
);

CREATE TABLE turmas (
    id_turma INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_turma)
);

CREATE TABLE turma_materia (
    id_turma INT NOT NULL,
    id_materia INT NOT NULL,
    PRIMARY KEY (id_turma, id_materia),
    KEY id_materia (id_materia)
);
   
