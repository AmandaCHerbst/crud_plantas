create database atv_sigaa;
use atv_sigaa;

create table atividade(
id int auto_increment primary key,
descricao VARCHAR(250),
peso decimal(16,2),
anexo VARCHAR(250)
);

select * from atividade;
-- script de criação do banco de dados

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150),
    matricula VARCHAR(50),
    data_nascimento DATE,
    login VARCHAR(100),
    senha VARCHAR(100)
);

CREATE TABLE planta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(250),
    tipo VARCHAR(100),
    finalidade VARCHAR(250),
    ambiente VARCHAR(250),
    cuidados TEXT,
    anexo VARCHAR(250)
);

