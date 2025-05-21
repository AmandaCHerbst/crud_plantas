create database siga;
use siga;

create table atividade(
id int auto_increment primary key,
descricao varchar(250),
peso decimal(16,2),
anexo varchar(250) );


CREATE TABLE planta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(250),
    tipo VARCHAR(100),
    finalidade VARCHAR(100),
    ambiente VARCHAR(100),
    cuidados TEXT
);



select * from atividade;
-- script de criação do banco de dados